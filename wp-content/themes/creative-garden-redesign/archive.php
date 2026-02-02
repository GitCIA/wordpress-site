<?php
/**
 * Archive Template
 *
 * @package CreativeGardenDesign
 */

get_header();

$post_type = get_post_type();
$bg_image = CGR_URI . '/assets/img/about_heading_bg.jpg';

if ($post_type === 'service') {
    $bg_image = CGR_URI . '/assets/img/service_heading_bg.jpg';
} elseif ($post_type === 'project') {
    $bg_image = CGR_URI . '/assets/img/project_heading_bg.jpg';
}
?>

<!-- Start Page Heading Section -->
<section class="cs_page_heading cs_style_1 cs_bg_filed cs_heading_bg" data-src="<?php echo esc_url($bg_image); ?>">
    <div class="container">
        <?php cgr_breadcrumb(); ?>
        <h1 class="cs_page_title mb-0 cs_fs_80 wow fadeInUp">
            <?php
            if (is_post_type_archive('service')) {
                esc_html_e('OUR SERVICES', 'creative-garden-redesign');
            } elseif (is_post_type_archive('project')) {
                esc_html_e('OUR PROJECTS', 'creative-garden-redesign');
            } elseif (is_post_type_archive('team')) {
                esc_html_e('OUR TEAM', 'creative-garden-redesign');
            } else {
                the_archive_title();
            }
            ?>
        </h1>
    </div>
</section>
<!-- End Page Heading Section -->

<?php if (is_post_type_archive('service')) : ?>
<!-- Start Services Section -->
<div class="cs_height_100 cs_height_lg_70"></div>
<div class="container">
    <div class="row cs_gap_y_40 cs_gap_x_40">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post();
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
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>
<div class="cs_height_100 cs_height_lg_70"></div>
<!-- End Services Section -->

<?php elseif (is_post_type_archive('project')) : ?>
<!-- Start Projects Section -->
<?php
// Get all projects
$all_projects = array();
if (have_posts()) :
    while (have_posts()) : the_post();
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
endif;

$total_projects = count($all_projects);

if ($total_projects > 0) :
    // Show first 2 projects normally
    for ($i = 0; $i < min(2, $total_projects); $i++) :
        $project = $all_projects[$i];
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
<?php endfor; ?>

<?php if ($total_projects > 2) : ?>
<hr>
<div class="cs_height_100 cs_height_lg_70"></div>
<div class="cs_slider cs_style_1 cs_slider_gap_24">
    <div class="cs_slider_container" data-autoplay="0" data-loop="1" data-speed="800" data-center="0" data-variable-width="0" data-slides-per-view="1">
        <div class="cs_slider_wrapper">
            <?php for ($i = 2; $i < $total_projects; $i++) : 
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
<?php endif; ?>
<!-- End Projects Section -->

<?php else : ?>
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
<?php endif; ?>

<?php get_footer(); ?>
