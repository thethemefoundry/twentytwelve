<?php
/**
 * The template for displaying a "No posts found" message.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

		<article id="post-0" class="post no-results not-found">
			<header class="entry-header">
			<?php if ( current_user_can( 'edit_posts' ) && is_search() ) : ?>
				<h1 class="entry-title"><?php _e( 'No posts to display', 'twentytwelve' ); ?></h1>
			<?php else : ?>
				<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentytwelve' ); ?></h1>
			<?php endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
			<?php if ( current_user_can( 'edit_posts' ) && is_search() ) : ?>
				<p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'twentytwelve' ), admin_url( 'post-new.php' ) ); ?></p>
			<?php elseif ( is_search() ) : ?>
				<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentytwelve' ); ?></p>
				<?php get_search_form(); ?>
			<?php else : ?>
				<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentytwelve' ); ?></p>
				<?php get_search_form(); ?>
			<?php endif; ?>
			</div><!-- .entry-content -->
		</article><!-- #post-0 -->
