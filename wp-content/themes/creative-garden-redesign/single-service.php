<?php
/**
 * Single Service Template
 *
 * @package CreativeGardenDesign
 */

get_header();

$tags = get_post_meta(get_the_ID(), '_service_tags', true);
$tags_array = $tags ? explode(',', $tags) : array();
?>

<!-- Start Page Heading Section -->
<section class="cs_page_heading cs_style_1 cs_bg_filed cs_heading_bg" data-src="<?php echo esc_url(CGR_URI . '/assets/img/service_heading_bg.jpg'); ?>">
    <div class="container">
        <?php cgr_breadcrumb(); ?>
        <h1 class="cs_page_title mb-0 cs_fs_80 wow fadeInUp"><?php echo esc_html(strtoupper(get_the_title())); ?></h1>
    </div>
</section>
<!-- End Page Heading Section -->

<!-- Start Service Details Section -->
<section>
    <div class="cs_height_100 cs_height_lg_70"></div>
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php if (has_post_thumbnail()) : ?>
            <div class="cs_service_thumb cs_radius_20 cs_mb_40">
                <?php the_post_thumbnail('large', array('class' => 'w-100 cs_radius_20')); ?>
            </div>
            <?php endif; ?>

            <div class="cs_service_content">
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </div>
        </article>
        <?php endwhile; ?>

        <div class="cs_height_60 cs_height_lg_40"></div>

        <!-- Related Services -->
        <?php
        $related = new WP_Query(array(
            'post_type'      => 'service',
            'posts_per_page' => 3,
            'post__not_in'   => array(get_the_ID()),
        ));

        if ($related->have_posts()) :
        ?>
        <h3 class="cs_fs_32 cs_mb_24"><?php esc_html_e('Related Services', 'creative-garden-redesign'); ?></h3>
        <div class="row cs_gap_y_40">
            <?php while ($related->have_posts()) : $related->the_post();
                $thumb_url = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'CreativeGardenDesign-service') : CGR_URI . '/assets/img/project_thumb_1.jpg';
            ?>
            <div class="col-lg-4">
                <article class="cs_card cs_style_2">
                    <a href="<?php the_permalink(); ?>" class="cs_card_thumb">
                        <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>">
                    </a>
                    <div class="cs_card_info">
                        <h2 class="cs_card_title cs_fs_24 cs_white_color cs_bold cs_mb_8">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="cs_arrow_btn cs_size_lg cs_center cs_white_bg cs_heading_color">
                        <?php echo cgr_arrow_icon(); ?>
                    </a>
                </article>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php endif; ?>
    </div>
    <div class="cs_height_100 cs_height_lg_70"></div>
</section>
<!-- End Service Details Section -->

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
