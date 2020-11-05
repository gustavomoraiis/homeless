<?php
header('Content-type: application/json');
require_once('php-mailer/PHPMailerAutoload.php'); // Include PHPMailer

$mail = new PHPMailer();
$mail->setLanguage('br');
$emailTO = $emailBCC =  $emailCC = array();

// Enter Your Sitename 
$sitename = 'LT Imóveis';

// Enter your email addresses: @required
// $emailTO[] = array( 'email' => 'gelatinacfal@gmail.com', 'name' => 'LT Imóveis' ); 


// Enable bellow parameters & update your BCC email if require.
//$emailBCC[] = array( 'email' => 'leandro@datacampo.com.br', 'name' => 'Leandro' ); 
//$emailBCC[] = array( 'email' => 'email@yoursite.com', 'name' => 'Your Name' );

// Enable bellow parameters & update your CC email if require.
//$emailCC[] = array( 'email' => 'email@yoursite.com', 'name' => 'Your Name' );

// Enter Email Subject
$subject = "Novo contato"; 

// Success Messages
$msg_success = "Nós <strong>recebemos</strong> sua mensagem. Logo entraremos em contato.";

if( $_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST["quote-request-email"]) && $_POST["quote-request-email"] != '' && isset($_POST["quote-request-name"]) && $_POST["quote-request-name"] != '') {
		// Form Fields
		$qr_name	= $_POST["quote-request-name"];
		$qr_email	= $_POST["quote-request-email"];
		$qr_email2	= $_POST["quote-request-email2"];
		$emailTO[] = array( 'email' => $qr_email2, 'name' => 'LT Imóveis' );
		$qr_phone	= isset($_POST["quote-request-phone"]) ? $_POST["quote-request-phone"] : null;
		$qr_objetivo = $_POST["quote-request-objetivo"];
		$qr_tipo = $_POST["quote-request-tipo"];
		$qr_endereco = $_POST["quote-request-endereco"];
		$qr_cidade = $_POST["quote-request-cidade"];
		$qr_estado = $_POST["quote-request-estado"];

		// $qr_email	= $_POST["quote-request-email"];
		// $qr_name	= $_POST["quote-request-name"];
		$subject = isset($_POST["quote-request-objetivo"]) ? $_POST["quote-request-objetivo"] : 'Novo contato';
		$subject .=  ' - ' . $sitename;
		// $qr_phone	= isset($_POST["quote-request-phone"]) ? $_POST["quote-request-phone"] : null;
		// $qr_company	= isset($_POST["quote-request-company"]) ? $_POST["quote-request-company"] : null;
		// $qr_reach	= isset($_POST["quote-request-reach"]) ? $_POST["quote-request-reach"] : null;
		// $qr_hear	= isset($_POST["quote-request-hear"]) ? $_POST["quote-request-hear"] : null;

		// $qr_interest = isset($_POST["quote-request-interest"]) ? $_POST["quote-request-interest"] : null;
		// $qr_interested = '';
		// if (is_array($qr_interest)) {
		// 	foreach ($qr_interest as $interest) {
		// 		$qr_interested .= ', '.$interest;
		// 	}
		// } else {
		// 	$qr_interested = $qr_interest;
		// }
		// $qr_interested = ($qr_interested !='') ? substr($qr_interested, 2) : '';

		// $qr_message	= isset($_POST["quote-request-message"]) ? $_POST["quote-request-message"] : null;

		$honeypot 	= isset($_POST["form-anti-honeypot"]) ? $_POST["form-anti-honeypot"] : '';
		$bodymsg	= '';
		
		if ($honeypot == '' && !(empty($emailTO))) {
			$mail->IsHTML(true);
			$mail->CharSet = 'UTF-8';

			$mail->From = $qr_email2;
			$mail->FromName = $sitename;
			$mail->AddReplyTo($qr_email);
			$mail->Subject = $subject;
			
			foreach( $emailTO as $to ) {
				$mail->AddAddress( $to['email'] , $to['name'] );
			}
			
			// if CC found
			if (!empty($emailCC)) {
				foreach( $emailCC as $cc ) {
					$mail->AddCC( $cc['email'] , $cc['name'] );
				}
			}
			
			// if BCC found
			if (!empty($emailBCC)) {
				foreach( $emailBCC as $bcc ) {
					$mail->AddBCC( $bcc['email'] , $bcc['name'] );
				}				
			}

			// Include Form Fields into Body Message
			$bodymsg .= isset($qr_name) ? "Nome: $qr_name<br><br>" : '';
			$bodymsg .= isset($qr_email) ? "E-mail: $qr_email<br><br>" : '';
			$bodymsg .= isset($qr_phone) ? "Fone: $qr_phone<br><br>" : '';
			$bodymsg .= isset($qr_objetivo) ? "Obejetivo: $qr_objetivo<br><br><br>" : '';
			$bodymsg .= isset($qr_tipo) ? "Tipo da Propriedade: $qr_tipo<br><br>" : '';
			$bodymsg .= isset($qr_endereco) ? "Endereço: $qr_endereco<br><br>" : '';
			$bodymsg .= isset($qr_cidade) ? "Cidade: $qr_cidade<br><br><br>" : '';
			$bodymsg .= isset($qr_estado) ? "Estado: $qr_estado<br><br>" : '';
			$bodymsg .= $_SERVER['HTTP_REFERER'] ? '<br>---<br><br>E-mail enviado de: ' . $_SERVER['HTTP_REFERER'] : '';
			
			$mail->MsgHTML( $bodymsg );
			$is_emailed = $mail->Send();

			if( $is_emailed === true ) {
				$response = array ('result' => "success", 'message' => $msg_success);
			} else {
				$response = array ('result' => "error", 'message' => $mail->ErrorInfo);
			}
			echo json_encode($response);
			
		} else {
			echo json_encode(array ('result' => "error", 'message' => "Robô <strong>detectado</strong>! Tente novamente mais tarde."));
		}
	} else {
		echo json_encode(array ('result' => "error", 'message' => "por favor <strong>preencha</strong> todos os campos obrigatórios."));
	}
}