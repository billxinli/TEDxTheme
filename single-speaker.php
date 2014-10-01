<?php get_header(); ?>
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <?php if (have_posts()): while (have_posts()) : the_post(); ?>
          <?php $speaker = get_post(); ?>
          <div class="page-header">
            <h1 class="red"><?php the_title() ?>
              <span class="dark-gray"><?php echo strip_tags(get_the_excerpt()) ?></span>
            </h1>
          </div>
          <?php if (get_field('video_id')): ?>
            <div class="video-container">
              <iframe width="100%" height="100%" src="//www.youtube.com/embed/<?php the_field('video_id') ?>" frameborder="0" allowfullscreen></iframe>
            </div>
          <?php endif; ?>

          <?php $event_year_terms = wp_get_post_terms($speaker->ID, 'event_year'); ?>
          <?php if (count($event_year_terms) > 0): ?>
            <div class="row">
              <div class="col-md-12">
                <ul class="inline">
                  <?php foreach ($event_year_terms as $event_year_term): ?>
                    <li class="event-years">
                      <?php echo $event_year_term->name ?>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          <?php endif; ?>
          <div class="the-content">
            <?php the_content(); ?>
          </div>
        <?php endwhile; endif; ?>
      </div>
      <div class="col-md-3">
        <div class="page-header">
          <h1>Related Videos</h1>
        </div>
      </div>
    </div>
  </div>
<?php get_footer(); ?>