<?php
/**
* Plugin Name: Nitea cookie info
* Plugin URI: http://plugin.wordpress.nitea.se/nitea-cookie-info
* Description: Simply make cookie and gdpr info bar with link to cookie and gdpr page (works with cache plugins)
* Version: 1.4.5
* Author: Nitea AB (Claes Norén)
* Author URI: http://www.nitea.se
* Text Domain: nitea-cookie-info
* License: GPL12
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

add_action('admin_menu','nitea_cookie_info_admin_menu');
function nitea_cookie_info_admin_menu() { 
	add_submenu_page('options-general.php', 'Nitea cookie info', 'Nitea cookie info', 'publish_pages', 'nitea-cookie-info', 'nitea_cookie_info_admin_menu_list');
}

function nitea_cookie_info_admin_menu_list(){ 
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );

	$nitea_cookie_info = get_option('nitea_cookie_info');
	$nitea_cookie_info = json_decode($nitea_cookie_info, true);

	/**
	 * Save
	 */
	if(isset($_POST['nitea_cookie_info_update_submit'])){
		$nitea_cookie_info = array(
			'active' 						=> ((isset($_POST['nitea_cookie_info_update_active']) && $_POST['nitea_cookie_info_update_active'] == '1') ? $_POST['nitea_cookie_info_update_active'] : '0'),
			'timeout' 						=> ((isset($_POST['nitea_cookie_info_update_timeout'])) ? $_POST['nitea_cookie_info_update_timeout'] : '30'),
			'message_text' 					=> ((isset($_POST['nitea_cookie_info_update_message_text'])) ? $_POST['nitea_cookie_info_update_message_text'] : ''),
			'message_text_color'			=> ((isset($_POST['nitea_cookie_info_update_message_text_color'])) ? $_POST['nitea_cookie_info_update_message_text_color'] : ''),
			'message_text_size'				=> ((isset($_POST['nitea_cookie_info_update_message_text_size'])) ? $_POST['nitea_cookie_info_update_message_text_size'] : ''),
			'message_background_color'		=> ((isset($_POST['nitea_cookie_info_update_message_background_color'])) ? $_POST['nitea_cookie_info_update_message_background_color'] : ''),
			'extra_button_placement'		=> ((isset($_POST['extra_button_placement'])) ? $_POST['extra_button_placement'] : ''),
			'extra_buttons'					=> ((isset($_POST['nitea_cookie_info_button'])) ? $_POST['nitea_cookie_info_button'] : ''),
			'button_text' 					=> ((isset($_POST['nitea_cookie_info_update_button_text'])) ? $_POST['nitea_cookie_info_update_button_text'] : ''),
			'button_color' 					=> ((isset($_POST['nitea_cookie_info_update_button_color'])) ? $_POST['nitea_cookie_info_update_button_color'] : ''),
			'button_class' 					=> ((isset($_POST['nitea_cookie_info_update_button_class'])) ? $_POST['nitea_cookie_info_update_button_class'] : ''),
			'style' 						=> ((isset($_POST['nitea_cookie_info_update_button_style'])) ? $_POST['nitea_cookie_info_update_button_style'] : ''),
			'gdpr_link_text' 				=> ((isset($_POST['nitea_cookie_info_update_gdpr_link_text'])) ? $_POST['nitea_cookie_info_update_gdpr_link_text'] : ''),
			'gdpr_link_url'					=> ((isset($_POST['nitea_cookie_info_update_gdpr_link_url'])) ? $_POST['nitea_cookie_info_update_gdpr_link_url'] : ''),
			'gdpr_link_color' 				=> ((isset($_POST['nitea_cookie_info_update_gdpr_link_color'])) ? $_POST['nitea_cookie_info_update_gdpr_link_color'] : ''),
			'link_text' 					=> ((isset($_POST['nitea_cookie_info_update_link_text'])) ? $_POST['nitea_cookie_info_update_link_text'] : ''),
			'link_url' 						=> ((isset($_POST['nitea_cookie_info_update_link_url'])) ? $_POST['nitea_cookie_info_update_link_url'] : ''),
			'link_color' 					=> ((isset($_POST['nitea_cookie_info_update_link_color'])) ? $_POST['nitea_cookie_info_update_link_color'] : ''),
		);
		update_option('nitea_cookie_info', json_encode($nitea_cookie_info));
	}

	$extra_button_placement_before 	= ((isset($nitea_cookie_info['extra_button_placement']) && $nitea_cookie_info['extra_button_placement'] == 'before') ? 'checked="checked"' : '');
	$extra_button_placement_after 	= ((isset($nitea_cookie_info['extra_button_placement']) && $nitea_cookie_info['extra_button_placement'] == 'after') ? 'checked="checked"' : '');

	$nitea_cookie_info_active_0 = ((isset($nitea_cookie_info['active']) && $nitea_cookie_info['active'] == '0') ? 'checked="checked"' : '');
	$nitea_cookie_info_active_1 = ((isset($nitea_cookie_info['active']) && $nitea_cookie_info['active'] == '1') ? 'checked="checked"' : '');

