<?php

	/*
	Template name: Hem
	*/
	
	get_header();

	$hero_image			= get_field('hero_image');
	$hero_title			= get_field('hero_title');
	$hero_text			= get_field('hero_text');
	$hero_btns_repeater = get_field('hero_btns_repeater');

	$services_title 	= get_field('services_title'); 
	$puff_repeater		= get_field('puff_repeater');

	$partner_title		= get_field('partner_title');
	$partner_logo 		= get_field('partner_logo');
	$partner_text 		= get_field('partner_text');
	$partner_image 		= get_field('partner_image');

	$testimonials_title		= get_field('testimonials_title');
	$testimonials_repeater 	= get_field('testimonials_repeater'); 

	$reference_title 		= get_field('reference_title');
	$reference_repeater 	= get_field('reference_repeater');

	$about_image 			= get_field('about_image');
	$about_title 			= get_field('about_title');
	$about_text 			= get_field('about_text');
	$about_counter_repeater = get_field('about_counter_repeater');
	$about_button_text 		= get_field('about_button_text');
	$about_button_link 		= get_field('about_button_link');
	
	$hem_iframe_link 		= get_field('hem_iframe_link');

	$form_choice			= get_field('form_choice');
?>

<main class="home">
	<section class="home-hero-section">
		<div class="home-hero-image" style="background-image:url(<?= $hero_image['url']; ?>);">
			<div class="container">
				<div class="hero-announcement">
					<h1><?= $hero_title; ?></h1>
					<p class="hero-text"><?= $hero_text; ?></p>
				</div>
				<?php if ($hero_btns_repeater) : ?>
					<div class="row home-hero-cta-wrapper">
						<?php foreach ($hero_btns_repeater as $k => $r) : ?>
							<div class="col-md-4">
								<a class="btn btn-primary primary-button-large <?= $r['button_class']; ?>" href="<?= $r['button_link']; ?>" role="button"><?= $r['button_text']; ?></a>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
				<div class="home-hero-image-overlay"></div>
			</div>
			<svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 2000 200" fill="#f0f4f7" class="home-hero-svg">
				<path d="M2000 0 L2000 200 L0 200 Z" />
			</svg>
		</div>
	</section> 
	<?php if ($puff_repeater): ?>
		<section class="puff-section section-padding">
		    <div class="container">
		    	<div class="row">
		    		<div class="col-sm-12">
		        		<h2 class="section-title"><?= $services_title; ?></h2>
		        	</div>
		        </div>
		        <div class="row">
		            <?php foreach ($puff_repeater as $k => $r) : ?>
		                <div class="col-lg-4 col-md 6 puff-container">
		                    <div class="puffar center h-100" style="background-image:url(<?php echo $r['puff_image']['url']; ?>);">
		                        <div class="row flex-column h-100">
		                            <div class="col-auto">
		                                <h3><?= $r['puff_title']; ?></h3>
		                            </div>
		                            <div class="col-auto">
		                                <?= $r['puff_text']; ?>
		                            </div>
		                            <div class="col-auto mt-auto">
		                                <a class="btn btn-block btn-primary primary-button-small" href="<?= $r['puff_btn_link']; ?>">
		                                    <?= $r['puff_btn_text']; ?>
		                                </a>
		                            </div>
		                        </div>
		                        <div class="puff-overlay"></div>
		                    </div>
		                </div>
		            <?php endforeach; ?>
		        </div>
		    </div>
		</section>
	<?php endif; ?>
	<section class="partner">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
		    		<h2 class="section-title"><?= $partner_title; ?></h2>
		    	</div>
		    </div>
		    <div class="row">
				<div class="col-lg-3 center">
		    		<img class="img-fluid" src="<?= $partner_logo['url']; ?>" alt="<?= $partner_logo['alt']; ?>">
		    	</div>
		    	<div class="col-lg-6">
		    		<div class="center partner-text"><?= $partner_text; ?></div>
		    	</div>
		    	<div class="col-lg-3 salesperson">
		    		<img class="img-fluid" src="<?= $partner_image['url']; ?>" alt="<?= $partner_image['alt']; ?>">
		    	</div>
		    </div>
		</div>
	</section>
	<section class="testimonials section-padding">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
		    		<h2 class="section-title"><?= $testimonials_title; ?></h2>
		    	</div>
		    </div>
			<?php if ($testimonials_repeater) : ?>
				<div class="row">
					<?php foreach ($testimonials_repeater as $k => $r) : ?>
						<div class="col-md-4 mobile-padding-not-first">
							<img class="testimonials-quote-img" src="<?= $r['testimonials_quote_img']['url']; ?>" alt="<?= $r['testimonials_quote_img']['alt']; ?>">
							<?= $r['testimonials_text']; ?>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>
	<section class="reference section-padding">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
		    		<h2 class="section-title"><?= $reference_title; ?></h2>
		    	</div>
		    </div>
			<?php if ($reference_repeater) : ?>
				<div class="row">
					<?php foreach ($reference_repeater as $k => $r) : ?>
						<div class="col-6 col-sm-6 col-md-4 col-lg-2 center logo-wrapper">
							<img src="<?= $r['reference_img']['url']; ?>" class="img-fluid" alt="<?= $r['reference_img']['alt']; ?>">
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>
	<section class="about" id="aboutUsScroll">
		<div class="about-image section-padding" style="background-image:url(<?= $about_image['url']; ?>);">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
			    		<h2 class="about-section-title"><?= $about_title; ?></h2>
			    	</div>
			    </div>
			    <div class="row">
					<div class="col-sm-12 center about-text">
			    		<?= $about_text; ?>
			    	</div>
			    </div>
			    <div class="row">
		    		<div class="col-sm-12 center about-btn-wrapper">
		        		<a class="btn btn-primary primary-button-small" href="<?= $about_button_link; ?>" role="button"><?= $about_button_text; ?></a>

		        	</div>
		        </div>
				<?php if ($about_counter_repeater) : ?>
					<div class="row">
						<?php foreach ($about_counter_repeater as $k => $r) : ?>
							<div class="col-md-4 about-counter">
								<div class="about-counter-number">
									<div class="counter" data-count="<?= $r['about_counter_number']; ?>">0</div>
								</div>
								<div class="about-counter-title">
									<?= $r['about_counter_title']; ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
			<div class="about-image-overlay"></div>
		</div>
	</section>
	<section class="google-map-iframe">
		<?= $hem_iframe_link; ?>
	</section>
	<?php if ($form_choice === '1') : ?>
		<?php require_once('lib/form/form.php'); ?>
	<?php endif; ?>
	<?php require_once('lib/form/form-service.php'); ?>
</main>

<?php
	get_footer(); 
?>




