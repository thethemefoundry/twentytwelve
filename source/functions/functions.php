<?php
/**
 * Twenty Twelve functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, twentytwelve_setup(), sets up the theme by registering support
 * for various features in WordPress, such as a custom background and a navigation menu.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 584;

/**
 * Tell WordPress to run twentytwelve_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'twentytwelve_setup' );

if ( ! function_exists( 'twentytwelve_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links, custom headers
 * 	and backgrounds, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_setup() {
	global $Twenty_Twelve_Options, $twentytwelve_options;

	/**
	 * Make Twenty Twelve available for translation.
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Twelve, use a find and replace
	 * to change 'twentytwelve' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentytwelve', get_template_directory() . '/languages' );

	// Load up our theme options page and related code.
	require( get_template_directory() . '/includes/theme-options.php' );
	$twentytwelve_options = new Twenty_Twelve_Options();

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// Add support for a variety of post formats
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'twentytwelve' ) );

	// Add support for custom background.
	add_theme_support( 'custom-background' );

	// Add support for a custom header image.
	add_theme_support( 'custom-header', array(
		// The default header text color.
		'default-text-color' => '444',
		// Random image rotation by default.
		'random-default' => true,
		// Support flexible height and width.
		'flex-height' => true,
		'flex-width' => true,
		// Set suggested height and width, with a maximum value for the width.
		'suggested-height' => apply_filters( 'twentytwelve_header_image_height', 250 ),
		'suggested-width' => apply_filters( 'twentytwelve_header_image_width', 960 ),
		'max-width' => apply_filters( 'twentytwelve_header_image_max_width', 2000 ),
		// Callback for styling the header.
		'wp-head-callback' => 'twentytwelve_header_style',
		// Callback for styling the header preview in the admin.
		'admin-head-callback' => 'twentytwelve_admin_header_style',
		// Callback used to display the header preview in the admin.
		'admin-preview-callback' => 'twentytwelve_admin_header_image',
	) );

	// Add custom image size for featured image use, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
}
endif;

if ( ! function_exists( 'twentytwelve_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * get_header_textcolor() options: 444 is default, hide text (returns 'blank'), or any hex value
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_header_style() {
	$text_color = get_header_textcolor();
	// If no custom options for text are set, let's bail
	if ( $text_color == get_theme_support( 'custom-header', 'default-text-color' ) )
		return;
	// If we get this far, we have custom styles.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text, use that.
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo $text_color; ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;

if ( ! function_exists( 'twentytwelve_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in twentytwelve_setup().
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg h1,
	#headimg h2 {
		line-height: 1.6;
		margin: 0;
		padding: 0;
	}
	#headimg h1 {
		font-size: 30px;
	}
	#headimg h1 a {
		text-decoration: none;
	}
	#headimg h2 {
		font: normal 13px/1.8 "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", sans-serif;
		margin-bottom: 24px;
	}
	#headimg img {
	}
	</style>
<?php
}
endif;

if ( ! function_exists( 'twentytwelve_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in twentytwelve_setup().
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_admin_header_image() {
	?>
	<div id="headimg">
		<?php
		if ( ! display_header_text() )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_header_textcolor() . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<h2 id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></h2>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
endif;

/**
 * Enqueue scripts for front-end.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_scripts() {
	wp_enqueue_script( 'navigation', get_template_directory_uri() . '/javascripts/theme.js', array( 'jquery' ), '20130320', true );
}
add_action( 'wp_enqueue_scripts', 'twentytwelve_scripts' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentytwelve_page_menu_args' );

/**
 * Register our single widget area.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'twentytwelve' ),
		'id' => 'sidebar-1',
		'description' => __( 'Appears on posts and pages except the optional Homepage template, which uses its own set of widgets', 'twentytwelve' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Homepage Widgets', 'twentytwelve' ),
		'id' => 'sidebar-home',
		'description' => __( 'Appears when using the optional homepage template with a page set as Static Front Page', 'twentytwelve' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'twentytwelve_widgets_init' );

if ( ! function_exists( 'twentytwelve_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
			<div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentytwelve' ) ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
}
endif;

if ( ! function_exists( 'twentytwelve_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentytwelve_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'twentytwelve' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );

					printf( '<cite class="fn">%s</cite>', get_comment_author_link() );
					printf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'twentytwelve' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header>

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentytwelve' ); ?></p>
			<?php endif; ?>

			<section class="comment post-content">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'twentytwelve' ), '<p class="edit-link">', '</p>' ); ?>
			</section>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'twentytwelve' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

if ( ! function_exists( 'twentytwelve_posted_on' ) ) :
/**
 * Prints HTML with information for the current post author and published date/time.
 *
 * Create your own twentytwelve_posted_on() to override in a child theme.
 *
 * @uses twentytwelve_posted_by()
 * @since Twenty Twelve 1.0
 */
function twentytwelve_posted_on( $return = false ) {
	$out = sprintf( __( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>%5$s', 'twentytwelve' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		twentytwelve_posted_by( true )
	);

	if ( $return )
		return $out;

	echo $out;
}
endif;

if ( ! function_exists( 'twentytwelve_posted_by' ) ) :
/**
 * Prints HTML with meta information for the current post author.
 *
 * Create your own twentytwelve_posted_by() to override in a child theme.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_posted_by( $return = false ) {
	$out = sprintf( __( '<span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span></span>', 'twentytwelve' ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'twentytwelve' ), get_the_author() ) ),
		get_the_author()
	);

	if ( $return )
		return $out;

	echo $out;
}
endif;

if ( ! function_exists( 'twentytwelve_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentytwelve_entry_meta() to override in a child theme.
 *
 * @uses twentytwelve_posted_on()
 * @since Twenty Twelve 1.0
 */
function twentytwelve_entry_meta() {
	/* translators: used between list items, there is a space after the comma */
	$categories_list = get_the_category_list( __( ', ', 'twentytwelve' ) );

	/* translators: used between list items, there is a space after the comma */
	$tag_list = get_the_tag_list( '', __( ', ', 'twentytwelve' ) );

	if ( '' != $tag_list ) {
		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s.', 'twentytwelve' );
	} elseif ( '' != $categories_list ) {
		$utility_text = __( 'This entry was posted in %1$s on %3$s.', 'twentytwelve' );
	} else {
		$utility_text = __( 'This entry was posted on %3$s.', 'twentytwelve' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		twentytwelve_posted_on( true )
	);
}
endif;

/**
 * Extends the default WordPress body class to denote a full-width layout.
 *
 * Used in two cases: no active widgets in sidebar, and full-width page template.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_body_class( $classes ) {
	if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'full-width' ) )
		$classes[] = 'full-width';

	return $classes;
}
add_filter( 'body_class', 'twentytwelve_body_class' );