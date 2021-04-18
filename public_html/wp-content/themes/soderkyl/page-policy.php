<?php

	/*
	Template name: Integritetspolicy
	*/	
	
	get_header();

	$policy_title 	= get_field('policy_title');
	$policy_text 	= get_field('policy_text');

?>

<main class="policy-page">
	<section class="policy-list section-padding">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h2 class="section-title"><?= $policy_title; ?></h2>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-8 offset-sm-2">
					<?= $policy_text; ?>
				</div>
			</div>
		</div>
	</section>
</main>

<?php 
	get_footer(); 
?>