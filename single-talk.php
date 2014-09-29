<?php get_header(); ?>

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
        'key'     => 'talk', // name of custom field
        'value'   => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
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

<?php get_footer(); ?>
