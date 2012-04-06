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
?><!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes( 'html' ); ?>>  <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes( 'html' ); ?>>         <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes( 'html' ); ?>>                <![endif]-->
<!--[if gt IE 8]> <!--> <html class="no-js" <?php language_attributes( 'html' ); ?>>                 <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1">
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
			<h3 class="assistive-text"><?php _e( 'Menu', 'twentytwelve' ); ?></h3>
			<div class="skip-link assistive-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a></div>
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav>

		<?php twentytwelve_get_header_image(); ?>

	</header><!-- #masthead -->

	<div id="main">
