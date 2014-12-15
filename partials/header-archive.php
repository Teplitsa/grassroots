<?php
/**
 * Headings for archive pages
 **/

global $wp_query;

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

function grt_paging_marker($paged){
	global $wp_query;
	
	if((int)$paged > 1){
		echo " <span class='paging-marker'>";
		printf( __('Page %s of %s', 'grt'), $paged, $wp_query->max_num_pages );
		echo "</span>";
	}
}

?>
<h4>
<?php
	if(is_category()){		
		single_cat_title();
		grt_paging_marker($paged);
	}
	elseif(is_tag()){
		single_tag_title(__('Tag: ', 'grt'));
		grt_paging_marker($paged);
		
	}
	elseif(is_home() && (int)$paged > 1) {
		printf( __('Page %s of %s', 'grt'), $paged, $wp_query->max_num_pages );
		
	}

?>
</h4>