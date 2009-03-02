<?php

include "header.php";

?>

<div id="content">
	<h2><? echo $string['what_is']; ?></h2>
	<img src="images/example.jpg" width="280" height="144" alt="Example right-aligned image" class="right photo" />
	<p><? echo $string['description_what_is']; ?></p>

	<h2><? echo $string['what_have_to_do']; ?></h2>
	<p><? echo $string['description_what_have_to_do']; ?></p>

	<h2><? echo $string['how_much']; ?></h2>
	<p><? echo $string['description_how_much']; ?></p>
</div>

<?
include "sidebar.php";

include "footer.php";
?>


