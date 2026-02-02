<?php
/**
 * Single Post Template
 *
 * @package LeafLife_Pro
 */

get_header();
?>

<!-- Start Page Heading Section -->
<section class="cs_page_heading cs_style_1 cs_bg_filed_filed cs_heading_bg" data-src="<?php echo esc_url(CGR_URI . '/assets/img/about_heading_bg.jpg'); ?>">
    <div class="container">
        <?php cgr_breadcrumb(); ?>
        <h1 class="cs_page_title mb-0 cs_fs_80 wow fadeInUp"><?php the_title(); ?></h1>
    </div>
</section>
<!-- End Page Heading Section -->

<!-- Start Blog Details Section -->
<section>
    <div class="cs_height_100 cs_height_lg_70"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('cs_post cs_style_1 cs_type_1'); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                    <div class="cs_post_thumb cs_radius_15">
                        <?php the_post_thumbnail('large', array('class' => 'w-100 cs_radius_15')); ?>
                    </div>
                    <?php endif; ?>
                    <div class="cs_post_info">
                        <div class="cs_post_meta cs_style_1 cs_ternary_color cs_semi_bold cs_primary_font">
                            <span class="cs_posted_by"><?php cgr_posted_on(); ?></span>
                            <?php
                            $category = cgr_get_primary_category();
                            if ($category) :
                            ?>
                            <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="cs_post_avatar"><?php echo esc_html($category->name); ?></a>
                            <?php endif; ?>
                        </div>
                        <h2 class="cs_post_title"><?php the_title(); ?></h2>
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                        <?php
                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'creative-garden-redesign'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>
                </article>

                <?php if (comments_open() || get_comments_number()) : ?>
                <div class="cs_height_30 cs_height_lg_30"></div>
                <?php comments_template(); ?>
                <?php endif; ?>
                <?php endwhile; ?>
            </div>
            <div class="col-lg-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
    <div class="cs_height_100 cs_height_lg_70"></div>
</section>
<!-- End Blog Details Section -->

<?php get_footer(); ?>
