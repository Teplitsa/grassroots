<?php
/**
 * Search Template
 *  
 **/

global $wp_query, $post;

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

get_header();
?>
<div class="content thin">
	
	<header class="archive-header cf">	
		<h4><?php _e('Search results', 'grt') ?>				
	</header> <!-- /page-title -->	
		
	
		
	<div class="content-inner"><div class="container">	
		
	<?php if (have_posts()) { ?>	
		<div class="posts-loop" id="posts">				
	    	<?php
				while (have_posts()) {
					the_post();
				
				$permalink = get_permalink(get_the_ID());
				$meta = apply_filters('grt_search_item_meta', '', $post);
				if(!empty($meta))
					$meta = ' | '.$meta;	
			?>
			<article class="search-item <?php echo esc_attr(get_post_type());?>">
				<h4 class="item-title">
					<a href="<?php echo $permalink;?>" rel="bookmark"><?php the_title();?></a>
					<?php echo $meta; ?>
				</h4>
				<cite><?php echo $permalink;?></cite>
				<div class="item-summary"><?php the_excerpt();?></div>
			</article>
			<?php } ?>
		</div> <!-- /posts -->
	<?php } else { ?>
		<div class="not-found"><?php _e('Unfortunately, nothing found', 'grt');?></div>
	<?php } ?>
	
	</div></div><!-- /content-inner -->
	
	
	<?php if ( $wp_query->max_num_pages > 1 ) { ?>
		
		<nav class="navigation archive-navigation">			
			
			<?php grt_posts_nav(); ?>			
			
		</nav> <!-- /archive-nav -->

	<?php } ?>

	
</div> <!-- /content -->

<?php get_footer(); ?>