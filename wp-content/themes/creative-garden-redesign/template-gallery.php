<?php
/**
 * Template Name: Gallery Page
 * Template Post Type: page
 *
 * @package CreativeGardenDesign
 */

get_header();
?>

<!-- Start Page Heading Section -->
<section class="cs_page_heading cs_style_1 cs_bg_filed cs_heading_bg" data-src="<?php echo esc_url(CGR_URI . '/assets/img/about_heading_bg.jpg'); ?>">
    <div class="container">
        <?php cgr_breadcrumb(); ?>
        <h1 class="cs_page_title mb-0 cs_fs_80 wow fadeInUp"><?php esc_html_e('GALLERY', 'creative-garden-redesign'); ?></h1>
    </div>
</section>
<!-- End Page Heading Section -->

<!-- Start Gallery Section -->
<section>
    <div class="cs_height_100 cs_height_lg_70"></div>
    <div class="container">
        <?php
        // Get gallery images from page content or attached images
        $gallery_images = array();
        
        // Get all project IDs to limit gallery images to project attachments
        $project_ids = get_posts(array(
            'post_type'      => 'project',
            'posts_per_page' => -1,
            'fields'         => 'ids',
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        ));
        $project_id_map = array_fill_keys($project_ids, true);

        // Check for gallery in post content
        $content = get_the_content();
        preg_match_all('/\[gallery.*ids=["\']([^"\']+)["\']/i', $content, $matches);
        
        if (!empty($matches[1][0])) {
            $gallery_images = array_map('intval', explode(',', $matches[1][0]));
        }
        
        // If gallery exists, keep only attachments that belong to projects
        if (!empty($gallery_images)) {
            $gallery_images = array_values(array_filter($gallery_images, function ($image_id) use ($project_id_map) {
                $attachment = get_post($image_id);
                return $attachment && !empty($attachment->post_parent) && isset($project_id_map[$attachment->post_parent]);
            }));
        }
        
        // If no gallery (or no project images), get attached project images
        if (empty($gallery_images) && !empty($project_ids)) {
            $attachments = get_posts(array(
                'post_type'      => 'attachment',
                'posts_per_page' => -1,
                'post_mime_type' => 'image',
                'post_status'    => 'inherit',
                'post_parent__in'=> $project_ids,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ));
            
            foreach ($attachments as $attachment) {
                $gallery_images[] = $attachment->ID;
            }
        }
        
        // Calculate pagination
        $per_page = 20;
        $total_images = count($gallery_images);
        $total_pages = ceil($total_images / $per_page);
        
        // Use fallback images if no gallery
        $use_fallback = empty($gallery_images);
        if ($use_fallback) {
            $total_images = 12;
            $total_pages = 1;
        }
        ?>
        
        <!-- Gallery Slider with Pagination -->
        <div class="cs_gallery_slider" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "dots": false, "arrows": true, "infinite": false, "speed": 500, "adaptiveHeight": true}'>
            <?php
            // If fallback images
            if ($use_fallback) :
                for ($i = 1; $i <= 12; $i++) :
                    $img_num = (($i - 1) % 8) + 1;
            ?>
            <div class="cs_gallery_page">
                <div class="cs_isotop cs_style_1 cs_isotop_col_3 cs_has_gutter_24 cs_lightgallery">
                    <div class="cs_grid_sizer"></div>
                    <div class="cs_isotop_item<?php echo $i == 1 ? ' wow fadeInLeft' : ''; ?>">
                        <a href="<?php echo esc_url(CGR_URI . '/assets/img/work_thumb_' . $img_num . '.jpg'); ?>" class="cs_gallery cs_style_1 cs_center cs_gallery_item">
                            <img src="<?php echo esc_url(CGR_URI . '/assets/img/work_thumb_' . $img_num . '.jpg'); ?>" alt="">
                            <span class="cs_gallery_info_wrap cs_center">
                                <span class="cs_gallery_info text-center cs_center">
                                    <span class="cs_white_color cs_fs_16 cs_bold cs_mb_4 d-block"><?php printf(esc_html__('Gallery %d', 'creative-garden-redesign'), $i); ?></span>
                                    <span class="cs_white_color d-block">2024</span>
                                </span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <?php
                endfor;
            else :
                // Display images in pages of 20
                for ($page = 0; $page < $total_pages; $page++) :
                    $page_images = array_slice($gallery_images, $page * $per_page, $per_page);
            ?>
            <div class="cs_gallery_page">
                <div class="cs_isotop cs_style_1 cs_isotop_col_3 cs_has_gutter_24 cs_lightgallery">
                    <div class="cs_grid_sizer"></div>
                    <?php
                    $count = 0;
                    foreach ($page_images as $image_id) :
                        $count++;
                        $image_url = wp_get_attachment_image_url($image_id, 'large');
                        $image_full = wp_get_attachment_image_url($image_id, 'full');
                        $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                        
                        // Get the project year from the parent post (project)
                        $attachment = get_post($image_id);
                        $project_year = '2024'; // Default fallback
                        
                        if ($attachment && $attachment->post_parent) {
                            $project_year = get_post_meta($attachment->post_parent, '_project_year', true);
                            if (empty($project_year)) {
                                // Fallback to post date year if no year meta is set
                                $project_year = get_the_date('Y', $attachment->post_parent);
                            }
                        }
                    ?>
                    <div class="cs_isotop_item<?php echo $count == 1 ? ' wow fadeInLeft' : ''; ?>">
                        <a href="<?php echo esc_url($image_full); ?>" class="cs_gallery cs_style_1 cs_center cs_gallery_item">
                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                            <span class="cs_gallery_info_wrap cs_center">
                                <span class="cs_gallery_info text-center cs_center">
                                    <span class="cs_white_color cs_fs_16 cs_bold cs_mb_4 d-block">
                                        <?php 
                                        if ($attachment && $attachment->post_parent) {
                                            echo esc_html(get_the_title($attachment->post_parent));
                                        } else {
                                            printf(esc_html__('Gallery %d', 'creative-garden-redesign'), ($page * $per_page) + $count);
                                        }
                                        ?>
                                    </span>
                                    <span class="cs_white_color d-block"><?php echo esc_html($project_year); ?></span>
                                </span>
                            </span>
                        </a>
                    </div>
                    <?php
                    endforeach;
                    ?>
                </div>
            </div>
            <?php
                endfor;
            endif;
            ?>
        </div>
        
        <!-- Pagination Arrows -->
        <?php if (!$use_fallback && $total_pages > 1) : ?>
        <div class="cs_height_64 cs_height_lg_50"></div>
        <div class="d-flex justify-content-center">
            <div class="cs_slider_arrows cs_style_4">
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
        <?php endif; ?>
    </div>
    <div class="cs_height_100 cs_height_lg_70"></div>
