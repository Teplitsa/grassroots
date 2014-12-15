<?php
/**
 * Single Campaign
 **/

?>	
<div class="post-inner">
	
	<header class="post-header">
										
		<h2 class="post-title"><?php the_title(); ?></h2>
												
	</header> <!-- /post-header -->
		
	<div class="post-content cf">
	
		<?php
			global $post;
			
			if(is_front_page()){
				$post = grt_leyka_print_donation_elements($post);
				echo apply_filters('the_content', $post->post_content);
			}
			else {
				the_content();
			}
			
		?>
		
	</div> <!-- /post-content -->			   
	
	<div class="post-meta-bottom cf">
		
		<?php 
			$args = array(
				'before'           => '<div class="clear"></div><p class="page-links"><span class="title">' . __( 'Pages:','grt' ) . '</span>',
				'after'            => '</p>',
				'link_before'      => '<span>',
				'link_after'       => '</span>',
				'separator'        => '',
				'pagelink'         => '%',
				'echo'             => 1
			);
			
		?>
	
		<ul>
			<li class="post-date" style="<?php echo get_theme_mod('display_single_campaign_date') ? '' : 'display: none;';?>">
                <?php echo esc_html(get_the_date());?>
            </li>
			<?php if (has_category()) : ?>
				<li class="post-categories"><?php the_category(', '); ?></li>
			<?php endif; ?>
			<?php if (has_tag()) : ?>
				<li class="post-tags"><?php the_tags('', ' '); ?></li>
			<?php endif; ?>						
		</ul>				
		
	</div> <!-- /post-meta-bottom -->

</div> <!-- /post-inner -->	
	

