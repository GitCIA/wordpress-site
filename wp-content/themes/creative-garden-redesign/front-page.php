<?php
/**
 * Front Page Template
 *
 * @package CreativeGardenDesign
 */

get_header();

// Get hero settings
$hero_title = get_theme_mod('hero_title', 'CREATE YOUR <b>DREAM GARDEN</b>');
$hero_subtitle = get_theme_mod('hero_subtitle', 'Crafting dream gardens with passion, creativity, and sustainability for over a decade with our experienced landscape artists and gardener teams.');
$hero_btn_1_text = get_theme_mod('hero_btn_1_text', 'Services');
$hero_btn_1_url = get_theme_mod('hero_btn_1_url', '/services/');
$hero_btn_2_text = get_theme_mod('hero_btn_2_text', 'Explore Projects');
$hero_btn_2_url = get_theme_mod('hero_btn_2_url', '/projects/');
$hero_clients_count = get_theme_mod('hero_clients_count', '500+');
$hero_box_display = get_theme_mod('hero_box_display', true);
$hero_feature_title = get_theme_mod('hero_feature_title', 'Hachioji Garden');
$hero_feature_desc = get_theme_mod('hero_feature_desc', 'We design Hachioji Garden as a part of our new Landscape Design Commission in the country.');
$hero_feature_url = get_theme_mod('hero_feature_url', get_post_type_archive_link('project'));
$hero_bg_video_url = get_theme_mod('hero_bg_video_url', '');
if (empty($hero_bg_video_url)) {
    $hero_bg_video_url = CGR_URI . '/assets/video/cgd.mp4';
}

$hero_video_is_youtube = false;
$hero_video_embed_url = '';
if (preg_match('~(?:youtu\.be/|youtube\.com/(?:watch\?v=|embed/|v/))([A-Za-z0-9_-]+)~', $hero_bg_video_url, $matches)) {
    $youtube_id = $matches[1];
    if (!empty($youtube_id)) {
        $hero_video_is_youtube = true;
        $hero_video_embed_url = 'https://www.youtube.com/embed/' . $youtube_id . '?autoplay=1&mute=1&loop=1&playlist=' . $youtube_id . '&controls=0&showinfo=0&modestbranding=1&playsinline=1';
    }
}

// Get values card settings
$values_card_display = get_theme_mod('values_card_display', true);

// Get feature settings
$features_title = get_theme_mod('features_title', 'WE ARE <span>DIFFERENT</span> IN EVERY WAYS');

// Get process settings
$process_title = get_theme_mod('process_title', 'SIMPLE STEPS FOR OUR <span>LANDSCAPE</span> WORK');

// Get CTA settings
$cta_title = get_theme_mod('cta_title', 'READY TO TRANSFORM <br>YOUR GARDEN?');
$cta_btn_text = get_theme_mod('cta_btn_text', 'Contact Us');
$cta_btn_url = get_theme_mod('cta_btn_url', '/contact/');
$cta_background = cgr_get_cta_background();
?>

