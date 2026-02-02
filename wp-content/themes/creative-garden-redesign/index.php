<?php
/**
 * Main Index Template
 *
 * @package CreativeGardenDesign
 */

get_header();
?>

<!-- Start Page Heading Section -->
<section class="cs_page_heading cs_style_1 cs_bg_filed cs_heading_bg" data-src="<?php echo esc_url(CGR_URI . '/assets/img/about_heading_bg.jpg'); ?>">
    <div class="container">
        <?php cgr_breadcrumb(); ?>
        <h1 class="cs_page_title mb-0 cs_fs_80 wow fadeInUp"><?php esc_html_e('Latest Posts', 'creative-garden-redesign'); ?></h1>
    </div>
</section>
<!-- End Page Heading Section -->

<!-- Start Blog Section -->
<section>
    <div class="cs_height_100 cs_height_lg_70"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="cs_post_1_list">
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('cs_post cs_style_1'); ?>>
                                <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" class="cs_post_thumb cs_radius_15">
                                    <?php the_post_thumbnail('CreativeGardenDesign-blog', array('class' => 'w-100 cs_radius_15')); ?>
                                </a>
                                <?php endif; ?>
                                <div class="cs_post_info">
                                    <div class="cs_post_meta cs_style_1">
                                        <span class="cs_posted_by"><?php cgr_posted_on(); ?></span>
                                        <?php
                                        $category = cgr_get_primary_category();
                                        if ($category) :
                                        ?>
                                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="cs_post_avatar"><?php echo esc_html($category->name); ?></a>
                                        <?php endif; ?>
                                    </div>
                                    <h2 class="cs_post_title cs_fs_40">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                    <div class="cs_post_sub_title"><?php echo wp_trim_words(get_the_excerpt(), 30); ?></div>
                                    <a href="<?php the_permalink(); ?>" class="cs_btn cs_style_2 cs_bold cs_heading_color"><?php esc_html_e('See More', 'creative-garden-redesign'); ?></a>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <p><?php esc_html_e('No posts found.', 'creative-garden-redesign'); ?></p>
                    <?php endif; ?>
                </div>
                <div class="cs_height_60 cs_height_lg_40"></div>
                <?php cgr_pagination(); ?>
            </div>
            <div class="col-lg-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
    <div class="cs_height_100 cs_height_lg_70"></div>
</section>
<!-- End Blog Section -->

<?php get_footer(); ?>
