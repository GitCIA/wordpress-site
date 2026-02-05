<?php
/**
 * Template Name: About Page
 * Template Post Type: page
 *
 * @package CreativeGardenDesign
 */

get_header();

// About Page Customizer Options
$about_sections = array();
for ($i = 1; $i <= 3; $i++) {
    $title = get_theme_mod('about_section_' . $i . '_title', '');
    $text_1 = get_theme_mod('about_section_' . $i . '_text_1', '');
    $text_2 = get_theme_mod('about_section_' . $i . '_text_2', '');
    
    // Only add section if it has content
    if (!empty($title) || !empty($text_1) || !empty($text_2)) {
        $about_sections[] = array(
            'title'  => $title,
            'text_1' => $text_1,
            'text_2' => $text_2,
        );
    }
}

$about_team_title = get_theme_mod('about_team_title', 'OUR TEAM <br><span>OF</span> DEDICATION');
$about_work_title = get_theme_mod('about_work_title', 'OUR <br><span>WORK</span>');
$about_video_url = get_theme_mod('about_video_url', 'https://youtu.be/LsU5Y5svvq8');
$about_video_bg = get_theme_mod('about_video_bg', CGR_URI . '/assets/img/video_block_bg.jpg');
$about_cta_bg = get_theme_mod('about_cta_bg', CGR_URI . '/assets/img/cta_bg_3.jpg');
$about_brand_display = get_theme_mod('about_brand_display', true);
$about_brand_count = absint(get_theme_mod('about_brand_count', 6));
?>

<!-- Start Page Heading Section -->
<section class="cs_page_heading cs_style_1 cs_bg_filed cs_heading_bg" data-src="<?php echo esc_url(CGR_URI . '/assets/img/about_heading_bg.jpg'); ?>">
    <div class="container">
        <?php cgr_breadcrumb(); ?>
        <h1 class="cs_page_title mb-0 cs_fs_80 wow fadeInUp"><?php esc_html_e('ABOUT US', 'creative-garden-redesign'); ?></h1>
    </div>
</section>
<!-- End Page Heading Section -->

<!-- Start About Section -->
<section>
    <div class="cs_height_100 cs_height_lg_70"></div>
    <div class="container">
        <?php foreach ($about_sections as $section) : ?>
        <div class="row cs_gap_x_40 cs_gap_y_24">
            <div class="col-lg-4">
                <div class="cs_section_heading cs_style_4">
                    <h2 class="cs_section_title cs_fs_32 cs_bold mb-0 wow fadeInDown"><?php echo wp_kses_post($section['title']); ?></h2>
                </div>
            </div>
            <div class="col-lg-4">
                <p class="cs_fs_20 mb-0"><?php echo esc_html($section['text_1']); ?></p>
            </div>
            <div class="col-lg-4">
                <p class="cs_fs_20 mb-0"><?php echo esc_html($section['text_2']); ?></p>
            </div>
        </div>
        <div class="cs_height_56 cs_height_lg_35"></div>
        <?php endforeach; ?>
        <div class="row cs_gap_y_30">
            <div class="col-lg-4 wow fadeInLeft">
                <a href="<?php echo esc_url($about_video_url); ?>" class="cs_video_block cs_style_1 cs_bg_filed cs_video_open cs_center cs_radius_20" data-src="<?php echo esc_url($about_video_bg); ?>">
                    <span class="cs_player_btn cs_heading_color">
                        <svg width="19" height="22" viewBox="0 0 19 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.5 11L0.5 21.3923V0.607696L18.5 11Z" fill="currentColor"/>
                        </svg>
                    </span>
                </a>
            </div>
            <div class="col-lg-8 wow fadeInRight">
                <div class="cs_cta cs_style_2 cs_bg_filed cs_radius_20" data-src="<?php echo esc_url($about_cta_bg); ?>">
                    <a href="<?php echo esc_url(home_url('/projects/')); ?>" class="cs_btn cs_style_2 cs_bold cs_white_color"><?php esc_html_e('Explore Projects', 'creative-garden-redesign'); ?></a>
                </div>
            </div>
        </div>
    </div>
    <div class="cs_height_100 cs_height_lg_70"></div>
</section>
<!-- End About Section -->

