<?php
/*
Template Name: Homepage
*/

get_header(); ?>

	<div id="primary">
		<div id="content" role="main">

			<div class="home-top">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php if ( has_post_thumbnail() ) { ?>
						<div class="entry-page-image">
							<?php the_post_thumbnail(); ?>
						</div>
					<?php } ?>
					<section class="home-content<?php echo ( has_post_thumbnail() ) ? ' thumbnail' : ''; ?>">
						<div class="entry-content">
							<header class="entry-header">
								<h1 class="entry-title"><?php the_title(); ?></h1>
							</header><!-- .entry-header -->
							<?php the_content(); ?>
						</div><!-- .entry-content -->
					</section>
				<?php endwhile; // end of the loop. ?>
			</div>

			<div class="home-middle">
				<div class="about">
					<h1>Meet the team</h1>
					<img src="http://wordpress.local/wp-content/uploads/2012/03/fall-tree.jpg" width="85" height="85" />
					<p>One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly.  I should be incapable of drawing a single stroke. His many legs, pitifully thin compared with the size of the rest of him.</p>
				</div>
				<div class="latest-news">
					<h1>Latest news</h1>
					<ul>
						<li><a href="#">Solace of a lonely highway</a> <time datetime="2012-05-08">May 8th, 2012</time></li>
						<li><a href="#">Write with a purpose</a> <time datetime="2012-05-08">April 16th, 2012</time></li>
						<li><a href="#">Tree on a lake</a> <time datetime="2012-05-08">April 4th, 2012</time></li>
						<li><a href="#">Don’t stop questioning</a> <time datetime="2012-05-08">March 23rd, 2012</time></li>
						<li><a href="#">Write with a purpose</a> <time datetime="2012-05-08">March 20th, 2012</time></li>
					</ul>
				</div>
			</div>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar( 'home' ); ?>
<?php get_footer(); ?>