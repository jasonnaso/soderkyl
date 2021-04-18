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

<h3 class="my-4 py-4 text-center">Gör din förfrågan på reservdelar här</h3>

<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data" name="form" id="soderkyl-offer-form" class="mb-4">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group mb-0">
				<input type="text" name="form_manufacturer" id="form-manufacturer" class="form-control" placeholder="Fabrikat">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group mb-0">
				<input type="text" name="form_model" id="form-model" class="form-control" placeholder="Modell">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group mb-0">
				<input type="text" name="form_product_number" id="form-product-number" class="form-control" placeholder="Produktnummer">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group mb-0">
				<input type="text" name="form_serial_number" id="form-serial-number" class="form-control" placeholder="Serienummer">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group mb-0">
				<input type="text" name="form_company" id="form-company" class="form-control" placeholder="Företag eller Förening">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group mb-0">
				<input type="text" name="form_name" id="form-name" class="form-control" placeholder="Namn">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group mb-0">
				<input type="text" name="form_phone" id="form-phone" class="form-control" placeholder="Telefonnummer">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group mb-0">
				<input type="email" name="form_email" id="form-email" class="form-control" placeholder="E-postadress">
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-0">
				<textarea name="form_message" id="form-message" class="form-control" rows="4" placeholder="Vänligen beskriv önskad reservdel här"></textarea>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group mb-0">
				<select name="form_delivery_option" id="form-delivery-option" class="form-control">
					<option value="">Välj leveranssätt</option>
					<option value="Hämtas i butik">Hämtas i butik</option>
					<option value="Skickas med posten">Skickas med posten</option>
					<option value="Skickas med bud inom Storstockholm">Skickas med bud inom Storstockholm</option>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group mb-0">
				<div class="custom-file">
					<input type="file" name="form_attachment" id="form-attachment" class="custom-file-input">
					<label class="custom-file-label" for="form-attachment">Ladda upp bild</label>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group mb-0 form-check">
				<input type="checkbox" name="form_policy" id="form-policy" class="form-check-input">
				<label class="form-check-label" for="form-policy">
					Jag har läst och förstått <a href="/integritetspolicy/">Söderkyls integritetspolicy</a>
				</label>
			</div>
    	</div>
    	<div class="col-md-12">
			<button type="submit" name="form_submit" id="form-submit" class="btn btn-primary form-btn primary-button-small">Skicka</button>
		</div>
		<input type="hidden" name="form_post_id" id="form-post-id" value="<?php echo get_queried_object_id(); ?>">
	</div>
</form>

<div class="preloader">
    <div class="loader"></div>
</div>