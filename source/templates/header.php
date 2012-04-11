<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?> <?php bloginfo( 'name' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!-- Grid loader FOR LOCAL DEV ONLY
     Files are located in /includes/headsupgrid
-->
<link href="<?php bloginfo( 'stylesheet_directory' ); ?>/includes/headsupgrid/hugrid.css" type="text/css" rel="stylesheet" />
<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/includes/headsupgrid/jquery-1.6.2.min.js"></script>
<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/includes/headsupgrid/hugrid.js"></script>
<script type="text/javascript">
		$(document).ready(function() {
				pageUnits = 'px';
				colUnits = 'px';
				pagewidth = 960;
				columns = 8;
				columnwidth = 85;
				gutterwidth = 40;
				pagetopmargin = 0;
				rowheight = 24;
				gridonload = 'off';
				makehugrid();
				setgridonload();
		});
</script>
<!-- End grid loader
-->

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/javascripts/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
	wp_enqueue_script( 'comment-reply' );

wp_enqueue_style( 'fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700' );

wp_enqueue_style( 'twentytwelve-style', get_stylesheet_uri() );
?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed">
	<header id="masthead" class="site-header" role="banner">
		<hgroup>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</hgroup>

		<nav class="site-navigation main-navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Show navigation', 'twentytwelve' ); ?></h3>
			<div class="skip-link assistive-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a></div>
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav>

		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
	</header><!-- #masthead -->

	<div id="main">