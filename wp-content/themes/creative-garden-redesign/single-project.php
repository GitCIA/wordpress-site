<?php
/**
 * Single Project Template
 *
 * @package LeafLife_Pro
 */

get_header();

$year = get_post_meta(get_the_ID(), '_project_year', true);
$location = get_post_meta(get_the_ID(), '_project_location', true);
$service_type = get_post_meta(get_the_ID(), '_project_service_type', true);
$outcomes = get_post_meta(get_the_ID(), '_project_outcomes', true);
$video_url = get_post_meta(get_the_ID(), '_project_video_url', true);
$video_bg_id = get_post_meta(get_the_ID(), '_project_video_bg', true);

$video_url = $video_url ? $video_url : 'https://youtu.be/LsU5Y5svvq8';
$video_bg = CGR_URI . '/assets/img/video_block_bg_2.jpg';
if (!empty($video_bg_id)) {
    $bg_url = wp_get_attachment_image_url($video_bg_id, 'large');
    if ($bg_url) {
        $video_bg = $bg_url;
    }
}

// Get slider images
$slider_images = get_post_meta(get_the_ID(), '_project_slider_images', true);
$slider_images = is_array($slider_images) ? $slider_images : array();

// If no slider images, use featured image and create array
if (empty($slider_images)) {
    $featured_id = get_post_thumbnail_id(get_the_ID());
    if ($featured_id) {
        $slider_images[] = $featured_id;
    }
}

// Count images for later use
$image_count = count($slider_images);

// Get project features from dynamic array
$project_features = get_post_meta(get_the_ID(), '_project_features', true);
$project_features = is_array($project_features) ? $project_features : array();
?>

<!-- Start Page Heading Section -->
<section class="cs_page_heading cs_style_1 cs_bg_filed cs_heading_bg" data-src="<?php echo esc_url(CGR_URI . '/assets/img/project_heading_bg.jpg'); ?>">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'creative-garden-redesign'); ?></a></li>
            <li class="breadcrumb-item active"><?php the_title(); ?></li>
        </ol>
        <h1 class="cs_page_title mb-0 cs_fs_80 wow fadeInUp"><?php echo esc_html(strtoupper(get_the_title())); ?></h1>
    </div>
</section>
<!-- End Page Heading Section -->

