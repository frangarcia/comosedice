<?php

include "header.php";

?>

<div id="content">
	<h2><? echo $string['news']; ?></h2>
<?
require_once("lib/database.php");

if (isset($_GET['id']) && ($_GET['id']!="")){
	//Obtengo la noticia
	$result = mysql_query("SELECT * FROM comosedice_news WHERE id=".$_GET['id']);
	while ($row = mysql_fetch_array($result)){
		echo "<h3>".$row['title']."</h3>";
		echo "<p>".$row['long_description']."</p>";
	}
}
else{
	//Obtengo las últimas noticias
	$result = mysql_query("SELECT * FROM comosedice_news ORDER BY date DESC");
	while ($row = mysql_fetch_array($result)){
		echo "<h3>".$row['title']."</h3>";
		echo "<p>".$row['short_description']."</p>";
		echo "<p style=\"text-align:right;\"><a href=\"news.php?id=".$row['id']."\">".$string['view_more']."</a></p>";
	}
}
?>
	
</div>

<?
include "sidebar.php";

include "footer.php";
?>


