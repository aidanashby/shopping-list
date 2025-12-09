<?php
/**
 * GitHub updater integration.
 */
class Shopping_List_Updater {
    private $plugin_file;
    private $version;
    private $repository;
    private $plugin_basename;
    private $slug;

    public function __construct($plugin_file, $version, $repository) {
        $this->plugin_file = $plugin_file;
        $this->version = $version;
        $this->repository = $repository;
        $this->plugin_basename = plugin_basename($plugin_file);

        $dirname = dirname($this->plugin_basename);
        $this->slug = $dirname === '.' ? basename($this->plugin_basename, '.php') : $dirname;
    }

    public function init_hooks() {
        add_filter('pre_set_site_transient_update_plugins', array($this, 'check_for_update'));
        add_filter('plugins_api', array($this, 'plugin_info'), 10, 3);
        add_filter('upgrader_post_install', array($this, 'upgrader_post_install'), 10, 3);
    }

    public function check_for_update($transient) {
        if (empty($transient->checked)) {
            return $transient;
        }

        $release = $this->get_latest_release();

        if (!$release || empty($release['version']) || empty($release['zipball']) || version_compare($release['version'], $this->version, '<=')) {
            return $transient;
        }

        $transient->response[$this->plugin_basename] = (object) array(
            'slug' => $this->slug,
            'plugin' => $this->plugin_basename,
            'new_version' => $release['version'],
            'package' => $release['zipball'],
            'url' => $release['url'],
            'tested' => get_bloginfo('version'),
            'requires' => '5.0',
            'icons' => array(),
            'banners' => array()
        );

        return $transient;
    }

    public function plugin_info($false, $action, $args) {
        if ($action !== 'plugin_information' || empty($args->slug) || $args->slug !== $this->slug) {
            return $false;
        }

        $release = $this->get_latest_release();

        if (!$release) {
            return new WP_Error('shopping_list_updater', __('Unable to retrieve plugin information at this time.', 'shopping-list'));
        }

        if (!function_exists('get_file_data')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        $plugin_data = get_file_data($this->plugin_file, array(
            'Name' => 'Plugin Name',
            'Author' => 'Author',
            'Description' => 'Description',
            'Version' => 'Version',
            'PluginURI' => 'Plugin URI'
        ));

        $version = $release && !empty($release['version']) ? $release['version'] : $this->version;

        return (object) array(
            'name' => $plugin_data['Name'],
            'slug' => $this->slug,
            'version' => $version,
            'author' => $plugin_data['Author'],
            'homepage' => $plugin_data['PluginURI'] ?: $release['url'],
            'download_link' => $release['zipball'],
            'sections' => array(
                'description' => $plugin_data['Description']
            )
        );
    }

    public function upgrader_post_install($result, $hook_extra, $extra) {
        if (!isset($hook_extra['plugin']) || $hook_extra['plugin'] !== $this->plugin_basename) {
            return $result;
        }

        global $wp_filesystem;

        $plugin_folder = trailingslashit(WP_PLUGIN_DIR) . $this->slug . '/';

        if (isset($result['destination']) && $result['destination'] !== $plugin_folder) {
            if ($wp_filesystem->exists($plugin_folder)) {
                $wp_filesystem->delete($plugin_folder, true);
            }
            $wp_filesystem->move($result['destination'], $plugin_folder);
            $result['destination'] = $plugin_folder;
        }

        $this->maybe_reactivate_plugin();

        return $result;
    }

    private function maybe_reactivate_plugin() {
        $active_plugins = get_option('active_plugins', array());
        if (in_array($this->plugin_basename, $active_plugins, true)) {
            activate_plugin($this->plugin_basename);
        }
    }

    private function get_latest_release() {
        $cached = get_site_transient('shopping_list_github_release');

        if ($cached) {
            return $cached;
        }

        $api_url = sprintf('https://api.github.com/repos/%s/releases/latest', $this->repository);
        $response = wp_remote_get($api_url, array(
            'headers' => array(
                'Accept' => 'application/vnd.github+json',
                'User-Agent' => 'shopping-list-plugin'
            )
        ));

        if (is_wp_error($response)) {
            return null;
        }

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        if (empty($data) || !is_array($data)) {
            return null;
        }

        $version = isset($data['tag_name']) ? ltrim($data['tag_name'], 'v') : '';
        $release = array(
            'version' => $version,
            'zipball' => isset($data['zipball_url']) ? $data['zipball_url'] : '',
            'url' => isset($data['html_url']) ? $data['html_url'] : ''
        );

        set_site_transient('shopping_list_github_release', $release, 12 * HOUR_IN_SECONDS);

        return $release;
    }
}
