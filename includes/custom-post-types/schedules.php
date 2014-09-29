<?php
namespace TEDxTheme\CustomPostTypes;

class Schedule {

  function __construct () {
    add_action('init', array($this, 'add_custom_post_type'));

    add_image_size('schedule', 370, 370, true);
    add_image_size('schedule_thumb', 100, 57, true);

    add_filter('enter_title_here', array($this, 'custom_title_text'));
  }

  function add_custom_post_type () {
    // Labels
    $schedule_labels = array(
      'name'          => __('Schedules'),
      'singular_name' => __('Schedule'),
      'add_new'       => __('Add New'),
      'all_items'     => __('All Schedules'),
      'add_new_item'  => __('Add New Schedule'),
      'edit_item'     => __('Edit Schedule'),
      'new_item'      => __('New Schedule'),
      'view_item'     => __('View Schedule'),
      'search_items'  => __('Search Schedules'),
      'not_found'     => __('No Schedules Found')
    );
    // Settings
    $schedule_settings = array(
      'labels'        => $schedule_labels,
      'public'        => true,
      'menu_icon'     => get_stylesheet_directory_uri() . '/dist/images/custom-post-types/schedule.png',
      'query_var'     => 'schedules',
      'menu_position' => null,
      'taxonomies'    => array('event_year'),
      'supports'      => array('title', 'editor', 'thumbnail', 'excerpt', 'trackbacks', 'revisions', 'page-attributes'),
    );
    register_post_type('schedule', $schedule_settings);
  }

  function custom_title_text ($title) {
    $screen = get_current_screen();
    if ($screen->post_type == 'schedule') {
      $title = 'Enter schedule name (eg. John Smith)';
    }

    return $title;
  }
}