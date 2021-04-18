if ($('#soderkyl-gas-stove-form').length > 0)
{
	/**
	 * ladda in recaptcha
	 */
	recaptchaInit();
	
	$('#soderkyl-gas-stove-form').formValidation({
		framework: 'bootstrap',
		icon: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			form_name: {
				validators: {
					notEmpty: {
						message: 'Vänligen ange ett namn.'
					},
					stringLength: {
						min: 2,
						message: 'Namnet behöver vara längre än 2 tecken långt.'
					}
				}
			},
			form_phone: {
				validators: {
					notEmpty: {
						message: 'Vänligen ange ett telefonnummer.'
					},
					digits: {
						message: 'Det ser inte ut som en riktig telefonnummer.'
					}
				}
			},
			form_email: {
				validators: {
					notEmpty: {
						message: 'Vänligen ange en e-postadress.'
					},
					emailAddress: {
						message: 'Det ser inte ut som en riktig e-postadress.'
					}
				}
			},
			form_address: {
				validators: {
					notEmpty: {
						message: 'Vänligen ange en address.'
					},
					stringLength: {
						min: 2,
						message: 'Adressen behöver vara längre än 2 tecken långt.'
					}
				}
			},
			form_message: {
				validators: {
					notEmpty: {
						message: 'Vänligen ange en beskrivning.'
					},
					stringLength: {
						min: 2,
						message: 'Beskrivningen behöver vara längre än 2 tecken långt.'
					}
				}
			},
			form_policy: {
	            validators: {
	                notEmpty: {
	                    message: 'Du måste godkänna villkoren för att skicka meddelandet.'
	                }
	            }
        	}
		}
	}).on('success.form.fv', function(e) {

		e.preventDefault();

        loader.show();

        grecaptcha.ready(function()
        {
            grecaptcha.execute('6Lc5VJUUAAAAAHbRgcbxOOtmuEZVKE3guZWtk2rD', {action: 'contact_form'}).then(function(token)
            {
				var form_data = new FormData();

				form_data.append('post_id', $('#soderkyl-gas-stove-form #form-post-id').val());
				form_data.append('name', $('#soderkyl-gas-stove-form #form-name').val());
				form_data.append('phone', $('#soderkyl-gas-stove-form #form-phone').val());
				form_data.append('email', $('#soderkyl-gas-stove-form #form-email').val());
				form_data.append('address', $('#soderkyl-gas-stove-form #form-address').val());
				form_data.append('message', $('#soderkyl-gas-stove-form #form-message').val());
				form_data.append('g-recaptcha-response', token);

				$.ajax({
					type: 'POST',
					url: '/wp-content/themes/soderkyl/lib/form/send/send-gas-stove.php',
					data: form_data,
                    cache: false,
                    contentType: false,
                    processData: false,
				})
				.done(function(data)
				{
    				$('#form-gas-stove-modal').modal('hide');

					if (data.status == 'ok')
					{
						$('#soderkyl-gas-stove-form input, #soderkyl-gas-stove-form textarea').each(function(index, element) {
							$(element).val('');
						});

						$('#soderkyl-gas-stove-form option').each(function(index, element) {
							$(element).prop('selected', false);
						});

						$('#soderkyl-gas-stove-form').data('formValidation').resetForm();

						$('#form-success-message-modal').modal('show');
					}
					else
					{
						$('#form-error-message-modal').modal('show');
					}

        			loader.hide();

				})
				.fail(function()
				{
					$('#form-error-message-modal').modal('show');

        			loader.hide();
				});

            });
        });

		return false;
	});
}
