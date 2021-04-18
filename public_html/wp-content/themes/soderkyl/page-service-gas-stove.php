<?php

	/*
	Template name: Tjanster Gasspisar
	*/	
	
	get_header(); 

	$hero_choice					= get_field('hero_choice');
	$hero_image						= get_field('hero_image');
	$hero_title						= get_field('hero_title');
	$hero_text						= get_field('hero_text');
	$hero_btns_repeater 			= get_field('hero_btns_repeater');

	$services_repeater				= get_field('services_repeater');

	$page_content_repeater			= get_field('page_content_repeater');

	$services_project_title			= get_field('services_project_title');
	$services_project_list_repeater	= get_field('services_project_list_repeater');


	$services_process_title 		= get_field('services_process_title');
	$services_process_text_left 	= get_field('services_process_text_left');
	$services_process_text_right 	= get_field('services_process_text_right');
	$services_process_name 			= get_field('services_process_name');
	$services_process_repeater 		= get_field('services_process_repeater');

	$services_suppliers_title 		= get_field('services_suppliers_title');
	$services_supplier_repeater 	= get_field('services_supplier_repeater');
	
	$services_product_btn_link 		= get_field('services_product_btn_link');
	$services_product_btn_text 		= get_field('services_product_btn_text');

	$form_choice					= get_field('form_choice');
	
?>
<main class="services-page">
	<?php if ($hero_choice = 1) : ?>
		<section class="services-hero">
			<div class="services-hero-image" style="background-image:url(<?= $hero_image['url']; ?>);">
				<div class="container">
					<div class="hero-announcement">
						<?php if($hero_title) : ?>
							<h1><?= $hero_title; ?></h1>
						<?php endif; ?>
						<?php if($hero_text) : ?>
							<p class="hero-text"><?= $hero_text; ?></p>
						<?php endif; ?>
					</div>
					<?php  ?>
					<?php if ($hero_btns_repeater) : ?>
						<div class="row services-hero-cta-wrapper">
							<?php foreach ($hero_btns_repeater as $k => $r) : ?>
								<div class="col-md-4 center">
									<a class="btn btn-primary primary-button-large <?= $r['button_class']; ?>" href="<?= $r['button_link']; ?>" role="button"><?= $r['button_text']; ?></a>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
					<div class="services-hero-image-overlay"></div>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php if($services_repeater) :?> 
		<section class="section-padding">
			<?php foreach($services_repeater as $k => $r) :?>
				<div class="services add-bg-color container">
					<div class="row">
						<?php if($r['service_image_video_choice'] === "bild"): ?>
							<div class="col-md-6 min-height-360 services-bg-image" style="background-image: url('<?= $r['service_image']['url']; ?>');"></div>
						<?php else: ?>
						<div class="col-md-6 video-container">
							<?php $video = str_replace('feature=oembed', 'feature=oembed&rel=0', $r['service_video']); ?>
							<?= $video; ?>
						</div>
						<?php endif; ?>
						<div class="col-md-6">
							<div class="services-description-title">
								<h3><?= $r['service_title']; ?></h3>
							</div>
							<div class="services-description-text">
								<?= $r['service_description_text']; ?>
							</div>
						</div>
					</div>	
				</div>
			<?php endforeach; ?>
		</section>
	<?php endif; ?>

	<?php if ($services_project_list_repeater) : ?>
		<section class="services-project section-padding">
			<div class="container">
				<div class="row">
					<div class="section-title center">
						<h2><?= $services_project_title; ?></h2>
					</div>
				</div>
				<?php foreach ($services_project_list_repeater as $k => $r) : ?>
					<div class="row">
						<div class="project-section-title center">
							<h3><?= $r['section_title']; ?></h3>
						</div>
					</div>
					<div class="row service-project-images">
						<?php if ($r['services_project_repeater']) : ?>
							<?php foreach ($r['services_project_repeater'] as $k2 => $r2) : ?>
								<div class="col-sm-4 center">
									<img class="img-fluid" src="<?= $r2['services_project_image']['url']; ?>" alt="<?= $r2['services_project_image']['alt']; ?>">
									<h4><?= $r2['services_project_text']; ?></h4>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</section>
	<?php endif; ?>

	<?php if($services_process_repeater) : ?>
		<section class="services-process section-padding">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<h2 class="section-title"><?= $services_process_title; ?></h2>
					</div>
				</div>
				<div class="row">
					<?php foreach ($services_process_repeater as $k => $r) : ?>
						<div class="col-md-2 col-sm-6 col-xs-6 center services-process-icon">
							<div><?= $r['services_process_icon']; ?></div>
							<div><?= $r['services_process_name']; ?></div>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="services-process-text"><?= $services_process_text_left; ?></div>
					</div>
					<div class="col-sm-6">
						<div class="services-process-text"><?= $services_process_text_right; ?></div>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>
	<?php if ($services_product_btn_text) : ?>
		<section class="services-product section-padding">
			<div class="container center">
					<div class="row">
						<div class="col-sm-12">
							<a class="btn btn-primary primary-button-large" href="<?= $services_product_btn_link;  ?>" role="button"><?= $services_product_btn_text; ?></a>
						</div>
					</div>
				</div>
		</section>
	<?php endif; ?>

	<?php if($services_supplier_repeater) : ?>
		<section class="services-supplier section-padding">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<h2 class="section-title"><?= $services_suppliers_title; ?></h2>
					</div>
				</div>
				<div class="row center">
					<?php foreach ($services_supplier_repeater as $k => $r) : ?>
						<div class="col-lg-2 col-sm-6 col-xs-6 services-supplier-icon">
							<img class="img-fluid" src="<?= $r['supplier_logo']['url']; ?>" alt="<?= $r['supplier_logo']['alt']; ?>">
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>
	<?php if ($form_choice === '1') : ?>
		<?php require_once('lib/form/form.php'); ?>
	<?php endif; ?>
</main>
<?php 
	get_footer(); 
?>

