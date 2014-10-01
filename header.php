<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till </header>
 *
 * @package TEDxToronto
 * @subpackage TEDxToronto
 * @since TEDxToronto 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
  <meta charset="<?php bloginfo('charset'); ?>"/>
  <meta name="viewport" content="width=device-width"/>
  <title><?php wp_title('|', true, 'right'); ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11"/>
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo get_template_directory_uri(); ?>/dist/css/vendor.css" rel="stylesheet">
  <link href="<?php echo get_template_directory_uri(); ?>/dist/css/application.css" rel="stylesheet">

  <script src="<?php echo get_template_directory_uri(); ?>/dist/js/vendor.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/dist/js/application.js"></script>

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header>
  <div class="black-header">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
          <div class="logo">
            <a href="<?php echo get_theme_mod('logo_link', '/'); ?>">
              <?php (get_theme_mod('logo')) ? $logo = get_theme_mod('logo') : $logo = get_template_directory_uri() . "/dist/images/logo-blank.png" ?>
              <img src="<?php echo $logo ?>" height="50" width="230" alt="TEDx Logo">
            </a>
          </div>
          <div class="date-location">
            <div class="date" datetime="2014-10-02">
              <strong><?php echo get_theme_mod('event_date', 'Event Date') ?></strong></div>
            <div class="location"><?php echo get_theme_mod('event_location', 'Event Location') ?></div>
          </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
          <div class="call-out-cta">
            <a href="<?php echo get_theme_mod('button_call_out_link', '/'); ?>"
               class="btn btn-danger btn-xs pull-right">
              <?php echo get_theme_mod('button_call_out_text', 'CTA') ?>
            </a>

            <div class="call-out pull-right"><?= get_theme_mod('header_call_out', 'Header Call Out') ?></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

