<?php
namespace TEDxTheme\CustomPostTypes;

class Speaker {

  function __construct () {
    add_action('init', array($this, 'add_custom_post_type'));

    add_image_size('speaker', 370, 370, true);
    add_image_size('speaker_thumb', 100, 57, true);

    add_filter('enter_title_here', array($this, 'custom_title_text'));

    $this->register_acf();
  }

  function register_acf () {
    if (function_exists("register_field_group")) {
      register_field_group(array(
        'id'         => 'acf_speaker',
        'title'      => 'Speaker',
        'fields'     => array(
          array(
            'key'           => 'field_5425e204f3e72',
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
          array(
            'key'           => 'field_5425e248f3e73',
            'label'         => 'Video ID',
            'name'          => 'video_id',
            'type'          => 'text',
            'instructions'  => 'The ID code that is referenced in the URL of every YouTube video (eg. http://www.youtube.com/watch?v=QRDJnLGBUTI)',
            'default_value' => '',
            'placeholder'   => '',
            'prepend'       => '',
            'append'        => '',
            'formatting'    => 'none',
            'maxlength'     => 15,
          ),
          array(
            'key'           => 'field_5425e278f3e74',
            'label'         => 'Video Description',
            'name'          => 'video_description',
            'type'          => 'wysiwyg',
            'instructions'  => 'Appears within the TEDx theatre on the right hand side.',
            'default_value' => '',
            'toolbar'       => 'basic',
            'media_upload'  => 'no',
          ),
          array(
            'key'           => 'field_5425e29ef3e75',
            'label'         => 'Twitter Link',
            'name'          => 'twitter_link',
            'type'          => 'text',
            'instructions'  => 'The full url to the speakers twitter account (eg. http://twitter.com/billxinli)',
            'default_value' => '',
            'placeholder'   => '',
            'prepend'       => '',
            'append'        => '',
            'formatting'    => 'none',
            'maxlength'     => 100,
          ),
        ),
        'location'   => array(
          array(
            array(
              'param'    => 'post_type',
              'operator' => '==',
              'value'    => 'speaker',
              'order_no' => 0,
              'group_no' => 0,
            ),
          ),
        ),
        'options'    => array(
          'position'       => 'normal',
          'layout'         => 'default',
          'hide_on_screen' => array(
            0 => 'custom_fields',
            1 => 'categories',
            2 => 'tags',
          ),
        ),
        'menu_order' => 0,
      ));
    }

  }

  function add_custom_post_type () {
    // Labels
    $speaker_labels = array(
      'name'          => __('Speakers'),
      'singular_name' => __('Speaker'),
      'add_new'       => __('Add New'),
      'all_items'     => __('All Speakers'),
      'add_new_item'  => __('Add New Speaker'),
      'edit_item'     => __('Edit Speaker'),
      'new_item'      => __('New Speaker'),
      'view_item'     => __('View Speaker'),
      'search_items'  => __('Search Speakers'),
      'not_found'     => __('No Speakers Found')
    );
    // Settings
    $speaker_settings = array(
      'labels'        => $speaker_labels,
      'public'        => true,
      'menu_icon'     => get_stylesheet_directory_uri() . '/dist/images/custom-post-types/speaker.png',
      'query_var'     => 'speakers',
      'menu_position' => null,
      'taxonomies'    => array('event_year'),
      'supports'      => array('title', 'editor', 'thumbnail', 'excerpt', 'trackbacks', 'revisions', 'page-attributes'),
    );
    register_post_type('speaker', $speaker_settings);
  }

  function custom_title_text ($title) {
    $screen = get_current_screen();
    if ($screen->post_type == 'speaker') {
      $title = 'Enter speaker name (eg. John Smith)';
    }

    return $title;
  }
}