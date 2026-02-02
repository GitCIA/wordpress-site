<?php
/**
 * Template Name: Projects Page
 * Template Post Type: page
 *
 * @package CreativeGardenDesign
 */

get_header();
?>

<!-- Start Page Heading Section -->
<section class="cs_page_heading cs_style_1 cs_bg_filed cs_heading_bg" data-src="<?php echo esc_url(CGR_URI . '/assets/img/project_heading_bg.jpg'); ?>">
    <div class="container">
        <?php cgr_breadcrumb(); ?>
        <h1 class="cs_page_title mb-0 cs_fs_80 wow fadeInUp"><?php esc_html_e('OUR PROJECTS', 'creative-garden-redesign'); ?></h1>
    </div>
</section>
<!-- End Page Heading Section -->

<!-- Start Projects Section -->
<?php
$projects = new WP_Query(array(
    'post_type'      => 'project',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
));

// Store all projects in array for reuse
$all_projects = array();
if ($projects->have_posts()) :
    while ($projects->have_posts()) : $projects->the_post();
        $all_projects[] = array(
            'id' => get_the_ID(),
            'title' => get_the_title(),
            'permalink' => get_permalink(),
            'year' => get_post_meta(get_the_ID(), '_project_year', true) ?: '2024',
            'location' => get_post_meta(get_the_ID(), '_project_location', true) ?: 'N/A',
            'service' => get_post_meta(get_the_ID(), '_project_service_type', true) ?: 'GARDEN LANDSCAPING',
            'thumb' => has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'creative-garden-redesignject') : CGR_URI . '/assets/img/project_thumb_10.jpg',
        );
    endwhile;
    wp_reset_postdata();
endif;

$total_projects = count($all_projects);

if ($total_projects > 0) :
    
    // Project 1: cs_card cs_style_5 in container
    if ($total_projects >= 1) :
        $project = $all_projects[0];
?>
<div class="container">
    <div class="cs_height_100 cs_height_lg_70"></div>
    <article class="cs_card cs_style_5">
        <a href="<?php echo esc_url($project['permalink']); ?>" class="cs_card_thumb">
            <img src="<?php echo esc_url($project['thumb']); ?>" alt="<?php echo esc_attr($project['title']); ?>">
        </a>
        <div class="cs_card_right">
            <h2 class="cs_card_title cs_fs_80 mb-0"><a href="<?php echo esc_url($project['permalink']); ?>"><?php echo esc_html(strtoupper($project['title'])); ?></a></h2>
            <ul class="cs_card_info_list cs_mp_0">
                <li>
                    <p class="mb-0"><?php esc_html_e('YEAR', 'creative-garden-redesign'); ?></p>
                    <h4 class="mb-0 cs_fs_20 cs_bold"><?php echo esc_html($project['year']); ?></h4>
                </li>
                <li>
                    <p class="mb-0"><?php esc_html_e('LOCATION', 'creative-garden-redesign'); ?></p>
                    <h4 class="mb-0 cs_fs_20 cs_bold"><?php echo esc_html(strtoupper($project['location'])); ?></h4>
                </li>
                <li>
                    <p class="mb-0"><?php esc_html_e('SERVICE', 'creative-garden-redesign'); ?></p>
                    <h4 class="mb-0 cs_fs_20 cs_bold"><?php echo esc_html(strtoupper($project['service'])); ?></h4>
                </li>
            </ul>
        </div>
    </article>
    <div class="cs_height_100 cs_height_lg_70"></div>
</div>
<?php endif; ?>

<?php 
    // Project 2: cs_card cs_style_6 full-width with background
    if ($total_projects >= 2) :
        $project = $all_projects[1];
        $description = get_post_meta($project['id'], '_project_description', true) ?: 'Tucked behind an old estate, this garden design evokes the charm of a hidden garden. The lighting design enhances the feeling of discovery, revealing unexpected beauty at every turn.';
        $outcomes = get_post_meta($project['id'], '_project_outcomes', true) ?: "The charm of a hidden garden\nOriental sense of discovery\nEvery step feels like an adventure";
