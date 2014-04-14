<?php
/**
 * The sidebar containing the front page widget areas.
 * If there are no active widgets, the sidebar will be hidden completely.
 *
 * @package Storyline
 * @since Storyline 1.0
 */
?>
	<div class="fornt-widget-area">
		<div class="widget-1">
			<?php dynamic_sidebar('sidebar-homepage1');
			?>
		</div>
		</div>
		<div class="fornt-widget-area">
			<div class="widget-2">
				<?php dynamic_sidebar('sidebar-homepage2');
				?>
			</div>
		</div>
		<div class="fornt-widget-area">
			<div class="widget-3">
				<?php dynamic_sidebar('sidebar-homepage3');
				?>
			</div>
		</div>
