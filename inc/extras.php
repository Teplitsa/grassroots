<?php
/**
 * Additional Helpers
 **/

/* Wrapper for links for SSL case */
function grt_protocol($url){
	
	$protocol = (is_ssl()) ? 'https://' : 'http://';
	$url = str_replace(array('https://', 'http://'), '', $url);
	return $protocol.$url;
}
 
 
/** Body class **/
add_filter('body_class', 'grt_body_class');
function grt_body_class($classes) {

    if(wp_is_mobile()) {
        $classes[] = 'wp-is-mobile';
    } else {
        $classes[] = 'wp-is-not-mobile';
    }

    return $classes;
}


/** Custom title function **/
add_filter('wp_title', 'grt_wp_title', 10, 2);
function grt_wp_title($title, $sep) {

	global $paged, $page;

	if(is_feed())
		return $title;

	// Add the site name:
	$title .= get_bloginfo('name');

	// Add the site description for the home/front page:
	$site_description = get_bloginfo('description', 'display');
	if($site_description && (is_home() || is_front_page()))
		$title = "$title &mdash; $site_description";

	// Add a page number if necessary:
	if($paged >= 2 || $page >= 2)
		$title = "$title &mdash; ".sprintf(__('Page %s', 'grt'), max($paged, $page));

	return $title;
}


/** Custom excerpts  **/

// more link 
function grt_continue_reading_link() {
	//$more = __('More', 'grt');
	return '&nbsp;<a href="'. esc_url( get_permalink() ) . '" class="more"><span class="meta-nav">[&nbsp;&rarr;&nbsp;]</span></a>';
}

add_filter('excerpt_more', 'grt_auto_excerpt_more');
function grt_auto_excerpt_more($more) {
	return '&hellip;';
}

add_filter('excerpt_length', 'grt_custom_excerpt_length');
function grt_custom_excerpt_length($l) {
	return 30;
}

add_filter('get_the_excerpt', 'grt_custom_excerpt_more');
function grt_custom_excerpt_more($output) {

	if(is_singular())
		return $output;

	if( !is_search() )
		$output .= grt_continue_reading_link();

	return $output;
}

/** Wrappers of Leyka's PT, to minimize their names' hardcode */
function grt_get_leyka_campaign_pt() {
    return defined('LEYKA_VERSION') ? Leyka_Campaign_Management::$post_type : 'leyka_campaign';
}

function grt_get_leyka_donation_pt() {
    return defined('LEYKA_VERSION') ? Leyka_Donation_Management::$post_type : 'leyka_donation';
}

add_filter('admin_post_thumbnail_html', 'grt_add_thumbnail_message', 10, 2);
function grt_add_thumbnail_message($content, $post_id) {

    if( !$post_id ) {
        return $content;
    }

    return '<div class="grt-thumbnail-message">'
           .__('A thumbnail must be at least 973 px wide to be displayed correctly', 'grt')
           .'</div>'.$content;
}

/**  Next / Prev nav attributes **/
//add_filter('next_posts_link_attributes', 'grt_posts_link_attributes_1');
//add_filter('previous_posts_link_attributes', 'grt_posts_link_attributes_2');

function grt_posts_link_attributes_1() {
    return 'class="archive-nav-older fleft"';
}
function grt_posts_link_attributes_2() {
    return 'class="archive-nav-newer fright"';
}


/** Widgets **/
add_action('widgets_init', 'grt_custom_widgets', 11);
function grt_custom_widgets(){

	//unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Meta');
	//unregister_widget('WP_Widget_Categories');
	//unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_Tag_Cloud');
	unregister_widget('WP_Widget_RSS');
	//unregister_widget('WP_Widget_Search');
	
}


/** Template tags **/
function grt_posted_on() {	

	$cat = get_the_term_list(get_the_ID(), 'category', '<span class="category">', ', ', '</span>');?>

<div class="post-meta">

	<span class="post-date"><?php echo esc_html(get_the_date());?></span>

	<?php if($cat && !is_wp_error($cat)) {?>
		<span class="date-sep"> / </span>
		<?php echo $cat;?>
	<?php }?>
</div>
<?php }

function grt_post_nav() {

	global $post;

	$label_next = __('Next', 'grt');
	$label_prev = __('Previous', 'grt');

	$next_link = get_next_post_link(
		'<div class="nav-next">%link</div>',
		$label_next.'&nbsp;&rarr;'
	);

	$previous_link = get_previous_post_link(
		'<div class="nav-previous">%link</div>',
		'&larr;&nbsp;'.$label_prev
	);

	if('' !== $next_link || '' !== $previous_link) {?>

	<div class="nav-links cf">
	<?php echo $previous_link;
		echo $next_link;?>
	</div>

	<?php }
}

