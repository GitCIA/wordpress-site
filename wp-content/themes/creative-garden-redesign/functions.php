<?php
/**
 * Creative Garden Redesign Theme Functions
 *
 * @package Creative_Garden_Redesign
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

define('CGR_VERSION', '1.0.0');
define('CGR_DIR', get_template_directory());
define('CGR_URI', get_template_directory_uri());

/**
 * Theme Setup
 */
function cgr_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    add_theme_support('automatic-feed-links');
    add_theme_support('customize-selective-refresh-widgets');

    // Add image sizes
    add_image_size('cgr-hero', 1920, 1080, true);
    add_image_size('cgr-service', 600, 400, true);
    add_image_size('creative-garden-redesignject', 800, 600, true);
    add_image_size('cgr-team', 400, 500, true);
    add_image_size('cgr-blog', 800, 500, true);
    add_image_size('cgr-gallery', 600, 600, true);

    // Register navigation menus
    register_nav_menus(array(
        'primary'        => __('Primary Menu', 'creative-garden-redesign'),
        'footer-support' => __('Footer Support Menu', 'creative-garden-redesign'),
        'footer-links'   => __('Footer Links Menu', 'creative-garden-redesign'),
        'footer-services'=> __('Footer Services Menu', 'creative-garden-redesign'),
    ));
}
add_action('after_setup_theme', 'cgr_setup');

/**
 * Enqueue Scripts and Styles
 */
function cgr_scripts() {
    // Styles
    wp_enqueue_style('bootstrap', CGR_URI . '/assets/css/bootstrap.min.css', array(), '5.3.0');
    wp_enqueue_style('fontawesome', CGR_URI . '/assets/css/fontawesome.min.css', array(), '6.2.1');
    wp_enqueue_style('slick', CGR_URI . '/assets/css/slick.min.css', array(), '1.8.1');
    wp_enqueue_style('animate', CGR_URI . '/assets/css/animate.css', array(), '4.1.1');
    wp_enqueue_style('lightgallery', CGR_URI . '/assets/css/lightgallery.min.css', array(), '2.7.0');
    wp_enqueue_style('cgr-main', CGR_URI . '/assets/css/style.css', array(), CGR_VERSION);

    // Scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('slick', CGR_URI . '/assets/js/jquery.slick.min.js', array('jquery'), '1.8.1', true);
    wp_enqueue_script('wow', CGR_URI . '/assets/js/wow.min.js', array(), '1.3.0', true);
    wp_enqueue_script('isotope', CGR_URI . '/assets/js/isotope.pkg.min.js', array('jquery'), '3.0.6', true);
    wp_enqueue_script('lightgallery', CGR_URI . '/assets/js/lightgallery.min.js', array(), '2.7.0', true);
    wp_enqueue_script('cgr-main', CGR_URI . '/assets/js/main.js', array('jquery', 'slick', 'wow', 'isotope', 'lightgallery'), CGR_VERSION, true);

    // Pass WordPress data to JavaScript
    wp_localize_script('cgr-main', 'cgr_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('cgr_nonce'),
    ));

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'cgr_scripts');

/**
 * Register Widget Areas
 */
