<!DOCTYPE html>
<!--[if lte IE 9]><html class="no-js IE9 IE" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head profile="http://gmpg.org/xfn/11">

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<?php wp_head(); ?>
</head>
	
<body id="top" <?php body_class(); ?>>
<div class="site">
	
	<nav id="primary-menu-mobile">
		<ul class="main-menu-mobile">				
			<?php if ( has_nav_menu( 'primary' ) ) {
																
				wp_nav_menu( array( 
				
					'container' => '', 
					'items_wrap' => '%3$s',
					'theme_location' => 'primary'
												
				) ); } else {
			
				wp_list_pages( array(
				
					'container' => '',
					'title_li' => ''
				
				));
				
			} ?>
			
		 </ul>
	</nav>

	<div class="sidebar">
		<?php $menu_label = apply_filters('grt_menu_label', __('Menu', 'grt')); ?>
		<span id="menu-trigger" class="menu-toggle" title=""><i class="dashicons dashicons-menu"></i> <?php echo esc_html($menu_label); ?></span>
			
		<div class="site-branding"><?php grt_logo();?></div>
		
		<ul class="main-menu">
			
			<?php if ( has_nav_menu( 'primary' ) ) {
																
				wp_nav_menu( array( 
				
					'container' => '', 
					'items_wrap' => '%3$s',
					'theme_location' => 'primary'
												
				) ); } else {
			
				wp_list_pages( array(
				
					'container' => '',
					'title_li' => ''
				
				));
				
			} ?>			
		 </ul>
				 
		 <div class="widgets">
		 
			<?php dynamic_sidebar('sidebar'); ?>
		 
		 </div>
		 
		<div class="credits">

			<p>
                <a href="<?php echo esc_url(home_url('/'));?>"><?php bloginfo('name'); ?></a>. <?php printf(__('All materials are avaliable under liscence %s', 'grt'), '<a href="http://creativecommons.org/licenses/by-sa/3.0/" target="_blank">Creative Commons СС-BY-SA 3.0</a>');?>
            </p>

			<!-- Teplitsa theme branding -->
			
			<p id="theme-brand" style="<?php echo get_theme_mod('hide_theme_brand') ? 'display:none;' : '';?>"><?php printf(
                __('Powered by %s for&nbsp;%s', 'grt'),
                '<a href="http://leyka.te-st.ru/" target="_blank">Grassroots&nbsp;Theme</a>',
                '<a href="http://leyka.te-st.ru/" target="_blank">WordPress</a>');?>
            </p>
		</div>
		
		<div class="clear"></div>
						
	</div> <!-- /sidebar -->

	<div class="wrapper" id="wrapper">