<?php
/**
 * Issue content template
 *
 * Used for both single and index/archive/search.
 *
 * Not leaving any whitespace before or after the <article> tag because it has display:inline-block
 * and we do not want more whitespace than defined margin between these blocks.
 */
?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-thumbnail-header-container">
		<?php
			// Post thumbnail.
			fifteen_issues_post_thumbnail();
		?>

		<header class="entry-header">
			<?php
				if ( !is_single() ) :
					the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
				else :
					the_title( '<h1 class="entry-title">', '</h1>' );
					?>
					<div class="entry-content">
						<?php
							/* translators: %s: Name of current post */
							the_content( sprintf(
								__( 'Continue reading %s', 'twentyfifteen' ),
								the_title( '<span class="screen-reader-text">', '</span>', false )
							) );

							wp_link_pages( array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfifteen' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
								'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>%',
								'separator'   => '<span class="screen-reader-text">, </span>',
							) );

							$url = post_custom('issue-pdf');
							if ($url) :
								?>
								<p class="issue-download">
									<a href="<?= $url ?>" class="issue-download-link">
										<?= __( 'Download whole issue', 'fifteen-issues' ) ?>
									</a>
								</p>
								<?php
							endif;
						?>
					</div><!-- .entry-content -->

					<?php
					// Author bio.
					if ( get_the_author_meta( 'description' ) ) :
						get_template_part( 'author-bio' );
					endif;
				endif; // is_single()
			?>
		</header><!-- .entry-header -->
	</div>

	<footer class="entry-footer">
		<?php twentyfifteen_entry_meta(); ?>
		<?php edit_post_link( __( 'Edit', 'twentyfifteen' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->