?>

<script>
(function( $ ) {

	// Add Color Picker to all inputs that have 'color-field' class
	$(function() {
	    $('.color-field').wpColorPicker();
	});
	 
})( jQuery );
</script>
<div class="wrap">
	<h1>Nitea cookie info</h1>
	<form method="post" action="<?=$_SERVER['SCRIPT_NAME']; ?>?page=nitea-cookie-info" name="nitea_cookie_info_update" id="nitea-cookie-info-update">
		<table class="wp-list-table widefat striped" style="max-width: 100%; margin-bottom: 20px;">
			<tr>
				<td colspan="2">
					<h2><?php _e('Status','nitea-cookie-info'); ?></h2>
				</td>
			</tr>
			<tr>
				<td>
					<label><input type="radio" name="nitea_cookie_info_update_active" id="nitea-cookie-info-update-active-0" value="0" <?=$nitea_cookie_info_active_0; ?>><?php _e('Av', 'nitea-cookie-info'); ?></label> 
					<label><input type="radio" name="nitea_cookie_info_update_active" id="nitea-cookie-info-update-active-1" value="1" <?=$nitea_cookie_info_active_1; ?>><?php _e('På', 'nitea-cookie-info'); ?></label>
				</td>
			</tr>
			<tr>
				<td>
					<?php _e('Stil (CSS)','nitea-cookie-info'); ?>:
				</td>
				<td>
					<textarea name="nitea_cookie_info_style" id="nitea-cookie-info-style" placeholder="{}" style="width: 100%; height: 200px;"><?=isset($nitea_cookie_info['style']) ? $nitea_cookie_info['style'] : ''; ?></textarea>
				</td>
			</tr>
	

			<tr>
				<td colspan="2">
					<h2><?php _e('Tidsgräns','nitea-cookie-info'); ?></h2>
				</td>
			</tr>
			<tr>
				<td>
					<?php _e('Minuter','nitea-cookie-info'); ?>:
				</td>
				<td>
					<input type="text" name="nitea_cookie_info_update_timeout" id="nitea-cookie-info-update-timeout" placeholder="120" value="<?=$nitea_cookie_info['timeout']; ?>" /><br>
					<?php _e('Ange efter hur lång tid, i minuter, som meddelande ska visas igen efter man har godkänt det', 'nitea-cookie-info'); ?>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<h2><?php _e('Meddelande','nitea-cookie-info'); ?></h2>
				</td>
			</tr>
			<tr>
				<td>
					<?php _e('Textstorlek','nitea-cookie-info'); ?>:
				</td>
				<td>
					<input type="text" name="nitea_cookie_info_update_message_text_size" id="nitea-cookie-info-update-message-text-size" placeholder="1em" value="<?=$nitea_cookie_info['message_text_size']; ?>" /><br>
					<?php _e('Ange textstorleken för all text i meddelandet. Tillåtna enheter är px, %, em, rem', 'nitea-cookie-info'); ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php _e('Text','nitea-cookie-info'); ?>:
				</td>
				<td>
					<textarea name="nitea_cookie_info_update_message_text" id="nitea-cookie-info-update-message-text" style="width: 100%" placeholder="På denna webbplats använder vi kakor (cookies) för att webbplatsen ska fungera på ett bra sätt för dig. Genom att surfa vidare godkänner du att vi använder kakor."><?=$nitea_cookie_info['message_text']; ?></textarea>
				</td>
			</tr>
			<tr>
				<td>
					<?php _e('Textfärg','nitea-cookie-info'); ?>:
				</td>
				<td>
					<input type="text" name="nitea_cookie_info_update_message_text_color" id="nitea-cookie-info-update-message-text-color" class="color-field" placeholder="#00FF00" value="<?=$nitea_cookie_info['message_text_color']; ?>" />
				</td>
			</tr>
			<tr>
				<td>
					<?php _e('Bakgrundsfärg','nitea-cookie-info'); ?>:
				</td>
				<td>
					<input type="text" name="nitea_cookie_info_update_message_background_color" id="nitea-cookie-info-update-message-background-color" class="color-field" placeholder="#00FF00" value="<?=$nitea_cookie_info['message_background_color']; ?>" />
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<h2><?php _e('Accepteraknapp','nitea-cookie-info'); ?></h2>
				</td>
			</tr>
			<tr>
				<td>
					<?php _e('Text','nitea-cookie-info'); ?>:
				</td>
				<td>
					<input type="text" name="nitea_cookie_info_update_button_text" id="nitea-cookie-info-update-button-text" placeholder="Jag förstår &raquo;" value="<?=$nitea_cookie_info['button_text']; ?>" />
				</td>
			</tr>
			<tr>
				<td>
					<?php _e('Färg','nitea-cookie-info'); ?>:
				</td>
				<td>
					<input type="text" name="nitea_cookie_info_update_button_color" id="nitea-cookie-info-update-button-color" class="color-field" placeholder="#00FF00" value="<?=$nitea_cookie_info['button_color']; ?>" />
				</td>
			</tr>
			<tr>
				<td>
					<?php _e('CSS klass','nitea-cookie-info'); ?>:
				</td>
				<td>
					<input type="text" name="nitea_cookie_info_update_button_class" id="nitea-cookie-info-update-button-class" value="<?=isset($nitea_cookie_info['button_class']) ? $nitea_cookie_info['button_class'] : ''; ?>" />
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<h2><?php _e('Övriga knappar','nitea-cookie-info'); ?></h2>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<strong><?php _e('Skapa fler knappar','nitea-cookie-info'); ?></strong><br>
					<label><?php _e('Placering av knappar, före eller efter accepteraknappen','nitea-cookie-info'); ?></label><br>
					<label><input type="radio" name="extra_button_placement" id="extra-button-placement" value="before" <?=$extra_button_placement_before; ?> /> <?php _e('Före','nitea-cookie-info'); ?></label>
					<label><input type="radio" name="extra_button_placement" id="extra-button-placement" value="after" <?=$extra_button_placement_after; ?> /> <?php _e('Efter','nitea-cookie-info'); ?></label>
					<table class="wp-list-table widefat striped" id="buttons">
						<tbody>
							<tr class="add">
								<td>
									<strong><?php _e('Text','nitea-cookie-info'); ?></strong><br>
									<input type="text" id="nitea-cookie-info-button-link-text-add" placeholder="<?php _e('Text','Läs vår dataskyddspolicy','nitea-cookie-info'); ?>" value="" />
								</td>
								<td>
									<strong><?php _e('Länkurl','nitea-cookie-info'); ?></strong><br>
									<input type="text" id="nitea-cookie-info-button-link-url-add" placeholder="/gdpr/" value="" />
								</td>
								<td>
									<strong><?php _e('Textfärg','nitea-cookie-info'); ?></strong><br>
									<input type="text" id="nitea-cookie-info-button-link-color-add" class="color-field" placeholder="#00FF00" value="" />
								</td>
								<td style="vertical-align: middle;">
									<button type="button" name="nitea_cookie_info_button_link_submit_add" id="nitea-cookie-info-button-link-submit-add" class="button button-primary">+</button>
								</td>
							</tr>
							<?php if(isset($nitea_cookie_info['extra_buttons']) && is_array($nitea_cookie_info['extra_buttons']) && count($nitea_cookie_info['extra_buttons']) > 0) : ?>
								<?php foreach($nitea_cookie_info['extra_buttons'] AS $index => $button) :?>
									<tr>
										<td><input type="text" name="nitea_cookie_info_button[<?=$index;?>][link_text]" class="link-text" value="<?=$button['link_text'];?>" /></td>
										<td><input type="text" name="nitea_cookie_info_button[<?=$index;?>][link_url]" class="link-url" value="<?=$button['link_url'];?>" /></td>
										<td><input type="text" name="nitea_cookie_info_button[<?=$index;?>][link_color]" class="link-color color-field" value="<?=$button['link_color'];?>" /></td>
										<td><button type="button" class="nitea-cookie-info-button-button-remove button">-</button></td>
									</tr>
								<?php endforeach; ?>
							<?php endif; ?>
						</tbody>
					</table>
				</td>
			</tr>
