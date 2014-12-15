<?php
/**
 * The template for displaying image attachments
 *
 */

get_header();
?>
<div class="content thin">
	<?php while (have_posts()){ the_post(); ?>
	
	<article id="post-<?php the_ID(); ?>" <?php post_class('tpl-image'); ?>>
		
		<div class="featured-media">
			<?php
				$image_size = apply_filters( 'grt_imagepage_attachment_size', 'full' );
				echo wp_get_attachment_image( get_the_ID(), $image_size );
			?>
		</div>
		
		<div class="content-inner"><div class="container">			
		
			<header class="post-header">
				<?php the_title( '<h2 class="post-title">', '</h2>' ); ?>
			</header><!-- .entry-header -->
			
			<div class="post-content cf">
				<?php if ( has_excerpt() ) : ?>
					<div class="entry-caption">
						<?php the_excerpt(); ?>
					</div><!-- .entry-caption -->
				<?php endif; ?>
				
				
			</div>
	
		</div></div><!-- /content-inner -->
	
	</article>
	<?php	} //endwhile ?>	
	
	<?php do_action('grt_content_bottom');?>
	
</div> <!-- /content -->
		
<?php get_footer(); ?>
