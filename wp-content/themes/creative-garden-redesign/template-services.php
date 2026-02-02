<?php
/**
 * Template Name: Services Page
 * Template Post Type: page
 *
 * @package CreativeGardenDesign
 */

get_header();
?>

<!-- Start Page Heading Section -->
<section class="cs_page_heading cs_style_1 cs_bg_filed cs_heading_bg" data-src="<?php echo esc_url(CGR_URI . '/assets/img/service_heading_bg.jpg'); ?>">
    <div class="container">
        <?php cgr_breadcrumb(); ?>
        <h1 class="cs_page_title mb-0 cs_fs_80 wow fadeInUp"><?php esc_html_e('OUR SERVICES', 'creative-garden-redesign'); ?></h1>
    </div>
</section>
<!-- End Page Heading Section -->

<!-- Start Services Section -->
<section>
    <div class="cs_height_100 cs_height_lg_70"></div>
    <div class="container">
        <div class="row cs_gap_y_40 cs_gap_x_40">
            <?php
            $services = new WP_Query(array(
                'post_type'      => 'service',
                'posts_per_page' => -1,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ));

            if ($services->have_posts()) :
                while ($services->have_posts()) : $services->the_post();
                    $thumb_url = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'CreativeGardenDesign-service') : CGR_URI . '/assets/img/project_thumb_1.jpg';
            ?>
            <div class="col-lg-6">
                <article class="cs_card cs_style_2">
                    <a href="<?php the_permalink(); ?>" class="cs_card_thumb">
                        <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>">
                    </a>
                    <div class="cs_card_info">
                        <h2 class="cs_card_title cs_fs_32 cs_white_color cs_bold cs_mb_8">
                            <a href="<?php the_permalink(); ?>"><?php echo esc_html(strtoupper(get_the_title())); ?></a>
                        </h2>
                        <p class="cs_card_subtitle mb-0 cs_white_color"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="cs_arrow_btn cs_size_lg cs_center cs_white_bg cs_heading_color">
                        <?php echo cgr_arrow_icon(); ?>
                    </a>
                </article>
            </div>
            <?php endwhile; wp_reset_postdata(); else : ?>
            <!-- Fallback Services -->
            <?php
            $fallback_services = array(
                array('title' => 'HOME GARDEN DESIGN', 'desc' => 'Transform your backyard into a beautiful sanctuary with our custom home garden designs.', 'img' => 'project_thumb_1.jpg'),
                array('title' => 'PLANT SELECTION & CARE', 'desc' => 'Expert guidance on choosing the right plants for your climate and soil conditions.', 'img' => 'project_thumb_2.jpg'),
                array('title' => 'HARDSCAPING', 'desc' => 'Create stunning pathways, patios, and retaining walls that complement your landscape.', 'img' => 'project_thumb_3.jpg'),
                array('title' => 'PUBLIC GARDEN DESIGN', 'desc' => 'Beautiful garden designs for public spaces, parks, and commercial properties.', 'img' => 'project_thumb_4.jpg'),
            );
            foreach ($fallback_services as $service) :
            ?>
            <div class="col-lg-6">
                <article class="cs_card cs_style_2">
                    <div class="cs_card_thumb">
                        <img src="<?php echo esc_url(CGR_URI . '/assets/img/' . $service['img']); ?>" alt="<?php echo esc_attr($service['title']); ?>">
                    </div>
                    <div class="cs_card_info">
                        <h2 class="cs_card_title cs_fs_32 cs_white_color cs_bold cs_mb_8"><?php echo esc_html($service['title']); ?></h2>
                        <p class="cs_card_subtitle mb-0 cs_white_color"><?php echo esc_html($service['desc']); ?></p>
                    </div>
                    <a href="#" class="cs_arrow_btn cs_size_lg cs_center cs_white_bg cs_heading_color">
                        <?php echo cgr_arrow_icon(); ?>
                    </a>
                </article>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="cs_height_100 cs_height_lg_70"></div>
</section>
<!-- End Services Section -->