<!-- 			<tr>
				<td colspan="2">
					<h2><?php _e('Länk GDPR','nitea-cookie-info'); ?></h2>
					<p>
						Använd knapparna ovan för bästa resultat.
					</p>
				</td>
			</tr>
			<tr>
				<td>
					<?php _e('Text','nitea-cookie-info'); ?>:
				</td>
				<td>
					<input type="text" name="nitea_cookie_info_update_gdpr_link_text" id="nitea-cookie-info-update-gpdr-link-text" placeholder="Läs vår dataskyddspolicy" value="<?=$nitea_cookie_info['gdpr_link_text']; ?>" />
				</td>
			</tr>
			<tr>
				<td>
					<?php _e('URL','nitea-cookie-info'); ?>:
				</td>
				<td>
					<input type="text" name="nitea_cookie_info_update_gdpr_link_url" id="nitea-cookie-info-update-gdpr-link-url" placeholder="/gdpr/" value="<?=$nitea_cookie_info['gdpr_link_url']; ?>" />
				</td>
			</tr>
			<tr>
				<td>
					<?php _e('Färg','nitea-cookie-info'); ?>:
				</td>
				<td>
					<input type="text" name="nitea_cookie_info_update_gdpr_link_color" id="nitea-cookie-info-update-gdpr-link-color"  class="color-field" placeholder="#00FF00" value="<?=$nitea_cookie_info['gdpr_link_color']; ?>" />
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<h2><?php _e('Länk Cookie','nitea-cookie-info'); ?></h2>
				</td>
			</tr>
			<tr>
				<td>
					<?php _e('Text','nitea-cookie-info'); ?>:
				</td>
				<td>
					<input type="text" name="nitea_cookie_info_update_link_text" id="nitea-cookie-info-update-link-text" placeholder="Läs om Cookies" value="<?=$nitea_cookie_info['link_text']; ?>" />
				</td>
			</tr>
			<tr>
				<td>
					<?php _e('URL','nitea-cookie-info'); ?>:
				</td>
				<td>
					<input type="text" name="nitea_cookie_info_update_link_url" id="nitea-cookie-info-update-link-url" placeholder="/om-cookies/" value="<?=$nitea_cookie_info['link_url']; ?>" />
				</td>
			</tr>
			<tr>
				<td>
					<?php _e('Färg','nitea-cookie-info'); ?>:
				</td>
				<td>
					<input type="text" name="nitea_cookie_info_update_link_color" id="nitea-cookie-info-update-link-color"  class="color-field" placeholder="#00FF00" value="<?=$nitea_cookie_info['link_color']; ?>" />
				</td>
			</tr> -->
		</table>
		<button class="button button-primary" type="submit" name="nitea_cookie_info_update_submit" id="nitea-cookie-info-update-submit">Spara</button>
	</form>