</section>
<!-- End Gallery Section -->

<!-- Start CTA Card Section -->
<section class="cs_half_bg">
    <div class="container">
        <div class="cs_card cs_style_1 cs_heading_bg cs_bg_filed" data-src="<?php echo esc_url(CGR_URI . '/assets/img/card_bg.jpg'); ?>">
            <div class="cs_card_top">
                <div class="cs_card_tags">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="cs_card_tag"><?php esc_html_e('Home', 'creative-garden-redesign'); ?></a>
                    <a href="#" class="cs_card_tag"><?php esc_html_e('Garden', 'creative-garden-redesign'); ?></a>
                    <a href="#" class="cs_card_tag"><?php esc_html_e('Landscape Design', 'creative-garden-redesign'); ?></a>
                    <a href="#" class="cs_card_tag"><?php esc_html_e('Expert', 'creative-garden-redesign'); ?></a>
                </div>
            </div>
            <div class="cs_card_bottom">
                <h2 class="cs_card_title cs_gradient_color_1 cs_fs_80 mb-0"><?php esc_html_e('MAKE YOUR DREAM', 'creative-garden-redesign'); ?> <br><?php esc_html_e('GARDEN INTO REALITY', 'creative-garden-redesign'); ?></h2>
            </div>
            <a href="<?php echo esc_url(get_post_type_archive_link('project')); ?>" class="cs_arrow_btn cs_size_lg cs_center cs_white_bg cs_heading_color">
                <?php echo cgr_arrow_icon(); ?>
            </a>
        </div>
    </div>
</section>
<!-- End CTA Card Section -->

<?php get_footer(); ?>