function cgr_widgets_init() {
    register_sidebar(array(
        'name'          => __('Blog Sidebar', 'creative-garden-redesign'),
        'id'            => 'sidebar-blog',
        'description'   => __('Add widgets here for blog sidebar.', 'creative-garden-redesign'),
        'before_widget' => '<div id="%1$s" class="cs_sidebar_item widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="cs_sidebar_widget_title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Widget Area', 'creative-garden-redesign'),
        'id'            => 'footer-widgets',
        'description'   => __('Add widgets here for footer area.', 'creative-garden-redesign'),
        'before_widget' => '<div id="%1$s" class="cs_footer_col widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="cs_footer_widget_title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'cgr_widgets_init');

/**
 * Register Custom Post Types
 */
function cgr_register_post_types() {
    // Services CPT
    register_post_type('service', array(
        'labels' => array(
            'name'               => __('Services', 'creative-garden-redesign'),
            'singular_name'      => __('Service', 'creative-garden-redesign'),
            'add_new'            => __('Add New Service', 'creative-garden-redesign'),
            'add_new_item'       => __('Add New Service', 'creative-garden-redesign'),
            'edit_item'          => __('Edit Service', 'creative-garden-redesign'),
            'new_item'           => __('New Service', 'creative-garden-redesign'),
            'view_item'          => __('View Service', 'creative-garden-redesign'),
            'search_items'       => __('Search Services', 'creative-garden-redesign'),
            'not_found'          => __('No services found', 'creative-garden-redesign'),
            'not_found_in_trash' => __('No services found in Trash', 'creative-garden-redesign'),
        ),
        'public'              => true,
        'has_archive'         => true,
        'rewrite'             => array('slug' => 'services'),
        'menu_icon'           => 'dashicons-hammer',
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'        => true,
    ));

    // Projects CPT
    register_post_type('project', array(
        'labels' => array(
            'name'               => __('Projects', 'creative-garden-redesign'),
            'singular_name'      => __('Project', 'creative-garden-redesign'),
            'add_new'            => __('Add New Project', 'creative-garden-redesign'),
            'add_new_item'       => __('Add New Project', 'creative-garden-redesign'),
            'edit_item'          => __('Edit Project', 'creative-garden-redesign'),
            'new_item'           => __('New Project', 'creative-garden-redesign'),
            'view_item'          => __('View Project', 'creative-garden-redesign'),
            'search_items'       => __('Search Projects', 'creative-garden-redesign'),
            'not_found'          => __('No projects found', 'creative-garden-redesign'),
            'not_found_in_trash' => __('No projects found in Trash', 'creative-garden-redesign'),
        ),
        'public'              => true,
        'has_archive'         => false,
        'rewrite'             => array('slug' => 'project'),
        'menu_icon'           => 'dashicons-portfolio',
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'        => true,
    ));

    // Team CPT
    register_post_type('team', array(
        'labels' => array(
            'name'               => __('Team Members', 'creative-garden-redesign'),
            'singular_name'      => __('Team Member', 'creative-garden-redesign'),
            'add_new'            => __('Add New Team Member', 'creative-garden-redesign'),
            'add_new_item'       => __('Add New Team Member', 'creative-garden-redesign'),
            'edit_item'          => __('Edit Team Member', 'creative-garden-redesign'),
            'new_item'           => __('New Team Member', 'creative-garden-redesign'),
            'view_item'          => __('View Team Member', 'creative-garden-redesign'),
            'search_items'       => __('Search Team Members', 'creative-garden-redesign'),
            'not_found'          => __('No team members found', 'creative-garden-redesign'),
            'not_found_in_trash' => __('No team members found in Trash', 'creative-garden-redesign'),
        ),
        'public'              => true,
        'has_archive'         => true,
        'rewrite'             => array('slug' => 'team'),
        'menu_icon'           => 'dashicons-groups',
        'supports'            => array('title', 'thumbnail', 'excerpt', 'editor', 'custom-fields', 'page-attributes'),
        'show_in_rest'        => true,
    ));

    // Testimonials CPT
    register_post_type('testimonial', array(
        'labels' => array(
            'name'               => __('Testimonials', 'creative-garden-redesign'),
            'singular_name'      => __('Testimonial', 'creative-garden-redesign'),
            'add_new'            => __('Add New Testimonial', 'creative-garden-redesign'),
            'add_new_item'       => __('Add New Testimonial', 'creative-garden-redesign'),
            'edit_item'          => __('Edit Testimonial', 'creative-garden-redesign'),
            'new_item'           => __('New Testimonial', 'creative-garden-redesign'),
            'view_item'          => __('View Testimonial', 'creative-garden-redesign'),
            'search_items'       => __('Search Testimonials', 'creative-garden-redesign'),
            'not_found'          => __('No testimonials found', 'creative-garden-redesign'),
            'not_found_in_trash' => __('No testimonials found in Trash', 'creative-garden-redesign'),
        ),
        'public'              => true,
        'has_archive'         => false,
        'rewrite'             => array('slug' => 'testimonials'),
        'menu_icon'           => 'dashicons-format-quote',
        'supports'            => array('title', 'editor', 'custom-fields'),
        'show_in_rest'        => true,
    ));

    // FAQ CPT
    register_post_type('faq', array(
        'labels' => array(
            'name'               => __('FAQs', 'creative-garden-redesign'),
            'singular_name'      => __('FAQ', 'creative-garden-redesign'),
            'add_new'            => __('Add New FAQ', 'creative-garden-redesign'),
            'add_new_item'       => __('Add New FAQ', 'creative-garden-redesign'),
            'edit_item'          => __('Edit FAQ', 'creative-garden-redesign'),
            'new_item'           => __('New FAQ', 'creative-garden-redesign'),
            'view_item'          => __('View FAQ', 'creative-garden-redesign'),
            'search_items'       => __('Search FAQs', 'creative-garden-redesign'),
            'not_found'          => __('No FAQs found', 'creative-garden-redesign'),
            'not_found_in_trash' => __('No FAQs found in Trash', 'creative-garden-redesign'),
        ),
        'public'              => true,
        'publicly_queryable'  => false,
        'has_archive'         => false,
        'rewrite'             => array('slug' => 'faq-item'),
        'menu_icon'           => 'dashicons-editor-help',
        'supports'            => array('title', 'editor', 'custom-fields'),
        'show_in_rest'        => true,
        'show_ui'             => true,
    ));
}
add_action('init', 'cgr_register_post_types');

/**
 * Register Custom Meta Fields
 */
function cgr_register_meta_fields() {
    // Service Meta
    register_post_meta('service', '_service_icon', array(
        'show_in_rest'  => true,
        'single'        => true,
        'type'          => 'string',
        'auth_callback' => function() { return current_user_can('edit_posts'); }
    ));
    register_post_meta('service', '_service_tags', array(
        'show_in_rest'  => true,
        'single'        => true,
        'type'          => 'string',
        'auth_callback' => function() { return current_user_can('edit_posts'); }
    ));

    // Project Meta
    register_post_meta('project', '_project_year', array(
        'show_in_rest'  => true,
        'single'        => true,
        'type'          => 'string',
        'auth_callback' => function() { return current_user_can('edit_posts'); }
    ));
    register_post_meta('project', '_project_location', array(
        'show_in_rest'  => true,
        'single'        => true,
        'type'          => 'string',
        'auth_callback' => function() { return current_user_can('edit_posts'); }
    ));
    register_post_meta('project', '_project_service_type', array(
        'show_in_rest'  => true,
        'single'        => true,
        'type'          => 'string',
        'auth_callback' => function() { return current_user_can('edit_posts'); }
    ));
    register_post_meta('project', '_project_outcomes', array(
        'show_in_rest'  => true,
        'single'        => true,
        'type'          => 'string',
        'auth_callback' => function() { return current_user_can('edit_posts'); }
    ));

    // Team Meta
    register_post_meta('team', '_team_position', array(
        'show_in_rest'  => true,
        'single'        => true,
        'type'          => 'string',
        'auth_callback' => function() { return current_user_can('edit_posts'); }
    ));
    register_post_meta('team', '_team_bio', array(
        'show_in_rest'  => true,
        'single'        => true,
        'type'          => 'string',
        'auth_callback' => function() { return current_user_can('edit_posts'); }
    ));

    // Testimonial Meta
    register_post_meta('testimonial', '_testimonial_name', array(
        'show_in_rest'  => true,
        'single'        => true,
        'type'          => 'string',
        'auth_callback' => function() { return current_user_can('edit_posts'); }
    ));
    register_post_meta('testimonial', '_testimonial_position', array(
        'show_in_rest'  => true,
        'single'        => true,
        'type'          => 'string',
        'auth_callback' => function() { return current_user_can('edit_posts'); }
    ));

    // FAQ Meta
    register_post_meta('faq', '_faq_answer', array(
        'show_in_rest'  => true,
        'single'        => true,
        'type'          => 'string',
        'auth_callback' => function() { return current_user_can('edit_posts'); }
    ));
    register_post_meta('faq', '_faq_category', array(
        'show_in_rest'  => true,
        'single'        => true,
        'type'          => 'string',
        'auth_callback' => function() { return current_user_can('edit_posts'); }
    ));
}
add_action('init', 'cgr_register_meta_fields');

/**
 * Add Meta Boxes
 */
function cgr_add_meta_boxes() {
    add_meta_box('service_details', __('Service Details', 'creative-garden-redesign'), 'cgr_service_meta_box', 'service', 'side');
    add_meta_box('project_details', __('Project Details', 'creative-garden-redesign'), 'cgr_project_details_meta_box', 'project', 'normal');
    add_meta_box('project_media_features', __('Video, Images & Features', 'creative-garden-redesign'), 'cgr_project_meta_box', 'project', 'normal');
    add_meta_box('team_details', __('Team Member Details', 'creative-garden-redesign'), 'cgr_team_meta_box', 'team', 'side');
    add_meta_box('faq_details', __('FAQ Details', 'creative-garden-redesign'), 'cgr_faq_meta_box', 'faq', 'normal');
    add_meta_box('testimonial_details', __('Testimonial Details', 'creative-garden-redesign'), 'cgr_testimonial_meta_box', 'testimonial', 'side');
}
add_action('add_meta_boxes', 'cgr_add_meta_boxes');

// Service Meta Box
function cgr_service_meta_box($post) {
    wp_nonce_field('cgr_service_meta', 'cgr_service_nonce');
    $icon = get_post_meta($post->ID, '_service_icon', true);
    $tags = get_post_meta($post->ID, '_service_tags', true);
    ?>
    <p>
        <label for="service_icon"><strong><?php _e('Icon Class (FontAwesome)', 'creative-garden-redesign'); ?></strong></label><br>
        <input type="text" id="service_icon" name="service_icon" value="<?php echo esc_attr($icon); ?>" class="widefat" placeholder="fa-regular fa-heart">
    </p>
    <p>
        <label for="service_tags"><strong><?php _e('Tags (comma separated)', 'creative-garden-redesign'); ?></strong></label><br>
        <input type="text" id="service_tags" name="service_tags" value="<?php echo esc_attr($tags); ?>" class="widefat" placeholder="Home, Garden, Expert">
    </p>
    <?php
}

// Project Details Meta Box (Year, Location, Service Type, Outcomes)
function cgr_project_details_meta_box($post) {
    wp_nonce_field('cgr_project_nonce', 'cgr_project_nonce');
    
    $year = get_post_meta($post->ID, '_project_year', true);
    $location = get_post_meta($post->ID, '_project_location', true);
    $service_type = get_post_meta($post->ID, '_project_service_type', true);
    $outcomes = get_post_meta($post->ID, '_project_outcomes', true);
    ?>
    <p>
        <label for="project_year"><strong><?php _e('Year', 'creative-garden-redesign'); ?></strong></label><br>
        <input type="text" id="project_year" name="project_year" value="<?php echo esc_attr($year); ?>" class="widefat" placeholder="2024">
    </p>
    <p>
        <label for="project_location"><strong><?php _e('Location', 'creative-garden-redesign'); ?></strong></label><br>
        <input type="text" id="project_location" name="project_location" value="<?php echo esc_attr($location); ?>" class="widefat" placeholder="Sunnyvale, CA">
    </p>
    <p>
        <label for="project_service_type"><strong><?php _e('Service Type', 'creative-garden-redesign'); ?></strong></label><br>
        <input type="text" id="project_service_type" name="project_service_type" value="<?php echo esc_attr($service_type); ?>" class="widefat" placeholder="Garden Landscaping">
    </p>
    <p>
        <label for="project_outcomes"><strong><?php _e('Outcomes', 'creative-garden-redesign'); ?></strong></label><br>
        <textarea id="project_outcomes" name="project_outcomes" class="widefat" rows="4"><?php echo esc_textarea($outcomes); ?></textarea>
    </p>
    <?php
}

// Project Media Box
function cgr_project_meta_box($post) {
    wp_nonce_field('cgr_project_meta', 'cgr_project_nonce');
    
    // Video
    $video_url = get_post_meta($post->ID, '_project_video_url', true);
    $video_bg_id = get_post_meta($post->ID, '_project_video_bg', true);
    
    // Slider Images
    $slider_images = get_post_meta($post->ID, '_project_slider_images', true);
    $slider_images = is_array($slider_images) ? $slider_images : array();
    
    wp_enqueue_media();
    ?>
    <style>
        .cgr-meta-tab { display: none; }
        .cgr-meta-tab.active { display: block; }
        .cgr-meta-tabs { display: flex; gap: 10px; margin-bottom: 20px; border-bottom: 1px solid #ddd; }
        .cgr-meta-tabs button { background: #f1f1f1; border: 1px solid #ddd; padding: 10px 15px; cursor: pointer; border-radius: 4px 4px 0 0; }
        .cgr-meta-tabs button.active { background: #0073aa; color: white; }
        .cgr-gallery-wrap { border: 1px solid #ddd; padding: 10px; margin: 10px 0; border-radius: 4px; }
        .cgr-gallery-items { display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 10px; margin: 10px 0; }
        .cgr-gallery-item { position: relative; }
        .cgr-gallery-item img { width: 100%; height: auto; display: block; }
        .cgr-gallery-item .remove { position: absolute; top: 5px; right: 5px; background: red; color: white; border: none; padding: 5px 8px; cursor: pointer; font-size: 12px; }
        .cgr-icon-box { border: 1px solid #e5e5e5; padding: 15px; margin: 10px 0; border-radius: 4px; background: #f9f9f9; }
    </style>

    <div class="cgr-meta-tabs">
        <button type="button" class="cgr-tab-btn active" data-tab="video"><?php _e('Video & Images', 'creative-garden-redesign'); ?></button>
        <button type="button" class="cgr-tab-btn" data-tab="features"><?php _e('Features', 'creative-garden-redesign'); ?></button>
    </div>

    <!-- Video & Images Tab -->
    <div class="cgr-meta-tab active" data-tab="video">
        <p>
            <label for="project_video_url"><strong><?php _e('Video URL (YouTube/Vimeo/MP4)', 'creative-garden-redesign'); ?></strong></label><br>
            <input type="url" id="project_video_url" name="project_video_url" value="<?php echo esc_url($video_url); ?>" class="widefat" placeholder="https://www.youtube.com/embed/...">
        </p>
        <p>
            <label><strong><?php _e('Video Background Image', 'creative-garden-redesign'); ?></strong></label><br>
            <input type="hidden" id="project_video_bg" name="project_video_bg" value="<?php echo esc_attr($video_bg_id); ?>">
            <div id="project_video_bg_preview">
                <?php 
                if ($video_bg_id) {
                    echo wp_get_attachment_image($video_bg_id, 'thumbnail');
                }
                ?>
            </div>
            <button type="button" class="button" id="project_video_bg_button"><?php _e('Select Image', 'creative-garden-redesign'); ?></button>
            <button type="button" class="button" id="project_video_bg_remove" style="<?php echo $video_bg_id ? '' : 'display:none;'; ?>"><?php _e('Remove', 'creative-garden-redesign'); ?></button>
        </p>

        <h4><?php _e('Slider Images', 'creative-garden-redesign'); ?></h4>
        <p><?php _e('Upload or select multiple images for the project slider', 'creative-garden-redesign'); ?></p>
        <div class="cgr-gallery-wrap">
            <div class="cgr-gallery-items" id="cgr-gallery-items">
                <?php foreach ($slider_images as $img_id) : ?>
                    <div class="cgr-gallery-item">
                        <?php echo wp_get_attachment_image($img_id, 'thumbnail'); ?>
                        <input type="hidden" name="project_slider_images[]" value="<?php echo esc_attr($img_id); ?>">
                        <button type="button" class="remove" onclick="this.parentElement.remove();">×</button>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="button" class="button" id="cgr-gallery-button"><?php _e('Add Images', 'creative-garden-redesign'); ?></button>
        </div>
    </div>

    <!-- Features Tab -->
    <div class="cgr-meta-tab" data-tab="features">
        <h4><?php _e('Project Features', 'creative-garden-redesign'); ?></h4>
        <p><?php _e('Add unlimited features with icon and title', 'creative-garden-redesign'); ?></p>
        
        <div id="cgr-features-list">
            <?php
            $features = get_post_meta($post->ID, '_project_features', true);
            $features = is_array($features) ? $features : array();
            
            $icons = array(
                'fa-solid fa-hand-holding-droplet' => '💧 Hand Holding Droplet',
                'fa-solid fa-utensils' => '🍴 Utensils',
                'fa-solid fa-vials' => '🧪 Vials',
                'fa-solid fa-feather' => '🪶 Feather',
                'fa-solid fa-seedling' => '🌱 Seedling',
                'fa-solid fa-handshake' => '🤝 Handshake',
                'fa-solid fa-leaf' => '🍃 Leaf',
                'fa-solid fa-flower' => '🌸 Flower',
                'fa-solid fa-tree' => '🌳 Tree',
                'fa-solid fa-water' => '💧 Water',
                'fa-solid fa-sun' => '☀️ Sun',
                'fa-solid fa-cloud' => '☁️ Cloud',
                'fa-solid fa-star' => '⭐ Star',
                'fa-solid fa-heart' => '❤️ Heart',
                'fa-solid fa-check' => '✓ Check',
                'fa-solid fa-award' => '🏆 Award',
                'fa-solid fa-shield' => '🛡️ Shield',
                'fa-solid fa-hammer' => '🔨 Hammer',
                'fa-solid fa-tools' => '🔧 Tools',
                'fa-solid fa-wrench' => '🔧 Wrench',
                'fa-solid fa-spade' => '🔱 Spade',
                'fa-solid fa-bugs' => '🐛 Bugs',
                'fa-solid fa-flask' => '🧪 Flask',
                'fa-solid fa-microscope' => '🔬 Microscope',
                'fa-solid fa-person-hiking' => '🥾 Hiking',
                'fa-solid fa-mountain' => '⛰️ Mountain',
            );
            
            if (!empty($features)) {
                foreach ($features as $index => $feature) {
                    $icon = isset($feature['icon']) ? $feature['icon'] : '';
                    $title = isset($feature['title']) ? $feature['title'] : '';
                    ?>
                    <div class="cgr-feature-item">
                        <div style="display: flex; gap: 10px; margin-bottom: 15px; border: 1px solid #ddd; padding: 15px; border-radius: 5px; position: relative;">
                            <div style="flex: 1;">
                                <p>
                                    <label><strong><?php _e('Icon', 'creative-garden-redesign'); ?></strong></label><br>
                                    <select class="cgr-feature-icon widefat" name="cgr-feature-icon[]">
                                        <option value="">-- <?php _e('Select Icon', 'creative-garden-redesign'); ?> --</option>
                                        <?php foreach ($icons as $icon_class => $icon_label) : ?>
                                            <option value="<?php echo esc_attr($icon_class); ?>" <?php selected($icon, $icon_class); ?>><?php echo esc_html($icon_label); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </p>
                                <p>
                                    <label><strong><?php _e('Title', 'creative-garden-redesign'); ?></strong></label><br>
                                    <input type="text" class="cgr-feature-title widefat" name="cgr-feature-title[]" value="<?php echo esc_attr($title); ?>" placeholder="Feature title">
                                </p>
                            </div>
                            <button type="button" class="cgr-remove-feature" style="position: absolute; top: 10px; right: 10px; padding: 5px 10px; background: #dc3545; color: white; border: none; border-radius: 3px; cursor: pointer;">×</button>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        
        <button type="button" id="cgr-add-feature" style="padding: 10px 20px; background: #0073aa; color: white; border: none; border-radius: 3px; cursor: pointer; font-size: 14px;">+ <?php _e('Add Feature', 'creative-garden-redesign'); ?></button>
    </div>

    <script>
    jQuery(function($) {
        // Tab switching
        $('.cgr-tab-btn').on('click', function(e) {
            e.preventDefault();
            var tab = $(this).data('tab');
            $('.cgr-meta-tab').removeClass('active');
            $('.cgr-meta-tabs button').removeClass('active');
            $('.cgr-meta-tab[data-tab="' + tab + '"]').addClass('active');
            $(this).addClass('active');
        });

        // Video Background Image
        var videoFrame;
        $('#project_video_bg_button').on('click', function(e) {
            e.preventDefault();
            if (videoFrame) {
                videoFrame.open();
                return;
            }
            videoFrame = wp.media({
                title: '<?php _e('Select Video Background Image', 'creative-garden-redesign'); ?>',
                button: { text: '<?php _e('Select', 'creative-garden-redesign'); ?>' },
                multiple: false,
                library: { type: 'image' }
            });
            videoFrame.on('select', function() {
                var attachment = videoFrame.state().get('selection').first().toJSON();
                $('#project_video_bg').val(attachment.id);
                $('#project_video_bg_preview').html('<img src="' + attachment.sizes.thumbnail.url + '" style="max-width: 150px;">');
                $('#project_video_bg_remove').show();
            });
            videoFrame.open();
        });

        $('#project_video_bg_remove').on('click', function(e) {
            e.preventDefault();
            $('#project_video_bg').val('');
            $('#project_video_bg_preview').html('');
            $(this).hide();
        });

        // Slider Images Gallery
        var galleryFrame;
        $('#cgr-gallery-button').on('click', function(e) {
            e.preventDefault();
            if (galleryFrame) {
                galleryFrame.open();
                return;
            }
            galleryFrame = wp.media({
                title: '<?php _e('Select Slider Images', 'creative-garden-redesign'); ?>',
                button: { text: '<?php _e('Select', 'creative-garden-redesign'); ?>' },
                multiple: true,
                library: { type: 'image' }
            });
            galleryFrame.on('select', function() {
                var attachments = galleryFrame.state().get('selection');
                attachments.each(function(attachment) {
                    var html = '<div class="cgr-gallery-item">';
                    html += '<img src="' + attachment.attributes.sizes.thumbnail.url + '">';
                    html += '<input type="hidden" name="project_slider_images[]" value="' + attachment.id + '">';
                    html += '<button type="button" class="remove" onclick="this.parentElement.remove();">×</button>';
                    html += '</div>';
                    $('#cgr-gallery-items').append(html);
                });
            });
            galleryFrame.open();
        });

        // Features functionality
        var featureIcons = {
            'fa-solid fa-hand-holding-droplet': '💧 Hand Holding Droplet',
            'fa-solid fa-utensils': '🍴 Utensils',
            'fa-solid fa-vials': '🧪 Vials',
            'fa-solid fa-feather': '🪶 Feather',
            'fa-solid fa-seedling': '🌱 Seedling',
            'fa-solid fa-handshake': '🤝 Handshake',
            'fa-solid fa-leaf': '🍃 Leaf',
            'fa-solid fa-flower': '🌸 Flower',
            'fa-solid fa-tree': '🌳 Tree',
            'fa-solid fa-water': '💧 Water',
            'fa-solid fa-sun': '☀️ Sun',
            'fa-solid fa-cloud': '☁️ Cloud',
            'fa-solid fa-star': '⭐ Star',
            'fa-solid fa-heart': '❤️ Heart',
            'fa-solid fa-check': '✓ Check',
            'fa-solid fa-award': '🏆 Award',
            'fa-solid fa-shield': '🛡️ Shield',
            'fa-solid fa-hammer': '🔨 Hammer',
            'fa-solid fa-tools': '🔧 Tools',
            'fa-solid fa-wrench': '🔧 Wrench',
            'fa-solid fa-spade': '🔱 Spade',
            'fa-solid fa-bugs': '🐛 Bugs',
            'fa-solid fa-flask': '🧪 Flask',
            'fa-solid fa-microscope': '🔬 Microscope',
            'fa-solid fa-person-hiking': '🥾 Hiking',
            'fa-solid fa-mountain': '⛰️ Mountain',
        };
        
        function generateIconOptions(selected) {
            var options = '<option value="">-- <?php _e('Select Icon', 'creative-garden-redesign'); ?> --</option>';
            $.each(featureIcons, function(value, label) {
                var sel = (selected === value) ? 'selected' : '';
                options += '<option value="' + value + '" ' + sel + '>' + label + '</option>';
            });
            return options;
        }
        
        $('#cgr-add-feature').on('click', function(e) {
            e.preventDefault();
            var html = '<div class="cgr-feature-item">';
            html += '<div style="display: flex; gap: 10px; margin-bottom: 15px; border: 1px solid #ddd; padding: 15px; border-radius: 5px; position: relative;">';
            html += '<div style="flex: 1;">';
            html += '<p><label><strong><?php _e('Icon', 'creative-garden-redesign'); ?></strong></label><br>';
            html += '<select class="cgr-feature-icon widefat" name="cgr-feature-icon[]">' + generateIconOptions('') + '</select></p>';
            html += '<p><label><strong><?php _e('Title', 'creative-garden-redesign'); ?></strong></label><br>';
            html += '<input type="text" class="cgr-feature-title widefat" name="cgr-feature-title[]" placeholder="Feature title"></p>';
            html += '</div>';
            html += '<button type="button" class="cgr-remove-feature" style="position: absolute; top: 10px; right: 10px; padding: 5px 10px; background: #dc3545; color: white; border: none; border-radius: 3px; cursor: pointer;">×</button>';
            html += '</div></div>';
            $('#cgr-features-list').append(html);
        });

        $(document).on('click', '.cgr-remove-feature', function(e) {
            e.preventDefault();
            $(this).closest('.cgr-feature-item').remove();
        });
    });
    </script>
    <?php
}

// Team Meta Box
function cgr_team_meta_box($post) {
    wp_nonce_field('cgr_team_meta', 'cgr_team_nonce');
    $position = get_post_meta($post->ID, '_team_position', true);
    $bio = get_post_meta($post->ID, '_team_bio', true);
    ?>
    <p>
        <label for="team_position"><strong><?php _e('Position/Role', 'creative-garden-redesign'); ?></strong></label><br>
        <input type="text" id="team_position" name="team_position" value="<?php echo esc_attr($position); ?>" class="widefat" placeholder="Founder & Lead Designer">
    </p>
    <p>
        <label for="team_bio"><strong><?php _e('Description/Bio', 'creative-garden-redesign'); ?></strong></label><br>
        <textarea id="team_bio" name="team_bio" class="widefat" rows="4" placeholder="Brief description of the team member..."><?php echo esc_textarea($bio); ?></textarea>
    </p>
    <?php
}

// Testimonial Meta Box
function cgr_testimonial_meta_box($post) {
    wp_nonce_field('cgr_testimonial_meta', 'cgr_testimonial_nonce');
    $name = get_post_meta($post->ID, '_testimonial_name', true);
    $position = get_post_meta($post->ID, '_testimonial_position', true);
    ?>
    <p>
        <label for="testimonial_name"><strong><?php _e('Client Name', 'creative-garden-redesign'); ?></strong></label><br>
        <input type="text" id="testimonial_name" name="testimonial_name" value="<?php echo esc_attr($name); ?>" class="widefat" placeholder="Steve Evans">
    </p>
    <p>
        <label for="testimonial_position"><strong><?php _e('Client Position/Company', 'creative-garden-redesign'); ?></strong></label><br>
        <input type="text" id="testimonial_position" name="testimonial_position" value="<?php echo esc_attr($position); ?>" class="widefat" placeholder="CEO of Malley Company">
    </p>
    <?php
}

// FAQ Meta Box
function cgr_faq_meta_box($post) {
    wp_nonce_field('cgr_faq_meta', 'cgr_faq_nonce');
    $answer = get_post_meta($post->ID, '_faq_answer', true);
    $category = get_post_meta($post->ID, '_faq_category', true);
    ?>
    <p>
        <label for="faq_category"><strong><?php _e('FAQ Category', 'creative-garden-redesign'); ?></strong></label><br>
        <select id="faq_category" name="faq_category" class="widefat">
            <option value=""><?php _e('-- Select Category --', 'creative-garden-redesign'); ?></option>
            <option value="garden-design" <?php selected($category, 'garden-design'); ?>><?php _e('Garden Design', 'creative-garden-redesign'); ?></option>
            <option value="landscape-design" <?php selected($category, 'landscape-design'); ?>><?php _e('Landscape Design', 'creative-garden-redesign'); ?></option>
        </select>
    </p>
    <p>
        <label for="faq_answer"><strong><?php _e('Answer (used as post content)', 'creative-garden-redesign'); ?></strong></label><br>
        <em><?php _e('The question is the post title. Edit the main content area above to change the answer.', 'creative-garden-redesign'); ?></em>
    </p>
    <?php
}

// Save Meta Boxes
function cgr_save_meta_boxes($post_id) {
    // Service
    if (isset($_POST['cgr_service_nonce']) && wp_verify_nonce($_POST['cgr_service_nonce'], 'cgr_service_meta')) {
        if (isset($_POST['service_icon'])) {
            update_post_meta($post_id, '_service_icon', sanitize_text_field($_POST['service_icon']));
        }
        if (isset($_POST['service_tags'])) {
            update_post_meta($post_id, '_service_tags', sanitize_text_field($_POST['service_tags']));
        }
    }
    // Project
    if (isset($_POST['cgr_project_nonce']) && wp_verify_nonce($_POST['cgr_project_nonce'], 'cgr_project_meta')) {
        if (isset($_POST['project_year'])) {
            update_post_meta($post_id, '_project_year', sanitize_text_field($_POST['project_year']));
        }
        if (isset($_POST['project_location'])) {
            update_post_meta($post_id, '_project_location', sanitize_text_field($_POST['project_location']));
        }
        if (isset($_POST['project_service_type'])) {
            update_post_meta($post_id, '_project_service_type', sanitize_text_field($_POST['project_service_type']));
        }
        if (isset($_POST['project_outcomes'])) {
            update_post_meta($post_id, '_project_outcomes', sanitize_textarea_field($_POST['project_outcomes']));
        }
        if (isset($_POST['project_video_url'])) {
            update_post_meta($post_id, '_project_video_url', esc_url_raw($_POST['project_video_url']));
        }
        if (isset($_POST['project_video_bg'])) {
            update_post_meta($post_id, '_project_video_bg', absint($_POST['project_video_bg']));
        }
        if (isset($_POST['project_slider_images'])) {
            $slider_images = array_map('absint', $_POST['project_slider_images']);
            update_post_meta($post_id, '_project_slider_images', $slider_images);
        } else {
            delete_post_meta($post_id, '_project_slider_images');
        }
        
        // Save project features (dynamic array)
        $features = array();
        if (isset($_POST['cgr-feature-icon']) && is_array($_POST['cgr-feature-icon'])) {
            $icons = array_map('sanitize_text_field', $_POST['cgr-feature-icon']);
            $titles = isset($_POST['cgr-feature-title']) && is_array($_POST['cgr-feature-title']) ? 
                      array_map('sanitize_text_field', $_POST['cgr-feature-title']) : array();
            
            foreach ($icons as $index => $icon) {
                if (!empty($icon) || !empty($titles[$index])) {
                    $features[] = array(
                        'icon' => $icon,
                        'title' => isset($titles[$index]) ? $titles[$index] : ''
                    );
                }
            }
        }
        update_post_meta($post_id, '_project_features', $features);
    }
    // Team
    if (isset($_POST['cgr_team_nonce']) && wp_verify_nonce($_POST['cgr_team_nonce'], 'cgr_team_meta')) {
        if (isset($_POST['team_position'])) {
            update_post_meta($post_id, '_team_position', sanitize_text_field($_POST['team_position']));
        }
        if (isset($_POST['team_bio'])) {
            update_post_meta($post_id, '_team_bio', sanitize_textarea_field($_POST['team_bio']));
        }
    }
    // Testimonial
    if (isset($_POST['cgr_testimonial_nonce']) && wp_verify_nonce($_POST['cgr_testimonial_nonce'], 'cgr_testimonial_meta')) {
        if (isset($_POST['testimonial_name'])) {
            update_post_meta($post_id, '_testimonial_name', sanitize_text_field($_POST['testimonial_name']));
        }
        if (isset($_POST['testimonial_position'])) {
            update_post_meta($post_id, '_testimonial_position', sanitize_text_field($_POST['testimonial_position']));
        }
    }
    // FAQ
    if (isset($_POST['cgr_faq_nonce']) && wp_verify_nonce($_POST['cgr_faq_nonce'], 'cgr_faq_meta')) {
        if (isset($_POST['faq_category'])) {
            update_post_meta($post_id, '_faq_category', sanitize_text_field($_POST['faq_category']));
        }
    }
}
add_action('save_post', 'cgr_save_meta_boxes');

/**
 * FAQ Admin Filtering and Columns
 */
// Add custom columns to FAQ list
function cgr_faq_columns($columns) {
    $columns['faq_category'] = __('Category', 'creative-garden-redesign');
    return $columns;
}
add_filter('manage_faq_posts_columns', 'cgr_faq_columns');

// Display custom column content for FAQ list
function cgr_faq_column_content($column, $post_id) {
    if ($column == 'faq_category') {
        $category = get_post_meta($post_id, '_faq_category', true);
        $category_labels = array(
            'garden-design' => __('Garden Design', 'creative-garden-redesign'),
            'landscape-design' => __('Landscape Design', 'creative-garden-redesign'),
        );
        echo isset($category_labels[$category]) ? $category_labels[$category] : '—';
    }
}
add_action('manage_faq_posts_custom_column', 'cgr_faq_column_content', 10, 2);

// Add filter dropdown to FAQ admin list
function cgr_faq_filter_by_category() {
    global $typenow;
    
    if ($typenow != 'faq') {
        return;
    }
    
    $selected_category = isset($_GET['faq_category']) ? sanitize_text_field($_GET['faq_category']) : '';
    ?>
    <select name="faq_category" id="faq_category">
        <option value=""><?php _e('All Categories', 'creative-garden-redesign'); ?></option>
        <option value="garden-design" <?php selected($selected_category, 'garden-design'); ?>>
            <?php _e('Garden Design', 'creative-garden-redesign'); ?>
        </option>
        <option value="landscape-design" <?php selected($selected_category, 'landscape-design'); ?>>
            <?php _e('Landscape Design', 'creative-garden-redesign'); ?>
        </option>
    </select>
    <?php
}
add_action('restrict_manage_posts', 'cgr_faq_filter_by_category');

// Apply category filter to FAQ list query
function cgr_faq_filter_query($query) {
    global $pagenow;
    
    if (is_admin() && $pagenow == 'edit.php' && isset($_GET['post_type']) && $_GET['post_type'] == 'faq') {
        if (isset($_GET['faq_category']) && $_GET['faq_category'] != '') {
            $category = sanitize_text_field($_GET['faq_category']);
            $query->query_vars['meta_key'] = '_faq_category';
            $query->query_vars['meta_value'] = $category;
        }
    }
    return $query;
}
add_filter('pre_get_posts', 'cgr_faq_filter_query');

/**
 * Theme Customizer Options
 */
function cgr_customize_register($wp_customize) {
    // Theme Options Panel
    $wp_customize->add_panel('cgr_options', array(
        'title'    => __('CreativeGarden Theme Options', 'creative-garden-redesign'),
        'priority' => 30,
    ));

    // Hero Section
    $wp_customize->add_section('cgr_hero', array(
        'title'    => __('Hero Section', 'creative-garden-redesign'),
        'panel'    => 'cgr_options',
        'priority' => 10,
    ));

    $wp_customize->add_setting('hero_title', array(
        'default'           => 'CREATE YOUR <b>DREAM GARDEN</b>',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('hero_title', array(
        'label'   => __('Hero Title', 'creative-garden-redesign'),
        'section' => 'cgr_hero',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('hero_subtitle', array(
        'default'           => 'Crafting dream gardens with passion, creativity, and sustainability for over a decade with our experienced landscape artists and gardener teams.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('hero_subtitle', array(
        'label'   => __('Hero Subtitle', 'creative-garden-redesign'),
        'section' => 'cgr_hero',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('hero_btn_1_text', array(
        'default'           => 'Services',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('hero_btn_1_text', array(
        'label'   => __('Primary Button Text', 'creative-garden-redesign'),
        'section' => 'cgr_hero',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('hero_btn_1_url', array(
        'default'           => '/services/',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('hero_btn_1_url', array(
        'label'   => __('Primary Button URL', 'creative-garden-redesign'),
        'section' => 'cgr_hero',
        'type'    => 'url',
    ));

    $wp_customize->add_setting('hero_btn_2_text', array(
        'default'           => 'Explore Projects',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('hero_btn_2_text', array(
        'label'   => __('Secondary Button Text', 'creative-garden-redesign'),
        'section' => 'cgr_hero',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('hero_btn_2_url', array(
        'default'           => '/projects/',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('hero_btn_2_url', array(
        'label'   => __('Secondary Button URL', 'creative-garden-redesign'),
        'section' => 'cgr_hero',
        'type'    => 'url',
    ));

    $wp_customize->add_setting('hero_clients_count', array(
        'default'           => '500+',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('hero_clients_count', array(
        'label'   => __('Satisfied Clients Count', 'creative-garden-redesign'),
        'section' => 'cgr_hero',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('hero_box_display', array(
        'default'           => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
    ));
    $wp_customize->add_control('hero_box_display', array(
        'label'   => __('Display Hero Box', 'creative-garden-redesign'),
        'section' => 'cgr_hero',
        'type'    => 'checkbox',
    ));

    $wp_customize->add_setting('hero_feature_title', array(
        'default'           => 'Hachioji Garden',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('hero_feature_title', array(
        'label'   => __('Featured Project Title', 'creative-garden-redesign'),
        'section' => 'cgr_hero',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('hero_feature_desc', array(
        'default'           => 'We design Hachioji Garden as a part of our new Landscape Design Commission in the country.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('hero_feature_desc', array(
        'label'   => __('Featured Project Description', 'creative-garden-redesign'),
        'section' => 'cgr_hero',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('hero_feature_url', array(
        'default'           => '/projects/',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('hero_feature_url', array(
        'label'   => __('Featured Project URL', 'creative-garden-redesign'),
        'section' => 'cgr_hero',
        'type'    => 'url',
    ));

    $wp_customize->add_setting('hero_bg_video_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('hero_bg_video_url', array(
        'label'       => __('Hero Background Video URL', 'creative-garden-redesign'),
        'section'     => 'cgr_hero',
        'type'        => 'url',
        'description' => __('Use a direct video URL (mp4) or a YouTube link.', 'creative-garden-redesign'),
    ));

    // Values Card Section
    $wp_customize->add_section('cgr_values', array(
        'title'    => __('Values Card Section', 'creative-garden-redesign'),
        'panel'    => 'cgr_options',
        'priority' => 12,
    ));

    $wp_customize->add_setting('values_card_display', array(
        'default'           => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
    ));
    $wp_customize->add_control('values_card_display', array(
        'label'   => __('Display Values Card Items', 'creative-garden-redesign'),
        'section' => 'cgr_values',
        'type'    => 'checkbox',
    ));

    // Navigation Section
    $wp_customize->add_section('cgr_navigation', array(
        'title'    => __('Navigation Menu', 'creative-garden-redesign'),
        'panel'    => 'cgr_options',
        'priority' => 5,
        'description' => __('Manage primary navigation menu. To add, reorder, or remove menu items, go to Appearance > Menus.', 'creative-garden-redesign'),
    ));

    // Menu Items Display Control
    $menu_items = wp_get_nav_menu_items('Primary Menu');
    if (!empty($menu_items)) {
        $menu_items_list = array();
        $menu_items_list['all'] = __('Show All Items', 'creative-garden-redesign');
        
        foreach ($menu_items as $item) {
            if ($item->menu_item_parent == 0) { // Only top-level items
                $menu_items_list[$item->ID] = $item->title;
            }
        }
        
        $wp_customize->add_setting('nav_items_limit', array(
            'default'           => 'all',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('nav_items_limit', array(
            'label'   => __('Navigation Items Display', 'creative-garden-redesign'),
            'section' => 'cgr_navigation',
            'type'    => 'select',
            'choices' => $menu_items_list,
            'description' => __('Select how many menu items to display', 'creative-garden-redesign'),
        ));
    }

    // Add setting for menu item ordering (stored as JSON)
    $wp_customize->add_setting('nav_items_order', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('nav_items_order_notice', array(
        'label'       => __('Menu Item Order', 'creative-garden-redesign'),
        'section'     => 'cgr_navigation',
        'type'        => 'checkbox',
        'description' => __('To reorder menu items, use the Menus page. Visit: Appearance > Menus, then drag items to reorder.', 'creative-garden-redesign'),
    ));

    // Add controls for hiding individual menu items
    $menu_items = wp_get_nav_menu_items('Primary Menu');
    if (!empty($menu_items)) {
        foreach ($menu_items as $item) {
            if ($item->menu_item_parent == 0) { // Only top-level items
                $setting_key = 'nav_item_show_' . $item->ID;
                $wp_customize->add_setting($setting_key, array(
                    'default'           => true,
                    'sanitize_callback' => 'rest_sanitize_boolean',
                ));
                $wp_customize->add_control($setting_key, array(
                    'label'   => sprintf(__('Show "%s"', 'creative-garden-redesign'), $item->title),
                    'section' => 'cgr_navigation',
                    'type'    => 'checkbox',
                ));
            }
        }
    }

    // About Section
    $wp_customize->add_section('cgr_about', array(
        'title'    => __('About Section', 'creative-garden-redesign'),
        'panel'    => 'cgr_options',
        'priority' => 15,
    ));

    $wp_customize->add_setting('about_title', array(
        'default'           => 'CRAFTING <br><span>DREAM GARDENS</span> <br>INTO REALITY',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('about_title', array(
        'label'   => __('About Title', 'creative-garden-redesign'),
        'section' => 'cgr_about',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('about_text_1', array(
        'default'           => 'At LeafLife, we are passionate about transforming outdoor spaces into breathtaking gardens that tell a unique story. Our journey began over a decade ago, driven by a shared love for nature',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('about_text_1', array(
        'label'   => __('About Text Column 1', 'creative-garden-redesign'),
        'section' => 'cgr_about',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('about_text_2', array(
        'default'           => 'and design. Since then, we have dedicated ourselves to creating gardens that enhance your property. Our solid commitment to sustainability, innovation, and collaboration has been the foundation of our success.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('about_text_2', array(
        'label'   => __('About Text Column 2', 'creative-garden-redesign'),
        'section' => 'cgr_about',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('about_section_title', array(
        'default'           => 'CRAFTING <br><span>DREAM GARDENS</span> <br>INTO REALITY',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('about_section_title', array(
        'label'   => __('About Section Title', 'creative-garden-redesign'),
        'section' => 'cgr_about',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('about_team_title', array(
        'default'           => 'OUR TEAM <br><span>OF</span> DEDICATION',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('about_team_title', array(
        'label'   => __('Team Section Title', 'creative-garden-redesign'),
        'section' => 'cgr_about',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('about_work_title', array(
        'default'           => 'OUR <br><span>WORK</span>',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('about_work_title', array(
        'label'   => __('Work Section Title', 'creative-garden-redesign'),
        'section' => 'cgr_about',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('about_video_url', array(
        'default'           => 'https://youtu.be/LsU5Y5svvq8',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('about_video_url', array(
        'label'   => __('Video URL', 'creative-garden-redesign'),
        'section' => 'cgr_about',
        'type'    => 'url',
    ));

    // About Brand Section
    $wp_customize->add_section('cgr_about_brand', array(
        'title'    => __('About Page Brands', 'creative-garden-redesign'),
        'panel'    => 'cgr_options',
        'priority' => 18,
    ));

    $wp_customize->add_setting('about_brand_display', array(
        'default'           => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
    ));
    $wp_customize->add_control('about_brand_display', array(
        'label'   => __('Display Brand Section', 'creative-garden-redesign'),
        'section' => 'cgr_about_brand',
        'type'    => 'checkbox',
    ));

    $wp_customize->add_setting('about_brand_count', array(
        'default'           => 6,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('about_brand_count', array(
        'label'       => __('Number of Brands', 'creative-garden-redesign'),
        'section'     => 'cgr_about_brand',
        'type'        => 'number',
        'input_attrs' => array(
            'min' => 1,
            'max' => 6,
        ),
    ));

    for ($i = 1; $i <= 6; $i++) {
        $wp_customize->add_setting('about_brand_logo_' . $i, array(
            'default'           => CGR_URI . '/assets/img/brand_logo_' . $i . '.svg',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_brand_logo_' . $i, array(
            'label'   => sprintf(__('Brand Logo %d', 'creative-garden-redesign'), $i),
            'section' => 'cgr_about_brand',
        )));
    }

    // Features Section
    $wp_customize->add_section('cgr_features', array(
        'title'    => __('Features Section', 'creative-garden-redesign'),
        'panel'    => 'cgr_options',
        'priority' => 20,
    ));

    $wp_customize->add_setting('features_title', array(
        'default'           => 'WE ARE <span>DIFFERENT</span> IN EVERY WAYS',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('features_title', array(
        'label'   => __('Features Title', 'creative-garden-redesign'),
        'section' => 'cgr_features',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('features_button_display', array(
        'default'           => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
    ));
    $wp_customize->add_control('features_button_display', array(
        'label'   => __('Display Features Button', 'creative-garden-redesign'),
        'section' => 'cgr_features',
        'type'    => 'checkbox',
    ));

    // Feature items (4)
    $feature_defaults = array(
        1 => array('icon' => 'fa-regular fa-heart', 'title' => 'Passion in every work', 'desc' => 'We are deeply passionate about creating beautiful, sustainable green landscapes for our clients.'),
        2 => array('icon' => 'fa-solid fa-link', 'title' => 'Collaboration on top', 'desc' => 'We make your dream design come true by combining your ideas with our 10+ years of garden design expertise.'),
        3 => array('icon' => 'fa-brands fa-buffer', 'title' => 'Sustainability in check', 'desc' => 'We love nurturing nature, one garden at a time, so that you can enjoy the beautiful landscape of our garden even longer.'),
        4 => array('icon' => 'fa-brands fa-ubuntu', 'title' => 'Creativity unleashed', 'desc' => 'We make sure to only give you our innovative designs that stand out to make sure that your garden is not like the others.'),
    );

    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting('feature_' . $i . '_icon', array(
            'default'           => $feature_defaults[$i]['icon'],
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('feature_' . $i . '_icon', array(
            'label'   => sprintf(__('Feature %d Icon Class', 'creative-garden-redesign'), $i),
            'section' => 'cgr_features',
            'type'    => 'text',
        ));

        $wp_customize->add_setting('feature_' . $i . '_title', array(
            'default'           => $feature_defaults[$i]['title'],
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('feature_' . $i . '_title', array(
            'label'   => sprintf(__('Feature %d Title', 'creative-garden-redesign'), $i),
            'section' => 'cgr_features',
            'type'    => 'text',
        ));

        $wp_customize->add_setting('feature_' . $i . '_desc', array(
            'default'           => $feature_defaults[$i]['desc'],
            'sanitize_callback' => 'sanitize_textarea_field',
        ));
        $wp_customize->add_control('feature_' . $i . '_desc', array(
            'label'   => sprintf(__('Feature %d Description', 'creative-garden-redesign'), $i),
            'section' => 'cgr_features',
            'type'    => 'textarea',
        ));
    }

    // Process Steps Section
    $wp_customize->add_section('cgr_process', array(
        'title'    => __('Process Steps Section', 'creative-garden-redesign'),
        'panel'    => 'cgr_options',
        'priority' => 25,
    ));

    $wp_customize->add_setting('process_title', array(
        'default'           => 'SIMPLE STEPS FOR OUR <span>LANDSCAPE</span> WORK',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('process_title', array(
        'label'   => __('Process Section Title', 'creative-garden-redesign'),
        'section' => 'cgr_process',
        'type'    => 'textarea',
    ));

    $process_defaults = array(
        1 => array('title' => 'Design consultation', 'desc' => 'In the initial step, we sit down with you to have a detailed discussion about your gardening vision and preferences.'),
        2 => array('title' => 'Design & planning', 'desc' => 'Our team of experts meticulously crafts a custom garden design that aligns with your desires and your space characteristics.'),
        3 => array('title' => 'Implement construction', 'desc' => 'We present the design to you for review. Once approved, we move forward to implement the plan with construction.'),
        4 => array('title' => 'Garden decorating', 'desc' => 'With your design finalized, we put on our gardening gloves and work, creating your garden to be as beautiful as envisioned.'),
    );

    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting('process_' . $i . '_title', array(
            'default'           => $process_defaults[$i]['title'],
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('process_' . $i . '_title', array(
            'label'   => sprintf(__('Step %d Title', 'creative-garden-redesign'), $i),
            'section' => 'cgr_process',
            'type'    => 'text',
        ));

        $wp_customize->add_setting('process_' . $i . '_desc', array(
            'default'           => $process_defaults[$i]['desc'],
            'sanitize_callback' => 'sanitize_textarea_field',
        ));
        $wp_customize->add_control('process_' . $i . '_desc', array(
            'label'   => sprintf(__('Step %d Description', 'creative-garden-redesign'), $i),
            'section' => 'cgr_process',
            'type'    => 'textarea',
        ));
    }

    // CTA Section
    $wp_customize->add_section('cgr_cta', array(
        'title'    => __('CTA Section', 'creative-garden-redesign'),
        'panel'    => 'cgr_options',
        'priority' => 30,
    ));

    $wp_customize->add_setting('cta_title', array(
        'default'           => 'READY TO TRANSFORM <br>YOUR GARDEN?',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('cta_title', array(
        'label'   => __('CTA Title', 'creative-garden-redesign'),
        'section' => 'cgr_cta',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('cta_btn_text', array(
        'default'           => 'Contact Us',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('cta_btn_text', array(
        'label'   => __('CTA Button Text', 'creative-garden-redesign'),
        'section' => 'cgr_cta',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('cta_btn_url', array(
        'default'           => '/contact/',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('cta_btn_url', array(
        'label'   => __('CTA Button URL', 'creative-garden-redesign'),
        'section' => 'cgr_cta',
        'type'    => 'url',
    ));

    $wp_customize->add_setting('cta_background', array(
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'cta_background', array(
        'label'     => __('CTA Background Image', 'creative-garden-redesign'),
        'section'   => 'cgr_cta',
        'mime_type' => 'image',
    )));

    // Contact Info Section
    $wp_customize->add_section('cgr_contact', array(
        'title'    => __('Contact Information', 'creative-garden-redesign'),
        'panel'    => 'cgr_options',
        'priority' => 35,
    ));

    $wp_customize->add_setting('contact_studio_1_name', array(
        'default'           => 'Dublin Studio',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('contact_studio_1_name', array(
        'label'   => __('Studio 1 Name', 'creative-garden-redesign'),
        'section' => 'cgr_contact',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('contact_studio_1_address', array(
        'default'           => "3 Landsdowne Valley Park\nDublin",
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('contact_studio_1_address', array(
        'label'   => __('Studio 1 Address', 'creative-garden-redesign'),
        'section' => 'cgr_contact',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('contact_studio_1_tel', array(
        'default'           => '+353 (0) 1 4920101',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('contact_studio_1_tel', array(
        'label'   => __('Studio 1 Tel/Fax', 'creative-garden-redesign'),
        'section' => 'cgr_contact',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('contact_studio_1_mobile', array(
        'default'           => '+353 (0) 86 8146924',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('contact_studio_1_mobile', array(
        'label'   => __('Studio 1 Mobile', 'creative-garden-redesign'),
        'section' => 'cgr_contact',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('contact_studio_1_email', array(
        'default'           => 'cgdsean@gmail.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('contact_studio_1_email', array(
        'label'   => __('Studio 1 Email', 'creative-garden-redesign'),
        'section' => 'cgr_contact',
        'type'    => 'email',
    ));

    $wp_customize->add_setting('contact_studio_2_name', array(
        'default'           => 'Midlands Studio',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('contact_studio_2_name', array(
        'label'   => __('Studio 2 Name', 'creative-garden-redesign'),
        'section' => 'cgr_contact',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('contact_studio_2_address', array(
        'default'           => "Cloonteagh\nNewtownforbes\nLongford",
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('contact_studio_2_address', array(
        'label'   => __('Studio 2 Address', 'creative-garden-redesign'),
        'section' => 'cgr_contact',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('contact_studio_2_tel', array(
        'default'           => '+353 (0)43 3329787',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('contact_studio_2_tel', array(
        'label'   => __('Studio 2 Tel/Fax', 'creative-garden-redesign'),
        'section' => 'cgr_contact',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('contact_studio_2_mobile', array(
        'default'           => '+353 (0) 86 8146924',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('contact_studio_2_mobile', array(
        'label'   => __('Studio 2 Mobile', 'creative-garden-redesign'),
        'section' => 'cgr_contact',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('contact_studio_2_email', array(
        'default'           => 'cgdsean@gmail.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('contact_studio_2_email', array(
        'label'   => __('Studio 2 Email', 'creative-garden-redesign'),
        'section' => 'cgr_contact',
        'type'    => 'email',
    ));

    $wp_customize->add_setting('contact_map_display', array(
        'default'           => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
    ));
    $wp_customize->add_control('contact_map_display', array(
        'label'   => __('Display Map', 'creative-garden-redesign'),
        'section' => 'cgr_contact',
        'type'    => 'checkbox',
    ));

    $wp_customize->add_setting('google_map_embed', array(
        'default'           => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96652.27317354927!2d-74.33557928194516!3d40.79756494697628!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c3a82f1352d0dd%3A0x81d4f72c4435aab5!2sTroy+Meadows+Wetlands!5e0!3m2!1sen!2sbd!4v1563075599994!5m2!1sen!2sbd',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('google_map_embed', array(
        'label'   => __('Google Map Embed URL', 'creative-garden-redesign'),
        'section' => 'cgr_contact',
        'type'    => 'url',
    ));

    // Footer Section
    $wp_customize->add_section('cgr_footer', array(
        'title'    => __('Footer Settings', 'creative-garden-redesign'),
        'panel'    => 'cgr_options',
        'priority' => 40,
    ));

    $wp_customize->add_setting('footer_text', array(
        'default'           => 'Stay updated with our latest projects and gardening tips.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('footer_text', array(
        'label'   => __('Footer Description', 'creative-garden-redesign'),
        'section' => 'cgr_footer',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('copyright_text', array(
        'default'           => 'COURTESY © 2025. ALL RIGHTS RESERVED.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('copyright_text', array(
        'label'   => __('Copyright Text', 'creative-garden-redesign'),
        'section' => 'cgr_footer',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('footer_logo', array(
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'footer_logo', array(
        'label'     => __('Footer Logo', 'creative-garden-redesign'),
        'section'   => 'cgr_footer',
        'mime_type' => 'image',
    )));

    // Social Media Section
    $wp_customize->add_section('cgr_social_media', array(
        'title'    => __('Social Media', 'creative-garden-redesign'),
        'priority' => 130,
    ));

    $social_networks = array(
        'facebook'  => __('Facebook URL', 'creative-garden-redesign'),
        'instagram' => __('Instagram URL', 'creative-garden-redesign'),
        'whatsapp'  => __('WhatsApp Number', 'creative-garden-redesign'),
    );

    foreach ($social_networks as $key => $label) {
        $wp_customize->add_setting('social_' . $key, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control('social_' . $key, array(
            'label'   => $label,
            'section' => 'cgr_social_media',
            'type'    => 'url',
        ));
    }
}
add_action('customize_register', 'cgr_customize_register');

/**
 * SEO - Dynamic Title and Meta Description
 */
function cgr_seo_meta() {
    if (is_singular()) {
        $post = get_post();
        $description = has_excerpt() ? get_the_excerpt() : wp_trim_words(strip_tags($post->post_content), 30);
        $description = esc_attr($description);
        echo '<meta name="description" content="' . $description . '">' . "\n";
    } elseif (is_home() || is_front_page()) {
        $description = get_bloginfo('description');
        echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
    } elseif (is_archive()) {
        $description = get_the_archive_description();
        if ($description) {
            echo '<meta name="description" content="' . esc_attr(wp_strip_all_tags($description)) . '">' . "\n";
        }
    }
}
add_action('wp_head', 'cgr_seo_meta', 1);

/**
 * Schema.org Structured Data for Services and Projects
 */
/**
 * Get Filtered Navigation Menu Items
 * Allows hiding/showing specific items
 */
function cgr_get_nav_menu_items($menu_location = 'primary') {
    $items = wp_get_nav_menu_items($menu_location);
    
    if (empty($items)) {
        return array();
    }
    
    // Get hidden items setting
    $hidden_items = get_theme_mod('nav_items_hidden', array());
    if (is_string($hidden_items)) {
        $hidden_items = json_decode($hidden_items, true);
    }
    
    if (!is_array($hidden_items)) {
        $hidden_items = array();
    }
    
    // Filter out hidden items
    $filtered_items = array_filter($items, function($item) use ($hidden_items) {
        return !in_array($item->ID, $hidden_items);
    });
    
    return array_values($filtered_items);
}

/**
 * Custom Walker for Primary Navigation
 * Modified to support customizer controls
 */
function cgr_schema_data() {
    if (is_singular('service')) {
        $schema = array(
            '@context'    => 'https://schema.org',
            '@type'       => 'Service',
            'name'        => get_the_title(),
            'description' => get_the_excerpt(),
            'provider'    => array(
                '@type' => 'Organization',
                'name'  => get_bloginfo('name'),
                'url'   => home_url(),
            ),
        );
        if (has_post_thumbnail()) {
            $schema['image'] = get_the_post_thumbnail_url(null, 'large');
        }
        echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>' . "\n";
    } elseif (is_singular('project')) {
        $year = get_post_meta(get_the_ID(), '_project_year', true);
        $location = get_post_meta(get_the_ID(), '_project_location', true);
        $schema = array(
            '@context'    => 'https://schema.org',
            '@type'       => 'CreativeWork',
            'name'        => get_the_title(),
            'description' => get_the_excerpt(),
            'dateCreated' => $year,
            'locationCreated' => array(
                '@type' => 'Place',
                'name'  => $location,
            ),
            'creator'     => array(
                '@type' => 'Organization',
                'name'  => get_bloginfo('name'),
            ),
        );
        if (has_post_thumbnail()) {
            $schema['image'] = get_the_post_thumbnail_url(null, 'large');
        }
        echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>' . "\n";
    }
}
add_action('wp_head', 'cgr_schema_data', 2);

/**
 * Custom Walker for Primary Navigation
 */
class CGR_Primary_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        $output .= '<ul>';
    }

    function end_lvl(&$output, $depth = 0, $args = null) {
        $output .= '</ul>';
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        
        // Add menu-item-has-children class if item has children
        $children = get_posts(array(
            'post_type' => 'nav_menu_item',
            'posts_per_page' => 1,
            'meta_query' => array(
                array(
                    'key' => '_menu_item_menu_item_parent',
                    'value' => $item->ID
                )
            )
        ));
        
        if (!empty($children) || in_array('menu-item-has-children', $classes)) {
            $classes[] = 'menu-item-has-children';
        }
        
        $classes = array_unique($classes);
        $class_names = join(' ', array_filter($classes));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= '<li' . $class_names . '>';

        $atts = array();
        $atts['href'] = !empty($item->url) ? $item->url : '';
        $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $attributes .= ' ' . $attr . '="' . esc_attr($value) . '"';
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);
        $item_output = isset($args->before) ? $args->before : '';
        $item_output .= '<a' . $attributes . '>';
        $item_output .= (isset($args->link_before) ? $args->link_before : '') . $title . (isset($args->link_after) ? $args->link_after : '');
        $item_output .= '</a>';
        $item_output .= isset($args->after) ? $args->after : '';

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

/**
 * Helper function to get theme mod with default
 */
function cgr_get_option($key, $default = '') {
    return get_theme_mod($key, $default);
}

/**
 * Include template parts
 */
require_once CGR_DIR . '/inc/template-tags.php';
