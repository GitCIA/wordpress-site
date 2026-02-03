<?php
/**
 * Template Name: Contact Page
 * Template Post Type: page
 *
 * @package CreativeGardenDesign
 */

get_header();

// Contact Page Customizer Options
$contact_email = get_theme_mod('contact_email', 'hallo@creativegardendesign.com');
$contact_phone = get_theme_mod('contact_phone', '+123 456 7890');
$contact_address = get_theme_mod('contact_address', '123 Any Where St, Any City, Any State');
$contact_address_2 = get_theme_mod('contact_address_2', '');
$contact_map_display = get_theme_mod('contact_map_display', true);
$contact_map_embed = get_theme_mod('google_map_embed', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96652.27317354927!2d-74.33557928194516!3d40.79756494697628!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c3a82f1352d0dd%3A0x81d4f72c4435aab5!2sTroy+Meadows+Wetlands!5e0!3m2!1sen!2sbd!4v1563075599994!5m2!1sen!2sbd');

$contact_info_html = '';
ob_start();
?>
<div class="cs_section_heading cs_style_4 cs_mb_25">
    <h2 class="cs_section_title cs_fs_32 cs_bold mb-0"><?php esc_html_e('GET IN', 'creative-garden-redesign'); ?> <span><?php esc_html_e('TOUCH', 'creative-garden-redesign'); ?></span></h2>
</div>
<ul class="cs_contact_info cs_mp_0">
    <li>
        <p class="mb-0"><?php esc_html_e('EMAIL', 'creative-garden-redesign'); ?></p>
        <h4 class="mb-0 cs_fs_20 cs_bold"><a href="mailto:<?php echo esc_attr($contact_email); ?>"><?php echo esc_html($contact_email); ?></a></h4>
    </li>
    <li>
        <p class="mb-0"><?php esc_html_e('PHONE', 'creative-garden-redesign'); ?></p>
        <h4 class="mb-0 cs_fs_20 cs_bold"><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $contact_phone)); ?>"><?php echo esc_html($contact_phone); ?></a></h4>
    </li>
    <li>
        <p class="mb-0"><?php esc_html_e('ADDRESS', 'creative-garden-redesign'); ?></p>
        <h4 class="mb-0 cs_fs_20 cs_bold"><?php echo esc_html($contact_address); ?></h4>
    </li>
    <?php if (!empty($contact_address_2)) : ?>
    <li>
        <p class="mb-0"><?php esc_html_e('ADDRESS 2', 'creative-garden-redesign'); ?></p>
        <h4 class="mb-0 cs_fs_20 cs_bold"><?php echo esc_html($contact_address_2); ?></h4>
    </li>
    <?php endif; ?>
    <?php
    $facebook = get_theme_mod('social_facebook');
    $instagram = get_theme_mod('social_instagram');
    $whatsapp = get_theme_mod('social_whatsapp');
    if ($facebook || $instagram || $whatsapp) :
    ?>
    <li>
        <p class="mb-0"><?php esc_html_e('SOCIAL', 'creative-garden-redesign'); ?></p>
        <ul class="cs_footer_links cs_mp_0">
            <?php if ($facebook) : ?>
            <li>
                <a href="<?php echo esc_url($facebook); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('Facebook', 'creative-garden-redesign'); ?>">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
            </li>
            <?php endif; ?>

            <?php if ($instagram) : ?>
            <li>
                <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('Instagram', 'creative-garden-redesign'); ?>">
                    <i class="fa-brands fa-instagram"></i>
                </a>
            </li>
            <?php endif; ?>

            <?php if ($whatsapp) :
                $whatsapp_url = 'https://wa.me/' . preg_replace('/[^0-9]/', '', $whatsapp);
            ?>
            <li>
                <a href="<?php echo esc_url($whatsapp_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('WhatsApp', 'creative-garden-redesign'); ?>">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </li>
    <?php endif; ?>
</ul>
<?php
$contact_info_html = ob_get_clean();
?>
?>

<!-- Start Page Heading Section -->
<section class="cs_page_heading cs_style_1 cs_bg_filed cs_heading_bg" data-src="<?php echo esc_url(CGR_URI . '/assets/img/about_heading_bg.jpg'); ?>">
    <div class="container">
        <?php cgr_breadcrumb(); ?>
        <h1 class="cs_page_title mb-0 cs_fs_80 wow fadeInUp"><?php esc_html_e('CONTACT US', 'creative-garden-redesign'); ?></h1>
    </div>
</section>
<!-- End Page Heading Section -->

<!-- Start Contact Section -->
<div class="cs_height_100 cs_height_lg_70"></div>
<div class="container">
    <div class="row cs_gap_y_40">
        <div class="col-lg-5">
            <?php if ($contact_map_display) : ?>
                <div class="cs_map">
                    <iframe id="map" src="<?php echo esc_url($contact_map_embed); ?>" allowfullscreen></iframe>
                </div>
            <?php else : ?>
                <?php echo $contact_info_html; ?>
            <?php endif; ?>
        </div>
        <div class="col-lg-7">
            <div class="cs_pl_40">
                <div class="cs_section_heading cs_style_4 cs_mb_25">
                    <h2 class="cs_section_title cs_fs_32 cs_bold mb-0"><?php esc_html_e('SEND US A', 'creative-garden-redesign'); ?> <span><?php esc_html_e('MESSAGE', 'creative-garden-redesign'); ?></span></h2>
                </div>
                <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST" class="row cs_gap_y_24" id="cs_form">
                    <?php wp_nonce_field('cgr_contact_form', 'cgr_contact_nonce'); ?>
                    <input type="hidden" name="action" value="cgr_contact_form">
                    <div class="col-sm-6">
                        <input type="text" name="name" class="cs_form_field" placeholder="<?php esc_attr_e('Name', 'creative-garden-redesign'); ?>" required>
                    </div>
                    <div class="col-sm-6">
                        <input type="email" name="email" class="cs_form_field" placeholder="<?php esc_attr_e('Email', 'creative-garden-redesign'); ?>" required>
                    </div>
                    <div class="col-lg-12">
                        <textarea class="cs_form_field" name="message" placeholder="<?php esc_attr_e('Message', 'creative-garden-redesign'); ?>" rows="5" required></textarea>
                    </div>
                    <div class="col-lg-12">
                        <button class="cs_btn cs_style_1 cs_type_1 cs_bold cs_heading_bg cs_white_color w-100" type="submit"><?php esc_html_e('Send Message', 'creative-garden-redesign'); ?></button>
                        <div id="cs_result" class="cs_heading_color"></div>
                    </div>
                </form>
                <?php if ($contact_map_display) : ?>
                    <div class="cs_height_60 cs_height_lg_40"></div>
                    <?php echo $contact_info_html; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="cs_height_100 cs_height_lg_70"></div>
<!-- End Contact Section -->

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
