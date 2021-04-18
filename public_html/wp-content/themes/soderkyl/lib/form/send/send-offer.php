<?php

header('Content-type: application/json');

date_default_timezone_set('Europe/Stockholm');

$response = array('status' => 'fail');

$captcha = null;

if (isset($_POST['g-recaptcha-response']))
{
    $captcha = $_POST['g-recaptcha-response'];
}

if ($captcha)
{
	$secret_key = "6Lc5VJUUAAAAANuZ9odNMLSsaTkmpIygx2d6W0i_";

	$response = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secret_key) .  '&response=' . urlencode($captcha)), true);

    if (array_key_exists('success', $response) && $response['success'] === true)
    {
		require_once $_SERVER['DOCUMENT_ROOT'] . '/wp-config.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/wp-includes/wp-db.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/wp-includes/post.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/wp-includes/class-phpmailer.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/wp-includes/class-smtp.php';

		// SMTP settings
		$smtp_server_address = get_field('smtp_server_address','options');
		$smtp_server_secure = get_field('smtp_server_secure','options');
		$smtp_server_port = get_field('smtp_server_port','options');
		$smtp_server_username = get_field('smtp_server_username','options');
		$smtp_server_password = get_field('smtp_server_password','options');
		$smtp_server_from_email_address = get_field('smtp_server_from_email_address','options');

		$from_name = $_POST['name'];
		$from_email = $_POST['email'];

		$product_category = get_term($_POST['post_id'], 'produktkategori');

		$body =  'Fabrikat: ' . $_POST['manufacturer'] . "\n";
		$body .=  'Modell: ' . $_POST['model'] . "\n";
		$body .=  'Produktnummer: ' . $_POST['product_number'] . "\n";
		$body .=  'Serienummer: ' . $_POST['serial_number'] . "\n";
		$body .=  'Företag: ' . $_POST['company'] . "\n";
		$body .=  'Namn: ' . $_POST['name'] . "\n";
		$body .=  'Telefon: ' . $_POST['phone'] . "\n";
		$body .=  'E-postadress: ' . $_POST['email'] . "\n";
		$body .=  'Leveranssätt: ' . $_POST['delivery_option'] . "\n";
		$body .= 'Meddelande: ' . $_POST['message'] . "\n\n";
		$body .= 'Meddelandet skickades från: ' . get_term_link($product_category, 'produktkategori');


		$mail = new PHPMailer();
		// $mail->SMTPDebug = 2;
		$mail->SMTPAuth = true;
		$mail->IsSMTP();
		$mail->Username = $smtp_server_username;
		$mail->Password = $smtp_server_password;
		$mail->Host = $smtp_server_address;
		$mail->Port = $smtp_server_port;
		$mail->SMTPSecure = $smtp_server_secure;
		$mail->SetFrom($smtp_server_from_email_address, $from_name);
		$mail->AddReplyTo($from_email, $from_name);
		$mail->Subject = 'Ansökan om Service från hemsidan';
		$mail->Body = $body;
		$mail->ContentType = 'text/plain';
		$mail->IsHTML(FALSE);
		$mail->WordWrap = 50;
		$mail->CharSet = 'UTF-8';

		if (isset($_FILES['attachment']))
		{
			$mail->AddAttachment($_FILES['attachment']['tmp_name'], $_FILES['attachment']['name']);
		}

		$form_recipient_repeater = get_field('form_recipient_repeater', get_term($_POST['post_id']));

		if ($form_recipient_repeater)
		{
			foreach ($form_recipient_repeater AS $k => $r)
			{
				$mail->AddAddress($r['email_address'], $r['name']);
			}
		}
		else
		{
			$mail->AddAddress('info@soderkyl.se', 'Söderkyl Offertformulär');
		}

		if (!$mail->Send())
		{
			$response = array('status' 	=> 'fail', 'error' => $mail->ErrorInfo);
		}
		else
		{
			$response = array('status' => 'ok');
		}
	}
}

echo json_encode($response);
