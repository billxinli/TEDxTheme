<?php
namespace TEDxTheme\CustomPostTypes;

class Talk {

  function __construct () {
    add_action('init', array($this, 'add_custom_post_type'));
    add_action('init', array($this, 'add_talk_types_taxonomy'));
    add_action('init', array($this, 'add_talk_categories_taxonomy'));

    add_image_size('talk', 370, 370, true);
    add_image_size('talk_thumb', 100, 57, true);

    add_filter('enter_title_here', array($this, 'custom_title_text'));

    $this->register_acf();
  }

  function register_acf () {
    if (function_exists("register_field_group")) {
      register_field_group(array(
        'id'         => 'acf_talk',
        'title'      => 'Talk',
        'fields'     => array(
          array(
            'key'             => 'field_5425e6101a6e8',
            'label'           => 'Speaker',
            'name'            => 'speaker',
            'type'            => 'relationship',
            'return_format'   => 'object',
            'post_type'       => array(
              0 => 'speaker',
            ),
            'taxonomy'        => array(
              0 => 'all',
            ),
            'filters'         => array(
              0 => 'search',
            ),
            'result_elements' => array(
              0 => 'post_type',
              1 => 'post_title',
            ),
            'max'             => '',
          ),
          array(
            'key'           => 'field_5425e7466fc16',
            'label'         => 'Video ID',
            'name'          => 'video_id',
            'type'          => 'text',
            'instructions'  => 'The ID code that is referenced in the URL of every YouTube video (eg. http://www.youtube.com/watch?v=QRDJnLGBUTI)',
            'default_value' => '',
            'placeholder'   => '',
            'prepend'       => '',
            'append'        => '',
            'formatting'    => 'none',
            'maxlength'     => 20,
          ),
          array(
            'key'           => 'field_5425e75b6fc17',
            'label'         => 'Speaker Role',
            'name'          => 'speaker_role',
            'type'          => 'text',
            'instructions'  => 'The role of the speaker (eg. Author, Musician, Dancer)',
            'default_value' => '',
            'placeholder'   => '',
            'prepend'       => '',
            'append'        => '',
            'formatting'    => 'html',
            'maxlength'     => '',
          ),
        ),
        'location'   => array(
          array(
            array(
              'param'    => 'post_type',
              'operator' => '==',
              'value'    => 'talk',
              'order_no' => 0,
              'group_no' => 0,
            ),
          ),
        ),
        'options'    => array(
          'position'       => 'normal',
          'layout'         => 'default',
          'hide_on_screen' => array(),
        ),
        'menu_order' => 0,
      ));
    }

  }

  function add_custom_post_type () {
    // Labels
    $talk_labels = array(
      'name'          => __('Talks'),
      'singular_name' => __('Talk'),
      'add_new'       => __('Add New'),
      'all_items'     => __('All Talks'),
      'add_new_item'  => __('Add New Talk'),
      'edit_item'     => __('Edit Talk'),
      'new_item'      => __('New Talk'),
      'view_item'     => __('View Talk'),
      'search_items'  => __('Search Talks'),
      'not_found'     => __('No Talks Found')
    );
    // Settings
    $talk_settings = array(
      'labels'        => $talk_labels,
      'public'        => true,
      'menu_icon'     => get_stylesheet_directory_uri() . '/dist/images/custom-post-types/talk.png',
      'query_var'     => 'talks',
      'menu_position' => null,
      'taxonomies'    => array('event_year'),
      'supports'      => array('title', 'editor', 'thumbnail', 'excerpt', 'trackbacks', 'revisions', 'page-attributes'),
    );
    register_post_type('talk', $talk_settings);
  }

  function add_talk_categories_taxonomy () {
    register_taxonomy(
      'talk_categories',
      'talk',
      array(
        'label'             => __('Talk Categories'),
        'show_in_nav_menus' => true,
        'show_ui'           => true,
        'hierarchical'      => true,
        'rewrite'           => array('slug' => 'talk-category'),
        'query_var'         => 'talk_category'
      ));
  }

  function add_talk_types_taxonomy () {
    register_taxonomy(
      'talk_types',
      'talk',
      array(
        'label'             => __('Talk Types'),
        'show_in_nav_menus' => true,
        'show_ui'           => true,
        'hierarchical'      => true,
        'rewrite'           => array('slug' => 'talk-type'),
        'query_var'         => 'talk_type'
      ));
  }

  function custom_title_text ($title) {
    $screen = get_current_screen();
    if ($screen->post_type == 'talk') {
      $title = 'Enter talk name (eg. John Smith)';
    }

    return $title;
  }
}