<!-- Start Projects -->
<div class="container">
    <div class="cs_height_100 cs_height_lg_70"></div>
    <?php while (have_posts()) : the_post(); ?>
    <div class="row cs_gap_x_40 cs_gap_y_30">
        <div class="col-lg-7">
            <ul class="cs_project_details_info cs_mp_0">
                <?php if ($year) : ?>
                <li>
                    <p class="mb-0"><?php esc_html_e('YEAR', 'creative-garden-redesign'); ?></p>
                    <h4 class="mb-0 cs_fs_20 cs_bold"><?php echo esc_html(strtoupper($year)); ?></h4>
                </li>
                <?php endif; ?>
                <?php if ($location) : ?>
                <li>
                    <p class="mb-0"><?php esc_html_e('LOCATION', 'creative-garden-redesign'); ?></p>
                    <h4 class="mb-0 cs_fs_20 cs_bold"><?php echo esc_html(strtoupper($location)); ?></h4>
                </li>
                <?php endif; ?>
                <?php if ($service_type) : ?>
                <li>
                    <p class="mb-0"><?php esc_html_e('SERVICE', 'creative-garden-redesign'); ?></p>
                    <h4 class="mb-0 cs_fs_20 cs_bold"><?php echo esc_html(strtoupper($service_type)); ?></h4>
                </li>
                <?php endif; ?>
            </ul>
            <div class="cs_height_50 cs_height_lg_40"></div>
            <a href="<?php echo esc_url($video_url); ?>" class="cs_video_block cs_style_1 cs_type_1 cs_bg_filed cs_video_open cs_center cs_radius_20" data-src="<?php echo esc_url($video_bg); ?>" style="background-image: url('<?php echo esc_url($video_bg); ?>');">
                <span class="cs_player_btn cs_heading_color">
                    <svg width="19" height="22" viewBox="0 0 19 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.5 11L0.5 21.3923V0.607696L18.5 11Z" fill="currentColor"></path>
                    </svg>
                </span>
            </a>
        </div>
        <div class="col-lg-5">
            <div class="cs_slider cs_style_1">
                <div class="cs_slider_container" data-autoplay="0" data-loop="1" data-speed="800" data-center="0" data-variable-width="0" data-slides-per-view="1">
                    <div class="cs_slider_wrapper cs_lightgallery">
                        <?php foreach ($slider_images as $img_id) : 
                            if (empty($img_id)) continue;
                            $img_url = wp_get_attachment_image_url($img_id, 'large');
                            if (!$img_url) $img_url = CGR_URI . '/assets/img/project_thumb_10.jpg';
                        ?>
                        <div class="cs_slide">
                            <a href="<?php echo esc_url($img_url); ?>" class="cs_project_details_image cs_gallery_item">
                                <img src="<?php echo esc_url($img_url); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php if ($image_count > 1) : ?>
                <div class="d-flex justify-content-center cs_slider_arrows_4_transparent_wrap">
                    <div class="cs_slider_arrows cs_style_4">
                        <div class="cs_left_arrow cs_white_color">
                            <svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.499953 9.00005C0.499953 8.80823 0.573265 8.61623 0.719703 8.4698L8.2197 0.969797C8.51277 0.676734 8.98733 0.676734 9.2802 0.969797C9.57308 1.26286 9.57327 1.73742 9.2802 2.0303L2.31045 9.00005L9.2802 15.9698C9.57327 16.2629 9.57327 16.7374 9.2802 17.0303C8.98714 17.3232 8.51258 17.3234 8.2197 17.0303L0.719703 9.5303C0.573265 9.38386 0.499953 9.19186 0.499953 9.00005Z" fill="currentColor"/>
                            </svg>
                        </div>
                        <div class="cs_slider_number cs_style_2 cs_bold"></div>
                        <div class="cs_right_arrow cs_white_color">
                            <svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.50005 8.99995C9.50005 9.19177 9.42673 9.38377 9.2803 9.5302L1.7803 17.0302C1.48723 17.3233 1.01267 17.3233 0.719797 17.0302C0.426922 16.7371 0.426734 16.2626 0.719797 15.9697L7.68955 8.99995L0.719797 2.0302C0.426734 1.73714 0.426734 1.26258 0.719797 0.969702C1.01286 0.676826 1.48742 0.67664 1.7803 0.969702L9.2803 8.4697C9.42673 8.61614 9.50005 8.80814 9.50005 8.99995Z" fill="currentColor"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="cs_height_70 cs_height_lg_50"></div>
    <div class="row cs_gap_x_40 cs_gap_y_30">
        <div class="col-xl-7">
            <div class="cs_fs_20">
                <b class="cs_heading_color"><?php esc_html_e('DESCRIPTION:', 'creative-garden-redesign'); ?></b><br>
                <?php the_content(); ?>
                <?php if ($outcomes) : ?>
                <br><br>
                <b class="cs_heading_color"><?php esc_html_e('OUTCOMES', 'creative-garden-redesign'); ?></b><br>
                <?php echo nl2br(esc_html($outcomes)); ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-xl-5">
            <div class="row cs_gap_x_20 cs_gap_y_20">
                <?php foreach ($project_features as $feature) : ?>
                <div class="col-sm-6">
                    <div class="cs_iconbox cs_style_2">
                        <div class="cs_iconbox_icon">
                            <i class="<?php echo esc_attr($feature['icon']); ?>"></i>
                        </div>
                        <p class="cs_iconbox_title cs_bold cs_fs_20 mb-0 cs_heading_color"><?php echo esc_html($feature['title']); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
    <div class="cs_height_100 cs_height_lg_70"></div>
</div>
<!-- End Projects -->

