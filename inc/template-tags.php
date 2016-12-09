<?php

if ( ! function_exists( 'fifteen_issues_issue_thumbnail' ) ) :
/**
 * Display an optional cover thumbnail for entries of issue type.
 *
 * Wraps the thumbnail in either an anchor element, or a div
 * element, depending on circumstances.
 */
function fifteen_issues_issue_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :

        $url = post_custom('issue_pdf');
        if ($url) : ?>
            <a href="<?= $url ?>" class="post-thumbnail">
                <?php the_post_thumbnail( 'fifteen-issues-issue-cover' ); ?>
                <span><span><?= __( 'Download', 'fifteen-issues' ) ?></span></span>
            </a>
        <?php else : ?>
            <div class="post-thumbnail">
                <?php the_post_thumbnail( 'fifteen-issues-issue-cover' ); ?>
            </div><!-- .post-thumbnail -->
            <?php
        endif;
	else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php
			the_post_thumbnail( 'fifteen-issues-issue-cover', array( 'alt' => get_the_title() ) );
		?>
	</a>

	<?php endif; // End is_singular()
}
endif;