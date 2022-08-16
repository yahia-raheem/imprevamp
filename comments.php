<?php
// ==========================================================================================
// Codepages Comments Teamplate
// @package CPS
// @author Codepages - Codepages
// @link http://themeforest.net/user/codepages/portfolio
// ==========================================================================================
?>

<?php if ( post_password_required() ) { return;} ?>
<div id="comments" class="theme-comments">

	<?php if (have_comments()) { ?>
		<h3 class="theme-comments__title">
			<?php
			printf(_nx('One thought', '%1$s thoughts', get_comments_number(), 'comments title', 'cps'),
				number_format_i18n(get_comments_number()), '<span>' . get_the_title() . '</span>');
			?>
		</h3>

		<ul class="theme-comments__list">
			<?php wp_list_comments(array('callback' => 'CPSModules::comment')); ?>
		</ul>

		<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) {
			echo '<nav class="theme-comments__nav">';
			paginate_comments_links(array(
				'prev_text'    => '<span class="arrow-left"></span>',
				'next_text'    => '<span class="arrow-right"></span>',
				'type'         => 'list',
				'add_fragment' => '#comments'
			));
			echo '</nav>';
		} ?>

	<?php } ?>


	<?php if (!comments_open() && '0' != get_comments_number() && post_type_supports(get_post_type(), 'comments')) { ?>
		<p class="theme-comments__closed"><?php esc_html_e('Comments are closed.', 'cps'); ?></p>
	<?php } ?>


	<?php
	$commenter = wp_get_current_commenter();
	$required = get_option('require_name_email');

	comment_form(array(
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title comment-respond__title">',
		'title_reply_after' => '</h3>',
		'comment_field' =>
			'<p class="comment-form-comment form-row">
				<label for="comment">
					' . esc_html__('Your Comment', 'cps') . '
					<abbr class="required" title="' . esc_html__('required', 'cps') . '">*</abbr>
				</label>
				<textarea id="comment" name="comment" cols="45" rows="8" required></textarea>
			</p>',

		'fields' => array(
			'author' =>
				'<p class="comment-form-author form-row">
					<label for="author">
						' . esc_html__('Your Name', 'cps') . '
						' . ($required ? '<abbr class="required" title="' . esc_html__('required', 'cps') . '">*</abbr>' : '') .'
					</label>
					<input
						id="author"
						name="author"
						type="text"
						minlength="3"
						value="' . esc_attr($commenter['comment_author']) . '"
						' . ($required ? 'required' : '') .'
					>
				</p>',

			'email' =>
				'<p class="comment-form-email form-row">
					<label for="email">
						' . esc_html__('Your Email', 'cps') . '
						' . ($required ? '<abbr class="required" title="' . esc_html__('required', 'cps') . '">*</abbr>' : '') .'
					</label>
					<input
						id="email"
						name="email"
						type="email"
						value="' . esc_attr($commenter['comment_author_email']) . '"
						' . ($required ? 'required' : '') .'
					>
				</p>',

			'url' => ''
		)
	));
	?>

</div>
