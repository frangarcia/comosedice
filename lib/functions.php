<?php
//Función para comprobar la validez de un correo electrónico
function Check_mail($str) {
	if ((!ereg("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)+$", $str)))
		return false;
	else
		return true;
}

//Función para imprimir una tabla con los mensajes enviados por un usuario
function print_table_messages($phonenumber){
global $string;
global $_SESSION;

require_once("database.php");

	$result = mysql_query("SELECT * FROM comosedice_messages WHERE phonenumber='$phonenumber' ORDER BY date DESC");
	if (mysql_num_rows($result)<=0)
		return $str_output = "<span class=\"error\">".$string['no_messages_sent']."</span>";
	else{
		$str_output = "<table width=\"100%\" >";
		$str_output .= "<tr><th>".$string['source_language']."</th><th>".$string['destiny_language']."</th><th>".$string['content']."</th><th>".$string['translation']."</th><th>".$string['date']."</th></th></tr>";
		while ($row = mysql_fetch_array($result)){
			$str_output .= "<tr><td>".$string[$row['src_lang']]."</td><td>".$string[$row['dest_lang']]."</td><td>".$row['content']."</td><td>".$row['translation']."</td><td>".print_date($row['date'])."</td></td></tr>";
		}
		$str_output .= "</table>";
	}
	return $str_output;
}

//Función para imprimir la fecha en un formato determinado
function print_date($str){
	return substr($str,11,8)." ".substr($str,8,2)."/".substr($str,5,2)."/".substr($str,0,4);
}
?> 
