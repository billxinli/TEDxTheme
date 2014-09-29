<?php get_header(); ?>

<?php if (have_posts()): while (have_posts()) : the_post(); ?>
  <?php $speaker = get_post(); ?>

  <div><?php echo $speaker->post_title; ?></div>
  <div><?php echo $speaker->post_excerpt; ?></div>
  <div><?php the_content(); ?></div>
  <pre><?php print_r(get_terms('event_year')) ?></pre>
  <pre><?php print_r(get_fields()) ?></pre>

  <?php
  $talks = get_posts(array(
    'post_type'  => 'talk',
    'meta_query' => array(
      array(
        'key'     => 'speaker', // name of custom field
        'value'   => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
        'compare' => 'LIKE'
      )
    )
  ));

  ?>
  <?php if ($talks): ?>
    <?php foreach ($talks as $talk): ?>
      <pre><?php print_r($talk); ?></pre>
    <?php endforeach; ?>
  <?php endif; ?>
<?php endwhile; endif; ?>

<?php get_footer(); ?>
