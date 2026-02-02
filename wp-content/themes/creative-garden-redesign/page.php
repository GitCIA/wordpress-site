<?php
/**
 * Page Template
 *
 * @package LeafLife_Pro
 */

get_header();
?>

<!-- Start Page Heading Section -->
<section class="cs_page_heading cs_style_1 cs_bg_filed cs_heading_bg" data-src="<?php echo esc_url(CGR_URI . '/assets/img/about_heading_bg.jpg'); ?>">
    <div class="container">
        <?php cgr_breadcrumb(); ?>
        <h1 class="cs_page_title mb-0 cs_fs_80 wow fadeInUp"><?php echo esc_html(strtoupper(get_the_title())); ?></h1>
    </div>
</section>
<!-- End Page Heading Section -->

<!-- Start Page Content Section -->
<section>
    <div class="cs_height_100 cs_height_lg_70"></div>
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
        <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php if (has_post_thumbnail()) : ?>
            <div class="cs_page_thumb cs_radius_20 cs_mb_40">
                <?php the_post_thumbnail('large', array('class' => 'w-100 cs_radius_20')); ?>
            </div>
            <?php endif; ?>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </article>
        <?php endwhile; ?>
    </div>
    <div class="cs_height_100 cs_height_lg_70"></div>
</section>
<!-- End Page Content Section -->

<?php get_footer(); ?>
