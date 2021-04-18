<?php

	/*
	Template name: Om oss 
	*/	
	
	get_header();

	$about_hero_choice	= get_field('about_hero_choice');
	$about_hero_image	= get_field('about_hero_image');
	$about_hero_title	= get_field('about_hero_title');
	$about_hero_text	= get_field('about_hero_text');

	$about_us_repeater	= get_field('about_us_repeater');

	$stadsmission_img	= get_field('stadsmission_img');
	$stadsmission_text	= get_field('stadsmission_text');

?>
	
<main class="about-page">
	<?php if ($about_hero_choice === 'ja') : ?>
		<section class="about-hero-section">
			<div class="about-hero-image" style="background-image:url(<?= $about_hero_image['url']; ?>);">
				<div class="container">
					<div class="hero-announcement">
						<?php if($about_hero_title) : ?>
							<h1><?= $about_hero_title; ?></h1>
						<?php endif; ?>
						<?php if($about_hero_text) : ?>
							<p class="hero-text"><?= $about_hero_text; ?></p>
						<?php endif; ?>
					</div>
					<div class="about-hero-image-overlay"></div>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php if($about_us_repeater) :?> 
		<section class="section-padding">
			<?php foreach($about_us_repeater as $k => $r) :?>
				<div class="about-us add-bg-color container">
					<div class="row">
						<?php if($r['about_us_image_video_choice'] === "bild"): ?>
							<div class="col-md-6 min-height-360 about-us-bg-image" style="background-image: url('<?= $r['about_us_image']['url']; ?>');"></div>
						<?php else: ?>
						<div class="col-md-6 video-container">
							<?php $video = str_replace('feature=oembed', 'feature=oembed&rel=0', $r['about_us_video']); ?>
							<?= $video; ?>
						</div>
						<?php endif; ?>
						<div class="col-md-6">
							<div class="about-us-description-title">
								<h3><?= $r['about_us_title']; ?></h3>
							</div>
							<div class="about-us-description-text">
								<?= $r['about_us_description_text']; ?>
							</div>
						</div>
					</div>	
				</div>
			<?php endforeach; ?>
		</section>
	<?php endif; ?>

	<?php if ($stadsmission_img && $stadsmission_text) :?>
		<section class="stadsmission section-padding">
			<div class="container">
				<div class="row center">
					<div class="col-sm-8 center">
						<img class="img-fluid" src="<?= $stadsmission_img['url']; ?>" alt="<?= $stadsmission_img['alt']; ?>">
						<div class="stadsmission-text"><?= $stadsmission_text; ?></div>
					</div>
				</div>
		</section>
	<?php endif; ?>


</main>

<?php 
	get_footer(); 
?>