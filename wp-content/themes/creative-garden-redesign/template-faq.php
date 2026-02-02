<?php
/**
 * Template Name: FAQ Page
 * Template Post Type: page
 *
 * @package CreativeGardenDesign
 */

get_header();

// Get all FAQ posts
$faq_posts = get_posts(array(
    'post_type'      => 'faq',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC'
));

// Group FAQs by category
$garden_faqs = array();
$landscape_faqs = array();

foreach ($faq_posts as $post) {
    $category = get_post_meta($post->ID, '_faq_category', true);
    $faq_item = array(
        'id'       => $post->ID,
        'question' => $post->post_title,
        'answer'   => $post->post_content,
        'category' => $category
    );
    
    if ($category === 'landscape-design') {
        $landscape_faqs[] = $faq_item;
    } else {
        $garden_faqs[] = $faq_item;
    }
}

// Provide default FAQs if none exist in database
if (empty($garden_faqs) && empty($landscape_faqs)) {
    $default_faqs = array(
        array(
            'question' => 'What services does CreativeGardenDesign offer?',
            'answer'   => 'CreativeGardenDesign offers a comprehensive range of garden design services including home garden design, plant selection and care, hardscaping, public garden design, and ongoing maintenance services.',
        ),
        array(
            'question' => 'How long does a typical garden design project take?',
            'answer'   => 'Project timelines vary depending on the scope and complexity. A small residential garden might take 2-4 weeks, while larger projects can take several months. We\'ll provide a detailed timeline during our initial consultation.',
        ),
        array(
            'question' => 'Do you offer maintenance services?',
            'answer'   => 'Yes, we offer comprehensive maintenance packages to keep your garden looking its best year-round. Our services include regular pruning, fertilizing, pest control, and seasonal planting.',
        ),
        array(
            'question' => 'What areas do you serve?',
            'answer'   => 'We primarily serve the greater metropolitan area and surrounding suburbs. For larger projects, we can travel to locations throughout the region. Contact us to confirm service availability in your area.',
        ),
        array(
            'question' => 'How much does a garden design project cost?',
            'answer'   => 'Costs vary based on the size and complexity of the project. We offer free initial consultations where we can discuss your needs and provide a detailed quote tailored to your specific requirements.',
        ),
        array(
            'question' => 'Do you work with sustainable and native plants?',
            'answer'   => 'Absolutely! Sustainability is at the core of our design philosophy. We specialize in native and drought-resistant plants that are well-suited to local conditions and require minimal water and maintenance.',
        ),
    );
    
    $garden_faqs = $default_faqs;
    $landscape_faqs = $default_faqs;
}
?>
<!-- Start Page Heading Section -->
<section class="cs_page_heading cs_style_1 cs_bg_filed cs_heading_bg" data-src="<?php echo esc_url(CGR_URI . '/assets/img/about_heading_bg.jpg'); ?>">
    <div class="container">
        <?php cgr_breadcrumb(); ?>
        <h1 class="cs_page_title mb-0 cs_fs_80 wow fadeInUp"><?php esc_html_e('FAQs', 'creative-garden-redesign'); ?></h1>
    </div>
</section>
<!-- End Page Heading Section -->

