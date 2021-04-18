window.recaptchaLoaded = false;

var recaptchaInit = function() {

	// setTimeout(function() {
	// 	if(!window.recaptchaLoaded) {
	// 		var script = document.createElement('script');
	// 		script.src = 'https://www.google.com/recaptcha/api.js?render=6Lc5VJUUAAAAAHbRgcbxOOtmuEZVKE3guZWtk2rD&test';
	// 		document.body.appendChild(script);
	// 		window.recaptchaLoaded = true;
	// 	}
	// },15000);

	$(function() {
		$(document).on('focus', 'input, textarea, select', function() {
			if(!window.recaptchaLoaded) {
				var script = document.createElement('script');
				script.src = 'https://www.google.com/recaptcha/api.js?render=6Lc5VJUUAAAAAHbRgcbxOOtmuEZVKE3guZWtk2rD&test';
				document.body.appendChild(script);
				window.recaptchaLoaded = true;
			}
		});
	});

}


