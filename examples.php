<?php

include "header.php";

?>

<div id="content">
	<h2><? echo $string['examples']; ?></h2>
<?
require_once("lib/database.php");

if (isset($_GET['id_language']) && ($_GET['id_language']!="")){
	//Obtengo la noticia
	$result = mysql_query("SELECT * FROM comosedice_examples WHERE src_lang='".$_GET['id_language']."' OR dest_lang='".$_GET['id_language']."'");
	while ($row = mysql_fetch_array($result)){
		echo "<p><a href=\"examples.php?id_language=".$row['src_lang']."\">".$row['src_lang']."</a>=&gt;<a href=\"examples.php?id_language=".$row['dest_lang']."\">".$row['dest_lang']."</a>: ".$row['content']." = ".$row['translation']."</p>";
	}
}
else{
	//Obtengo las últimas noticias
	$result = mysql_query("SELECT * FROM comosedice_examples ORDER BY src_lang DESC");
	while ($row = mysql_fetch_array($result)){
		echo "<p><a href=\"examples.php?id_language=".$row['src_lang']."\">".$row['src_lang']."</a>=&gt;<a href=\"examples.php?id_language=".$row['dest_lang']."\">".$row['dest_lang']."</a>: ".$row['content']." = ".$row['translation']."</p>";
	}
}
?>
	
</div>

<?
include "sidebar.php";

include "footer.php";
?>


