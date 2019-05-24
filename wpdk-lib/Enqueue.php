<?php

/***
 * Enqueue Css and js
 */

class Enqueue
{

    /** Array of scripts */
    private $public_scripts = [];

    /** Array of styles */
    private $public_styles = [];

    /** Array of scripts */
    private $admin_scripts = [];

    /** Array of styles */
    private $admin_styles = [];

    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_front_scripts'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
    }

    public function enqueue_front_scripts()
    {
        $public_scripts = apply_filters('wpdk_enqueue_public_scripts', $this->public_scripts);

        $this->enqueue_scripts($public_scripts);

        $public_styles = apply_filters('wpdk_enqueue_public_style', $this->public_styles);

        $this->enqueue_styles($public_styles);
    }

    public function enqueue_admin_scripts()
    {
        $admin_scripts = apply_filters('wpdk_enqueue_admin_scripts', $this->admin_scripts);

        $this->enqueue_scripts($admin_scripts);

        $admin_styles = apply_filters('wpdk_enqueue_admin_style', $this->admin_styles);

        $this->enqueue_styles($admin_styles);
    }

    protected function enqueue_scripts($scripts = [])
    {
        if (!empty($scripts)) {
            foreach ($scripts as $script) {
                $handle = ($script['handle']) ? $script['handle'] : '';

                $src = ($script['src']) ? $script['src'] : '';

                $deps = ($script['deps']) ? $script['deps'] : false;

                $ver = ($script['ver']) ? $script['ver'] : false;

                $in_footer = ($script['in_footer']) ? $script['in_footer'] : false;

                if ($handle) {
                    wp_enqueue_script($handle, $src, $deps, $ver, $in_footer);
                }
            }
        }
    }

    protected function enqueue_styles($styles = [])
    {
        if (!empty($styles)) {
            foreach ($styles as $style) {
                $handle = ($style['handle']) ? $style['handle'] : '';

                $src = ($style['src']) ? $style['src'] : '';

                $deps = ($style['deps']) ? $style['deps'] : false;

                $ver = ($style['ver']) ? $style['ver'] : false;

                $media = ($style['media']) ? $style['media'] : 'all';

                if ($handle) {
                    wp_enqueue_style($handle, $src, $deps, $ver, $media);
                }
            }
        }
    }
}

new Enqueue();
