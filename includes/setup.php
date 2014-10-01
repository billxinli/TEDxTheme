<?php
namespace TEDxTheme;

// Plugins required for this theme
require_once 'plugins/class-tgm-plugin-activation.php';
require_once 'plugins/taxonomy-dropdown-custom-control.php';

class SetupTheme {
  function __construct () {
    // Hide all visual references to advanced custom fields in the front end when the site goes to production or staging
    //define('ACF_LITE', !WP_DEBUG);

    add_theme_support('post-thumbnails');

    add_action('tgmpa_register', array($this, 'setup_required_plugins'));

    add_action('init', array($this, 'setup_event_year_taxonomy'));

    add_action('customize_register', array($this, 'setup_customize_register'));

    $sidebar_settings = [
      'class'        => 'sidebar',
      'before_title' => '<h4 class="widgettitle">',
      'after_title'  => "</h4>\n"
    ];
    register_sidebar(array_merge($sidebar_settings, ['name' => 'Blog Sidebar', 'id' => 'blog-sidebar']));
    register_sidebar(array_merge($sidebar_settings, ['name' => 'Page Sidebar', 'id' => 'page-sidebar']));
    register_sidebar(array_merge($sidebar_settings, ['name' => 'Home Sidebar', 'id' => 'home-sidebar']));

    register_nav_menu('primary', 'Primary Header Menu');
  }

  function setup_event_year_taxonomy () {
    // create a new taxonomy
    register_taxonomy(
      'event_year',
      array(
        'post',
        'page'
      ),
      array(
        'label'             => __('Event Year'),
        'rewrite'           => array('slug' => 'event_year'),
        'show_in_nav_menus' => false,
        'show_ui'           => true,
        'hierarchical'      => true,
        'query_var'         => 'event_year'
      ));
  }

