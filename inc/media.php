<?php
/**
 * Media fucntions
 **/

 
// Remove inline styling of attachment 
add_shortcode('wp_caption', 'grt_fixed_img_caption_shortcode');
add_shortcode('caption', 'grt_fixed_img_caption_shortcode');
function grt_fixed_img_caption_shortcode($attr, $content = null) {
	if ( ! isset( $attr['caption'] ) ) {
		if ( preg_match( '#((?:<a [^>]+>\s*)?<img [^>]+>(?:\s*</a>)?)(.*)#is', $content, $matches ) ) {
			$content = $matches[1];
			$attr['caption'] = trim( $matches[2] );
		}
	}
	
	$output = apply_filters('img_caption_shortcode', '', $attr, $content);
	
	if ( $output != '' ) return $output;
	extract(shortcode_atts(array(
		'id' => '',
		'align' => 'alignnone',
		'width' => '',
		'caption' => ''
	), $attr));
	
	if ( 1 > (int) $width || empty($caption) )
	return $content;
	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';
	return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" >' 
	. do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}

// Custom image size for medialib
add_filter('image_size_names_choose', 'grt_medialib_custom_image_sizes');
function grt_medialib_custom_image_sizes($sizes) {
	
	$addsizes = apply_filters('grt_medialib_custom_image_sizes', array(
		"post-thumb" => __("Column-width", "grt")
	));	
	
	return array_merge($sizes, $addsizes);
}


/**
 * Lightbox for linked images
 **/
add_filter('media_send_to_editor', 'grt_media_send_to_editor_filter', 2, 3);
function grt_media_send_to_editor_filter($html, $id, $attachment) {
		
	$post = get_post($id);		
	//var_dump($attachment); 
	
	if (false !== strpos($post->post_mime_type, 'image')) { //image shortcode
		$gallery_ref = 'gallery-'.$post->ID;
		
		if(false !== strpos($html, '<a') && (strpos($attachment['url'], '.jpg') || strpos($attachment['url'], '.png'))){
			
			$html = str_replace('<a ', "<a data-imagelightbox='{$gallery_ref}' ", $html);
		}
	}
		
	return $html;
}



/**
 * Gallery templates
 **/

// Register shortcode
add_action('init', 'grt_gallery_shortcodes', 1);
function grt_gallery_shortcodes() {

    remove_shortcode('gallery');
    add_shortcode('gallery', 'grt_gallery_screen');
}

// Shortcode callback
function grt_gallery_screen($atts) {

    extract(shortcode_atts(array('ids' => '', 'columns' => 3), $atts));

    /** @var $ids From extract */
    /** @var $columns From extract */

    $out = '';
    if(empty($ids))
        return $out; // No items in gallery

    $args = array(
        'post_type'   => 'attachment',
        'post_status' => 'inherit',
        'orderby'     => 'post__in',
        'order'       => 'ASC',
        'post_mime_type' => 'image',
        'post__in'     => explode(',', $ids),
        'posts_per_page' => -1
    );

    $query = new WP_Query($args);
    if(empty($query->posts))
        return $out; // No attachments

    return grt_gallery_output($query->posts, $columns);
}

//  Gallery markup 
function grt_gallery_output($items, $columns) {

    $columns = (int)$columns;

    if($columns == 0 || $columns > 8) 
        $columns = 5;
    

    $out = "<div class='grt-gallery'><ul class='cf cols-{$columns}'>";
    $gallery_ref = uniqid('gallery-');

    foreach($items as $picture) {
        $size = apply_filters('lpg_thumbnail_size', 'post-thumbnail');
        $img = wp_get_attachment_image($picture->ID, $size, false, array('title' => ''));
        $url = wp_get_attachment_url($picture->ID);
        $title = esc_attr(stripslashes($picture->post_excerpt));

        // HTML for lightbox
        $out .= "<li><a data-imagelightbox='{$gallery_ref}' href='{$url}'>{$img}</a></li>";
    }

    return $out.'</ul></div>';
}




