<?php
/**
 * Template Tags for Creative Garden Pro Theme
 *
 * @package Creative Garden_Pro
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get custom logo or default
 */
function cgr_get_logo($type = 'header') {
    if ($type === 'footer') {
        $footer_logo_id = get_theme_mod('footer_logo');
        if ($footer_logo_id) {
            return wp_get_attachment_image_url($footer_logo_id, 'full');
        }
        return CGR_URI . '/assets/img/footer_logo.svg';
    }

    if (has_custom_logo()) {
        $custom_logo_id = get_theme_mod('custom_logo');
        return wp_get_attachment_image_url($custom_logo_id, 'full');
    }

    return CGR_URI . '/assets/img/logo.svg';
}

/**
 * Get hero background images
 */
function cgr_get_hero_backgrounds() {
    $backgrounds = array();
    $defaults = array(
        CGR_URI . '/assets/img/hero_bg.jpg',
        CGR_URI . '/assets/img/hero_bg_4.jpg',
        CGR_URI . '/assets/img/hero_bg_2.jpg',
        CGR_URI . '/assets/img/hero_bg_4.jpg',
    );

    for ($i = 1; $i <= 4; $i++) {
        $bg_id = get_theme_mod('hero_bg_' . $i);
        if ($bg_id) {
            $backgrounds[] = wp_get_attachment_image_url($bg_id, 'cgr-hero');
        } else {
            $backgrounds[] = $defaults[$i - 1];
        }
    }

    return $backgrounds;
}

/**
 * Get CTA background
 */
function cgr_get_cta_background() {
    $bg_id = get_theme_mod('cta_background');
    if ($bg_id) {
        return wp_get_attachment_image_url($bg_id, 'full');
    }
    return CGR_URI . '/assets/img/cta_bg.jpg';
}

/**
 * Posted on / date template tag
 */
function cgr_posted_on() {
    $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
    echo sprintf(
        $time_string,
        esc_attr(get_the_date(DATE_W3C)),
        esc_html(get_the_date('d M Y'))
    );
}

/**
 * Posted by / author template tag
 */
function cgr_posted_by() {
    $byline = sprintf(
        esc_html_x('by %s', 'post author', 'creative-garder-redesign'),
        '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
    );
    echo '<span class="byline"> ' . $byline . '</span>';
}

/**
 * Get primary category
 */
function cgr_get_primary_category() {
    $categories = get_the_category();
    if (!empty($categories)) {
        return $categories[0];
    }
    return null;
}

/**
 * Pagination
 */
function cgr_pagination() {
    global $wp_query;

    if ($wp_query->max_num_pages <= 1) {
        return;
    }

    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max = intval($wp_query->max_num_pages);

    echo '<ul class="cs_pagination_box cs_center cs_mp_0">';

    for ($i = 1; $i <= $max; $i++) {
        $active = ($paged === $i) ? ' active' : '';
        echo '<li><a class="cs_pagination_item cs_center' . $active . '" href="' . esc_url(get_pagenum_link($i)) . '">' . $i . '</a></li>';
    }

    if ($paged < $max) {
        echo '<li><a href="' . esc_url(get_pagenum_link($paged + 1)) . '" class="cs_pagination_item cs_center">';
        echo '<svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">';
        echo '<path d="M0 1.272L4.55116 6L0 10.728L1.22442 12L7 6L1.22442 0L0 1.272Z" fill="currentColor"></path>';
        echo '</svg></a></li>';
    }

    echo '</ul>';
}

/**
 * Breadcrumb
 */
function cgr_breadcrumb() {
    echo '<ol class="breadcrumb">';
    echo '<li class="breadcrumb-item"><a href="' . esc_url(home_url('/')) . '">' . __('Home', 'creative-garder-redesign') . '</a></li>';

    if (is_singular('service')) {
        echo '<li class="breadcrumb-item"><a href="' . esc_url(get_post_type_archive_link('service')) . '">' . __('Services', 'creative-garder-redesign') . '</a></li>';
        echo '<li class="breadcrumb-item active">' . get_the_title() . '</li>';
    } elseif (is_singular('project')) {
        echo '<li class="breadcrumb-item"><a href="' . esc_url(get_post_type_archive_link('project')) . '">' . __('Projects', 'creative-garder-redesign') . '</a></li>';
        echo '<li class="breadcrumb-item active">' . get_the_title() . '</li>';
    } elseif (is_singular()) {
        $categories = get_the_category();
        if (!empty($categories)) {
            echo '<li class="breadcrumb-item"><a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a></li>';
        }
        echo '<li class="breadcrumb-item active">' . get_the_title() . '</li>';
    } elseif (is_archive()) {
        if (is_post_type_archive('service')) {
            echo '<li class="breadcrumb-item active">' . __('Services', 'creative-garder-redesign') . '</li>';
        } else {
            echo '<li class="breadcrumb-item active">' . get_the_archive_title() . '</li>';
        }
    } elseif (is_search()) {
        echo '<li class="breadcrumb-item active">' . sprintf(__('Search: %s', 'creative-garder-redesign'), get_search_query()) . '</li>';
    } elseif (is_page()) {
        echo '<li class="breadcrumb-item active">' . get_the_title() . '</li>';
    }

    echo '</ol>';
}

