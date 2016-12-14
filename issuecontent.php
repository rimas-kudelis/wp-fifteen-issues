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
		<header class="entry-header">
			<?php
				if ( !is_single() ) :
					the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
				else :
					the_title( '<h1 class="entry-title">', '</h1>' );
				endif; // is_single()
			?>
		</header><!-- .entry-header -->

		<?php
			// Post thumbnail.
			fifteen_issues_issue_thumbnail();
		?>
	</div>

	<?php
	if (is_single()):
		?>
		<div class="entry-content">
			<?php
				/* translators: %s: Name of current post */
				the_content( sprintf(
					__( 'Continue reading %s', 'twentyfifteen' ),
					the_title( '<span class="screen-reader-text">', '</span>', false )
				) );

				/* List articles */
				$articles = maybe_unserialize(post_custom('issue_articles'));
				if (!empty($articles) && is_array($articles)) {
					if (!empty(trim(get_the_content()))) {
						?>
						<h2><?= __('Articles', 'fifteen-issues') ?></h2>
						<?php
					}
					?>
					<ul class="issue-articles">
					<?php
					$in_group = false;
					foreach ($articles as $article) {
						if (empty($article['title'])) {
							continue;
						}

						if (empty($article['group_title'])) {
							?>
							<li>
								<?php
								if (!empty($article['author'])) {
									?>
									<b><?= $article['author'] ?>.</b><br />
									<?php
								}
								if (empty($article['url'])) {
									echo $article['title'];
								} else {
									?>
									<a class="issue-download issue-download-article" href="<?= $article['url'] ?>"><?= $article['title'] ?></a>
									<?php
								}
								?>
							</li>
							<?php
						} else {
							if ($in_group) {
								?>
								</ul></li><li>
								<?php
							} else {
								?>
								<li>
								<?php
								$in_group = true;
							}
							?>
							<b>
								<?php
								if (empty($article['url'])) {
									echo $article['title'];
								} else {
									?>
									<a class="issue-download issue-download-group" href="<?= $article['url'] ?>"><?= $article['title'] ?></a>
									<?php
								}
								?>
							</b>
							<ul>
							<?php
						}
						?>
						<?php
					}
					if ($in_group) {
						?>
						</ul>
						</li>
						<?php
					}
					?>
					</ul>
					<?php
				}

				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfifteen' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) );

				$url = post_custom('issue_pdf');
				if ($url) :
					?>
					<p class="issue-download-para">
						<a href="<?= $url ?>" class="issue-download issue-download-complete"><?= __( 'Download complete issue', 'fifteen-issues' ) ?></a>
					</p>
					<?php
				endif;
			?>
		</div><!-- .entry-content -->
		<?php
	endif;

	// Author bio.
	if ( get_the_author_meta( 'description' ) ) :
		get_template_part( 'author-bio' );
	endif;
	?>

	<footer class="entry-footer"><?php twentyfifteen_entry_meta(); ?><?php edit_post_link( __( 'Edit', 'twentyfifteen' ), '<span class="edit-link">', '</span>' ); ?></footer>

</article><!-- #post-## -->