<?php
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");	
header('Cache-Control: no-store, no-cache, must-revalidate'); 
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Content-Type: text/html; charset=UTF-8');
header('Pragma: no-cache');

session_start("comosedice");
require_once("lib/functions.php");
require_once("lang/es/lang.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="Como Se Dice" />
	<meta name="keywords" content="como,se,dice,traducción,sms" />
	<meta name="author" content="comosedice" />
	<link rel="stylesheet" type="text/css" href="css/styles.css" title="styles" media="screen,projection" />
	<title><? echo $string['title']; ?></title>
</head>

<body>
<div id="wrap">

	<div id="header">
		<p id="toplinks"><a href="register.php"><? echo $string['register']; ?></a> | 
<?
//Si está identificado en el sistema, le mostraré su nombre y un texto para salir del mismo
if (isset($_SESSION['phonenumber']) && ($_SESSION['phonenumber']!=""))
	$login_text = $_SESSION['name'].", <a href=\"logout.php\">".$string['logout']."</a>";
else
	$login_text = "<a href=\"login.php\">".$string['login']."</a>";
?>
		<? echo $login_text; ?></p>
		<h1><a href="index.php"><? echo $string['titlehtml']; ?></a></h1>
		<p id="slogan"><? echo $string['subtitle']; ?></p>
	</div> 