  function setup_customize_register ($wp_customize) {

    // Section
    $wp_customize->add_section(
      'tedxtheme_event',
      array(
        'title'    => __('TEDx Event Settings'),
        'priority' => 35
      ));













    $wp_customize->add_setting(
      'logo'
    );
    $wp_customize->add_control(
      new \WP_Customize_Image_Control(
        $wp_customize, 'logo', array(
        'priority' => 1,
        'label'    => __('Logo'),
        'section'  => 'tedxtheme_event',
        'settings' => 'logo',
      )));

    $wp_customize->add_setting(
      'logo_link',
      array(
        'default'   => '/',
        'transport' => 'refresh',
      ));
    $wp_customize->add_control(
      'tedxtheme_event_logo_link',
      array(
        'priority' => 2,
        'label'    => __('Logo Link'),
        'section'  => 'tedxtheme_event',
        'settings' => 'logo_link',
        'type'     => 'text'
      ));


    $wp_customize->add_setting(
      'event_name',
      array(
        'default'   => 'TEDxCity',
        'transport' => 'refresh',
      ));
    $wp_customize->add_control(
      'tedxtheme_event_event_name',
      array(
        'priority' => 3,
        'label'    => __('Event Name'),
        'section'  => 'tedxtheme_event',
        'settings' => 'event_name',
        'type'     => 'text'
      ));

    $wp_customize->add_setting(
      'event_date',
      array(
        'default'   => 'Jan 1, 1970',
        'transport' => 'refresh',
      ));
    $wp_customize->add_control(
      'tedxtheme_event_event_date',
      array(
        'priority' => 4,
        'label'    => __('Event Date'),
        'section'  => 'tedxtheme_event',
        'settings' => 'event_date',
        'type'     => 'text'
      ));

    $wp_customize->add_setting(
      'event_location',
      array(
        'default'   => 'Toronto, ON',
        'transport' => 'refresh',
      ));
    $wp_customize->add_control(
      'tedxtheme_event_event_location',
      array(
        'priority' => 5,
        'label'    => __('Event Location'),
        'section'  => 'tedxtheme_event',
        'settings' => 'event_location',
        'type'     => 'text'
      ));

    $wp_customize->add_setting(
      'header_call_out',
      array(
        'default'   => 'Header Call Out',
        'transport' => 'refresh',
      ));
    $wp_customize->add_control(
      'tedxtheme_event_header_call_out',
      array(
        'priority' => 6,
        'label'    => __('Header Call Out'),
        'section'  => 'tedxtheme_event',
        'settings' => 'header_call_out',
        'type'     => 'text'
      ));

    $wp_customize->add_setting(
      'button_call_out_text',
      array(
        'default'   => 'CTA',
        'transport' => 'refresh',
      ));
    $wp_customize->add_control(
      'tedxtheme_event_button_call_out_text',
      array(
        'priority' => 7,
        'label'    => __('Button Call Out Text'),
        'section'  => 'tedxtheme_event',
        'settings' => 'button_call_out_text',
        'type'     => 'text'
      ));

    $wp_customize->add_setting(
      'button_call_out_link',
      array(
        'default'   => '/',
        'transport' => 'refresh',
      ));
    $wp_customize->add_control(
      'tedxtheme_event_button_call_out_link',
      array(
        'priority' => 8,
        'label'    => __('Button Call Out Link'),
        'section'  => 'tedxtheme_event',
        'settings' => 'button_call_out_link',
        'type'     => 'text'
      ));

    $wp_customize->add_setting(
      'promoted_year', array(
        'default' => -1
      )
    );

    $wp_customize->add_control(
      new \Taxonomy_Dropdown_Custom_Control(
        $wp_customize, 'promoted_year', array(
          'priority' => 9,
          'label' => __( 'Promoted Year' ),
          'section' => 'tedxtheme_event',
          'settings' => 'promoted_year',
        ),
        array('taxonomy' => 'event_year')
      )
    );


    // Section
    $wp_customize->add_section(
      'tedxtheme_social',
      array(
        'title'    => __('TEDx Social'),
        'priority' => 36
      ));

    $wp_customize->add_setting(
      'twitter_follow_button',
      array(
        'default'   => '<a href="https://twitter.com/twg" class="twitter-follow-button" data-show-count="false">Follow @twg</a>',
        'transport' => 'refresh',
      ));

    $wp_customize->add_control(
      'tedxtheme_social_twitter_follow_button',
      array(
        'priority' => 8,
        'label'    => __('Twitter Follow Button'),
        'section'  => 'tedxtheme_social',
        'settings' => 'twitter_follow_button',
        'type'     => 'text'
      ));


    $wp_customize->add_setting(
      'twitter_account',
      array(
        'default'   => '@twg',
        'transport' => 'refresh',
      ));
    $wp_customize->add_control(
      'tedxtheme_social_twitter_account',
      array(
        'priority' => 7,
        'label'    => __('Twitter Account'),
        'section'  => 'tedxtheme_social',
        'settings' => 'twitter_account',
        'type'     => 'text'
      ));
  }


  function setup_required_plugins () {
    $plugins = array(
      array(
        'name'               => 'Advanced Custom Fields',
        'slug'               => 'advanced-custom-fields',
        'required'           => true,
        'force_activation'   => true,
        'force_deactivation' => true
      ),
      array(
        'name'               => 'Date and Time Picker Field',
        'slug'               => 'acf-field-date-time-picker',
        'required'           => true,
        'force_activation'   => true,
        'force_deactivation' => true
      ),
      array(
        'name'               => 'Amazon S3 and Cloudfront',
        'slug'               => 'amazon-s3-and-cloudfront',
        'required'           => true,
        'force_activation'   => true,
        'force_deactivation' => true
      ),
      array(
        'name'               => 'Amazon Web Services',
        'slug'               => 'amazon-web-services',
        'required'           => true,
        'force_activation'   => true,
        'force_deactivation' => true
      )
    );

    $config = array(
      'menu'         => 'tgmpa-install-plugins', // Menu slug.
      'has_notices'  => true, // Show admin notices or not.
      'dismissable'  => false, // If false, a user cannot dismiss the nag message.
      'is_automatic' => true // Automatically activate plugins after installation or not.
    );

    tgmpa($plugins, $config);
  }
}