<?php
/**
 * The template for displaying search forms in fhg_capm_theme
 *
 * @package fhg_capm_theme
 */
?>

<div class="search_form">
  <?php $search_form_action = esc_url(home_url(custom_translate("/", "/ar/"))) ?>
  <form id="target" role="search_post" method="get" class="search-form" action="<?php echo $search_form_action; ?>" >
    <div class="searchPannel">
      <input type="text"  id="global_search" class="searchtextbox search-field required" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="<?php echo custom_translate('search here...', 'ابحث هنا...') ?>" name="s">      
    </div>
  </form>
</div>
<a class="last" href="#"><img width="19" height="18" alt="" src="<?php echo INC_URL_IMG . DS . 'icon-search' . custom_translate("", "_ar") . '.png' ?>"></a> 