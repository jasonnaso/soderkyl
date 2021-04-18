<div class="modal fade" id="form-success-message-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Meddelande skickat</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				Tack för ditt meddelande
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


<div class="modal fade" id="form-gas-stove-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Boka service av gasspisar</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data" name="form" id="soderkyl-gas-stove-form" class="mb-4">
					<div class="form-group">
						<input type="text" name="form_name" id="form-name" class="form-control" placeholder="Namn">
					</div>
					<div class="form-group">
						<input type="text" name="form_phone" id="form-phone" class="form-control" placeholder="Telefonnummer">
					</div>
					<div class="form-group">
						<input type="email" name="form_email" id="form-email" class="form-control" placeholder="E-postadress">
					</div>
					<div class="form-group">
						<input type="text" name="form_address" id="form-address" class="form-control" placeholder="Adress">
					</div>
					<div class="form-group">
						<textarea name="form_message" id="form-message" class="form-control" rows="4" placeholder="Meddelande"></textarea>
					</div>
					<div class="form-group form-check">
						<input type="checkbox" name="form_policy" id="form-policy" class="form-check-input">
						<label class="form-check-label" for="form-policy">
							Jag har läst och förstått <a href="/integritetspolicy/">Söderkyls integritetspolicy</a>
						</label>
					</div>
					<div class="form-group mb-0">
						<input type="hidden" name="form_post_id" id="form-post-id" value="<?php echo $post->ID; ?>">
						<button type="submit" name="form_submit" id="form-submit" class="btn btn-primary form-btn">Skicka</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="preloader">
    <div class="loader"></div>
</div>