?>
<div class="cs_card cs_style_6 cs_bg_filed" data-src="<?php echo esc_url($project['thumb']); ?>">
    <div class="container">
        <div class="cs_card_in">
            <div class="cs_card_left">
                <h2 class="cs_card_title cs_white_color cs_fs_80 mb-0"><a href="<?php echo esc_url($project['permalink']); ?>"><?php echo esc_html(strtoupper($project['title'])); ?></a></h2>
                <ul class="cs_card_info_list cs_mp_0">
                    <li>
                        <p class="mb-0 cs_white_color"><?php esc_html_e('YEAR', 'creative-garden-redesign'); ?></p>
                        <h4 class="mb-0 cs_fs_20 cs_bold cs_white_color"><?php echo esc_html($project['year']); ?></h4>
                    </li>
                    <li>
                        <p class="mb-0 cs_white_color"><?php esc_html_e('LOCATION', 'creative-garden-redesign'); ?></p>
                        <h4 class="mb-0 cs_fs_20 cs_bold cs_white_color"><?php echo esc_html(strtoupper($project['location'])); ?></h4>
                    </li>
                    <li>
                        <p class="mb-0 cs_white_color"><?php esc_html_e('SERVICE', 'creative-garden-redesign'); ?></p>
                        <h4 class="mb-0 cs_fs_20 cs_bold cs_white_color"><?php echo esc_html(strtoupper($project['service'])); ?></h4>
                    </li>
                </ul>
            </div>
            <div class="cs_card_right">
                <div class="cs_card_text">
                    <p class="text-uppercase cs_white_color mb-0"><?php esc_html_e('DESCRIPTION', 'creative-garden-redesign'); ?></p>
                    <p class="cs_fs_20 cs_bold cs_white_color cs_mb_40"><?php echo esc_html($description); ?></p>
                    <p class="text-uppercase cs_white_color mb-0"><?php esc_html_e('OUTCOMES', 'creative-garden-redesign'); ?></p>
                    <p class="cs_fs_20 cs_bold cs_white_color mb-0"><?php echo nl2br(esc_html($outcomes)); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php 
    // Project 3: cs_card cs_style_5 in container
    if ($total_projects >= 3) :
        $project = $all_projects[2];
?>
<div class="container">
    <div class="cs_height_100 cs_height_lg_70"></div>
    <article class="cs_card cs_style_5">
        <a href="<?php echo esc_url($project['permalink']); ?>" class="cs_card_thumb">
            <img src="<?php echo esc_url($project['thumb']); ?>" alt="<?php echo esc_attr($project['title']); ?>">
        </a>
        <div class="cs_card_right">
            <h2 class="cs_card_title cs_fs_80 mb-0"><a href="<?php echo esc_url($project['permalink']); ?>"><?php echo esc_html(strtoupper($project['title'])); ?></a></h2>
            <ul class="cs_card_info_list cs_mp_0">
                <li>
                    <p class="mb-0"><?php esc_html_e('YEAR', 'creative-garden-redesign'); ?></p>
                    <h4 class="mb-0 cs_fs_20 cs_bold"><?php echo esc_html($project['year']); ?></h4>
                </li>
                <li>
                    <p class="mb-0"><?php esc_html_e('LOCATION', 'creative-garden-redesign'); ?></p>
                    <h4 class="mb-0 cs_fs_20 cs_bold"><?php echo esc_html(strtoupper($project['location'])); ?></h4>
                </li>
                <li>
                    <p class="mb-0"><?php esc_html_e('SERVICE', 'creative-garden-redesign'); ?></p>
                    <h4 class="mb-0 cs_fs_20 cs_bold"><?php echo esc_html(strtoupper($project['service'])); ?></h4>
                </li>
            </ul>
        </div>
    </article>
    <div class="cs_height_100 cs_height_lg_70"></div>
</div>
<?php endif; ?>

