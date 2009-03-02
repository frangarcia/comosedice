<?php

$available_languages = array("en","es","de","fr","ca");

//Los datos del móvil para mandar mensajes gratuitos
$ourphonenumber = "";//Aquí vendrá el número de teléfono
$oursecretcode = "";//Aquí el código secreto proporcionado para este número de teléfono

//Sirve para activar o desactivar que el primer mensaje es gratuito
$first_message_free = true;

//Sirve para activar o desactivar el envio de mensajes. Servirá para hacer pruebas
$sendmessages = true;

//Datos de acceso al correo electrónico
$imap_connection_string = "{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX";//Si tu correo no es gmail, deberás cambiar esta variable por su correspondiente
$imap_connection_mail = "";//Aquí irá el correo electrónico
$imap_connection_pwd = "";//Aquí irá la contraseña de acceso al correo electrónico

?> 
