<?php
/**
 * The default template for displaying content on indexed pages (home, archive, search)
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

			<?php if ( 'post' == get_post_type() ) : // Hide entry meta for pages ?>
			<div class="entry-meta">
				by Drew Strojny
			</div><!-- .entry-meta -->
			<?php endif; ?>
			<?php if ( comments_open() ) : ?>
			<?php endif; // End if comments_open() ?>
		</header><!-- .entry-header -->

		<?php if ( is_search() ) : // Only display excerpts for search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
			<!--<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>-->
		</div><!-- .entry-content -->
		<?php endif; ?>

		<footer class="entry-meta">
			<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'twentytwelve' ) );
				if ( $categories_list ) :
			?>
			<div class="category-and-date">
				<?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'twentytwelve' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list ); ?> on <?php the_date(); ?>
			</div>
			<?php endif; // End if categories ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'twentytwelve' ) );
				if ( $tags_list ) : ?>
			<div class="tag-links">
				<?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'twentytwelve' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
			</div>
			<?php endif; // End if $tags_list ?>
			<?php endif; // End if 'post' == get_post_type() ?>
			<div class="comments-link">
			<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'twentytwelve' ) . '</span>', __( '1 Reply', 'twentytwelve' ), __( '% Replies', 'twentytwelve' ) ); ?>
			</div>
		</footer><!-- #entry-meta -->
	</article><!-- #post -->