<!-- Start Hero Section -->
<section class="cs_hero cs_style_1 cs_heading_bg cs_white_color">
    <div class="container">
        <div class="cs_hero_in">
            <div class="cs_hero_text">
                <h1 class="cs_hero_title cs_fs_100 cs_normal cs_mb_12 cs_white_color cs_gradient_color_1 wow fadeInUp"><?php echo wp_kses_post($hero_title); ?></h1>
                <p class="cs_hero_subtitle cs_fs_20 cs_mb_32 cs_opacity_7_5"><?php echo esc_html($hero_subtitle); ?></p>
                <div class="cs_hero_btns">
                    <a href="<?php echo esc_url($hero_btn_1_url); ?>" class="cs_btn cs_style_1 cs_bold cs_heading_color cs_white_bg wow fadeInLeft"><?php echo esc_html($hero_btn_1_text); ?></a>
                    <a href="<?php echo esc_url($hero_btn_2_url); ?>" class="cs_btn cs_style_2 cs_bold cs_white_color wow fadeInRight"><?php echo esc_html($hero_btn_2_text); ?></a>
                </div>
            </div>
            <div class="cs_hero_funfact_wrap wow fadeInRight">
                <div class="cs_hero_funfact">
                    <h3 class="cs_fs_24 cs_bold cs_white_color mb-0"><?php echo esc_html($hero_clients_count); ?></h3>
                    <p class="cs_fs_20 cs_white_color cs_opacity_7_5 cs_mb_16"><?php esc_html_e('Satisfied Clients', 'creative-garden-redesign'); ?></p>
                    <div class="cs_circle_group">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
            <?php if ($hero_box_display) : ?>
            <div class="cs_hero_box wow fadeInUp">
                <div class="cs_hero_box_icon cs_mb_29">
                    <svg width="22" height="30" viewBox="0 0 22 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 0C4.93447 0 0 4.97132 0 11.0821C0 13.0939 0.895529 15.2575 0.933059 15.3488C1.22229 16.0404 1.793 17.1147 2.20453 17.7445L9.74665 29.2575C10.0553 29.7295 10.5121 30 11 30C11.4879 30 11.9447 29.7295 12.2534 29.2581L19.7961 17.7445C20.2083 17.1147 20.7784 16.0404 21.0676 15.3488C21.1051 15.2581 22 13.0945 22 11.0821C22 4.97132 17.0655 0 11 0ZM19.8744 14.8429C19.6162 15.4628 19.085 16.4622 18.7155 17.0267L11.1728 28.5404C11.0239 28.7679 10.9767 28.7679 10.8279 28.5404L3.28512 17.0267C2.91565 16.4622 2.38441 15.4622 2.12624 14.8422C2.11523 14.8155 1.29412 12.824 1.29412 11.0821C1.29412 5.69035 5.64818 1.30378 11 1.30378C16.3518 1.30378 20.7059 5.69035 20.7059 11.0821C20.7059 12.8266 19.8828 14.8233 19.8744 14.8429Z" fill="currentColor"/>
                        <path d="M11.0003 5.21578C7.78893 5.21578 5.17676 7.84811 5.17676 11.0828C5.17676 14.3175 7.78893 16.9498 11.0003 16.9498C14.2116 16.9498 16.8238 14.3175 16.8238 11.0828C16.8238 7.84811 14.2116 5.21578 11.0003 5.21578ZM11.0003 15.646C8.50329 15.646 6.47088 13.5991 6.47088 11.0828C6.47088 8.56649 8.50329 6.51956 11.0003 6.51956C13.4973 6.51956 15.5297 8.56649 15.5297 11.0828C15.5297 13.5991 13.4973 15.646 11.0003 15.646Z" fill="currentColor"/>
                    </svg>
                </div>
                <h3 class="cs_hero_box_title cs_fs_24 cs_mb_12 cs_white_color"><?php echo esc_html($hero_feature_title); ?></h3>
                <p class="cs_hero_box_subtitle mb-0 cs_opacity_7_5"><?php echo esc_html($hero_feature_desc); ?></p>
                <a href="<?php echo esc_url($hero_feature_url ? $hero_feature_url : get_post_type_archive_link('project')); ?>" class="cs_arrow_btn cs_hero_box_btn cs_center cs_heading_bg cs_white_color">
                    <?php echo cgr_arrow_icon(); ?>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="cs_hero_bg">
        <?php if ($hero_video_is_youtube) : ?>
            <iframe
                class="cs_hero_bg_video"
                src="<?php echo esc_url($hero_video_embed_url); ?>"
                title="<?php echo esc_attr($hero_feature_title); ?>"
                frameborder="0"
                allow="autoplay; fullscreen; picture-in-picture"
                allowfullscreen
            ></iframe>
        <?php else : ?>
            <video class="cs_hero_bg_video" autoplay muted loop playsinline>
                <source src="<?php echo esc_url($hero_bg_video_url); ?>" type="video/mp4">
            </video>
        <?php endif; ?>
    </div>
