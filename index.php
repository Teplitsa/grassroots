<?php
/**
 * General template
 * 
 **/

global $wp_query;

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

get_header();
?>
<div class="content thin">
	<?php if(is_archive() || 1 < (int)$paged) { ?>
		
		<header class="archive-header cf">	
			<?php get_template_part( 'partials/header', 'archive'); ?>				
		</header> <!-- /page-title -->	
		
	<?php } ?>
		
	<div class="content-inner"><div class="container">	
		
	<?php if (have_posts()) { ?>	
		<div class="posts-loop" id="posts">				
	    	<?php
				while (have_posts()) {
					the_post(); 
					get_template_part( 'partials/content', get_post_type() ); 
				}
			?>
		</div> <!-- /posts -->
	<?php } ?>
	
	</div></div><!-- /content-inner -->
	
	
	<?php if ( $wp_query->max_num_pages > 1 ) { ?>
		
		<nav class="navigation archive-navigation">			
			
			<?php grt_posts_nav(); ?>			
			
		</nav> <!-- /archive-nav -->

	<?php } ?>

	<?php do_action('grt_content_bottom');?>
	
</div> <!-- /content -->

<?php get_footer(); ?>