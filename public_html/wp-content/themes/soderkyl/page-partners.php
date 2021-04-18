<?php
/*
Template name: Partners
*/	
	
	get_header();

	$partners_hero_choice	= get_field('partners_hero_choice');
	$partners_hero_image	= get_field('partners_hero_image');
	$partners_hero_title	= get_field('partners_hero_title');
	$partners_hero_text		= get_field('partners_hero_text');
	
	$partners_title			= get_field('partners_title');
	$partners_text			= get_field('partners_text');
	$partners_logo_repeater	= get_field('partners_logo_repeater');
?>
<main class="partners-page">
	<?php if ($partners_hero_choice === 'ja') : ?>
		<section class="partners-hero">
			<div class="partners-hero-image" style="background-image:url(<?= $partners_hero_image['url']; ?>);">
				<div class="container">
					<div class="hero-announcement">
						<?php if($partners_hero_title) : ?>
							<h1><?= $partners_hero_title; ?></h1>
						<?php endif; ?>	
						<?php if($partners_hero_text) : ?>
							<p class="hero-text"><?= $partners_hero_text; ?></p>
						<?php endif; ?>
					</div>
					<div class="partners-hero-image-overlay"></div>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php if($partners_logo_repeater) : ?>
		<section class="partners-logo section-padding">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<h2 class="section-title"><?= $partners_title; ?></h2>
					</div>
				</div>
				<div class="row center">
					<?php foreach ($partners_logo_repeater as $k => $r) : ?>
						<div class="col-sm-3 center logo-wrapper">
							<img src="<?= $r['partners_logo']['url']; ?>" alt="<?= $r['partners_logo']['alt']; ?>" class="img-fluid partners-logo-img">
						</div>
					<?php endforeach; ?>
				</div>
				<div class="row center">
					<div class="col-sm-12">
						<div class="partners-text"><?= $partners_text; ?></div>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>
</main>

<?php 
	get_footer(); 
?>
