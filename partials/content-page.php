<?php
/**
 * General page
 **/

?>	
<div class="post-inner">
	
	<header class="post-header">
										
		<h2 class="post-title"><?php the_title(); ?></h2>
												
	</header> <!-- /post-header -->
		
	<div class="post-content cf">
	
		<?php the_content(); ?>		
		
	</div> <!-- /post-content -->			   
	
	<div class="post-meta-bottom cf">
		
		<?php //@to_do: add sharing somewhere
			$args = array(
				'before'           => '<p class="page-links"><span class="title">' . __( 'Pages:','grt' ) . '</span>',
				'after'            => '</p>',
				'link_before'      => '<span>',
				'link_after'       => '</span>',
				'separator'        => '',
				'pagelink'         => '%',
				'echo'             => 1
			);
		
			wp_link_pages($args); 
		?>		
	</div> <!-- /post-meta-bottom -->

</div> <!-- /post-inner -->	
	

