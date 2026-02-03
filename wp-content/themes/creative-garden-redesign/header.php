<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Start Preloader -->
<div class="cs_preloader">
    <div class="cs_preloader_in">
        <span></span>
        <span></span>
    </div>
    <div class="cs_preloader_text"><?php esc_html_e('Loading...', 'creative-garden-redesign'); ?></div>
</div>
<!-- End Preloader -->

<!-- Start Header Section -->
<header class="cs_site_header cs_style_1 cs_sticky_header" role="banner">
    <div class="cs_main_header">
        <div class="container">
            <div class="cs_main_header_in">
                <div class="cs_main_header_left">
                    <a class="cs_site_branding" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <img src="<?php echo esc_url(cgr_get_logo()); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                    </a>
                </div>
                <div class="cs_main_header_center">
                    <div class="cs_nav cs_heading_color">
                        <nav class="cs_nav_list_wrap text-uppercase" role="navigation" aria-label="<?php esc_attr_e('Primary Navigation', 'creative-garden-redesign'); ?>">
                            <?php                            // Filter menu items based on customizer settings
                            $menu_items = wp_get_nav_menu_items('primary');
                            $show_items = array();
                            
                            if (!empty($menu_items)) {
                                foreach ($menu_items as $item) {
                                    $setting_key = 'nav_item_show_' . $item->ID;
                                    $show_item = get_theme_mod($setting_key, true);
                                    if ($show_item) {
                                        $show_items[] = $item->ID;
                                    }
                                }
                            }
                                                        wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'menu_class'     => 'cs_nav_list',
                                'container'      => false,
                                'fallback_cb'    => false,
                                'walker'         => new CGR_Primary_Walker(),
                            ));
                            ?>
                        </nav>
                    </div>
                </div>
                <div class="cs_main_header_right">
                    <div class="cs_header_icon_btns">
                        <button type="button" class="cs_header_icon_btn cs_search_tobble_btn cs_center" aria-label="<?php esc_attr_e('Search', 'creative-garden-redesign'); ?>">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                <path d="M19.7556 18.5774L14.0682 12.89C15.1699 11.5292 15.8332 9.8 15.8332 7.91669C15.8332 3.55174 12.2815 9.15527e-05 7.91656 9.15527e-05C3.55161 9.15527e-05 0 3.5517 0 7.91666C0 12.2816 3.55165 15.8333 7.9166 15.8333C9.7999 15.8333 11.5291 15.1699 12.8899 14.0683L18.5773 19.7557C18.7398 19.9182 18.9531 19.9999 19.1665 19.9999C19.3798 19.9999 19.5932 19.9182 19.7557 19.7557C20.0815 19.4299 20.0815 18.9032 19.7556 18.5774ZM7.9166 14.1666C4.46996 14.1666 1.66666 11.3633 1.66666 7.91666C1.66666 4.47001 4.46996 1.66672 7.9166 1.66672C11.3632 1.66672 14.1665 4.47001 14.1665 7.91666C14.1665 11.3633 11.3632 14.1666 7.9166 14.1666Z" fill="currentColor"/>
                                </g>
                                <defs>
                                <clipPath>
                                <rect width="20" height="20" fill="currentColor"/>
                                </clipPath>
                                </defs>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="cs_header_form_wrap cs_center">
    <div class="cs_header_form_overlay"></div>
    <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="cs_header_form" role="search">
        <input type="text" name="s" class="cs_header_form_input" placeholder="<?php esc_attr_e('Search...', 'creative-garden-redesign'); ?>" value="<?php echo get_search_query(); ?>">
        <button type="submit" class="cs_header_form_btn cs_center" aria-label="<?php esc_attr_e('Search', 'creative-garden-redesign'); ?>">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g>
                <path d="M19.7556 18.5774L14.0682 12.89C15.1699 11.5292 15.8332 9.8 15.8332 7.91669C15.8332 3.55174 12.2815 9.15527e-05 7.91656 9.15527e-05C3.55161 9.15527e-05 0 3.5517 0 7.91666C0 12.2816 3.55165 15.8333 7.9166 15.8333C9.7999 15.8333 11.5291 15.1699 12.8899 14.0683L18.5773 19.7557C18.7398 19.9182 18.9531 19.9999 19.1665 19.9999C19.3798 19.9999 19.5932 19.9182 19.7557 19.7557C20.0815 19.4299 20.0815 18.9032 19.7556 18.5774ZM7.9166 14.1666C4.46996 14.1666 1.66666 11.3633 1.66666 7.91666C1.66666 4.47001 4.46996 1.66672 7.9166 1.66672C11.3632 1.66672 14.1665 4.47001 14.1665 7.91666C14.1665 11.3633 11.3632 14.1666 7.9166 14.1666Z" fill="currentColor"/>
                </g>
                <defs>
                <clipPath>
                <rect width="20" height="20" fill="currentColor"/>
                </clipPath>
                </defs>
            </svg>
        </button>
    </form>
</div>
<!-- End Header Section -->

<main id="primary" role="main">
