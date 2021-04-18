<?php

	/*
	Template name: Referenser
	*/	
	
	get_header();

	$reference_title 			= get_field('reference_title');
	$reference_list_repeater	= get_field('reference_list_repeater');





?>

<main class="reference-page">
	<section class="reference-list">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h2 class=" page-title"><?= $reference_title; ?></h2>
				</div>
			</div>
			<div class="row center">
				<?php if ($reference_list_repeater): ?>
					<?php foreach ($reference_list_repeater as $k => $r) : ?>
						<div class="col-md-4">
							<div class="reference-title">
								<h3><?= $r['reference_title']; ?></h3>
							</div>
							<div class="center">
								<img class="img-fluid" src="<?= $r['reference_image']['url']; ?>" alt="<?= $r['reference_image']['alt']; ?>">
							</div>
							<div class="reference-quote">
								<?= $r['reference_quote']; ?>
							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		
	</section>
</main>

<?php 
	get_footer(); 
?>