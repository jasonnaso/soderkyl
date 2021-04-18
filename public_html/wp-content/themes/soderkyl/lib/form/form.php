<?php

	$form_success_message 	= get_field('form_success_message');
	$form_title			  	= get_field('form_title');

	$form_form_heading		= get_field('form_form_heading');
	$form_column_heading	= get_field('form_column_heading');
	$form_address			= get_field('form_address'); 
?>

<section id="soderkyl-form" class="contact-form">
	<div class="modal fade" id="form-success-message-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Meddelande skickat</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<?php echo $form_success_message; ?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="form-error-message-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Meddelande kunde inte skickas</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					Meddelandet kunde tyvärr inte skickas. Vänligen försök igen eller kontakta oss per telefon.
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
	<div class="form-bg-image">

		<div class="container">
			<div class="row">
				<div class="col-md-12">
		    		<h2 class="section-title"><?= $form_title; ?></h2>
		    	</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="fill-in-contact-form bold-custom center-mobile">
						<?= $form_form_heading; ?>
					</div>
				</div>
				<div class="col-md-8">
					<div class="call-direct-for-booking bold-custom center-mobile">
						<?= $form_column_heading; ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-telephone center-mobile">
						<?= $form_address; ?>
					</div>
				</div>
				<div class="col-md-4">
					<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" name="form" id="soderkyl-form">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<input type="text" name="form_name" id="form-name" placeholder="Ditt namn: *" class="form-control custom-form" />
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="email" name="form_email" id="form-email" placeholder="Din e-postadress: *" class="form-control custom-form" />
									<input type="email" name="form_email_retype" id="form-email-retype" placeholder="Din e-postadress: *" class="form-control custom-form retypeEmail" />
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="text" name="form_phone" id="form-phone" placeholder="Telefonnummer: *" class="form-control custom-form" />
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-group-message">
									<textarea name="form_message" id="form-message" rows="4" placeholder="Ditt meddelande:" class="form-control custom-form-message"></textarea>
								</div>
							</div>
							<div class="col-md-12">
	                    		<div class="form-group form-group-policy">
	                    			<input type="checkbox" name="form_agree" id="form-agree"> Jag har läst och förstått <a href="/integritetspolicy/" target="_blank">Söderkyls integritetspolicy</a>
	                    		</div>
	                    	</div>
		                	<div class="col-md-12">
								<div class="form-group">
									<button type="submit" name="form_submit" id="form-submit" class="btn btn-primary primary-button-small">Skicka</button>
								</div>
							</div>
							<input type="hidden" name="form_post_id" id="form-post-id" value="<?php echo $post->ID; ?>" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<?php var_dump($_SERVER['REQUEST_URI']); ?>
