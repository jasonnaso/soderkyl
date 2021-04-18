<?php

	/*
	Template name: Kontakt
	*/

	get_header();

	$contact_hero 			= get_field('contact_hero');
	$contact_list_repeater 	= get_field('contact_list_repeater');

	$contact_iframe_link	= get_field('contact_iframe_link');
	
	$form_choice	= get_field('form_choice');
?>

<main class="contact-page">
	<section class="google-map-hero">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<div class="contact-hero" style="background-image:url(<?= $contact_hero['url']; ?>);"></div>
				</div>
				<div class="col-md-6 google-map-iframe">
					<?= $contact_iframe_link; ?>
				</div>
			</div>
		</div>
	</section>
	<section class="contact-list section-padding">
		<?php if ($contact_list_repeater) : ?>
			<div class="container">
				<div class="row contact-section">
					<?php foreach ($contact_list_repeater as $k => $r) : ?>
						<div class="col-lg-4 contact-column">
							<div class="position-title center">
								<h3><?= $r['section_title']; ?></h3>
								
							</div>
							<?php if ($r['contact_information_repeater']) : ?>
								<?php foreach ($r['contact_information_repeater'] as $k2 => $r2) : ?>
									<div class="center contact-information">
										<?= $r2['contact_information']; ?>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
	</section>
	<?php if ($form_choice === '1') : ?>
		<?php require_once('lib/form/form.php'); ?>
	<?php endif; ?>
</main>

<?php
	get_footer();
?>
