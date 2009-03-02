<?php
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");	
header('Cache-Control: no-store, no-cache, must-revalidate'); 
header('Cache-Control: post-check=0, pre-check=0', FALSE);
//header('Content-Type: text/html; charset=UTF-8');
header('Pragma: no-cache');

//Este script pretende leer el contenido de una dirección de correo electrónico
//para analizar los últimos mensajes recibidos. Mostrará el título de los últimos 5 mensajes.
require_once("../lib/api.php");
require_once("../lib/APISMS.php");
require_once("../lib/database.php");
require_once("../lib/conf.php");

$mbox = imap_open ($imap_connection_string, $imap_connection_mail,$imap_connection_pwd)
     or die("can't connect: " . imap_last_error());
$infombox = imap_mailboxmsginfo($mbox);

$num_msg = imap_num_msg($mbox);
$num_msg_rec = imap_num_recent($mbox);

$sw = true;
for($i=$infombox->Unread;$i>0;$i--){
	$current_message = $num_msg - $i + 1;
	$msg = imap_fetch_overview($mbox,$current_message);
	imap_setflag_full($mbox, imap_uid($mbox, $current_message), "\\Seen \\Flagged", ST_UID);
	if ($msg[0]->subject=="OPEN SMS"){
		$bError = false;
		$body = imap_fetchbody($mbox,$msg[0]->msgno,1);
		$info = split("\n",$body,2);
		if (substr($info[0],0,5)=="Movil"){
			$movil = trim(substr($info[0],6,strlen($info[0])));
			$movilshort = substr($movil,2);
			$langsrc = strtolower(substr($info[1],6,2));
			$langdes = strtolower(substr($info[1],9,2));
			//Compruebo si los idiomas escogidos están entre los aceptados
			if (!(in_array($langsrc,$available_languages)) || !(in_array($langdes,$available_languages)))//Alguno de los idiomas enviados no están aceptados por la aplicación
				$bError = true;
			$text = substr($info[1],12,strlen($info[1]));
			$text2 = utf8_decode($text);
			$text3 = utf8_decode($text);
			
			$g = new Google_API_translator();
			$g->setOpts(array("text" => $text, "language_pair" => "$langsrc|$langdes"));
			$g->translate();
			$translated = $g->out;
			
			//Ahora trato de mandar el mensaje de vuelta al usuario
			$sms = new MensajeriaWeb();
			//El primer mensaje que mande, será gratuito, con lo que debo comprobar si este ha mandado algún mensaje en este día
			$result_check = mysql_query("SELECT DATE(date) FROM comosedice_messages WHERE phonenumber='$movilshort' AND DATE(date)=CURDATE()");
			if ((mysql_num_rows($result_check)<=0) && ($first_message_free)){//El mensaje lo enviamos nosotros si está configurado así en la aplicación
				$log = $ourphonenumber;
				$pwd = $oursecretcode;

			}
			else{//El usuario deberá estar registrado para que se le envie el mensaje
				//En primer lugar trato de obtener el password del usuario que ha enviado el mensaje
				$result_user = mysql_query("SELECT secretcode FROM comosedice_users WHERE phonenumber='$movilshort'");
				if (mysql_num_rows($result_user)>0){//existe el usuario
					$row_user = mysql_fetch_array($result_user);
					$log = $movilshort;
					$pwd = $row_user['secretcode'];
				}
				else
					$bError = true;
				
			}
			if (!$bError){//Si no hay errores
				if ($sendmessages){// Si la aplicación permite el envio de mensajes desde el conf.php, mando el mensaje
					$dest = "00$movil";
					$msg = $translated;
 					$sms->EnviaMensaje($log, $pwd, $dest, $msg);
 				}
				//Antes almaceno el mensaje en la base de datos para tener constancia del hecho
				mysql_query("INSERT INTO comosedice_messages (phonenumber, content, src_lang, dest_lang, translation) VALUES ('$movilshort', '$text', '$langsrc', '$langdes', '$translated')"); 				
 			}
		}
	}
}
?>
