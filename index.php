<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Focalise
 */

get_header();
wp_title();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">


		<?php
		if (have_posts()) :

			if (is_home() && !is_front_page()) :
		?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php
			endif;

			/* Start the Loop */
			while (have_posts()) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the  content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				// get_template_part( 'template-parts/content', get_post_type() );
				// la ligne du dessus est une ligne par défaut du créateur de theme

			?>

				<div class="card" style="width: 18rem;">
					<div class="card-body">
						<h5 class="card-title"><?php the_title() ?></h5>
						<h6 class="card-subtitle mb-2 text-muted"><?php the_category() ?></h6>
						<p class="card-text"><?php the_content('En voir plus') ?></p>
						<a href="<?php the_permalink() ?>" class="card-link"> Voir plus</a>
					</div>
				</div>

			<?php

			endwhile;

			the_posts_navigation();

		else : ?>
			<h1>Pas d'articles</h1>;
		<?php
		endif;
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