<!-- Start Process Section -->
<section class="cs_heading_bg cs_white_color">
    <div class="cs_height_100 cs_height_lg_70"></div>
    <div class="container">
        <div class="cs_section_heading cs_style_1">
            <h2 class="cs_section_title cs_fs_80 mb-0 wow fadeInUp"><?php esc_html_e('OUR', 'creative-garden-redesign'); ?> <span><?php esc_html_e('PROCESS', 'creative-garden-redesign'); ?></span></h2>
        </div>
        <div class="cs_height_64 cs_height_lg_50"></div>
        <div class="cs_card cs_style_3">
            <?php for ($i = 1; $i <= 4; $i++) :
                $step_title = get_theme_mod("process_step_{$i}_title", ($i == 1 ? 'CONSULTATION' : ($i == 2 ? 'CONCEPT & DESIGN' : ($i == 3 ? 'CONSTRUCTION' : 'MAINTENANCE'))));
                $step_desc = get_theme_mod("process_step_{$i}_description", 'Work with our team to define your vision and preferences.');
            ?>
            <div class="cs_card_col">
                <h3 class="cs_card_number cs_heading_color cs_fs_80 cs_bold"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></h3>
                <h4 class="cs_card_title cs_fs_24 cs_bold mb-0"><?php echo esc_html(strtoupper($step_title)); ?></h4>
                <p class="cs_card_subtitle mb-0"><?php echo esc_html($step_desc); ?></p>
            </div>
            <?php endfor; ?>
        </div>
    </div>
    <div class="cs_height_100 cs_height_lg_70"></div>
</section>
<!-- End Process Section -->

<!-- Start Testimonials Section -->
<section>
    <div class="cs_height_100 cs_height_lg_70"></div>
    <div class="container">
        <div class="cs_slider cs_style_1 cs_slider_gap_24">
            <div class="cs_section_heading cs_style_2 cs_color_1">
                <h2 class="cs_section_title cs_fs_80 mb-0 wow fadeInUp"><?php esc_html_e('WHAT OUR', 'creative-garden-redesign'); ?> <br><span><?php esc_html_e('CLIENTS', 'creative-garden-redesign'); ?></span> <?php esc_html_e('SAY', 'creative-garden-redesign'); ?></h2>
                <div class="cs_section_right">
                    <h3 class="cs_brackets_title cs_normal cs_fs_16 mb-0"><?php esc_html_e('TESTIMONIALS', 'creative-garden-redesign'); ?></h3>
                    <div class="cs_slider_arrows cs_style_4 cs_hide_lg">
                        <div class="cs_left_arrow cs_heading_color">
                            <?php echo cgr_slider_arrow_left(); ?>
                        </div>
                        <div class="cs_slider_number cs_style_2 cs_bold"></div>
                        <div class="cs_right_arrow cs_heading_color">
                            <?php echo cgr_slider_arrow_right(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cs_height_64 cs_height_lg_50"></div>
            <div class="cs_slider_container" data-autoplay="0" data-loop="1" data-speed="800" data-center="0" data-variable-width="0" data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="1" data-md-slides="2" data-lg-slides="3" data-add-slides="3">
                <div class="cs_slider_wrapper wow fadeInUp">
                    <?php
                    $testimonials = new WP_Query(array(
                        'post_type'      => 'testimonial',
                        'posts_per_page' => 6,
                    ));

                    if ($testimonials->have_posts()) :
                        while ($testimonials->have_posts()) : $testimonials->the_post();
                            $client_name = get_post_meta(get_the_ID(), '_testimonial_client_name', true);
                            $rating = get_post_meta(get_the_ID(), '_testimonial_rating', true) ?: 5;
                    ?>
                    <div class="cs_slide">
                        <div class="cs_testimonial cs_style_1">
                            <ul class="cs_rating cs_mp_0">
                                <?php for ($j = 0; $j < intval($rating); $j++) : ?>
                                <li><i class="fa-solid fa-star"></i></li>
                                <?php endfor; ?>
                            </ul>
                            <blockquote class="cs_testimonial_content"><?php echo wp_kses_post(get_the_content()); ?></blockquote>
                            <h3 class="cs_testimonial_author cs_fs_20 cs_bold mb-0"><?php echo esc_html($client_name ?: get_the_title()); ?></h3>
                        </div>
                    </div>
                    <?php endwhile; wp_reset_postdata(); else : ?>
                    <!-- Fallback testimonials -->
                    <div class="cs_slide">
                        <div class="cs_testimonial cs_style_1">
                            <ul class="cs_rating cs_mp_0">
                                <?php for ($j = 0; $j < 5; $j++) : ?>
                                <li><i class="fa-solid fa-star"></i></li>
                                <?php endfor; ?>
                            </ul>
                            <blockquote class="cs_testimonial_content">"CreativeGardenDesign turned our backyard into a stunning oasis. Their attention to detail and creativity exceeded our expectations."</blockquote>
                            <h3 class="cs_testimonial_author cs_fs_20 cs_bold mb-0">Amanda Thompson</h3>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="cs_pagination cs_style_2 cs_show_lg"></div>
        </div>
    </div>
    <div class="cs_height_100 cs_height_lg_70"></div>
</section>
<!-- End Testimonials Section -->

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
