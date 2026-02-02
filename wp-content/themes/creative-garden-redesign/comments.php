<?php
/**
 * Comments Template
 *
 * @package LeafLife_Pro
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if (have_comments()) : ?>
        <h3 class="comments-title cs_fs_32 cs_bold cs_mb_24">
            <?php
            $comments_number = get_comments_number();
            if ('1' === $comments_number) {
                printf(esc_html__('One Response to "%s"', 'creative-garden-redesign'), '<span>' . get_the_title() . '</span>');
            } else {
                printf(
                    esc_html(_nx('%1$s Response to "%2$s"', '%1$s Responses to "%2$s"', $comments_number, 'comments title', 'creative-garden-redesign')),
                    number_format_i18n($comments_number),
                    '<span>' . get_the_title() . '</span>'
                );
            }
            ?>
        </h3>

        <ol class="comment-list cs_mp_0">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 60,
                'callback'    => 'cgr_comment_callback',
            ));
            ?>
        </ol>

        <?php
        the_comments_navigation(array(
            'prev_text' => '<i class="fa-solid fa-chevron-left"></i> ' . esc_html__('Older Comments', 'creative-garden-redesign'),
            'next_text' => esc_html__('Newer Comments', 'creative-garden-redesign') . ' <i class="fa-solid fa-chevron-right"></i>',
        ));
        ?>

        <?php if (!comments_open()) : ?>
            <p class="no-comments"><?php esc_html_e('Comments are closed.', 'creative-garden-redesign'); ?></p>
        <?php endif; ?>

    <?php endif; ?>

    <?php
    comment_form(array(
        'title_reply'          => esc_html__('Leave a Reply', 'creative-garden-redesign'),
        'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title cs_fs_32 cs_bold cs_mb_24">',
        'title_reply_after'    => '</h3>',
        'class_form'           => 'comment-form row cs_gap_y_24',
        'class_submit'         => 'cs_btn cs_style_1 cs_type_1 cs_bold cs_heading_bg cs_white_color',
        'comment_field'        => '<div class="col-lg-12"><textarea id="comment" name="comment" class="cs_form_field" placeholder="' . esc_attr__('Your Comment *', 'creative-garden-redesign') . '" rows="5" required></textarea></div>',
        'fields'               => array(
            'author' => '<div class="col-sm-6"><input id="author" name="author" type="text" class="cs_form_field" placeholder="' . esc_attr__('Name *', 'creative-garden-redesign') . '" required></div>',
            'email'  => '<div class="col-sm-6"><input id="email" name="email" type="email" class="cs_form_field" placeholder="' . esc_attr__('Email *', 'creative-garden-redesign') . '" required></div>',
            'url'    => '<div class="col-lg-12"><input id="url" name="url" type="url" class="cs_form_field" placeholder="' . esc_attr__('Website', 'creative-garden-redesign') . '"></div>',
        ),
        'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
        'submit_field'         => '<div class="col-lg-12">%1$s %2$s</div>',
    ));
    ?>

</div>
