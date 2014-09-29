<?php
namespace TEDxTheme\CustomPostTypes;

class Partner {

  function __construct () {
    add_action('init', array($this, 'add_custom_post_type'));
    add_action('init', array($this, 'add_partner_types_taxonomy'));

    add_image_size('partner', 370, 370, true);
    add_image_size('partner_thumb', 100, 57, true);

    add_filter('enter_title_here', array($this, 'custom_title_text'));

    $this->register_acf();
  }

  function register_acf () {
    if (function_exists("register_field_group")) {
      register_field_group(array(
        'id'         => 'acf_partner',
        'title'      => 'Partner',
        'fields'     => array(
          array(
            'key'           => 'field_54282d75d4007',
            'label'         => 'Website URL',
            'name'          => 'website_url',
            'type'          => 'text',
            'instructions'  => 'eg. http://www.bill.li (with the http://)',
            'default_value' => '',
            'placeholder'   => '',
            'prepend'       => '',
            'append'        => '',
            'formatting'    => 'none',
            'maxlength'     => '',
          ),
        ),
        'location'   => array(
          array(
            array(
              'param'    => 'post_type',
              'operator' => '==',
              'value'    => 'partner',
              'order_no' => 0,
              'group_no' => 0,
            ),
          ),
        ),
        'options'    => array(
          'position'       => 'normal',
          'layout'         => 'default',
          'hide_on_screen' => array(
            0 => 'the_content',
            1 => 'excerpt',
            2 => 'send-trackbacks',
          ),
        ),
        'menu_order' => 0,
      ));
    }
  }

  function add_custom_post_type () {
    // Labels
    $partner_labels = array(
      'name'          => __('Partners'),
      'singular_name' => __('Partner'),
      'add_new'       => __('Add New'),
      'all_items'     => __('All Partners'),
      'add_new_item'  => __('Add New Partner'),
      'edit_item'     => __('Edit Partner'),
      'new_item'      => __('New Partner'),
      'view_item'     => __('View Partner'),
      'search_items'  => __('Search Partners'),
      'not_found'     => __('No Partners Found')
    );
    // Settings
    $partner_settings = array(
      'labels'        => $partner_labels,
      'public'        => true,
      'menu_icon'     => get_stylesheet_directory_uri() . '/dist/images/custom-post-types/partner.png',
      'query_var'     => 'partners',
      'menu_position' => null,
      'taxonomies'    => array('event_year'),
      'supports'      => array('title', 'editor', 'thumbnail', 'excerpt', 'trackbacks', 'revisions', 'page-attributes'),
    );
    register_post_type('partner', $partner_settings);
  }

  function add_partner_types_taxonomy () {
    register_taxonomy(
      'partner_types',
      'partner',
      array(
        'label'             => __('Partner Types'),
        'show_in_nav_menus' => true,
        'show_ui'           => true,
        'hierarchical'      => true,
        'rewrite'           => array('slug' => 'partner-type'),
        'query_var'         => 'partner_type'
      ));
  }

  function custom_title_text ($title) {
    $screen = get_current_screen();
    if ($screen->post_type == 'partner') {
      $title = 'Enter partner name (eg. TWG)';
    }

    return $title;
  }
}