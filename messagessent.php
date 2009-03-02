<?php

include "header.php";

?>

<div id="content">
	<h2><? echo $string['sent_messages']; ?></h2>
<?
require_once("lib/database.php");

if (isset($_SESSION['phonenumber']) && ($_SESSION['phonenumber']!=""))
	echo "<p>".print_table_messages($_SESSION['phonenumber'])."</p>";
else{
	echo "<p>".$string['must_be_login']."</p>";
	echo "<p><a href=\"login.php\">".$string['login']."</a></p>";
}
?>

</div>

<?
include "sidebar.php";

include "footer.php";
?>


