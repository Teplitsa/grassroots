<?php
/**
 * Error 404
 **/

get_header(); ?>

<div class="content thin">
	
	<article class="error-404">		
		<div class="content-inner"><div class="container">  
			
			
			<div class="post-inner">
	
				<header class="post-header">
					<h2 class="post-title"><?php _e('Error 404','grt'); ?><span> / <?php _e('Page not found','grt'); ?></span></h2>					
				</header> <!-- /post-header -->
					
				<div class="post-content cf">
				
					<p><?php _e("It seems like you have tried to open a page that doesn't exist. It could have been deleted, moved, or it never existed at all. You are welcome to search for what you are looking for with the form below.", 'grt') ?></p>
            
					<?php get_search_form(); ?>
					
				</div> <!-- /post-content -->			   	
				
			
			</div> <!-- /post-inner -->	
			
	
		</div></div><!-- /content-inner -->	
	</article>
	
	<?php do_action('grt_content_bottom');?>
	
</div> <!-- /content -->
		
<?php get_footer(); ?>
