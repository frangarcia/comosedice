<?php

include "header.php";

?>

<div id="content">
	<h2><? echo $string['register']; ?></h2>
<?
$bError = true;
if (count($_POST)>0){//Viene a registrarse
	require_once("lib/database.php");
	
	if ($_POST['name']==""){
		$error_message_name = "<span class='error'>".$string['name_empty']."</span>";						
		$class_input_error_name = "class='inputerror'";
	}
	else{
		if ($_POST['email']==""){
			$error_message_email = "<span class='error'>".$string['email_empty']."</span>";						
			$class_input_error_email = "class='inputerror'";	
		}
		else{
			//Compruebo que el mail tenga un formato correcto
			if (!check_mail($_POST['email'])){
				$error_message_email = "<span class='error'>".$string['email_not_valid']."</span>";			
				$class_input_error_email = "class='inputerror'";
			}		
			else{
				if ($_POST['phonenumber']==""){
					$error_message_phonenumber = "<span class='error'>".$string['phonenumber_empty']."</span>";						
					$class_input_error_phonenumber = "class='inputerror'";	
				}
				else{
					//Compruebo si el número de móvil introducido ya existe en nuestra base de datos
					$result = mysql_query("SELECT phonenumber FROM comosedice_users WHERE phonenumber='".$_POST['phonenumber']."'");
					if (mysql_num_rows($result)>0){//Este móvil ya existe en la base de datos
						$error_message_phonenumber = "<span class='error'>".$string['phonenumber_already_registered']."</span>";
						$class_input_error_phonenumber = "class='inputerror'";
					}	
					else{
						if ($_POST['secretcode']==""){
							$error_message_secretcode = "<span class='error'>".$string['secretcode_empty']."</span>";										
							$class_input_error_secretcode = "class='inputerror'";
						}
						else{
							$bError = false;
							mysql_query("INSERT INTO comosedice_users (name, email, phonenumber, secretcode) VALUES ('".$_POST['name']."','".$_POST['email']."','".$_POST['phonenumber']."','".$_POST['secretcode']."')");										
						}
					}			
				}	
			}
		}
	}
}

if ($bError){
?>	
<div><? echo $string['register_description']; ?></div>
<form action="register.php" method="post">
	<fieldset>
		<legend><? echo $string['data_contact']; ?></legend>
		<? echo $string['description_data_contact']; ?>: <br />
		<label for="name"><? echo $string['name']; ?>:</label> <input type="text" name="name" size="30" <? echo $class_input_error_name; ?> value="<? echo $_POST['name']; ?>"/><? echo $error_message_name; ?> <br />
		<label for="email"><? echo $string['email']; ?>:</label> <input type="text" name="email" size="30" <? echo $class_input_error_email; ?> value="<? echo $_POST['email']; ?>"/><? echo $error_message_email; ?> <br />
	</fieldset>
	
	<fieldset>
		<legend><? echo $string['data_connection']; ?></legend>
		<? echo $string['description_data_connection']; ?>: <br />
		<label for="phonenumber"><? echo $string['phonenumber']; ?>:</label> <input type="text" name="phonenumber" size="10" <? echo $class_input_error_phonenumber; ?> value="<? echo $_POST['phonenumber']; ?>"/><? echo $error_message_phonenumber; ?> <br />
		<label for="password"><? echo $string['password']; ?>:</label> <input type="password" name="secretcode" size="10" <? echo $class_input_error_secretcode; ?>/><? echo $error_message_secretcode; ?> <br />
	</fieldset>
	<input type="submit" value="<? echo $string['register']; ?>"/>
</form>
<?
}
else{
?>
	<p><? echo $string['ok_registration']; ?></p>
<?
}//fin else
?>
</div>

<?

include "sidebar.php";

include "footer.php";
?>
