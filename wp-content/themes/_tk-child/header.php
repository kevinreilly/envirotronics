<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package _tk
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/includes/css/bootstrap-magnify.min.css">
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/includes/js/bootstrap-magnify.min.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/includes/js/jquery.mobile.custom.min.js"></script>
	
	<!-- HitsLink.com tracking script -->
	<script type="text/javascript" id="wa_u" defer></script>
	<script type="text/javascript" async>
		//<![CDATA[
		var wa_pageName=location.pathname;    // customize the page name here;
		wa_account="9A9189968D908B8D90919C90"; wa_location=102;
		wa_MultivariateKey = '';    //  Set this variable to perform multivariate testing
		var wa_c=new RegExp('__wa_v=([^;]+)').exec(document.cookie),wa_tz=new Date(),
		wa_rf=document.referrer,wa_sr=location.search,wa_hp='http'+(location.protocol=='https:'?'s':'');
		if(wa_c!=null){wa_c=wa_c[1]}else{wa_c=wa_tz.getTime();
		document.cookie='__wa_v='+wa_c+';path=/;expires=1/1/'+(wa_tz.getUTCFullYear()+2);}wa_img=new Image();
		wa_img.src=wa_hp+'://counter.hitslink.com/statistics.asp?v=1&s=102&eacct='+wa_account+'&an='+
		escape(navigator.appName)+'&sr='+escape(wa_sr)+'&rf='+escape(wa_rf)+'&mvk='+escape(wa_MultivariateKey)+
		'&sl='+escape(navigator.systemLanguage)+'&l='+escape(navigator.language)+
		'&pf='+escape(navigator.platform)+'&pg='+escape(wa_pageName)+'&cd='+screen.colorDepth+'&rs='+escape(screen.width+
		' x '+screen.height)+'&je='+navigator.javaEnabled()+'&c='+wa_c+'&tks='+wa_tz.getTime()
		;document.getElementById('wa_u').src=wa_hp+'://counter.hitslink.com/track.js';
		//]]>
	</script>
</head>

<body <?php body_class(); ?>>
	<?php do_action( 'before' ); ?>

<div class="container">
    <div class="row header">
    	<div class="col-md-12">
			<div class="col-md-5 header-logo">
				<a href="<?php echo get_site_url();?>">
					<img class="img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png" />
				</a>
			</div>
			<div class="col-md-7 header-right">
				<div class="row">
					<div class="col-md-12 mast-nav">
						<div class="row">
							<div class="col-md-9 mini-nav">
							<?php
							$args = array(
							'theme_location'  => '_tk-child',
							'menu'            => 'top',
							'container'       => 'ul',
							'container_class' => '',
							'container_id'    => '',
							'menu_class'      => 'menu',
							'menu_id'         => '',
							'echo'            => true,
							'fallback_cb'     => 'wp_page_menu',
							'before'          => '',
							'after'           => '',
							'link_before'     => '',
							'link_after'      => '',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'depth'           => 0,
							'walker'          => ''
							);

							wp_nav_menu( $args );
							?>
							</div>
							<div class="col-md-3">
								<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
									<input type="text" class="form-control" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="Search" />
									<input class="hidden" type="submit" id="searchsubmit" value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>" />
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-5 global-manuf">Global Manufacturer of Environmental Test Chambers</div>
							<div class="col-md-offset-3 col-md-4 phone">(800) 368-4768</div>
						</div>
					</div>
			   </div>
			</div>
		</div>    
	</div>
</div>

<nav class="site-navigation">
<?php // substitute the class "container-fluid" below if you want a wider content area ?>
	<div class="container navbar-custom">
		<div class="row">
			<div class="site-navigation-inner col-sm-12">
				<div class="navbar navbar-default">
					<div class="navbar-header">
						<!-- .navbar-toggle is used as the toggle for collapsed navbar content -->
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only"><?php _e('Toggle navigation','_tk') ?></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>

					<!-- The WordPress Menu goes here -->
					<?php wp_nav_menu(
						array(
							'theme_location' 	=> 'primary',
							'depth'             => 2,
							'container'         => 'div',
							'container_class'   => 'collapse navbar-collapse',
							'menu_class' 		=> 'nav navbar-nav',
							'fallback_cb' 		=> 'wp_bootstrap_navwalker::fallback',
							'menu_id'			=> 'main-menu',
							'walker' 			=> new wp_bootstrap_navwalker()
						)
					); ?>

				</div>
			</div>
		</div>
	</div><!-- .container -->
</nav><!-- .site-navigation -->
<div class="container">
    <div class="row quotes">
		<div class="col-md-12">
			<div class="col-md-3 in-stock">
				<?php echo '<a href="' . get_site_url() . '/in-stock-chambers-immediate-shipment/" style="color:#333;">'; ?>
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/right-arrow.png">&nbsp;In Stock Ready to Ship
				</a>
			</div>
			<div class="col-md-offset-2 col-md-7 in-stock-quotes">
				<div class="row">
					<?php /*
					<span class="in-stock-element"><a class="a-black" href="<?php echo esc_url( home_url( '/' ) ); ?>contact"><span style="color:#8A9400">&rsaquo;</span>&nbsp;Request a Quote/Service</a></span>
					<span class="in-stock-padding">&nbsp;</span>
					<span class="in-stock-element"><a class="a-black" href="<?php echo esc_url( home_url( '/' ) ); ?>locations"><span style="color:#8A9400">&rsaquo;</span>&nbsp;Find a Local Salesperson</a></span>
					<span class="in-stock-padding">&nbsp;</span>
					<span class="in-stock-element"><a class="a-black" href="<?php echo esc_url( home_url( '/' ) ); ?>locations"><span style="color:#8A9400">&rsaquo;</span>&nbsp;Find a Local Service Technician</a></span>
					*/ ?>
					<span class="in-stock-element"><a class="a-black" href="<?php echo esc_url( home_url( '/' ) ); ?>locations"><span style="color:#8A9400">&rsaquo;</span>&nbsp;Find a Local Salesperson / Service Technician</a></span>
					<span class="in-stock-padding">&nbsp;</span>
					<span class="in-stock-element service-button"><a class="a-black" href="<?php echo esc_url( home_url( '/' ) ); ?>contact"><span style="color:#fff">&rsaquo;</span>&nbsp;Request a Quote / Service</a></span>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="main-content">