</section>
<!-- End Hero Section -->

<?php if ($values_card_display) : ?>
<!-- Start Values Section -->
<div class="cs_height_100 cs_height_lg_70"></div>
<div class="container">
    <div class="cs_values_card cs_style_1">
        <div class="cs_values_card_left">
            <h3 class="cs_brackets_title cs_normal cs_fs_16 mb-0"><?php esc_html_e('WHO WE ARE', 'creative-garden-redesign'); ?></h3>
        </div>
        <div class="cs_values_card_left">
            <ul class="cs_values cs_mp_0 cs_heading_color cs_fs_20">
                <li>
                    <span><?php esc_html_e('Landscape Design', 'creative-garden-redesign'); ?></span>
                    <span class="cs_bold">01</span>
                </li>
                <li>
                    <span><?php esc_html_e('Indoor Garden', 'creative-garden-redesign'); ?></span>
                    <span class="cs_bold">02</span>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Values Section -->
<?php endif; ?>

<!-- Start Feature Section -->
<section>
    <div class="cs_height_100 cs_height_lg_70"></div>
    <div class="container">
        <div class="cs_section_heading cs_style_1">
            <h2 class="cs_section_title cs_fs_80 mb-0 wow fadeInDown"><?php echo wp_kses_post($features_title); ?></h2>
            <div class="cs_section_right">
                <a href="<?php echo esc_url(get_post_type_archive_link('service')); ?>" class="cs_btn cs_style_1 cs_bold cs_heading_bg cs_white_color w-100 wow fadeInRight"><?php esc_html_e('Services', 'creative-garden-redesign'); ?></a>
            </div>
        </div>
        <div class="cs_height_64 cs_height_lg_50"></div>
        <div class="row align-items-end cs_gap_y_50">
            <div class="col-lg-4">
                <div class="cs_img_box cs_style_1 wow fadeInLeft">
                    <?php
                    $feature_image_id = get_theme_mod('feature_image');
                    if ($feature_image_id) {
                        echo wp_get_attachment_image($feature_image_id, 'large');
                    } else {
                        echo '<img src="' . esc_url(CGR_URI . '/assets/img/feature_thumb.jpg') . '" alt="">';
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row cs_gap_y_64">
                    <?php for ($i = 1; $i <= 4; $i++) :
                        $feature_defaults = array(
                            1 => array('icon' => 'fa-regular fa-heart', 'title' => 'Passion in every work', 'desc' => 'We are deeply passionate about creating beautiful, sustainable green landscapes for our clients.'),
                            2 => array('icon' => 'fa-solid fa-link', 'title' => 'Collaboration on top', 'desc' => 'We make your dream design come true by combining your ideas with our 10+ years of garden design expertise.'),
                            3 => array('icon' => 'fa-brands fa-buffer', 'title' => 'Sustainability in check', 'desc' => 'We love nurturing nature, one garden at a time, so that you can enjoy the beautiful landscape of our garden even longer.'),
                            4 => array('icon' => 'fa-brands fa-ubuntu', 'title' => 'Creativity unleashed', 'desc' => 'We make sure to only give you our innovative designs that stand out to make sure that your garden is not like the others.'),
                        );
                        $icon = get_theme_mod('feature_' . $i . '_icon', $feature_defaults[$i]['icon']);
                        $title = get_theme_mod('feature_' . $i . '_title', $feature_defaults[$i]['title']);
                        $desc = get_theme_mod('feature_' . $i . '_desc', $feature_defaults[$i]['desc']);
                    ?>
                    <div class="col-sm-6">
                        <div class="cs_iconbox cs_style_1">
                            <div class="cs_iconbox_icon cs_center cs_mb_24">
                                <i class="<?php echo esc_attr($icon); ?>"></i>
                            </div>
                            <h3 class="cs_fs_24 cs_mb_12"><?php echo esc_html($title); ?></h3>
                            <p class="mb-0 cs_fs_20"><?php echo esc_html($desc); ?></p>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="cs_height_100 cs_height_lg_70"></div>
</section>
<!-- End Feature Section -->

<!-- Start Working Process -->
<section class="cs_heading_bg">
    <div class="cs_height_100 cs_height_lg_70"></div>
    <div class="container">
        <div class="cs_section_heading cs_style_2">
            <h2 class="cs_section_title cs_white_color cs_fs_80 mb-0 wow fadeInUp"><?php echo wp_kses_post($process_title); ?></h2>
            <div class="cs_section_right">
                <h3 class="cs_brackets_title cs_normal cs_fs_16 mb-0 cs_white_color"><?php esc_html_e('HOW IT WORKS', 'creative-garden-redesign'); ?></h3>
            </div>
        </div>
        <div class="cs_height_64 cs_height_lg_50"></div>
        <div class="cs_card_3_wrap">
            <?php
            $process_defaults = array(
                1 => array('title' => 'Design consultation', 'desc' => 'In the initial step, we sit down with you to have a detailed discussion about your gardening vision and preferences.'),
                2 => array('title' => 'Design & planning', 'desc' => 'Our team of experts meticulously crafts a custom garden design that aligns with your desires and your space characteristics.'),
                3 => array('title' => 'Implement construction', 'desc' => 'We present the design to you for review. Once approved, we move forward to implement the plan with construction.'),
                4 => array('title' => 'Garden decorating', 'desc' => 'With your design finalized, we put on our gardening gloves and work, creating your garden to be as beautiful as envisioned.'),
            );
            for ($i = 1; $i <= 4; $i++) :
                $title = get_theme_mod('process_' . $i . '_title', $process_defaults[$i]['title']);
                $desc = get_theme_mod('process_' . $i . '_desc', $process_defaults[$i]['desc']);
            ?>
            <div class="cs_card cs_style_3">
                <div class="cs_card_in">
                    <h3 class="cs_fs_24 cs_bold cs_white_color cs_mb_12"><?php printf('%02d  |  %s', $i, esc_html($title)); ?></h3>
                    <p class="mb-0 cs_white_color cs_opacity_5 cs_fs_20"><?php echo esc_html($desc); ?></p>
                </div>
            </div>
            <?php endfor; ?>
            <div class="cs_section_logo">
                <img src="<?php echo esc_url(cgr_get_logo()); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
            </div>
        </div>
    </div>
    <div class="cs_height_100 cs_height_lg_70"></div>
</section>
<!-- End Working Process -->

<!-- Start Services Section -->
<section>
    <div class="cs_height_100 cs_height_lg_70"></div>
    <div class="container">
        <div class="cs_section_heading cs_style_3">
            <h3 class="cs_brackets_title cs_normal cs_fs_16 mb-0 wow fadeInUp"><?php esc_html_e('SERVICES', 'creative-garden-redesign'); ?></h3>
            <div class="cs_section_right">
                <a href="<?php echo esc_url(get_post_type_archive_link('service')); ?>" class="cs_btn cs_style_2 cs_bold cs_heading_color"><?php esc_html_e('See More Services', 'creative-garden-redesign'); ?></a>
            </div>
        </div>
        <div class="cs_height_64 cs_height_lg_50"></div>
        <div class="cs_card_1_group">
            <?php
            $services = new WP_Query(array(
                'post_type'      => 'service',
                'posts_per_page' => 4,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ));

            $count = 0;
            while ($services->have_posts()) : $services->the_post();
                $count++;
                $tags = get_post_meta(get_the_ID(), '_service_tags', true);
                $tags_array = $tags ? explode(',', $tags) : array('Home', 'Garden', 'Landscape Design', 'Expert');
                $thumb_url = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'CreativeGardenDesign-service') : CGR_URI . '/assets/img/service_thumb_' . $count . '.jpg';
                $active_class = ($count === 1) ? ' active' : '';
                $wow_class = ($count === 1) ? ' wow fadeInLeft' : (($count === 4) ? ' wow fadeInRight' : '');
            ?>
            <article class="cs_card cs_style_1 cs_hover_active cs_heading_bg cs_bg_filed<?php echo esc_attr($active_class . $wow_class); ?>" data-src="<?php echo esc_url($thumb_url); ?>">
                <div class="cs_card_top">
                    <div class="cs_card_tags">
                        <?php foreach ($tags_array as $tag) : ?>
                        <span class="cs_card_tag"><?php echo esc_html(trim($tag)); ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="cs_card_bottom">
                    <h2 class="cs_card_title cs_white_color cs_fs_32"><?php the_title(); ?></h2>
                    <p class="cs_card_subtitle mb-0 cs_white_color"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                </div>
                <a href="<?php the_permalink(); ?>" class="cs_arrow_btn cs_size_lg cs_center cs_white_bg cs_heading_color" aria-label="<?php echo esc_attr(get_the_title()); ?>">
                    <?php echo cgr_arrow_icon(); ?>
                </a>
            </article>
            <?php
            endwhile;
            wp_reset_postdata();

            // Fallback if no services
            if (!$services->have_posts()) :
                $fallback_services = array(
                    array('title' => 'HOME GARDEN', 'desc' => 'Crafting the perfect garden space for your home. Whether indoor or outdoor, we got it all ready for your greenery needs.'),
                    array('title' => 'PLANT SELECTION', 'desc' => 'Crafting the perfect garden space for your home. Whether indoor or outdoor, we got it all ready for your greenery needs.'),
                    array('title' => 'HARD SCAPING', 'desc' => 'Crafting the perfect garden space for your home. Whether indoor or outdoor, we got it all ready for your greenery needs.'),
                    array('title' => 'PUBLIC GARDEN', 'desc' => 'Crafting the perfect garden space for your home. Whether indoor or outdoor, we got it all ready for your greenery needs.'),
                );
                foreach ($fallback_services as $index => $service) :
                    $active_class = ($index === 0) ? ' active' : '';
            ?>
            <div class="cs_card cs_style_1 cs_hover_active cs_heading_bg cs_bg_filed<?php echo esc_attr($active_class); ?>" data-src="<?php echo esc_url(CGR_URI . '/assets/img/service_thumb_' . ($index + 1) . '.jpg'); ?>">
                <div class="cs_card_top">
                    <div class="cs_card_tags">
                        <span class="cs_card_tag">Home</span>
                        <span class="cs_card_tag">Garden</span>
                        <span class="cs_card_tag">Landscape Design</span>
                        <span class="cs_card_tag">Expert</span>
                    </div>
                </div>
                <div class="cs_card_bottom">
                    <h2 class="cs_card_title cs_white_color cs_fs_32"><?php echo esc_html($service['title']); ?></h2>
                    <p class="cs_card_subtitle mb-0 cs_white_color"><?php echo esc_html($service['desc']); ?></p>
                </div>
                <a href="<?php echo esc_url(get_post_type_archive_link('service')); ?>" class="cs_arrow_btn cs_size_lg cs_center cs_white_bg cs_heading_color">
                    <?php echo cgr_arrow_icon(); ?>
                </a>
            </div>
            <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
    <div class="cs_height_100 cs_height_lg_70"></div>