<?php if ($total_projects > 3) : ?>
<hr>
<div class="cs_height_100 cs_height_lg_70"></div>
<div class="cs_slider cs_style_1 cs_slider_gap_24">
    <div class="cs_slider_container" data-autoplay="0" data-loop="1" data-speed="800" data-center="0" data-variable-width="0" data-slides-per-view="1">
        <div class="cs_slider_wrapper">
            <?php for ($i = 3; $i < $total_projects; $i++) : 
                $project = $all_projects[$i];
            ?>
            <div class="cs_slide">
                <div class="container">
                    <article class="cs_card cs_style_5">
                        <a href="<?php echo esc_url($project['permalink']); ?>" class="cs_card_thumb">
                            <img src="<?php echo esc_url($project['thumb']); ?>" alt="<?php echo esc_attr($project['title']); ?>">
                        </a>
                        <div class="cs_card_right">
                            <h2 class="cs_card_title cs_fs_80 mb-0"><a href="<?php echo esc_url($project['permalink']); ?>"><?php echo esc_html(strtoupper($project['title'])); ?></a></h2>
                            <ul class="cs_card_info_list cs_mp_0">
                                <li>
                                    <p class="mb-0"><?php esc_html_e('YEAR', 'creative-garden-redesign'); ?></p>
                                    <h4 class="mb-0 cs_fs_20 cs_bold"><?php echo esc_html($project['year']); ?></h4>
                                </li>
                                <li>
                                    <p class="mb-0"><?php esc_html_e('LOCATION', 'creative-garden-redesign'); ?></p>
                                    <h4 class="mb-0 cs_fs_20 cs_bold"><?php echo esc_html(strtoupper($project['location'])); ?></h4>
                                </li>
                                <li>
                                    <p class="mb-0"><?php esc_html_e('SERVICE', 'creative-garden-redesign'); ?></p>
                                    <h4 class="mb-0 cs_fs_20 cs_bold"><?php echo esc_html(strtoupper($project['service'])); ?></h4>
                                </li>
                            </ul>
                        </div>
                    </article>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>
    <div class="cs_height_100 cs_height_lg_70"></div>
    <hr>
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
</div>
<div class="cs_height_100 cs_height_lg_70"></div>
<?php endif; ?>

<?php else : ?>
<!-- Fallback Projects -->
<?php
$fallback_projects = array(
    array('title' => 'EVENING GARDEN', 'year' => '2024', 'location' => 'SUNNYVALE, CA', 'service' => 'GARDEN LANDSCAPING', 'img' => 'project_thumb_10.jpg', 'description' => 'A stunning evening garden designed to come alive after sunset with carefully placed lighting and night-blooming flowers.', 'outcomes' => "Beautiful evening ambiance\nNight-blooming flower showcase\nPerfect for outdoor dining"),
    array('title' => 'SECRET GARDEN', 'year' => '2024', 'location' => 'CHARLESTON, SC', 'service' => 'PUBLIC GARDEN DESIGN', 'img' => 'project_thumb_11.jpg', 'description' => 'Tucked behind an old estate, this garden design evokes the charm of a hidden garden. The lighting design enhances the feeling of discovery.', 'outcomes' => "The charm of a hidden garden\nOriental sense of discovery\nEvery step feels like an adventure"),
    array('title' => 'MINIMALIST GARDEN', 'year' => '2024', 'location' => 'ASHVILLE, NC', 'service' => 'EVENT GARDEN DESIGN', 'img' => 'project_thumb_12.jpg', 'description' => 'Clean lines and simple plantings create a peaceful minimalist retreat.', 'outcomes' => "Modern aesthetic\nLow maintenance\nPeaceful atmosphere"),
    array('title' => 'GREEN DISPLAY GARDEN', 'year' => '2023', 'location' => 'BROOKLYN, NY', 'service' => 'INDOOR GARDEN DESIGN', 'img' => 'project_thumb_13.jpg', 'description' => 'An indoor garden designed to bring nature into urban living spaces.', 'outcomes' => "Indoor greenery\nAir purification\nNatural beauty"),
    array('title' => 'TROPICAL PARADISE', 'year' => '2023', 'location' => 'MIAMI, FL', 'service' => 'GARDEN LANDSCAPING', 'img' => 'project_thumb_10.jpg', 'description' => 'A lush tropical garden featuring exotic plants and water features.', 'outcomes' => "Exotic plant collection\nWater features\nTropical ambiance"),
    array('title' => 'ZEN RETREAT', 'year' => '2022', 'location' => 'SEATTLE, WA', 'service' => 'MEDITATION GARDEN', 'img' => 'project_thumb_12.jpg', 'description' => 'A Japanese-inspired zen garden designed for meditation and relaxation.', 'outcomes' => "Peaceful atmosphere\nJapanese aesthetics\nMeditation space"),
);
$fb_total = count($fallback_projects);

