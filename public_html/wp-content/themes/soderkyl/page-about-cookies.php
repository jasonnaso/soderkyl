<?php

	/*
	Template name: Om cookies
	*/	
	
	get_header();

	$about_cookies_title 	= get_field('about_cookies_title');
	$about_cookies_text 	= get_field('about_cookies_text');

?>

<main class="about-cookies-page">
	<section class="about-cookies-list section-padding">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h2 class="section-title"><?= $about_cookies_title; ?></h2>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 offset-sm-3">
					<?= $about_cookies_text; ?>
				</div>
			</div>
		</div>
	</section>
</main>

<?php 
	get_footer(); 
?>