</section>
<!-- End Services Section -->

<!-- Start Testimonial Section -->
<section class="cs_gray_bg">
    <div class="cs_height_100 cs_height_lg_70"></div>
    <div class="container">
        <div class="text-center">
            <h3 class="cs_brackets_title cs_normal cs_fs_16 mb-0 wow fadeInDown"><?php esc_html_e('TESTIMONIAL', 'creative-garden-redesign'); ?></h3>
        </div>
        <div class="cs_height_64 cs_height_lg_50"></div>
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="cs_slider cs_style_1">
                    <div class="cs_slider_container" data-autoplay="0" data-loop="1" data-speed="800" data-center="0" data-variable-width="0" data-slides-per-view="1">
                        <div class="cs_slider_wrapper">
                            <?php
                            $testimonials = new WP_Query(array(
                                'post_type'      => 'testimonial',
                                'posts_per_page' => -1,
                            ));

                            if ($testimonials->have_posts()) :
                                $first = true;
                                while ($testimonials->have_posts()) : $testimonials->the_post();
                                    $name = get_post_meta(get_the_ID(), '_testimonial_name', true);
                                    $position = get_post_meta(get_the_ID(), '_testimonial_position', true);
                            ?>
                            <div class="cs_slide">
                                <div class="cs_testimonial cs_style_1 text-center<?php echo $first ? ' wow fadeInUp' : ''; ?>">
                                    <blockquote class="cs_testimonial_blockquote cs_heading_color cs_fs_32 cs_bold cs_mb_48"><?php the_content(); ?></blockquote>
                                    <div class="cs_testimonial_meta">
                                        <h4 class="cs_testimonial_avatar cs_bold cs_fs_16 cs_mb_2"><?php echo esc_html(strtoupper($name ?: get_the_title())); ?></h4>
                                        <p class="cs_testimonial_avatar_designation mb-0"><?php echo esc_html($position); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php
                                    $first = false;
                                endwhile;
                                wp_reset_postdata();
                            else :
                            ?>
                            <div class="cs_slide">
                                <div class="cs_testimonial cs_style_1 text-center wow fadeInUp">
                                    <blockquote class="cs_testimonial_blockquote cs_heading_color cs_fs_32 cs_bold cs_mb_48">CreativeGardenDesign's dedication to bringing our <span>vision</span> to life was exceptional. They turned our <span>backyard</span> into a haven of tranquility. Their attention to detail and sustainable practices on their design <span>impressed</span> us.</blockquote>
                                    <div class="cs_testimonial_meta">
                                        <h4 class="cs_testimonial_avatar cs_bold cs_fs_16 cs_mb_2">STEVE EVANS</h4>
                                        <p class="cs_testimonial_avatar_designation mb-0">CEO of Malley Company</p>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="cs_slider_arrows cs_style_2">
                        <div class="cs_left_arrow cs_heading_color"><?php echo cgr_arrow_left_icon(); ?></div>
                        <div class="cs_right_arrow cs_heading_color"><?php echo cgr_arrow_right_icon(); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cs_height_100 cs_height_lg_70"></div>