// Project 1: cs_card cs_style_5 in container
if ($fb_total >= 1) :
    $project = $fallback_projects[0];
?>
<div class="container">
    <div class="cs_height_100 cs_height_lg_70"></div>
    <article class="cs_card cs_style_5">
        <div class="cs_card_thumb">
            <img src="<?php echo esc_url(CGR_URI . '/assets/img/' . $project['img']); ?>" alt="<?php echo esc_attr($project['title']); ?>">
        </div>
        <div class="cs_card_right">
            <h2 class="cs_card_title cs_fs_80 mb-0"><?php echo esc_html($project['title']); ?></h2>
            <ul class="cs_card_info_list cs_mp_0">
                <li>
                    <p class="mb-0"><?php esc_html_e('YEAR', 'creative-garden-redesign'); ?></p>
                    <h4 class="mb-0 cs_fs_20 cs_bold"><?php echo esc_html($project['year']); ?></h4>
                </li>
                <li>
                    <p class="mb-0"><?php esc_html_e('LOCATION', 'creative-garden-redesign'); ?></p>
                    <h4 class="mb-0 cs_fs_20 cs_bold"><?php echo esc_html($project['location']); ?></h4>
                </li>
                <li>
                    <p class="mb-0"><?php esc_html_e('SERVICE', 'creative-garden-redesign'); ?></p>
                    <h4 class="mb-0 cs_fs_20 cs_bold"><?php echo esc_html($project['service']); ?></h4>
                </li>
            </ul>
        </div>
    </article>
    <div class="cs_height_100 cs_height_lg_70"></div>
</div>
<?php endif; ?>

<?php 
// Project 2: cs_card cs_style_6 full-width with background
if ($fb_total >= 2) :
    $project = $fallback_projects[1];
?>
<div class="cs_card cs_style_6 cs_bg_filed" data-src="<?php echo esc_url(CGR_URI . '/assets/img/' . $project['img']); ?>">
    <div class="container">
        <div class="cs_card_in">
            <div class="cs_card_left">
                <h2 class="cs_card_title cs_white_color cs_fs_80 mb-0"><?php echo esc_html($project['title']); ?></h2>
                <ul class="cs_card_info_list cs_mp_0">
                    <li>
                        <p class="mb-0 cs_white_color"><?php esc_html_e('YEAR', 'creative-garden-redesign'); ?></p>
                        <h4 class="mb-0 cs_fs_20 cs_bold cs_white_color"><?php echo esc_html($project['year']); ?></h4>
                    </li>
                    <li>
                        <p class="mb-0 cs_white_color"><?php esc_html_e('LOCATION', 'creative-garden-redesign'); ?></p>
                        <h4 class="mb-0 cs_fs_20 cs_bold cs_white_color"><?php echo esc_html($project['location']); ?></h4>
                    </li>
                    <li>
                        <p class="mb-0 cs_white_color"><?php esc_html_e('SERVICE', 'creative-garden-redesign'); ?></p>
                        <h4 class="mb-0 cs_fs_20 cs_bold cs_white_color"><?php echo esc_html($project['service']); ?></h4>
                    </li>
                </ul>
            </div>
            <div class="cs_card_right">
                <div class="cs_card_text">
                    <p class="text-uppercase cs_white_color mb-0"><?php esc_html_e('DESCRIPTION', 'creative-garden-redesign'); ?></p>
                    <p class="cs_fs_20 cs_bold cs_white_color cs_mb_40"><?php echo esc_html($project['description']); ?></p>
                    <p class="text-uppercase cs_white_color mb-0"><?php esc_html_e('OUTCOMES', 'creative-garden-redesign'); ?></p>
                    <p class="cs_fs_20 cs_bold cs_white_color mb-0"><?php echo nl2br(esc_html($project['outcomes'])); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php 
