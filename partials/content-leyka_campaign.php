<?php
/**
 * Single campaign template
 **/

add_filter('leyka_campaign_card_thumbnail_size', 'grt_leyka_campaign_card_thumbnail_size');
?>
<div id="<?php echo esc_attr('leyka_campaign_card_standalone-').get_the_ID();?>" class="leyka-campaign-item">
	
<?php	
	if(function_exists('leyka_get_campaign_card')) {		
		echo leyka_get_campaign_card();
	}
	else { //fallback ?>
	
	<div class="leyka-campaign-card<?php echo (has_post_thumbnail()) ? ' has-thumb' : '';?>">	
		<?php if(has_post_thumbnail()) { ?>
			<div class="lk-thumbnail"><a href="<?php the_permalink(); ?>">				
				<?php the_post_thumbnail('post-thumbnail'); ?>			
			</a></div>		
		<?php } ?>
		
		<div class="lk-info">
			<h4 class="lk-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			<?php the_excerpt(); ?>	
		</div>
		
	</div>
<?php } ?>
</div> <!-- /leyka-campaign-item -->

<?php remove_filter('leyka_campaign_card_thumbnail_size', 'grt_leyka_campaign_card_thumbnail_size');?>
