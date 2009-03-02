<?php
require_once("lib/conf.php");
require_once("lang/es/lang.php");
require_once("lib/database.php");
require_once("lib/functions.php");
?>

<div id="sidebar">
	<h2><a href="examples.php"><? echo $string['examples']; ?></a></h2>
	<h2><? echo $string['code_languages']; ?></h2>
	<ul>
<?
	foreach ($available_languages as $language){
		echo "<li><a href=\"examples.php?id_language=$language\">$language: ".$string[$language]."</a></li>";
	}
?>
	</ul>

	<h2><a href="news.php"><? echo $string['news']; ?></a></h2>
<?
	//Obtengo las 3 últimas noticias
	$result = mysql_query("SELECT * FROM comosedice_news ORDER BY date DESC LIMIT 0,3");
	while ($row = mysql_fetch_array($result)){
		echo "<p><strong>".print_date($row['date'])."</strong><br/>".$row['title']." <a href=\"news.php?id=".$row['id']."\">[+]</a></p>";
	}

?>

	<h2><? echo $string['interesting_links']; ?></h2>
	<ul>
<?
	//Obtengo los enlaces interesantes
	$result = mysql_query("SELECT * FROM comosedice_links ORDER BY title DESC LIMIT 0,3");
	while ($row = mysql_fetch_array($result)){
		echo "<li><a href=\"".$row['link']."\" target=\"_blank\">".$row['title']."</a></li>";
	}

?>
	</ul>
</div> 
