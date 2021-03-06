<?php get_header(); ?>
<div class="container">
  <div class="row">
    <div class="col-md-9">
      <?php if (have_posts()): while (have_posts()) : the_post(); ?>
        <?php $talk = get_post(); ?>
        <div class="page-header">
          <h1 class="red"><?php the_title() ?></h1>
        </div>
        <?php if (get_field('video_id')): ?>
          <div class="video-container">
            <iframe width="100%" height="100%" src="//www.youtube.com/embed/<?php the_field('video_id') ?>" frameborder="0" allowfullscreen></iframe>
          </div>
        <?php endif; ?>
        <?php the_content(); ?>
      <?php endwhile; endif; ?>




      <?php if (have_posts()): while (have_posts()) : the_post(); ?>
        <?php $talk = get_post(); ?>

        <div><?php echo $talk->post_title; ?></div>
        <div><?php echo $talk->post_excerpt; ?></div>
        <div><?php the_content(); ?></div>
        <pre><?php print_r(get_terms('event_year')) ?></pre>
        <pre><?php print_r(get_fields()) ?></pre>

        <?php
        $speakers = get_posts(array(
          'post_type'  => 'speaker',
          'meta_query' => array(
            array(
              'key'     => 'talk',
              'value'   => '"' . get_the_ID() . '"',
              'compare' => 'LIKE'
            )
          )
        ));

        ?>
        <?php if ($speakers): ?>
          <?php foreach ($speakers as $speaker): ?>
            <pre><?php print_r($speaker); ?></pre>
          <?php endforeach; ?>
        <?php endif; ?>
      <?php endwhile; endif; ?>

    </div>
    <div class="col-md-3">
      <div class="page-header">

        <h1>Related Videos</h1>
      </div>
    </div>
    <!-- .col-md-3 -->
  </div>
</div>
<?php get_footer(); ?>







