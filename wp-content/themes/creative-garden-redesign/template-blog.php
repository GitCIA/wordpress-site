<?php
/**
 * Template Name: Blog Page
 * Template Post Type: page
 *
 * @package CreativeGardenDesign
 */

get_header();
?>

<!-- Start Page Heading Section -->
<section class="cs_page_heading cs_style_1 cs_bg_filed_filed cs_heading_bg" data-src="<?php echo esc_url(CGR_URI . '/assets/img/about_heading_bg.jpg'); ?>">
    <div class="container">
        <?php cgr_breadcrumb(); ?>
        <h1 class="cs_page_title mb-0 cs_fs_80 wow fadeInUp"><?php esc_html_e('Latest Post', 'creative-garden-redesign'); ?></h1>
    </div>
</section>
<!-- End Page Heading Section -->

<!-- Start Gallery Section -->
<section>
    <div class="cs_height_100 cs_height_lg_70"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="cs_post_1_list">
                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $blog_query = new WP_Query(array(
                        'post_type'      => 'post',
                        'posts_per_page' => 5,
                        'paged'          => $paged,
                    ));

                    if ($blog_query->have_posts()) :
                        while ($blog_query->have_posts()) : $blog_query->the_post();
                    ?>
                    <div class="cs_post cs_style_1">
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
                    </div>
                    <?php endwhile; ?>
                    <?php else : ?>
                    <p><?php esc_html_e('No posts found.', 'creative-garden-redesign'); ?></p>
                    <?php endif; ?>
                </div>
                <div class="cs_height_60 cs_height_lg_40"></div>
                <?php
                // Custom Pagination
                $total_pages = $blog_query->max_num_pages;
                $current_page = max(1, $paged);
                if ($total_pages > 1) :
                ?>
                <ul class="cs_pagination_box cs_center cs_mp_0">
                    <?php
                    // Previous button
                    if ($current_page > 1) :
                        $prev_link = get_pagenum_link($current_page - 1);
                    ?>
                    <li>
                        <a href="<?php echo esc_url($prev_link); ?>" class="cs_pagination_item cs_center">
                            <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 1.272L2.44884 6L7 10.728L5.77558 12L0 6L5.77558 0L7 1.272Z" fill="currentColor"></path>
                            </svg>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php
                    // Page numbers
                    for ($i = 1; $i <= $total_pages; $i++) :
                        $page_link = get_pagenum_link($i);
                        $active_class = ($i === $current_page) ? 'active' : '';
                    ?>
                    <li>
                        <a href="<?php echo esc_url($page_link); ?>" class="cs_pagination_item cs_center <?php echo esc_attr($active_class); ?>"><?php echo esc_html($i); ?></a>
                    </li>
                    <?php endfor; ?>

                    <?php
                    // Next button
                    if ($current_page < $total_pages) :
                        $next_link = get_pagenum_link($current_page + 1);
                    ?>
                    <li>
                        <a href="<?php echo esc_url($next_link); ?>" class="cs_pagination_item cs_center">
                            <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 1.272L4.55116 6L0 10.728L1.22442 12L7 6L1.22442 0L0 1.272Z" fill="currentColor"></path>
                            </svg>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
                <?php endif; wp_reset_postdata(); ?>
            </div>
            <div class="col-lg-4">
                <div class="cs_sidebar cs_right_sidebar">
                    <!-- Search Widget -->
                    <div class="cs_sidebar_item widget_search">
                        <form class="cs_sidebar_search" action="<?php echo esc_url(home_url('/')); ?>" method="get">
                            <input type="text" name="s" placeholder="<?php esc_attr_e('Search...', 'creative-garden-redesign'); ?>" value="<?php echo get_search_query(); ?>">
                            <button class="cs_sidebar_search_btn">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.4351 10.0629H10.7124L10.4563 9.81589C11.3528 8.77301 11.8925 7.4191 11.8925 5.94625C11.8925 2.66209 9.23042 0 5.94625 0C2.66209 0 0 2.66209 0 5.94625C0 9.23042 2.66209 11.8925 5.94625 11.8925C7.4191 11.8925 8.77301 11.3528 9.81589 10.4563L10.0629 10.7124V11.4351L14.6369 16L16 14.6369L11.4351 10.0629ZM5.94625 10.0629C3.66838 10.0629 1.82962 8.22413 1.82962 5.94625C1.82962 3.66838 3.66838 1.82962 5.94625 1.82962C8.22413 1.82962 10.0629 3.66838 10.0629 5.94625C10.0629 8.22413 8.22413 10.0629 5.94625 10.0629Z" fill="currentColor"></path>
                                </svg>
                            </button>
                        </form>
                    </div>

                    <!-- Categories Widget -->
                    <div class="cs_sidebar_item widget_categories">
                        <h4 class="cs_sidebar_widget_title"><?php esc_html_e('Categories', 'creative-garden-redesign'); ?></h4>
                        <ul>
                            <?php
                            $categories = get_categories(array(
                                'orderby' => 'count',
                                'order'   => 'DESC',
                                'number'  => 5,
                            ));
                            foreach ($categories as $cat) :
                                echo '<li class="cat-item"><a href="' . esc_url(get_category_link($cat->term_id)) . '"><i class="fa-solid fa-link"></i>' . esc_html($cat->name) . '</a></li>';
                            endforeach;
                            ?>
                        </ul>
                    </div>

                    <!-- Recent Posts Widget -->
                    <div class="cs_sidebar_item">
                        <h4 class="cs_sidebar_widget_title"><?php esc_html_e('Recent Posts', 'creative-garden-redesign'); ?></h4>
                        <ul class="cs_recent_posts">
                            <?php
                            $recent_posts = new WP_Query(array(
                                'posts_per_page' => 3,
                                'post_type'      => 'post',
                            ));
                            while ($recent_posts->have_posts()) : $recent_posts->the_post();
                            ?>
                            <li>
                                <div class="cs_recent_post">
                                    <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>" class="cs_recent_post_thumb">
                                        <div class="cs_recent_post_thumb_in cs_bg_filed" data-src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>"></div>
                                    </a>
                                    <?php endif; ?>
                                    <div class="cs_recent_post_info">
                                        <h3 class="cs_recent_post_title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <div class="cs_recent_post_date cs_primary_40_color">
                                            <?php echo get_the_date('d M Y'); ?>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </ul>
                    </div>

                    <!-- Archives Widget -->
                    <div class="cs_sidebar_item widget_archive">
                        <h4 class="cs_sidebar_widget_title"><?php esc_html_e('Archives', 'creative-garden-redesign'); ?></h4>
                        <ul>
                            <?php wp_get_archives(array(
                                'type'  => 'monthly',
                                'limit' => 5,
                                'format' => 'custom',
                                'before' => '<li><a href="%url%"><i class="fa-solid fa-link"></i>',
                                'after'  => '</a></li>',
                            )); ?>
                        </ul>
                    </div>

                    <!-- Tags Widget -->
                    <div class="cs_sidebar_item widget_tag_cloud">
                        <h4 class="cs_sidebar_widget_title"><?php esc_html_e('Tags', 'creative-garden-redesign'); ?></h4>
                        <div class="tagcloud">
                            <?php
                            $tags = get_tags(array(
                                'orderby' => 'count',
                                'order'   => 'DESC',
                                'number'  => 10,
                            ));
                            if ($tags) :
                                foreach ($tags as $tag) :
                                    echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="tag-cloud-link">' . esc_html($tag->name) . '</a>';
                                endforeach;
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cs_height_100 cs_height_lg_70"></div>
</section>
<!-- End Gallery Section -->

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