</div>
<?php }


function nitea_cookie_info_load_textdomain() {
	load_plugin_textdomain('nitea-cookie-info',false,dirname(plugin_basename(__FILE__)).'/lang/');
}
add_action('plugins_loaded', 'nitea_cookie_info_load_textdomain');

function nitea_cookie_info() {
}
add_action('wp_footer', 'nitea_cookie_info');
	
function nitea_cookie_info_enqueue_script() {
	$nitea_cookie_info = get_option('nitea_cookie_info');
	$nitea_cookie_info = json_decode($nitea_cookie_info, true);

	wp_register_script('nitea_cookie_info_js', plugins_url('js/public/script.js', __FILE__), array('jquery'), '1.0.0', true);
	wp_enqueue_script('nitea_cookie_info_js');

	wp_localize_script('nitea_cookie_info_js', 'niteaCookieInfoJs', array(
		'pluginsUrl' => plugins_url(),
		'timeout' => isset($nitea_cookie_info['timeout']) && !empty($nitea_cookie_info['timeout']) ? $nitea_cookie_info['timeout'] : 60,
		'url' => plugins_url("/nitea-cookie-info-ajax.php",__FILE__),
		'message_text_size' => (isset($nitea_cookie_info['message_text_size'])) ? $nitea_cookie_info['message_text_size'] : '',
		'message_background_color' => (isset($nitea_cookie_info['message_background_color'])) ? $nitea_cookie_info['message_background_color'] : '',
		'message_text_color' => (isset($nitea_cookie_info['message_text_color'])) ? $nitea_cookie_info['message_text_color'] : '',
		'message_text' => (isset($nitea_cookie_info['message_text'])) ? nl2br($nitea_cookie_info['message_text']) : '',
		'gdpr_link_text' => (isset($nitea_cookie_info['gdpr_link_text'])) ? $nitea_cookie_info['gdpr_link_text'] : '',
		'gdpr_link_color' => (isset($nitea_cookie_info['gdpr_link_color'])) ? $nitea_cookie_info['gdpr_link_color'] : '',
		'gdpr_link_url' => (isset($nitea_cookie_info['gdpr_link_url'])) ? $nitea_cookie_info['gdpr_link_url'] : '',
		'gdpr_link_text' => (isset($nitea_cookie_info['gdpr_link_text'])) ? $nitea_cookie_info['gdpr_link_text'] : '',
		'link_text' => (isset($nitea_cookie_info['link_text'])) ? $nitea_cookie_info['link_text'] : '',
		'link_color' => (isset($nitea_cookie_info['link_color'])) ? $nitea_cookie_info['link_color'] : '',
		'link_url' => (isset($nitea_cookie_info['link_url'])) ? $nitea_cookie_info['link_url'] : '',
		'button_color' => (isset($nitea_cookie_info['button_color'])) ? $nitea_cookie_info['button_color'] : '',
		'button_text' => (isset($nitea_cookie_info['button_text'])) ? $nitea_cookie_info['button_text'] : '',
		'button_class' => (isset($nitea_cookie_info['button_class'])) ? $nitea_cookie_info['button_class'] : '',
		'style' => !empty($nitea_cookie_info['style']) ? $nitea_cookie_info['style'] : "{}",
	));
}
add_action('wp_enqueue_scripts', 'nitea_cookie_info_enqueue_script');


function nitea_cookie_info_enqueue_admin_script() {	
	wp_register_script('nitea_cookie_info_admin_js', plugins_url('js/admin/script.js', __FILE__), array(), '1.0.0', true);
	wp_enqueue_script('nitea_cookie_info_admin_js');
}

add_action('admin_enqueue_scripts', 'nitea_cookie_info_enqueue_admin_script');
/**
 * Update stuff
 */
require 'plugin-update-checker-2.2/plugin-update-checker.php';
$myUpdateChecker = PucFactory::buildUpdateChecker(
    'http://plugin.wordpress.nitea.se/nitea-cookie-info/metadata.json',
    __FILE__
);