function grt_posts_nav() {
	global $wp_query;
	
	//$query_pt = (isset($wp_query->query_vars['post_type'])) ? $wp_query->query_vars['post_type'] : 'post';
	$label_next = __('Older', 'grt');
	$label_prev = __('Newer', 'grt');	
?>

	<div class="nav-links cf">						
		<div class="nav-previous"><?php echo get_previous_posts_link( '&larr;&nbsp;' . "<span>$label_prev</span>"); ?></div>
		<div class="nav-next"><?php echo get_next_posts_link( "<span>$label_next</span>" . '&nbsp;&rarr;'); ?></div>
	</div>
<?php }



/**
 * Сontent filter for leyka elements on homepage
 **/
function grt_leyka_print_donation_elements($cpost) {	
		
	if(!class_exists('Leyka_Campaign'))
		return $cpost;
	
	$autoprint = leyka_options()->opt('donation_form_mode');
	if(grt_get_leyka_campaign_pt() != $cpost->post_type || !$autoprint )
		return $cpost;
	
	$campaign = new Leyka_Campaign($cpost);	
	if($campaign->ignore_global_template_settings)
		return $cpost;
	
	$content = '';

	// Scale on top of form:	
	if(leyka_options()->opt('scale_widget_place') == 'top' || leyka_options()->opt('scale_widget_place') == 'both')
        $content .= "[leyka_scale show_button='1']";

	$content .= $cpost->post_content;

	// Scale below form:	
	if(!empty($campaign->target) && (leyka_options()->opt('scale_widget_place') == 'bottom' || leyka_options()->opt('scale_widget_place') == 'both'))
        $content .= "[leyka_scale show_button='0']";

	// Payment form:
    $content .= "[leyka_payment_form]";

	// Donations list:
    if(leyka_options()->opt('leyka_donations_history_under_forms')) {

		$list = leyka_get_donors_list($cpost->ID);
		if($list) {

			$label = apply_filters('leyka_donations_list_title', __('Our sincere thanks', 'grt'), $cpost->ID);
			$content .= '<h3 class="leyka-donations-list-title">'.$label.'</h3>'.$list;
		}
    }

	$cpost->post_content = $content;
	
	return $cpost;
}


/**
 * Filter list of items on homepage
 **/
add_action('pre_get_posts', 'grt_homepage_list_correction');
function grt_homepage_list_correction(WP_Query $query){

	if($query->is_main_query() && $query->is_home()){

		if(get_option('show_on_front') != 'posts')
			return;

		if(get_theme_mod('homepage_template') == 'campaigns') {

			$query->set('post_type', grt_get_leyka_campaign_pt());
			add_filter('body_class', 'grt_homepage_list_body_class');
		}
	}	
}

function grt_homepage_list_body_class($classes) {

    $classes[] = 'leyka-campaigns-home';
	return $classes;
}

function grt_leyka_campaign_card_thumbnail_size($size){

	return 'post-thumb'; // may be in all case - not only on homepage
}


/**
 * Favicon
 **/
function grt_favicon(){

	$favicon = get_theme_mod('favicon');
    if( !$favicon )
        $favicon = '/favicon.ico';?>
    <link rel="shortcut icon" type="<?php echo stristr($favicon, 'ico') ? 'image/x-icon' : 'image/png';?>" href="<?php echo $favicon;?>" />
<?php
}
add_action('wp_enqueue_scripts', 'grt_favicon', 1);
add_action('admin_enqueue_scripts', 'grt_favicon', 1);
add_action('login_enqueue_scripts', 'grt_favicon', 1);


/**
 * Logo
 **/
if(!function_exists('grt_logo')):
function grt_logo() {
	
	if(get_theme_mod('logo')) { ?>

<a class="blog-logo" href='<?php echo esc_url(home_url('/'));?>' title='<?php echo esc_attr(get_bloginfo('title'));?> &mdash; <?php echo esc_attr(get_bloginfo('description'));?>' rel='home'>
	<img src='<?php echo esc_url(get_theme_mod('logo'));?>' alt='<?php echo esc_attr(get_bloginfo('title'));?>' />
</a>

<?php } elseif(get_bloginfo('description') || get_bloginfo('title')) {?>

<h1 class="blog-title">
	<a href="<?php echo esc_url(home_url());?>" title="<?php echo esc_attr(get_bloginfo('title'));?> &mdash; <?php echo esc_attr(get_bloginfo('description'));?>" rel="home"><?php echo esc_attr(get_bloginfo('title'));?></a>
</h1>

<?php }	
	
}
endif;


?>
