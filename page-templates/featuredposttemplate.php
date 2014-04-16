<?php
/**
 * Template name: featured post template
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Storyline
 * @since Storyline 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content row" role="main">

		<div class="col grid_8_of_12">
			<div class="featured-widget">
				<div class="featured-widget-1">
					<?php dynamic_sidebar('featured-widget-one');
					?>
				</div>
			</div>
			<?php
            // Display featured posts on front page
            get_template_part('content', 'frontposts');
            ?>
		</div> <!-- /.col.grid_8_of_12 -->
		<?php get_sidebar(); ?>

	</div> <!-- /#primary.site-content.row -->

<?php get_footer(); ?>
