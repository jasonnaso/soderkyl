// 'use strict';

$(function()
{
	if ($('#soderkyl-form').length > 0)
	{
		/**
		 * ladda in recaptcha
		 */
		recaptchaInit();
		$('#soderkyl-form').formValidation({
			framework: 'bootstrap',
			
			icon: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				row: '.form-group',
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
				form_phone: {
					validators: {
						notEmpty: {
							message: 'Vänligen ange ett telefonnummer.'
						},
						digits: {
							message: 'Det ser inte ut som ett riktigt telefonnummer.'
						}
					}
				},
				form_agree: {
		            validators: {
		                notEmpty: {
		                    message: 'Du måste godkänna villkoren för att skicka meddelandet.'
		                }
		            }
	        	}
			}
		}).on('success.form.fv', function(e) {

			e.preventDefault();

            grecaptcha.ready(function()
            {
                grecaptcha.execute('6Lc5VJUUAAAAAHbRgcbxOOtmuEZVKE3guZWtk2rD', {action: 'contact_form'}).then(function(token)
                {
                	$.ajax({
						type: 'POST',
						url: '/wp-content/themes/soderkyl/lib/form/send/send.php',
						data: {
							post_id: $('#form-post-id').val(),
							name: $('#form-name').val(),
							email: $('#form-email').val(),
							email_retype: $('#form-email-retype').val(),
							phone: $('#form-phone').val(),
							message: $('#form-message').val(),
							'g-recaptcha-response': token

						},
						dataType: 'json',
					})
					.done(function(data)
					{
						if (data.status == 'ok')
						{
							$('#form-success-message-modal').modal('show');
							$('#form-name').val('');
							$('#form-email').val('');
							$('#form-phone').val('');
							$('#form-message').val('');
							$('#soderkyl-form').data('formValidation').resetForm();
		        			// FormValidation.AddOn.reCaptcha2.reset('captchaContainer');
						}
						else
						{
							$('#form-error-message-modal').modal('show');
						}
					})
					.fail(function()
					{
						$('#form-error-message-modal').modal('show');
					});

                });
            });

			return false;
		});
	}
});