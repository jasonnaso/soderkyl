if ($('#soderkyl-offer-form').length > 0)
{

	/**
	 * ladda in recaptcha
	 */
	recaptchaInit();
	recaptchaInit();
	recaptchaInit();
	recaptchaInit();
	recaptchaInit();

	$('#soderkyl-offer-form').formValidation({
		framework: 'bootstrap',
		icon: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			form_company: {
				validators: {
					notEmpty: {
						message: 'Vänligen ange ett företagsnamn eller förening.'
					},
					stringLength: {
						min: 2,
						message: 'Namnet på företaget behöver vara längre än 2 tecken långt.'
					}
				}
			},
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
			form_manufacturer: {
				validators: {
					notEmpty: {
						message: 'Vänligen ange ett fabrikat.'
					},
					stringLength: {
						min: 2,
						message: 'Namnet på fabrikatet behöver vara längre än 2 tecken långt.'
					}
				}
			},

			/*
			form_model: {
				validators: {
					notEmpty: {
						message: 'Vänligen ange en modell.'
					},
					stringLength: {
						min: 2,
						message: 'Namnet på modellen behöver vara längre än 2 tecken långt.'
					}
				}
			},
			form_product_number: {
				validators: {
					notEmpty: {
						message: 'Vänligen ange ett produktnummer.'
					},
					stringLength: {
						min: 2,
						message: 'Produktnumret behöver vara längre än 2 tecken långt.'
					}
				}
			},
			form_serial_number: {
				validators: {
					notEmpty: {
						message: 'Vänligen ange ett serienummer.'
					},
					stringLength: {
						min: 2,
						message: 'Serienumret behöver vara längre än 2 tecken långt.'
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
			form_delivery_option: {
				validators: {
					notEmpty: {
						message: 'Vänligen ange ett leveranssätt.'
					}
				}
			},
			*/
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

				form_data.append('post_id', $('#form-post-id').val());
				form_data.append('manufacturer', $('#form-manufacturer').val());
				form_data.append('model', $('#form-model').val());
				form_data.append('product_number', $('#form-product-number').val());
				form_data.append('serial_number', $('#form-serial-number').val());
				form_data.append('company', $('#form-company').val());
				form_data.append('name', $('#form-name').val());
				form_data.append('phone', $('#form-phone').val());
				form_data.append('email', $('#form-email').val());
				form_data.append('message', $('#form-message').val());
				form_data.append('delivery_option', $('#form-delivery-option :selected').val());
				form_data.append('g-recaptcha-response', token);

				if ($('#form-attachment').val().length)
				{
					form_data.append('attachment', $('#form-attachment')[0].files[0]);
				}

				$.ajax({
					type: 'POST',
					url: '/wp-content/themes/soderkyl/lib/form/send/send-offer.php',
					data: form_data,
                    cache: false,
                    contentType: false,
                    processData: false,
				})
				.done(function(data)
				{
					if (data.status == 'ok')
					{
						$('#soderkyl-offer-form input, #soderkyl-offer-form textarea').each(function(index, element) {
							$(element).val('');
						});

						$('#soderkyl-offer-form option').each(function(index, element) {
							$(element).prop('selected', false);
						});

						$('#soderkyl-offer-form').data('formValidation').resetForm();

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
