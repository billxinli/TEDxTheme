<?php
namespace TEDxTheme\CustomPostTypes;

class Team {

  function __construct () {
    add_action('init', array($this, 'add_custom_post_type'));

    add_image_size('team', 370, 370, true);
    add_image_size('team_thumb', 100, 57, true);

    add_filter('enter_title_here', array($this, 'custom_title_text'));

    $this->register_acf();
  }

  function register_acf () {
    if (function_exists("register_field_group")) {
      register_field_group(array(
        'id'         => 'acf_team',
        'title'      => 'Team',
        'fields'     => array(
          array(
            'key'           => 'field_542828868d7c0',
            'label'         => 'Job Description',
            'name'          => 'job_description',
            'type'          => 'text',
            'instructions'  => 'eg. Strategic Director',
            'default_value' => '',
            'placeholder'   => '',
            'prepend'       => '',
            'append'        => '',
            'formatting'    => 'none',
            'maxlength'     => '',
          ),
          array(
            'key'           => 'field_542828a18d7c1',
            'label'         => 'Twitter Link',
            'name'          => 'twitter_link',
            'type'          => 'text',
            'instructions'  => 'The full url to the speakers twitter account (eg. http://twitter.com/billxinli)',
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
              'value'    => 'team',
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
    $team_labels = array(
      'name'          => __('Teams'),
      'singular_name' => __('Team'),
      'add_new'       => __('Add New'),
      'all_items'     => __('All Teams'),
      'add_new_item'  => __('Add New Team'),
      'edit_item'     => __('Edit Team'),
      'new_item'      => __('New Team'),
      'view_item'     => __('View Team'),
      'search_items'  => __('Search Teams'),
      'not_found'     => __('No Teams Found')
    );
    // Settings
    $team_settings = array(
      'labels'        => $team_labels,
      'public'        => true,
      'menu_icon'     => get_stylesheet_directory_uri() . '/dist/images/custom-post-types/team.png',
      'query_var'     => 'teams',
      'menu_position' => null,
      'taxonomies'    => array('event_year'),
      'supports'      => array('title', 'editor', 'thumbnail', 'excerpt', 'trackbacks', 'revisions', 'page-attributes'),
    );
    register_post_type('team', $team_settings);
  }

  function custom_title_text ($title) {
    $screen = get_current_screen();
    if ($screen->post_type == 'team') {
      $title = 'Enter team member name (eg. John Smith)';
    }

    return $title;
  }
}