/**
 * Get feature image or placeholder
 */
function cgr_get_featured_image_url($size = 'large') {
    if (has_post_thumbnail()) {
        return get_the_post_thumbnail_url(null, $size);
    }
    return CGR_URI . '/assets/img/placeholder.jpg';
}

/**
 * Comment callback
 */
function cgr_comment($comment, $args, $depth) {
    $tag = 'li';
    ?>
    <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?>>
        <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
            <footer class="comment-meta">
                <div class="comment-author vcard">
                    <?php echo get_avatar($comment, 48); ?>
                    <?php printf('<b class="fn">%s</b>', get_comment_author_link()); ?>
                </div>
                <div class="comment-metadata">
                    <time datetime="<?php comment_time('c'); ?>">
                        <?php printf(
                            esc_html__('%1$s at %2$s', 'creative-garder-redesign'),
                            get_comment_date(),
                            get_comment_time()
                        ); ?>
                    </time>
                </div>
            </footer>
            <div class="comment-content">
                <?php comment_text(); ?>
            </div>
            <?php if ('0' == $comment->comment_approved) : ?>
                <p class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'creative-garder-redesign'); ?></p>
            <?php endif; ?>
            <?php
            comment_reply_link(array_merge($args, array(
                'depth'     => $depth,
                'max_depth' => $args['max_depth'],
            )));
            ?>
        </article>
    <?php
}

/**
 * SVG Arrow Icon
 */
function cgr_arrow_icon() {
    return '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M15.3846 0H0.615385C0.275692 0 0 0.275692 0 0.615385C0 0.955077 0.275692 1.23077 0.615385 1.23077H13.8988L0.180308 14.9495C-0.06 15.1898 -0.06 15.5794 0.180308 15.8197C0.300615 15.94 0.457846 16 0.615385 16C0.772923 16 0.930461 15.94 1.05046 15.8197L14.7692 2.10092V15.3846C14.7692 15.7243 15.0449 16 15.3846 16C15.7243 16 16 15.7243 16 15.3846V0.615385C16 0.275692 15.7243 0 15.3846 0Z" fill="currentColor"/>
    </svg>';
}

/**
 * Slider Left Arrow SVG
 */
function cgr_arrow_left_icon() {
    return '<svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0.499953 9.00005C0.499953 8.80823 0.573265 8.61623 0.719703 8.4698L8.2197 0.969797C8.51277 0.676734 8.98733 0.676734 9.2802 0.969797C9.57308 1.26286 9.57327 1.73742 9.2802 2.0303L2.31045 9.00005L9.2802 15.9698C9.57327 16.2629 9.57327 16.7374 9.2802 17.0303C8.98714 17.3232 8.51258 17.3234 8.2197 17.0303L0.719703 9.5303C0.573265 9.38386 0.499953 9.19186 0.499953 9.00005Z" fill="currentColor"/>
    </svg>';
}

/**
 * Slider Right Arrow SVG
 */
function cgr_arrow_right_icon() {
    return '<svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M9.50005 8.99995C9.50005 9.19177 9.42673 9.38377 9.2803 9.5302L1.7803 17.0302C1.48723 17.3233 1.01267 17.3233 0.719797 17.0302C0.426922 16.7371 0.426734 16.2626 0.719797 15.9697L7.68955 8.99995L0.719797 2.0302C0.426734 1.73714 0.426734 1.26258 0.719797 0.969702C1.01286 0.676826 1.48742 0.67664 1.7803 0.969702L9.2803 8.4697C9.42673 8.61614 9.50005 8.80814 9.50005 8.99995Z" fill="currentColor"/>
    </svg>';
}

/**
 * Slider Left Arrow (alias)
 */
function cgr_slider_arrow_left() {
    return cgr_arrow_left_icon();
}

/**
 * Slider Right Arrow (alias)
 */
function cgr_slider_arrow_right() {
    return cgr_arrow_right_icon();
}
