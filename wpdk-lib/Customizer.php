<?php

/**
 * Create Customize option with hook.
 */

class Customizer
{
    private $wp_customize;

    private $section_array = [];

    public function __construct()
    {
        add_action('customize_register', array($this, 'register'));
    }

    public function register($wp_customize)
    {
        $this->wp_customize = $wp_customize;
        $this->register_options();

        return $this->wp_customize;
    }

    public function register_options()
    {
        $sections = apply_filters('wpdk_register_theme_option', $this->section_array);
        if (count($sections) == count($sections, COUNT_RECURSIVE)) {
            if ($sections['panel']) {
                $this->register_panel($sections['panel']);
            }
            if ($sections['section']) {
                $panelid = $sections['section']['id'] ? $sections['section']['id'] : '';
                $this->register_section($sections['section'], $panelid);
            }
            if ($sections['setting']) {
                $this->register_setting($sections['setting']);
            }
            if ($sections['control']) {
                $sectionid = $sections['control']['section'] ? $sections['control']['section'] : '';
                $settingid = $sections['control']['setting'] ? $sections['control']['setting'] : '';
                $this->register_setting($sections['control'], $sectionid, $settingid);
            }
        } else {
            foreach ($sections as $key => $value) {
                if ($value['panel']) {
                    $this->register_panel($value['panel']);
                }
                if ($value['section']) {
                    $panelid = $value['panel']['id'] ? $value['panel']['id'] : '';
                    $this->register_section($value['section'], $panelid);
                }
                if ($value['setting']) {
                    $this->register_setting($value['setting']);
                }

                if ($value['control']) {
                    $sectionid = $value['control']['section'] ? $value['control']['section'] : '';
                    $settingid = $value['control']['setting'] ? $value['control']['setting'] : '';
                    $this->register_control($value['control'], $sectionid, $settingid);
                }
            }
        }
    }

    public function register_panel($panel)
    {
        $this->wp_customize->add_panel($panel['id'], array(
            'title' => sprintf(__('%s'), $panel['title']),
            'description' => sprintf(__('%s'), $panel['description']),
            'priority' => $panel['priority'] ? $panel['priority'] : 160,
        ));
    }

    public function register_section($section, $panelid = false)
    {
        $this->wp_customize->add_section($section['id'], array(
            'title' => sprintf(__('%s'), $section['title']),
            'panel' => $panelid ? $panelid : 'title_tagline',
            'priority' => $section['priority'] ? $section['priority'] : 30,
        ));
    }

    public function register_setting($setting)
    {
        $this->wp_customize->add_setting($setting['id'], array(
            'default' => $setting['default'] ? $setting['default'] : '',
            'transport' => $setting['transport'] ? $setting['transport'] : 'refresh',
        ));
    }

    public function register_control($control, $sectionid = false, $settingid = false)
    {
        $type = trim($control['type']);
        if ($type != '' && method_exists($this, "generate_{$type}_section")) {
            call_user_func(array($this, "generate_{$type}_section"), $control, $sectionid, $settingid);
        } else {
            $this->wp_customize->add_control($control['id'], array(
            'label' => sprintf(__('%s'), $control['title']),
            'section' => $sectionid ? $sectionid : 'title_tagline', //title_tagline
            'setting' => $settingid,
            'type' => $type ? $type : 'text', ));
        }
    }

    public function generate_image_section($control, $sectionid = false, $settingid = false)
    {
        $this->wp_customize->add_control(new WP_Customize_Image_Control($this->wp_customize, $control['id'], array(
                    'label' => sprintf(__('%s'), $control['title']),
                    'section' => $sectionid ? $sectionid : 'title_tagline', //title_tagline
                    'setting' => $settingid, )));
    }

    public function generate_upload_section($control, $sectionid = false, $settingid = false)
    {
        $this->wp_customize->add_control(new WP_Customize_Upload_Control($this->wp_customize, $control['id'], array(
                    'label' => sprintf(__('%s'), $control['title']),
                    'section' => $sectionid ? $sectionid : 'title_tagline', //title_tagline
                    'setting' => $settingid, )));
    }

    public function generate_color_section($control, $sectionid = false, $settingid = false)
    {
        $this->wp_customize->add_control(new WP_Customize_Color_Control($this->wp_customize, $control['id'], array(
                    'label' => sprintf(__('%s'), $control['title']),
                    'section' => $sectionid ? $sectionid : 'title_tagline', //title_tagline
                    'setting' => $settingid, )));
    }

    public function generate_menu_location_section($control, $sectionid = false, $settingid = false)
    {
        $this->wp_customize->add_control(new WP_Customize_Nav_Menu_Locations_Control($this->wp_customize, $control['id'], array(
                    'label' => sprintf(__('%s'), $control['title']),
                    'section' => $sectionid ? $sectionid : 'title_tagline', //title_tagline
                    'setting' => $settingid, )));
    }

    public function generate_code_section($control, $sectionid = false, $settingid = false)
    {
        $this->wp_customize->add_control(new WP_Customize_Code_Editor_Control($this->wp_customize, $control['id'], array(
                    'label' => sprintf(__('%s'), $control['title']),
                    'section' => $sectionid ? $sectionid : 'title_tagline', //title_tagline
                    'setting' => $settingid, )));
    }

    public function generate_date_section($control, $sectionid = false, $settingid = false)
    {
        $this->wp_customize->add_control(new WP_Customize_Date_Time_Control($this->wp_customize, $control['id'], array(
                    'label' => sprintf(__('%s'), $control['title']),
                    'section' => $sectionid ? $sectionid : 'title_tagline', //title_tagline
                    'setting' => $settingid, )));
    }

    public function generate_media_section($control, $sectionid = false, $settingid = false)
    {
        $this->wp_customize->add_control(new WP_Customize_Media_Control($this->wp_customize, $control['id'], array(
                    'label' => sprintf(__('%s'), $control['title']),
                    'section' => $sectionid ? $sectionid : 'title_tagline', //title_tagline
                    'setting' => $settingid, )));
    }

    public function generate_menu_auto_add_section($control, $sectionid = false, $settingid = false)
    {
        $this->wp_customize->add_control(new WP_Customize_Nav_Menu_Auto_Add_Control($this->wp_customize, $control['id'], array(
                    'label' => sprintf(__('%s'), $control['title']),
                    'section' => $sectionid ? $sectionid : 'title_tagline', //title_tagline
                    'setting' => $settingid, )));
    }

    public function generate_new_menu_section($control, $sectionid = false, $settingid = false)
    {
        $this->wp_customize->add_control(new WP_Customize_New_Menu_Control($this->wp_customize, $control['id'], array(
                    'label' => sprintf(__('%s'), $control['title']),
                    'section' => $sectionid ? $sectionid : 'title_tagline', //title_tagline
                    'setting' => $settingid, )));
    }

    public function generate_checkbox_section($control, $sectionid = false, $settingid = false)
    {
        $this->wp_customize->add_control(new WP_Customize_Control($this->wp_customize, $control['id'], array(
                    'label' => sprintf(__('%s'), $control['title']),
                    'section' => $sectionid ? $sectionid : 'title_tagline', //title_tagline
                    'setting' => $settingid,
                    'type' => $control['type'],
                    'choices' => $control['choices'], )));
    }
}

$customizer = new Customizer();
