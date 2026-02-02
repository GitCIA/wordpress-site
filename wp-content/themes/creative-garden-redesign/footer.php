</main><!-- #primary -->

<!-- Start Footer Section -->
<footer class="cs_footer cs_style_1" role="contentinfo">
    <div class="container">
        <div class="cs_footer_row">
            <div class="cs_footer_col">
                <div class="cs_footer_widget">
                    <div class="cs_text_widget">
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <img src="<?php echo esc_url(cgr_get_logo('footer')); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="wow zoomIn">
                        </a>
                        <p><?php echo esc_html(get_theme_mod('footer_text', 'Stay updated with our latest projects and gardening tips.')); ?></p>
                    </div>
                </div>
                <div class="cs_footer_widget">
                    <form action="#" class="cs_newsletter cs_style_1" id="newsletter-form">
                        <input type="email" placeholder="<?php esc_attr_e('Enter your email address ...', 'creative-garden-redesign'); ?>" class="cs_newsletter_input" required>
                        <button type="submit" class="cs_newsletter_btn cs_arrow_btn cs_white_bg cs_heading_color" aria-label="<?php esc_attr_e('Subscribe', 'creative-garden-redesign'); ?>">
                            <?php echo cgr_arrow_icon(); ?>
                        </button>
                    </form>
                </div>
            </div>
            <div class="cs_footer_col">
                <div class="cs_footer_widget">
                    <h4 class="cs_footer_widget_title"><?php esc_html_e('SUPPORT', 'creative-garden-redesign'); ?></h4>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer-support',
                        'menu_class'     => 'cs_footer_widget_menu cs_mp_0',
                        'container'      => false,
                        'fallback_cb'    => function() {
                            echo '<ul class="cs_footer_widget_menu cs_mp_0">';
                            echo '<li><a href="' . esc_url(home_url('/faq/')) . '">' . esc_html__('FAQ', 'creative-garden-redesign') . '</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/contact/')) . '">' . esc_html__('CONTACT', 'creative-garden-redesign') . '</a></li>';
                            echo '</ul>';
                        },
                    ));
                    ?>
                </div>
            </div>
            <div class="cs_footer_col">
                <div class="cs_footer_widget">
                    <h4 class="cs_footer_widget_title"><?php esc_html_e('LINKS', 'creative-garden-redesign'); ?></h4>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer-links',
                        'menu_class'     => 'cs_footer_widget_menu cs_mp_0',
                        'container'      => false,
                        'fallback_cb'    => function() {
                            echo '<ul class="cs_footer_widget_menu cs_mp_0">';
                            echo '<li><a href="' . esc_url(home_url('/about/')) . '">' . esc_html__('ABOUT US', 'creative-garden-redesign') . '</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/gallery/')) . '">' . esc_html__('GALLERY', 'creative-garden-redesign') . '</a></li>';
                            echo '<li><a href="' . esc_url(home_url('/projects/')) . '">' . esc_html__('PROJECTS', 'creative-garden-redesign') . '</a></li>';
                            echo '<li><a href="' . esc_url(get_permalink(get_option('page_for_posts'))) . '">' . esc_html__('BLOG', 'creative-garden-redesign') . '</a></li>';
                            echo '</ul>';
                        },
                    ));
                    ?>
                </div>
            </div>
            <div class="cs_footer_col">
                <div class="cs_footer_widget">
                    <h4 class="cs_footer_widget_title"><?php esc_html_e('SERVICES', 'creative-garden-redesign'); ?></h4>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer-services',
                        'menu_class'     => 'cs_footer_widget_menu cs_mp_0',
                        'container'      => false,
                        'fallback_cb'    => function() {
                            $services = get_posts(array(
                                'post_type'      => 'service',
                                'posts_per_page' => 4,
                                'orderby'        => 'menu_order',
                                'order'          => 'ASC',
                            ));
                            echo '<ul class="cs_footer_widget_menu cs_mp_0">';
                            foreach ($services as $service) {
                                echo '<li><a href="' . esc_url(get_permalink($service->ID)) . '">' . esc_html(strtoupper($service->post_title)) . '</a></li>';
                            }
                            if (empty($services)) {
                                echo '<li><a href="#">' . esc_html__('HOME GARDEN', 'creative-garden-redesign') . '</a></li>';
                                echo '<li><a href="#">' . esc_html__('PLANT SELECTION', 'creative-garden-redesign') . '</a></li>';
                                echo '<li><a href="#">' . esc_html__('HARDSCAPING', 'creative-garden-redesign') . '</a></li>';
                                echo '<li><a href="#">' . esc_html__('PUBLIC GARDEN', 'creative-garden-redesign') . '</a></li>';
                            }
                            echo '</ul>';
                        },
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="cs_bottom_footer">
            <div class="cs_bottom_footer_left wow fadeInLeft">
                <div class="cs_copyright"><?php 
                    $copyright_text = get_theme_mod('copyright_text', 'COURTESY © [YEAR]. ALL RIGHTS RESERVED.');
                    $copyright_text = str_replace('[YEAR]', date('Y'), $copyright_text);
                    echo esc_html($copyright_text);
                ?></div>
            </div>
            <div class="cs_bottom_footer_right wow fadeInRight">
                <ul class="cs_footer_links cs_mp_0">
                    <?php
                    $facebook = get_theme_mod('social_facebook');
                    $instagram = get_theme_mod('social_instagram');
                    $whatsapp = get_theme_mod('social_whatsapp');

                    if ($facebook) :
                    ?>
                    <li>
                        <a href="<?php echo esc_url($facebook); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('Facebook', 'creative-garden-redesign'); ?>">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php
                    if ($instagram) :
                    ?>
                    <li>
                        <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('Instagram', 'creative-garden-redesign'); ?>">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php
                    if ($whatsapp) :
                        $whatsapp_url = 'https://wa.me/' . preg_replace('/[^0-9]/', '', $whatsapp);
                    ?>
                    <li>
                        <a href="<?php echo esc_url($whatsapp_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('WhatsApp', 'creative-garden-redesign'); ?>">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer Section -->

<?php wp_footer(); ?>
</body>
</html>
