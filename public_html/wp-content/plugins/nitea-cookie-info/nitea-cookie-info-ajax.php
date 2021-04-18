<?php
if(isset($_GET['type']) && $_GET['type'] == 'click') {	
	$timeout = ($_GET['timeout']*60);
	setcookie('nitea_cookie_info_read_status', 'OK', (time()+$timeout), "/");
	$output['nitea_cookie_info_read_status'] = 'OK';
	echo json_encode($output);
}

if(isset($_GET['type']) && $_GET['type'] == 'get-status') {	
	require_once $_SERVER['DOCUMENT_ROOT'].'/wp-config.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/wp-includes/wp-db.php';

	$res = array();

	$nitea_cookie_info = get_option('nitea_cookie_info');
	$nitea_cookie_info = json_decode($nitea_cookie_info, true);	
	$res['show'] = false;
	if(isset($nitea_cookie_info['active']) && $nitea_cookie_info['active'] == '1') {	
		$res['show'] = false;
		
		if(!isset($_COOKIE['nitea_cookie_info_read_status'])) {
			$res = $nitea_cookie_info;
			$res['show'] = true;
		}
	}
	header('content-type: application/json');
	echo json_encode($res);
}

?>