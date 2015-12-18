<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package FHG CAPM Theme
 */
?>
<section class="no-results not-found">
  <header class="page-header">
    <h2 class="text-center page-title">
       <br /><br />
       <?php echo custom_translate('Sorry! nothing found.', 'آسف! العثور على شيء.'); ?>
    </h2>
    </header>
  <!-- .page-header -->

  <div class="page-content">
    <?php if (is_home() && current_user_can('publish_posts')) : ?>

      <p><?php printf(wp_kses(__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'fhg-capm-theme'), array('a' => array('href' => array()))), esc_url(admin_url('post-new.php'))); ?></p>

    <?php elseif (is_search()) : ?>

      <p class="text-center"><?php echo custom_translate('Sorry, but nothing matched your search terms. We advise you to search again with some different keywords.', 'آسف، ولكن لا شيء يضاهي شروط البحث الخاصة بك. فإننا ننصح للبحث مرة أخرى مع بعض كلمات مختلفة.'); ?></p>

    <?php else : ?>

      <p class="text-center"><?php echo custom_translate('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'يبدو أننا لا يمكن أن تجد ما تبحث عنه. البحث ربما يمكن أن تساعد.'); ?></p>
     
    <?php endif; ?>
  </div><!-- .page-content -->
  </section><!-- .no-results -->

