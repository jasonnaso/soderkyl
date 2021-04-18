<?php
/**
* Plugin Name: Nitea redirect
* Plugin URI: http://plugin.wordpress.nitea.se/nitea-redirect
* Description: Simply add redirects to your website
* Version: 1.6.10
* Author: Nitea AB (Claes Norén)
* Author URI: http://www.nitea.se
* Text Domain: nitea-redirect
* License: GPL12
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if(isset($_GET['nitea-redirect-export'])){
	$nitea_redirect = get_option('nitea_redirect');
	$nitea_redirect = json_decode($nitea_redirect, true);

	if($_GET['nitea-redirect-export'] == 'csv'){
		header("Content-type: text/csv");
		header("Content-Disposition: attachment; filename=nitea-redirect-export.csv");
		header("Pragma: no-cache");
		header("Expires: 0");

		echo '"from","to","status"'."\r\n";
		foreach($nitea_redirect AS $k => $r){
			echo '"'.$k.'","'.$r['to'].'","'.$r['status'].'"'."\r\n";
		}
	}
	if($_GET['nitea-redirect-export'] == 'semicolon'){
		header("Content-type: text/csv");
		header("Content-Disposition: attachment; filename=nitea-redirect-export.csv");
		header("Pragma: no-cache");
		header("Expires: 0");

		echo '"from";"to";"status"'."\r\n";
		foreach($nitea_redirect AS $k => $r){
			echo '"'.$k.'";"'.$r['to'].'";"'.$r['status'].'"'."\r\n";
		}
	}
	if($_GET['nitea-redirect-export'] == 'tab'){
		header('Content-type: text/tab-separated-values');
		header("Content-Disposition: attachment; filename=nitea-redirect-export.txt");
		header("Pragma: no-cache");
		header("Expires: 0");

		echo "from\tto\tstatus\r\n";
		foreach($nitea_redirect AS $k => $r){
			echo $k."\t".$r['to']."\t".$r['status']."\r\n";
		}
	}
	if($_GET['nitea-redirect-export'] == 'json'){
		header('Content-type: text/tab-separated-values');
		header("Content-Disposition: attachment; filename=nitea-redirect-export.json");
		header("Pragma: no-cache");
		header("Expires: 0");

		echo json_encode($nitea_redirect);
	}
	die();
}

add_action('admin_menu','nitea_redirect_admin_menu');
function nitea_redirect_admin_menu() { 
	add_menu_page('Nitea redirect', 'Nitea redirect', 'publish_pages', 'nitea-redirect', 'nitea_redirect_admin_menu_list');
}

function nitea_redirect_admin_menu_list(){ 
	wp_enqueue_script('jquery');
	$nitea_redirect = get_option('nitea_redirect');
	$nitea_redirect = json_decode($nitea_redirect, true);
	
	/**
	 * Save
	 */
	if(isset($_POST['nitea_redirect_insert_submit'])){
		$nitea_redirect[$_POST['nitea_redirect_insert_from_url']] = array(
			'to' => $_POST['nitea_redirect_insert_to_url'],
			'status' => empty($_POST['nitea_redirect_insert_status']) ? 301 : intval($_POST['nitea_redirect_insert_status'])
		);
		update_option('nitea_redirect', json_encode($nitea_redirect));
	}

	if(isset($_GET['delete-from'])){
		
		/**
		 * Remove key and value from array 
		 */
		if(isset($nitea_redirect[$_GET['delete-from']])){
			unset($nitea_redirect[$_GET['delete-from']]);
		}
		update_option('nitea_redirect', json_encode($nitea_redirect));
	}