<!-- Start Accordion Section -->
<section class="cs_gray_bg">
    <div class="cs_height_100 cs_height_lg_70"></div>
    <div class="container">
        <div class="cs_slider cs_style_1 cs_slider_gap_24">
            <div class="cs_section_heading cs_style_2 cs_color_1">
                <h2 class="cs_section_title cs_fs_80 mb-0">CHOOSE OUR <br>SPECIAL <span>SERVICES</span></h2>
                <div class="cs_section_right">
                    <h3 class="cs_brackets_title cs_normal cs_fs_16 mb-0">SERVICES</h3>
                    <div class="cs_slider_arrows cs_style_4 cs_hide_lg">
                        <div class="cs_left_arrow cs_heading_color">
                            <svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.499953 9.00005C0.499953 8.80823 0.573265 8.61623 0.719703 8.4698L8.2197 0.969797C8.51277 0.676734 8.98733 0.676734 9.2802 0.969797C9.57308 1.26286 9.57327 1.73742 9.2802 2.0303L2.31045 9.00005L9.2802 15.9698C9.57327 16.2629 9.57327 16.7374 9.2802 17.0303C8.98714 17.3232 8.51258 17.3234 8.2197 17.0303L0.719703 9.5303C0.573265 9.38386 0.499953 9.19186 0.499953 9.00005Z" fill="currentColor"/>
                            </svg>
                        </div>
                        <div class="cs_slider_number cs_style_2 cs_bold"></div>
                        <div class="cs_right_arrow cs_heading_color">
                            <svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.50005 8.99995C9.50005 9.19177 9.42673 9.38377 9.2803 9.5302L1.7803 17.0302C1.48723 17.3233 1.01267 17.3233 0.719797 17.0302C0.426922 16.7371 0.426734 16.2626 0.719797 15.9697L7.68955 8.99995L0.719797 2.0302C0.426734 1.73714 0.426734 1.26258 0.719797 0.969702C1.01286 0.676826 1.48742 0.67664 1.7803 0.969702L9.2803 8.4697C9.42673 8.61614 9.50005 8.80814 9.50005 8.99995Z" fill="currentColor"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cs_height_64 cs_height_lg_50"></div>
            <div class="cs_slider_container" data-autoplay="0" data-loop="1" data-speed="800" data-center="0" data-variable-width="0" data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="1" data-md-slides="2" data-lg-slides="2" data-add-slides="2">
                <div class="cs_slider_wrapper">
                    <?php
                    $services = new WP_Query(array(
                        'post_type'      => 'service',
                        'posts_per_page' => 4,
                    ));

                    if ($services->have_posts()) :
                        while ($services->have_posts()) : $services->the_post();
                            $service_img = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : CGR_URI . '/assets/img/project_thumb_1.jpg';
                    ?>
                    <div class="cs_slide">
                        <div class="cs_card cs_style_2">
                            <a href="<?php the_permalink(); ?>" class="cs_card_thumb">
                                <img src="<?php echo esc_url($service_img); ?>" alt="<?php the_title_attribute(); ?>">
                            </a>
                            <div class="cs_card_info">
                                <h2 class="cs_card_title cs_fs_32 cs_white_color cs_bold cs_mb_8">
                                    <a href="<?php the_permalink(); ?>"><?php echo esc_html(strtoupper(get_the_title())); ?></a>
                                </h2>
                                <p class="cs_card_subtitle mb-0 cs_white_color"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 22)); ?></p>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="cs_arrow_btn cs_size_lg cs_center cs_white_bg cs_heading_color">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.3846 0H0.615385C0.275692 0 0 0.275692 0 0.615385C0 0.955077 0.275692 1.23077 0.615385 1.23077H13.8988L0.180308 14.9495C-0.06 15.1898 -0.06 15.5794 0.180308 15.8197C0.300615 15.94 0.457846 16 0.615385 16C0.772923 16 0.930461 15.94 1.05046 15.8197L14.7692 2.10092V15.3846C14.7692 15.7243 15.0449 16 15.3846 16C15.7243 16 16 15.7243 16 15.3846V0.615385C16 0.275692 15.7243 0 15.3846 0Z" fill="currentColor"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        $fallback_services = array(
                            array('GARDEN DESIGN', 'Crafting the perfect garden space. We will design a garden that suits your lifestyle and enhances your property\'s beauty.', 'project_thumb_1.jpg'),
                            array('PLANT SELECTION', 'Hand-picked greenery for your oasis. Our experts select the right plants, ensuring they thrive in your garden\'s unique conditions.', 'project_thumb_2.jpg'),
                            array('HARDSCAPING', 'Adding structure to your landscape. We create functional and aesthetic hardscape features like patios, walkways, and retaining walls.', 'project_thumb_3.jpg'),
                            array('GARDEN MAINTENANCE', 'Preserving your garden\'s allure. We offer ongoing maintenance services to ensure your garden looks its best year-round.', 'project_thumb_4.jpg'),
                        );
                        foreach ($fallback_services as $service) :
                    ?>
                    <div class="cs_slide">
                        <div class="cs_card cs_style_2">
                            <a href="<?php echo esc_url(home_url('/services/')); ?>" class="cs_card_thumb">
                                <img src="<?php echo esc_url(CGR_URI . '/assets/img/' . $service[2]); ?>" alt="<?php echo esc_attr($service[0]); ?>">
                            </a>
                            <div class="cs_card_info">
                                <h2 class="cs_card_title cs_fs_32 cs_white_color cs_bold cs_mb_8">
                                    <a href="<?php echo esc_url(home_url('/services/')); ?>"><?php echo esc_html($service[0]); ?></a>
                                </h2>
                                <p class="cs_card_subtitle mb-0 cs_white_color"><?php echo esc_html($service[1]); ?></p>
                            </div>
                            <a href="<?php echo esc_url(home_url('/services/')); ?>" class="cs_arrow_btn cs_size_lg cs_center cs_white_bg cs_heading_color">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.3846 0H0.615385C0.275692 0 0 0.275692 0 0.615385C0 0.955077 0.275692 1.23077 0.615385 1.23077H13.8988L0.180308 14.9495C-0.06 15.1898 -0.06 15.5794 0.180308 15.8197C0.300615 15.94 0.457846 16 0.615385 16C0.772923 16 0.930461 15.94 1.05046 15.8197L14.7692 2.10092V15.3846C14.7692 15.7243 15.0449 16 15.3846 16C15.7243 16 16 15.7243 16 15.3846V0.615385C16 0.275692 15.7243 0 15.3846 0Z" fill="currentColor"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; endif; ?>
                </div>
            </div>
            <div class="cs_pagination cs_style_2 cs_show_lg"></div>
        </div>
    </div>
    <div class="cs_height_100 cs_height_lg_70"></div>
</section>
<!-- End Accordion Section -->

<?php get_footer(); ?>