</section>
<!-- End Testimonial Section -->

<!-- Start Works Section -->
<section>
    <div class="cs_height_100 cs_height_lg_70"></div>
    <div class="container">
        <div class="cs_section_heading cs_style_2 cs_color_1">
            <h2 class="cs_section_title cs_fs_80 mb-0 wow fadeInDown"><?php esc_html_e('GET TO', 'creative-garden-redesign'); ?> <span><?php esc_html_e('KNOW', 'creative-garden-redesign'); ?></span> <?php esc_html_e('OUR', 'creative-garden-redesign'); ?> <br><?php esc_html_e('LATEST GARDEN', 'creative-garden-redesign'); ?> <span><?php esc_html_e('WORKS', 'creative-garden-redesign'); ?></span></h2>
            <div class="cs_section_right">
                <h3 class="cs_brackets_title cs_normal cs_fs_16 mb-0"><?php esc_html_e('WORKS', 'creative-garden-redesign'); ?></h3>
            </div>
        </div>
        <div class="cs_height_64 cs_height_lg_50"></div>
        <div class="cs_full_width_slider_section">
            <div class="cs_slider cs_style_1 cs_slider_gap_24">
                <div class="cs_slider_container" data-autoplay="0" data-loop="1" data-speed="800" data-center="0" data-variable-width="1" data-slides-per-view="1">
                    <div class="cs_slider_wrapper">
                        <?php
                        $projects = new WP_Query(array(
                            'post_type'      => 'project',
                            'posts_per_page' => 6,
                            'orderby'        => 'date',
                            'order'          => 'DESC',
                        ));

                        if ($projects->have_posts()) :
                            while ($projects->have_posts()) : $projects->the_post();
                                $location = get_post_meta(get_the_ID(), '_project_location', true);
                                $thumb_url = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'creative-garden-redesignject') : CGR_URI . '/assets/img/project_thumb_9.jpg';
                        ?>
                        <div class="cs_slide">
                            <article class="cs_card cs_style_4">
                                <div class="cs_card_thumb cs_bg_filed cs_mb_40" data-src="<?php echo esc_url($thumb_url); ?>"></div>
                                <div class="cs_card_info">
                                    <ul class="cs_card_info_list cs_mp_0">
                                        <li>
                                            <p class="mb-0"><?php esc_html_e('NAME', 'creative-garden-redesign'); ?></p>
                                            <h3 class="mb-0 cs_fs_20 cs_bold"><?php echo esc_html(strtoupper(get_the_title())); ?></h3>
                                        </li>
                                        <li>
                                            <p class="mb-0"><?php esc_html_e('LOCATION', 'creative-garden-redesign'); ?></p>
                                            <h3 class="mb-0 cs_fs_20 cs_bold"><?php echo esc_html(strtoupper($location)); ?></h3>
                                        </li>
                                    </ul>
                                    <div class="cs_card_text"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></div>
                                </div>
                            </article>
                        </div>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                        ?>
                        <div class="cs_slide">
                            <div class="cs_card cs_style_4">
                                <div class="cs_card_thumb cs_bg_filed cs_mb_40" data-src="<?php echo esc_url(CGR_URI . '/assets/img/project_thumb_9.jpg'); ?>"></div>
                                <div class="cs_card_info">
                                    <ul class="cs_card_info_list cs_mp_0">
                                        <li>
                                            <p class="mb-0">NAME</p>
                                            <h3 class="mb-0 cs_fs_20 cs_bold">SERENE RETREAT</h3>
                                        </li>
                                        <li>
                                            <p class="mb-0">LOCATION</p>
                                            <h3 class="mb-0 cs_fs_20 cs_bold">SUNNYVALE, CA</h3>
                                        </li>
                                    </ul>
                                    <div class="cs_card_text">A tranquil garden oasis perfect for your relaxation time with family or alone within your comfortable home.</div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="cs_slider_arrows cs_style_3 cs_hide_lg">
                    <div class="cs_right_arrow cs_heading_color cs_fs_20 cs_center">
                        <span class="cs_center"><?php esc_html_e('NEXT', 'creative-garden-redesign'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cs_height_100 cs_height_lg_70"></div>
</section>
<!-- End Works Section -->

<!-- Start CTA Section -->
<section class="cs_cta cs_style_1 cs_heading_bg cs_bg_filed" data-src="<?php echo esc_url($cta_background); ?>">
    <div class="cs_height_100 cs_height_lg_70"></div>
    <div class="container">
        <div class="cs_cta_in">
            <h2 class="cs_cta_title cs_fs_80 cs_white_color cs_mb_40 wow fadeInDown"><?php echo wp_kses_post($cta_title); ?></h2>
            <a href="<?php echo esc_url($cta_btn_url); ?>" class="cs_btn cs_style_1 cs_bold cs_heading_color cs_white_bg wow fadeInUp"><?php echo esc_html($cta_btn_text); ?></a>
        </div>
    </div>
    <div class="cs_height_100 cs_height_lg_70"></div>
</section>
<!-- End CTA Section -->

<?php get_footer(); ?>
