<?php
/**
 * 404 Error Page Template
 *
 * @package LeafLife_Pro
 */

get_header();
?>

<!-- Start Page Heading Section -->
<section class="cs_page_heading cs_style_1 cs_bg_filed cs_heading_bg" data-src="<?php echo esc_url(CGR_URI . '/assets/img/about_heading_bg.jpg'); ?>">
    <div class="container">
        <?php cgr_breadcrumb(); ?>
        <h1 class="cs_page_title mb-0 cs_fs_80 wow fadeInUp"><?php esc_html_e('404 ERROR', 'creative-garden-redesign'); ?></h1>
    </div>
</section>
<!-- End Page Heading Section -->

<!-- Start 404 Section -->
<section>
    <div class="cs_height_100 cs_height_lg_70"></div>
    <div class="container">
        <div class="cs_error_page text-center">
            <h1 class="cs_error_title cs_fs_120 cs_heading_color cs_bold"><?php esc_html_e('404', 'creative-garden-redesign'); ?></h1>
            <h2 class="cs_fs_40 cs_mb_16"><?php esc_html_e('Page Not Found', 'creative-garden-redesign'); ?></h2>
            <p class="cs_mb_40"><?php esc_html_e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'creative-garden-redesign'); ?></p>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="cs_btn cs_style_1 cs_bold cs_heading_bg cs_white_color"><?php esc_html_e('Back to Home', 'creative-garden-redesign'); ?></a>
        </div>
    </div>
    <div class="cs_height_100 cs_height_lg_70"></div>
</section>
<!-- End 404 Section -->

<!-- Start CTA Section -->
<?php
$cta_title = get_theme_mod('cta_title', 'READY TO DESIGN YOUR GARDEN?');
$cta_btn_text = get_theme_mod('cta_btn_text', 'Contact Us');
$cta_btn_url = get_theme_mod('cta_btn_url', '/contact/');
$cta_background = cgr_get_cta_background();
?>
<section class="cs_cta cs_style_1 cs_type_1 cs_heading_bg cs_bg_filed" data-src="<?php echo esc_url($cta_background); ?>">
    <div class="cs_height_100 cs_height_lg_70"></div>
    <div class="container">
        <div class="cs_cta_in">
            <h2 class="cs_cta_title cs_fs_80 cs_white_color cs_mb_40"><?php echo wp_kses_post($cta_title); ?></h2>
            <a href="<?php echo esc_url($cta_btn_url); ?>" class="cs_btn cs_style_1 cs_bold cs_heading_color cs_white_bg"><?php echo esc_html($cta_btn_text); ?></a>
        </div>
    </div>
    <div class="cs_height_100 cs_height_lg_70"></div>
</section>
<!-- End CTA Section -->

<?php get_footer(); ?>
