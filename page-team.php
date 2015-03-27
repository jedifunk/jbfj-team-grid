<?php
/**
 * Template Name: Team
 */

get_header(); ?>

		<div id="primary" class="content-area grid_16 suffix_1">
			<div id="content" class="site-content" role="main">
			
				<?php the_post(); ?>
				
				<?php get_template_part( 'content', 'page' ); ?>
				
				<div class="app-folders-container">
					
					<?php
						$next = 0;
						$args = array(
							'post_type' => 'team_member',
							'order' => 'ASC',
							'posts_per_page' => -1
						);
						$loop1 = new WP_Query($args);
						while ( $loop1->have_posts() ) : $loop1->the_post();
						$open = !($next%3) ? '<div class="jaf-row jaf-container">' : '';
						$close = !($next%3) && $next ? '</div><!-- .jaf-row .jaf-container -->' : '';
						echo $close.$open;
						$img = wp_get_attachment_image_src( get_post_thumbnail_id($loop1->post->ID), 'team-grid' );
					?>
						<div class="folder" id="post<?php the_ID(); ?>">
							<?php if(has_post_thumbnail() ) : ?>
								<img src="<?php echo $img[0] ?>" />
							<?php else : ?>
								<img src="http://rickbarnett.com/wp-content/plugins/team-grid/lib/img/no-pic.jpg" />
							<?php endif; ?>						
							<h5><?php the_title(); ?></h5>
							
						</div><!-- .folder -->
						
					<?php $next++; endwhile; wp_reset_postdata(); ?>
					<?php echo $next ? '</div>' : ''; ?>
						
					
					<?php
						$args2 = array(
							'post_type' => 'team_member',
							'order' => 'ASC',
							'posts_per_page' => -1
						);
						$loop2 = new WP_Query($args2);
						while ( $loop2->have_posts() ) : $loop2->the_post();
					?>
					
					<div class="folderContent post<?php the_ID(); ?>">
						<div class="jaf-container">
							<?php the_content(); ?>
						</div>
					</div><!-- .folderContent -->
					<?php endwhile; wp_reset_postdata(); ?>
				</div><!-- .app-folders-container -->

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<script>
jQuery(document).ready(function($) {
	$(function() {
		$('.app-folders-container').appFolders({
			opacity: .2,
			animationSpeed: 200
		});
	});
});
</script>

<?php get_sidebar(); ?>
<?php get_footer(); ?>