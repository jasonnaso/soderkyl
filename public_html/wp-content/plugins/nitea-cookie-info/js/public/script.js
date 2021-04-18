(function( $ ) {
	$(function() {

		setTimeout(function() {

			$(document).on('click', '.nitea-cookie-info-ok-btn', function(e){
				e.preventDefault();
				$.ajax({
					url: $('#nitea-cookie-info-container').attr('data-url'),
					cache: false,
					data: {
						type: 'click',
						timeout: $('#nitea-cookie-info-container').attr('data-timeout')
					},
					method: 'get',
					dataType: 'json',
					success: function(data) {
						$('.nitea-cookie-info-container').fadeOut();
					}
				});
			});

			$.ajax({
				url: niteaCookieInfoJs.pluginsUrl+'/nitea-cookie-info/nitea-cookie-info-ajax.php',
				cache: false,
				data: {
					type: 'get-status'
				},
				method: 'get',
				dataType: 'json',
				success: function(data) {
					if(data.show && data.active == '1') {
						niteaCookieInfoJsHtml(data);
					}
				}
			});
		},1500);


	});
})( jQuery );


var niteaCookieInfoJsHtml = function(data) {

	var $ = jQuery;

	var $nCContainer 				= $('<div>');
	var $nCWrapper 					= $('<div>');
	var $nCP1 						= $('<p>');
	var $nCP2 						= $('<p>');
	var $nCP2A1 					= $('<a>');
	var $nCP2A2 					= $('<a>');
	var $nCP2A3 					= $('<a>');

	var	timeout 					= data.timeout;
	var	url 						= niteaCookieInfoJs.url;
	var message_text_size 			= data.message_text_size;
	var message_background_color 	= data.message_background_color;
	var message_text_color 			= data.message_text_color;
	var message_text 				= data.message_text;
	var extra_buttons 				= data.extra_buttons;
	var extra_button_placement 		= data.extra_button_placement;

	var gdpr_link_text 				= data.gdpr_link_text;
	var gdpr_link_color 			= data.gdpr_link_color;
	var gdpr_link_url 				= data.gdpr_link_url;
	var gdpr_link_text 				= data.gdpr_link_text;
	var link_text 					= data.link_text;
	var link_color 					= data.link_color;
	var link_url 					= data.link_url;
	var button_color 				= data.button_color;
	var button_text 				= data.button_text;
	var button_class 				= data.button_class;
	var style 				= data.style;

	if(style && style.length > 2) {
		$('body').append('<style>'+style+'</style>');
	}


	$nCContainer
		.addClass('nitea-cookie-info-container')
		.addClass('tetsar')
		.attr('id', 'nitea-cookie-info-container')
		.attr('data-timeout', timeout)
		.attr('data-url', url)
		.css({
			'position': 'relative',
			'width': '100%',
			'background-color': 'red'
		})
	;

	$nCWrapper
		.addClass('nitea-cookie-info-wrapper')
		.css({
			'font-size': message_text_size,
			'position': 'fixed',
			'bottom': 0,
			'left': 0,
			'margin': 0,
			'padding': '15px 15px',
			'text-align': 'center',
			'z-index': '99999999',
			'width': '100%',
			'background-color': message_background_color,
			'color': message_text_color
		})
	;
	

	if(extra_buttons && extra_buttons.length) {
		$nCP1
			.css({
				'margin': 0,
				'padding': 0
			})
			.html(message_text)
		;

		/**
		 * extraknappar
		 */
		var extraButtonsArr = [];
		$.map(extra_buttons, function(item, index) {

			if(item.link_url && item.link_url.length && item.link_text && item.link_text.length) {
				var $a = $('<a>')
					.attr('href', item.link_url)
					.css({
						'color': item.link_color
					})
					.text(item.link_text)
				;

				extraButtonsArr.push($a);
			}

		});


		$nCP2
			.css({
				'margin': '15px 0 0 0',
				'padding': 0
			})
		;
		$nCP2A1
			.css('font-size', '1em')
			.attr('href', '#')
			.addClass('nitea-cookie-info-ok-btn')
			.text(button_text)
		;
		if(button_color && button_color.length) {
			$nCP2A1.css('color', button_color);
		}
		if(button_class && button_class.length) {
			$nCP2A1.addClass(button_class);
		}

		$nCP2.html($nCP2A1);


		if(extra_button_placement == 'before') {
			$.map(extraButtonsArr, function(item, index) {
				$nCP2.prepend(' | ');
				$nCP2.prepend(item);
			});
			
		}

		if(extra_button_placement == 'after') {
			$.map(extraButtonsArr, function(item, index) {
				$nCP2.append(' | ');
				$nCP2.append(item);
			});
		}

	} else {
		/* old */
		$nCP1
			.css({
				'margin': 0,
				'padding': 0
			})
			.html(message_text)
		;
		$nCP2
			.css({
				'margin': '15px 0 0 0',
				'padding': 0
			})
		;

		$nCP2A2
			.css({
				'font-size': '1em',
				'color': gdpr_link_color
			})
			.attr('href', gdpr_link_url)
			.addClass('nitea-cookie-info-read-more-btn')
			.text(gdpr_link_text+' | ') 
		;

		if(gdpr_link_text && gdpr_link_text.length) {
			$nCP2.append($nCP2A2);
		}

		$nCP2A3
			.css({
				'font-size': '1em',
				'color': link_color
			})
			.attr('href', link_url)
			.addClass('nitea-cookie-info-read-more-btn')
			.text(link_text+' | ')
		;

		if(link_text && link_text.length) {
			$nCP2.append($nCP2A3)
		}

		/* // old */

		$nCP2A1
			.css('font-size', '1em')
			.attr('href', '#')
			.addClass('nitea-cookie-info-ok-btn')
			.append(button_text)
		;
		if(button_color && button_color.length) {
			$nCP2A1.css('color', button_color);
		}
		if(button_class && button_class.length) {
			$nCP2A1.addClass(button_class);
		}

		$nCP2.append($nCP2A1);
	}

	$nCWrapper.append($nCP1);
	$nCWrapper.append($nCP2);
	$nCContainer.append($nCWrapper);


	$('body').append($nCContainer);
}