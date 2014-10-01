<section class="speaker-tile-section">
  <div class="row animated-tiles">
    <?php foreach ($slugs as $slug): ?>
      <?php
      $speaker = $this->get_speaker_by_slug($slug);
      if (empty($speaker)) {
        continue;
      }
      $video_id = get_field('video_id', $speaker);
      $description = get_field('video_description', $speaker);
      $image = wp_get_attachment_image_src(get_post_thumbnail_id($speaker->ID), 'speaker');
      if (is_array($image) && !empty($image[0])) {
        $image = $image[0];
      }
      ?>

      <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 speaker-tile">
        <a class="speaker-tile-container" href="<?php echo get_permalink($speaker->ID) ?>">
          <div class="speaker-description" style="background-image: url(<?php echo $image ?>);">
            <div class="speaker-border"></div>
            <div class="speaker-info">
              <div class="speaker-title">Speaker</div>
              <h2><?php echo $speaker->post_title; ?></h2>

              <div class="speaker-position"><?php echo $speaker->post_excerpt ?></div>
            </div>
          </div>
          <!-- .speaker-title -->
          <div class="speaker-video-thumb">
            <div class="hover-container">
              <div class="hover-table">
                <div><span>See Intro Video</span></div>
              </div>
            </div>
            <img src="http://img.youtube.com/vi/<?php echo $video_id; ?>/0.jpg">
          </div>
          <!-- .speaker-video-thumb -->
        </a>
      </div>
    <?php endforeach; ?>
  </div>
</section>