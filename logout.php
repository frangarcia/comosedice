<?php

session_start("comosedice");

session_destroy();

header("Location: index.php");

?>

