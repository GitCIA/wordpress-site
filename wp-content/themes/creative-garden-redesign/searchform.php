<?php
/**
 * Search Form Template
 *
 * @package LeafLife_Pro
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label class="screen-reader-text" for="s"><?php esc_html_e('Search for:', 'creative-garden-redesign'); ?></label>
    <input type="search" class="cs_form_field" placeholder="<?php esc_attr_e('Search...', 'creative-garden-redesign'); ?>" value="<?php echo get_search_query(); ?>" name="s" id="s">
    <button type="submit" class="cs_btn cs_style_1 cs_bold cs_heading_bg cs_white_color">
        <i class="fa-solid fa-search"></i>
        <span class="screen-reader-text"><?php esc_html_e('Search', 'creative-garden-redesign'); ?></span>
    </button>
</form>
