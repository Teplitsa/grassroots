<?php
/**
 * Template Name: Single Campaign Home
 **/

global $post; 

get_header();

$query = new WP_Query(array(
	'post_type' => grt_get_leyka_campaign_pt(),
	'posts_per_page' => 1
));

?>
<div class="content thin">
	<?php while ($query->have_posts()){ $query->the_post(); ?>
	
	<article id="post-<?php the_ID(); ?>" <?php post_class('tpl-single'); ?>>
	
		<?php if ( has_post_thumbnail() ) : ?>
				
			<div class="featured-media">	
				<?php the_post_thumbnail('post-image'); ?>				
			</div> <!-- /featured-media -->
				
		<?php endif; ?>
		
		<div class="content-inner"><div class="container">
	  
			<?php get_template_part( 'partials/content_single', get_post_type() ); ?>
	
		</div></div><!-- /content-inner -->
	
	</article>
	<?php	} //endwhile ?>
	
	<?php do_action('grt_content_bottom');?>
	
</div> <!-- /content -->
		
<?php get_footer(); ?>