?>
<div class="wrap">
	<script>
	var $ = jQuery;
	$(function(){
		$(document).on('change', '#nitea-redirect-export-choose', function(e){
			var exportType = $('option:selected',this).val();
			if(exportType.length > 0){
				window.location = ('<?php echo $_SERVER['SCRIPT_NAME']; ?>?page=nitea-redirect&nitea-redirect-export='+exportType);
			}
		});
	});
	</script>
	
	<h1>Nitea redirect</h1>
	<p>
		<?php _e('OBS! Ändra endast dessa inställningar om du är 100% säker på det du ändrar.', 'nitea-redirect'); ?>
	</p>
	<table class="wp-list-table widefat striped" style="max-width: 100%; margin-bottom: 20px;">
		<tr>
			<td>
				<?php _e('Exportera','nitea-redirect'); ?>:
			</td>
			<td>
				<select name="nitea_redirect_export_choose" id="nitea-redirect-export-choose">
					<option value=""><?php _e('Välj','nitea-redirect'); ?></option> 
					<option value="tab"><?php _e('Tab-separerad','nitea-redirect'); ?></option> 
					<option value="semicolon"><?php _e('Semikolon-separerad','nitea-redirect'); ?></option> 
					<option value="tab"><?php _e('Komma-separerad','nitea-redirect'); ?></option>
					<option value="json"><?php _e('json','nitea-redirect'); ?></option>
				</select>
			</td>
		</tr>
	</table>
	<form method="post" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>?page=nitea-redirect" name="nitea_redirect_insert" id="nitea-redirect-insert">
			<table class="wp-list-table widefat striped" style="max-width: 100%; margin-bottom: 20px;">
			<tr>
				<td>
					<?php _e('Från URL','nitea-redirect'); ?>:
				</td>
				<td>
					<input type="text" name="nitea_redirect_insert_from_url" id="nitea-redirect-insert-from-url" placeholder="/fran-sida/" />
				</td>
			</tr>
			<tr>
				<td>
					<?php _e('Till URL','nitea-redirect'); ?>:
				</td>
				<td>
					<input type="text" name="nitea_redirect_insert_to_url" id="nitea-redirect-insert-to-url" placeholder="/till-sida/" />
				</td>
			</tr>
			<tr>
				<td>
					<?php _e('Status','nitea-redirect'); ?>:
				</td>
				<td>
					<input type="text" name="nitea_redirect_insert_status" id="nitea-redirect-insert-status" placeholder="301" />
				</td>
			</tr>
			<tr>
				<td>
					<button class="button button-primary" type="submit" name="nitea_redirect_insert_submit" id="nitea-redirect-insert-submit">Spara</button>
				</td>
			</tr>
		</table>
	</form>
	<?php if($nitea_redirect) : ?>
		<table class="wp-list-table widefat striped" style="max-width: 100%;">
			<thead>
				<tr>
					<th><?php _e('#','nitea-redirect'); ?></th>
					<th><?php _e('Från URL','nitea-redirect'); ?></th>
					<th><?php _e('Till URL','nitea-redirect'); ?></th>
					<th><?php _e('Status','nitea-redirect'); ?></th>
					<th></th>
				</tr>
			</thead>
		<?php $rowNum = 1; foreach($nitea_redirect AS $from => $v) : ?>
			<tr>
				<td><?php echo $rowNum; ?></td>
				<td><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?><?php echo $from; ?>" target="_blank"><?php echo $from; ?></a></td>
				<td><?php echo $v['to']; ?></td>
				<td><?php echo $v['status']; ?></td>
				<td>
					<a class="deletion" href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?page=nitea-redirect&amp;delete-from=<?php echo $from; ?>&amp;delete-to=<?php echo $v['to']; ?>"><?php _e('Ta bort','nitea-redirect'); ?></a>
				</td>
			</tr>
		<?php $rowNum++; endforeach; ?>
		</table>
	<?php endif; ?>

</div>
<?php }


function nitea_redirect_load_textdomain(){
	load_plugin_textdomain('nitea-redirect',false,dirname( plugin_basename(__FILE__)).'/lang/');
}
add_action('plugins_loaded', 'nitea_redirect_load_textdomain');



function nitea_redirect(){
	$request_uri = rtrim($_SERVER['REQUEST_URI'],'/').'/';

	$thisUri 		= $request_uri;
	$thisUri_2 		= rtrim($request_uri,'/');
	$nitea_redirect = get_option('nitea_redirect');
	$nitea_redirect = json_decode($nitea_redirect, true);


	if(isset($nitea_redirect[$thisUri]) && !empty($nitea_redirect[$thisUri])) {
		$status = (isset($nitea_redirect[$thisUri]['status']) && !empty($nitea_redirect[$thisUri]['status'])) ? intval($nitea_redirect[$thisUri]['status']) : 301;

		wp_redirect($nitea_redirect[$thisUri]['to'], $status);
		exit;
	}

	if(isset($nitea_redirect[$thisUri_2]) && !empty($nitea_redirect[$thisUri_2])) {
		$status = (isset($nitea_redirect[$thisUri_2]['status']) && !empty($nitea_redirect[$thisUri_2]['status'])) ? intval($nitea_redirect[$thisUri_2]['status']) : 301;
		
		wp_redirect($nitea_redirect[$thisUri_2]['to'], $status);
		exit;
	}
}
add_action('init', 'nitea_redirect');


/**
 * Update stuff
 */
require 'plugin-update-checker-2.2/plugin-update-checker.php';
$myUpdateChecker = PucFactory::buildUpdateChecker(
    'http://plugin.wordpress.nitea.se/nitea-redirect/metadata.json',
    __FILE__
);