<!-- Start Team Member Section -->
<section>
    <div class="container">
        <div class="cs_slider cs_style_1 cs_slider_gap_24">
            <div class="cs_section_heading cs_style_2 cs_color_1">
                <h2 class="cs_section_title cs_fs_80 mb-0 wow fadeInDown"><?php echo wp_kses_post($about_team_title); ?></h2>
                <div class="cs_section_right">
                    <h3 class="cs_brackets_title cs_normal cs_fs_16 mb-0"><?php esc_html_e('TEAM', 'creative-garden-redesign'); ?></h3>
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
            <div class="cs_slider_container" data-autoplay="0" data-loop="1" data-speed="800" data-center="0" data-variable-width="0" data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="3" data-lg-slides="4" data-add-slides="4">
                <div class="cs_slider_wrapper wow fadeInUp">
                    <?php
                    $team_query = new WP_Query(array(
                        'post_type'      => 'team',
                        'posts_per_page' => 5,
                        'orderby'        => 'menu_order',
                        'order'          => 'ASC',
                    ));

                    if ($team_query->have_posts()) :
                        while ($team_query->have_posts()) : $team_query->the_post();
                            $position = get_post_meta(get_the_ID(), '_team_position', true);
                            $bio = get_post_meta(get_the_ID(), '_team_bio', true);
                            $thumb_url = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'CreativeGardenDesign-team') : CGR_URI . '/assets/img/team_member_1.jpg';
                    ?>
                    <div class="cs_slide">
                        <div class="cs_team_member cs_style_1">
                            <a href="<?php the_permalink(); ?>" class="cs_team_member_link" aria-label="<?php echo esc_attr(get_the_title()); ?>">
                                <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>" class="cs_team_member_img">
                                <div class="cs_team_member_info">
                                    <h3 class="cs_team_member_name cs_white_color cs_fs_20 cs_bold mb-0"><?php the_title(); ?></h3>
                                    <?php if ($position) : ?>
                                    <p class="cs_team_member_designation cs_white_color cs_fs_20 mb-0"><?php echo esc_html($position); ?></p>
                                    <?php endif; ?>
                                    <?php if ($bio) : ?>
                                    <p class="cs_team_member_desc cs_white_color mb-0"><?php echo esc_html($bio); ?></p>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php endwhile; wp_reset_postdata(); else : ?>
                    <!-- Fallback team members -->
                    <?php
                    $fallback_team = array(
                        array('name' => 'Sarah Turner', 'position' => 'Founder & Lead Designer', 'bio' => 'Experienced in 10 years of Garden Landscape design.', 'img' => 'team_member_1.jpg'),
                        array('name' => 'John Mason', 'position' => 'Landscape Architect', 'bio' => 'Experienced in 10 years of Garden Landscape design.', 'img' => 'team_member_2.jpg'),
                        array('name' => 'Emily Parker', 'position' => 'Horticulture Expert', 'bio' => 'Experienced in 10 years of Garden Landscape design.', 'img' => 'team_member_3.jpg'),
                        array('name' => 'David Anderson', 'position' => 'Team Project Manager', 'bio' => 'Experienced in 10 years of Garden Landscape design.', 'img' => 'team_member_4.jpg'),
                    );
                    foreach ($fallback_team as $member) :
                    ?>
                    <div class="cs_slide">
                        <div class="cs_team_member cs_style_1">
                            <img src="<?php echo esc_url(CGR_URI . '/assets/img/' . $member['img']); ?>" alt="<?php echo esc_attr($member['name']); ?>" class="cs_team_member_img">
                            <div class="cs_team_member_info">
                                <h3 class="cs_team_member_name cs_white_color cs_fs_20 cs_bold mb-0"><?php echo esc_html($member['name']); ?></h3>
                                <p class="cs_team_member_designation cs_white_color cs_fs_20 mb-0"><?php echo esc_html($member['position']); ?></p>
                                <p class="cs_team_member_desc cs_white_color mb-0"><?php echo esc_html($member['bio']); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="cs_pagination cs_style_2 cs_show_lg"></div>
        </div>
    </div>
    <?php if ($about_brand_display) : ?>
    <div class="cs_height_100 cs_height_lg_70"></div>
    <?php endif; ?>
</section>
<!-- End Team Member Section -->

