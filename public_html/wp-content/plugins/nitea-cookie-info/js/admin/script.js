(function($) {


	$(document).on('click', '#nitea-cookie-info-button-link-submit-add', function(e) {
		e.preventDefault();
		var link_text 	= $('#nitea-cookie-info-button-link-text-add').val();
		var link_url 	= $('#nitea-cookie-info-button-link-url-add').val();
		var link_color 	= $('#nitea-cookie-info-button-link-color-add').val();

		var html = ''+
		'<tr>'+
		'	<td><input type="text" name="nitea_cookie_info_button[8888][link_text]" class="link-text" value="'+link_text+'" /></td>'+
		'	<td><input type="text" name="nitea_cookie_info_button[8888][link_url]" class="link-url" value="'+link_url+'" /></td>'+
		'	<td><input type="text" name="nitea_cookie_info_button[8888][link_color]" class="link-color color-field" value="'+link_color+'" /></td>'+
		'	<td><button type="button" class="nitea-cookie-info-button-button-remove button">-</button></td>'+
		'</tr>'+
		'';

		$(e.target).closest('table').find('tbody').append(html);

		$('#nitea-cookie-info-button-link-text-add').val('');
		$('#nitea-cookie-info-button-link-url-add').val('');
		$('#nitea-cookie-info-button-link-color-add').val('');


		niteaCookieInfoButtonFixIndex();
	});

	$(document).on('click', '.nitea-cookie-info-button-button-remove', function(e) {
		e.preventDefault()

		$(e.target).closest('tr').remove();
		niteaCookieInfoButtonFixIndex();
	});

	var niteaCookieInfoButtonFixIndex = function() {

		$('#buttons tbody tr:not(.add)').each(function(index, item) {
			$(item).find('.link-text').attr('name', 'nitea_cookie_info_button['+(index)+'][link_text]');
			$(item).find('.link-url').attr('name', 'nitea_cookie_info_button['+(index)+'][link_url]');
			$(item).find('.link-color').attr('name', 'nitea_cookie_info_button['+(index)+'][link_color]');
		});

	};


})( jQuery );