// Project 3: cs_card cs_style_5 in container
if ($fb_total >= 3) :
    $project = $fallback_projects[2];
?>
<div class="container">
    <div class="cs_height_100 cs_height_lg_70"></div>
    <article class="cs_card cs_style_5">
        <div class="cs_card_thumb">
            <img src="<?php echo esc_url(CGR_URI . '/assets/img/' . $project['img']); ?>" alt="<?php echo esc_attr($project['title']); ?>">
        </div>
        <div class="cs_card_right">
            <h2 class="cs_card_title cs_fs_80 mb-0"><?php echo esc_html($project['title']); ?></h2>
            <ul class="cs_card_info_list cs_mp_0">
                <li>
                    <p class="mb-0"><?php esc_html_e('YEAR', 'creative-garden-redesign'); ?></p>
                    <h4 class="mb-0 cs_fs_20 cs_bold"><?php echo esc_html($project['year']); ?></h4>
                </li>
                <li>
                    <p class="mb-0"><?php esc_html_e('LOCATION', 'creative-garden-redesign'); ?></p>
                    <h4 class="mb-0 cs_fs_20 cs_bold"><?php echo esc_html($project['location']); ?></h4>
                </li>
                <li>
                    <p class="mb-0"><?php esc_html_e('SERVICE', 'creative-garden-redesign'); ?></p>
                    <h4 class="mb-0 cs_fs_20 cs_bold"><?php echo esc_html($project['service']); ?></h4>
                </li>
            </ul>
        </div>
    </article>
    <div class="cs_height_100 cs_height_lg_70"></div>
</div>
<?php endif; ?>

<?php if ($fb_total > 3) : ?>
<hr>
<div class="cs_height_100 cs_height_lg_70"></div>
<div class="cs_slider cs_style_1 cs_slider_gap_24">
    <div class="cs_slider_container" data-autoplay="0" data-loop="1" data-speed="800" data-center="0" data-variable-width="0" data-slides-per-view="1">
        <div class="cs_slider_wrapper">
            <?php for ($i = 3; $i < $fb_total; $i++) : 
                $project = $fallback_projects[$i];
            ?>
            <div class="cs_slide">
                <div class="container">
                    <article class="cs_card cs_style_5">
                        <div class="cs_card_thumb">
                            <img src="<?php echo esc_url(CGR_URI . '/assets/img/' . $project['img']); ?>" alt="<?php echo esc_attr($project['title']); ?>">
                        </div>
                        <div class="cs_card_right">
                            <h2 class="cs_card_title cs_fs_80 mb-0"><?php echo esc_html($project['title']); ?></h2>
                            <ul class="cs_card_info_list cs_mp_0">
                                <li>
                                    <p class="mb-0"><?php esc_html_e('YEAR', 'creative-garden-redesign'); ?></p>
                                    <h4 class="mb-0 cs_fs_20 cs_bold"><?php echo esc_html($project['year']); ?></h4>
                                </li>
                                <li>
                                    <p class="mb-0"><?php esc_html_e('LOCATION', 'creative-garden-redesign'); ?></p>
                                    <h4 class="mb-0 cs_fs_20 cs_bold"><?php echo esc_html($project['location']); ?></h4>
                                </li>
                                <li>
                                    <p class="mb-0"><?php esc_html_e('SERVICE', 'creative-garden-redesign'); ?></p>
                                    <h4 class="mb-0 cs_fs_20 cs_bold"><?php echo esc_html($project['service']); ?></h4>
                                </li>
                            </ul>
                        </div>
                    </article>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>
    <div class="cs_height_100 cs_height_lg_70"></div>
    <hr>
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
</div>
<div class="cs_height_100 cs_height_lg_70"></div>
<?php endif; ?>
<?php endif; ?>
<!-- End Projects Section -->

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
