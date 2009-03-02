<?
session_start("comosedice");
require_once("lang/es/lang.php");

$bError = true;
if (count($_POST)>0){//Viene a registrarse
	require_once("lib/database.php");
	
	if ($_POST['phonenumber']==""){
		$error_message_phonenumber = "<span class='error'>".$string['phonenumber_empty']."</span>";						
		$class_input_error_phonenumber = "class='inputerror'";
	}
	else{
		if ($_POST['secretcode']==""){
			$error_message_secretcode = "<span class='error'>".$string['secretcode_empty']."</span>";						
			$class_input_error_secretcode = "class='inputerror'";	
		}
		else{
			//Compruebo si este usuario está en nuestra base de datos
			$result = mysql_query("SELECT phonenumber FROM comosedice_users WHERE phonenumber='".$_POST['phonenumber']."'");
			if (mysql_num_rows($result)<=0){//El usuario no está registrado
				$error_message_phonenumber = "<span class='error'>".$string['phonenumber_not_registered']."</span>";
				$class_input_error_phonenumber = "class='inputerror'";
			}	
			else{
				//Compruebo si este usuario está en nuestra base de datos
				$result = mysql_query("SELECT name, secretcode, phonenumber FROM comosedice_users WHERE phonenumber='".$_POST['phonenumber']."' AND secretcode='".$_POST['secretcode']."'");
				if (mysql_num_rows($result)<=0){//El password no es correcto
					$error_message_secretcode = "<span class='error'>".$string['password_not_correct']."</span>";
					$class_input_error_secretcode = "class='inputerror'";
				}	
				else{
					$bError = false;
					$row = mysql_fetch_array($result);
					$_SESSION['name'] = $row['name'];
					$_SESSION['phonenumber'] = $row['phonenumber'];
				}
			}
		}
	}
}

if ($bError){

include "header.php";

?>
<div id="content">
<h2><? echo $string['login']; ?></h2>	
<form action="login.php" method="post">
	<fieldset>
		<legend><? echo $string['data_connection']; ?></legend>
		<label for="phonenumber"><? echo $string['phonenumber']; ?>:</label> <input type="text" name="phonenumber" size="10" <? echo $class_input_error_phonenumber; ?> value="<? echo $_POST['phonenumber']; ?>"/><? echo $error_message_phonenumber; ?> <br />
		<label for="password"><? echo $string['password']; ?>:</label> <input type="password" name="secretcode" size="10" <? echo $class_input_error_secretcode; ?>/><? echo $error_message_secretcode; ?> <br />
	</fieldset>
	<input type="submit" value="<? echo $string['login']; ?>"/>
</form>
</div>
<?
include "sidebar.php";

include "footer.php";
}
else{
	header("Location: messagessent.php");
}//fin else
?>
