<?php
$dbhost = "";  // El host donde se aloja la base de datos. Normalmente será localhost
$dbname = "";  // El nombre de la base de datos
$dbuser = "";  // El nombre de usuario que tenga acceso a la base de datos
$dbpass = "";  // La contraseña de acceso a la base de datos

$connect = mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db($dbname, $connect);

mysql_query("SET NAMES utf8");
mysql_query("SET collation_connection = 'utf8_unicode_ci'");
?>
