<?php
/**
 * General Page template
 **/

get_header();
?>
<div class="content thin">
	<?php while (have_posts()){ the_post(); ?>
	
	<article id="post-<?php the_ID(); ?>" <?php post_class('tpl-page'); ?>>
	
		<?php if ( has_post_thumbnail() ) : ?>
				
			<div class="featured-media">	
				<?php the_post_thumbnail('post-image'); ?>				
			</div> <!-- /featured-media -->
				
		<?php endif; ?>
		
		<div class="content-inner"><div class="container">
	  
			<?php get_template_part( 'partials/content', 'page'); ?>
	
		</div></div><!-- /content-inner -->
	
	</article>
	<?php	} //endwhile ?>	
	
	<?php do_action('grt_content_bottom');?>
	
</div> <!-- /content -->
		
<?php get_footer(); ?>