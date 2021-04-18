<?php

	$logo 		  		= get_field('logo', 'options');
	$logo_electrolux	= get_field('logo_electrolux', 'options');
	$logo_electrolux_excellence	= get_field('logo_electrolux_excellence', 'options');
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<?php wp_head(); ?>
		<!-- META -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<!-- CSS -->
		<link rel="stylesheet" id="font-awesome-css" href="https://cdn.jsdelivr.net/fontawesome/4.7.0/css/font-awesome.min.css?ver=5.0.1" type="text/css" media="all">
		<?php wp_head() ?>
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-MJFWSKD');</script>
		<!-- End Google Tag Manager -->
	</head>
	<body <?php body_class(); ?>>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MJFWSKD" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<header>
		<nav class="navbar navbar-expand-lg navbar-light soderkyl-nav fixed-top">
			<div class="navbar-white">
				<div class="container">
					<div class="row justify-content-center align-items-center">
						<div class="col">
							<a class="navbar-brand" href="/">
					        	<img src="<?php echo $logo['url']; ?>" class="soderkyl-header-logo" alt="<?php echo $logo['alt']; ?>">
					        </a>
						</div>
						<div class="col-auto logo-electrolux">
							<img src="<?php echo $logo_electrolux_excellence['url']; ?>" class="header-logo" alt="<?php echo $logo_electrolux_excellence['alt']; ?>">
							<img src="<?php echo $logo_electrolux['url']; ?>" class="header-logo" alt="<?php echo $logo_electrolux['alt']; ?>">
						</div>
						<div class="col-auto">
					        <form role="search" method="get" id="searchform" class="searchform" action="/">
						        <div class="input-group d-none d-lg-flex">
						        	<input type="text" class="form-control py-2 screen-reader-text" placeholder="Sök produkter" id="s" name="s">
						            <span class="input-group-append">
						                <button type="submit" class="btn btn-outline-secondary">
						                    <i class="fa fa-search"></i>
						                </button>
						            </span>
						        </div>
							</form>
					        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					            <span class="navbar-toggler-icon">
					            	<i class="fas fa-bars"></i>
					            </span>
					        </button>
						</div>
					</div> 
				</div>
			</div>
			<div class="navbar-blue">
				<div class="container">
		            <div class="collapse navbar-collapse" id="navbarSupportedContent">
		            	<div class="input-group d-lg-none">
		            		<input class="form-control py-2 mt-2 mb-2" type="search" value="Sök produkter" id="example-search-input">
		            	    <span class="input-group-append mt-2 mb-2">
		            	        <button class="btn btn-outline-secondary" type="button">
		            	            <i class="fa fa-search"></i>
		            	        </button>
		            	    </span>
		            	</div>
		               <?php wp_nav_menu(array(
		    			    'container'       => 0,
		    			    'menu_id'         => false,
		    			    'menu_class'      => 'navbar-nav',
		    			    'depth'           => 3,
                            'fallback_cb'     => '__return_false',
                            'walker'          => new Bootstrap_NavWalker()
		               	)); ?>
		            </div>
				</div>
			</div>
		</nav>
	</header>
