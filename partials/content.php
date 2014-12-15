<?php
/**
 * Post content
 **/

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('archived'); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		
		<a class="featured-media" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">	
			
			<?php the_post_thumbnail('post-thumb'); ?>
			
		</a> <!-- /featured-media -->
			
	<?php endif; ?>
		

	<div class="post-inner cf">
		
	
		<div class="post-header">
			<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
							
			<!-- posted on -->
			<?php  grt_posted_on(); ?>
			
		</div> <!-- /post-header -->
		
																						
		<div class="post-excerpt">
			
			<?php the_excerpt(); ?>
			
		</div>
	
	</div>

</article>