<?php if ($about_brand_display) : ?>
<!-- Start Brand Section -->
<div class="cs_gray_bg">
    <div class="cs_height_64 cs_height_lg_50"></div>
    <div class="container">
        <div class="cs_slider cs_style_1 cs_slider_gap_24">
            <div class="cs_slider_container" data-autoplay="0" data-loop="1" data-speed="800" data-center="0" data-variable-width="0" data-slides-per-view="responsive" data-xs-slides="2" data-sm-slides="3" data-md-slides="5" data-lg-slides="6" data-add-slides="6">
                <div class="cs_slider_wrapper">
                    <?php for ($i = 1; $i <= $about_brand_count; $i++) : ?>
                        <?php $brand_logo = get_theme_mod('about_brand_logo_' . $i, CGR_URI . '/assets/img/brand_logo_' . $i . '.svg'); ?>
                        <?php if (!empty($brand_logo)) : ?>
                        <div class="cs_slide">
                            <div class="cs_brand cs_style_1">
                                <img src="<?php echo esc_url($brand_logo); ?>" alt="">
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="cs_height_64 cs_height_lg_50"></div>
</div>
<!-- End Brand Section -->
<?php endif; ?>

<!-- Start Work Section -->
<section>
    <div class="cs_height_100 cs_height_lg_70"></div>
    <div class="container">
        <div class="cs_slider cs_style_1 cs_slider_gap_24">
            <div class="cs_section_heading cs_style_2 cs_color_1">
                <h2 class="cs_section_title cs_fs_80 mb-0 wow fadeInDown"><?php echo wp_kses_post($about_work_title); ?></h2>
                <div class="cs_section_right">
                    <a href="<?php echo esc_url(home_url('/gallery/')); ?>" class="cs_btn cs_style_2 cs_bold cs_heading_color mt-2 fadeInDown"><?php esc_html_e('See More Work', 'creative-garden-redesign'); ?></a>
                </div>
            </div>
        </div>
        <div class="cs_height_64 cs_height_lg_50"></div>
        <div class="cs_isotop cs_style_1 cs_isotop_col_3 cs_has_gutter_24 cs_lightgallery">
            <div class="cs_grid_sizer"></div>
            <?php
            // Get project images
            $projects = get_posts(array(
                'post_type'      => 'project',
                'posts_per_page' => 5,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ));
            
            $counter = 0;
            foreach ($projects as $project) :
                $counter++;
                $featured_image = get_the_post_thumbnail_url($project->ID, 'large');
                if (!$featured_image) {
                    $featured_image = CGR_URI . '/assets/img/work_thumb_' . (($counter - 1) % 5 + 1) . '.jpg';
                }
                $project_year = get_post_meta($project->ID, '_project_year', true);
                if (empty($project_year)) {
                    $project_year = get_the_date('Y', $project->ID);
                }
            ?>
            <div class="cs_isotop_item<?php echo $counter == 1 ? ' wow fadeInLeft' : ($counter == 3 ? ' wow fadeInRight' : ''); ?>">
                <a href="<?php echo esc_url($featured_image); ?>" class="cs_gallery cs_style_1 cs_center cs_gallery_item">
                    <img src="<?php echo esc_url($featured_image); ?>" alt="<?php echo esc_attr($project->post_title); ?>">
                    <span class="cs_gallery_info_wrap cs_center">
                        <span class="cs_gallery_info text-center cs_center">
                            <span class="cs_white_color cs_fs_16 cs_bold cs_mb_4 d-block"><?php echo esc_html($project->post_title); ?></span>
                            <span class="cs_white_color d-block"><?php echo esc_html($project_year); ?></span>
                        </span>
                    </span>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="cs_height_100 cs_height_lg_70"></div>
</section>
<!-- End Work Section -->

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
                <h2 class="cs_card_title cs_gradient_color_1 cs_fs_80 mb-0 wow fadeInUp"><?php esc_html_e('MAKE YOUR DREAM', 'creative-garden-redesign'); ?> <br><?php esc_html_e('GARDEN INTO REALITY', 'creative-garden-redesign'); ?></h2>
            </div>
            <a href="<?php echo esc_url(get_post_type_archive_link('project')); ?>" class="cs_arrow_btn cs_size_lg cs_center cs_white_bg cs_heading_color">
                <?php echo cgr_arrow_icon(); ?>
            </a>
        </div>
    </div>
</section>
<!-- End CTA Card Section -->

<?php get_footer(); ?>