<!-- Start FAQ Section -->
<section>
    <div class="cs_height_100 cs_height_lg_70"></div>
    <div class="container">
        <div class="cs_section_heading cs_style_2 cs_color_1">
            <h2 class="cs_section_title cs_fs_80 mb-0"><?php esc_html_e('GARDEN', 'creative-garden-redesign'); ?> <span><?php esc_html_e('DESIGN', 'creative-garden-redesign'); ?></span></h2>
        </div>
        <div class="cs_height_64 cs_height_lg_50"></div>
        <div class="row cs_gap_y_30">
            <div class="col-xxl-4 col-xl-5">
                <div class="cs_img_box cs_style_2">
                    <img src="<?php echo esc_url(CGR_URI . '/assets/img/faq_img.jpg'); ?>" alt="" class="cs_radius_20 w-100">
                </div>
            </div>
            <div class="col-xxl-8 col-xl-7">
                <div class="cs_accordians cs_style_1">
                    <?php foreach ($garden_faqs as $index => $faq) : ?>
                    <div class="cs_accordian<?php echo $index === 0 ? ' active' : ''; ?>">
                        <div class="cs_accordian_head">
                            <p class="cs_accordian_title cs_fs_20 cs_bold cs_heading_color"><?php echo esc_html($faq['question']); ?></p>
                            <span class="cs_accordian_toggle cs_heading_color">
                                <svg width="20" height="12" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.0001 11.2501C9.77627 11.2501 9.55227 11.1645 9.38143 10.9937L0.63143 2.24368C0.289523 1.90177 0.289523 1.34812 0.63143 1.00643C0.973336 0.664742 1.52699 0.664523 1.86868 1.00643L10.0001 9.1378L18.1314 1.00643C18.4733 0.664523 19.027 0.664523 19.3687 1.00643C19.7104 1.34834 19.7106 1.90199 19.3687 2.24368L10.6187 10.9937C10.4478 11.1645 10.2238 11.2501 10.0001 11.2501Z" fill="currentColor"/>
                                </svg>
                            </span>
                        </div>
                        <div class="cs_accordian_body cs_heading_color cs_opacity_7_5">
                            <p><?php echo wp_kses_post($faq['answer']); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="cs_height_100 cs_height_lg_70"></div>
    <div class="container">
        <div class="cs_section_heading cs_style_2 cs_color_1">
            <h2 class="cs_section_title cs_fs_80 mb-0"><?php esc_html_e('LANDSCAPE', 'creative-garden-redesign'); ?> <span><?php esc_html_e('DESIGN', 'creative-garden-redesign'); ?></span></h2>
        </div>
        <div class="cs_height_64 cs_height_lg_50"></div>
        <div class="row cs_gap_y_30">
            <div class="col-xxl-4 col-xl-5">
                <div class="cs_img_box cs_style_2">
                    <img src="<?php echo esc_url(CGR_URI . '/assets/img/faq_img_2.jpg'); ?>" alt="" class="cs_radius_20 w-100">
                </div>
            </div>
            <div class="col-xxl-8 col-xl-7">
                <div class="cs_accordians cs_style_1">
                    <?php foreach ($landscape_faqs as $index => $faq) : ?>
                    <div class="cs_accordian<?php echo $index === 0 ? ' active' : ''; ?>">
                        <div class="cs_accordian_head">
                            <p class="cs_accordian_title cs_fs_20 cs_bold cs_heading_color"><?php echo esc_html($faq['question']); ?></p>
                            <span class="cs_accordian_toggle cs_heading_color">
                                <svg width="20" height="12" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.0001 11.2501C9.77627 11.2501 9.55227 11.1645 9.38143 10.9937L0.63143 2.24368C0.289523 1.90177 0.289523 1.34812 0.63143 1.00643C0.973336 0.664742 1.52699 0.664523 1.86868 1.00643L10.0001 9.1378L18.1314 1.00643C18.4733 0.664523 19.027 0.664523 19.3687 1.00643C19.7104 1.34834 19.7106 1.90199 19.3687 2.24368L10.6187 10.9937C10.4478 11.1645 10.2238 11.2501 10.0001 11.2501Z" fill="currentColor"/>
                                </svg>
                            </span>
                        </div>
                        <div class="cs_accordian_body cs_heading_color cs_opacity_7_5">
                            <p><?php echo wp_kses_post($faq['answer']); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="cs_height_100 cs_height_lg_70"></div>
</section>
<!-- End FAQ Section -->

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
            <a href="<?php echo esc_url(home_url('/projects/')); ?>" class="cs_arrow_btn cs_size_lg cs_center cs_white_bg cs_heading_color">
                <?php echo cgr_arrow_icon(); ?>
            </a>
        </div>
    </div>
</section>
<!-- End CTA Card Section -->

<?php get_footer(); ?>
