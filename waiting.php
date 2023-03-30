<?php
session_start(); // start the session if it hasn't been started already
header("Refresh:5");
if (isset($_GET['id'])){
	$session_id = $_GET['id'];
	$_SESSION['session_id'] = $session_id;
}
if (isset($_GET['t'])){
	$t = $_GET['t'];
	$_SESSION['t']=$t;
}
if (isset($_SESSION['x']) and isset($_SESSION['o'])){
	header('Location: play.php?id='.$session_id.'&t='.$t);
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1" charset="utf-8" http-equiv="refresh" content="2">
    <title>Tic Tac Toe game</title>

    <link rel='stylesheet' href='style.css' type='text/css'/>
</head>
<body>
  <h1>Play Tic Tac Toe online</h1>
  <h2>
  <?php 
  echo 'Hello '.ucwords($_SESSION[$t]).'. Currently waiting for other player.'
  ?>
  </h2>
  <br>
  <br>
  <br>
  <br>
  </h3>
  <?php
	if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
		$url = "https://";
	} else {
		$url = "http://";
	}
	$url.=$_SERVER['HTTP_HOST'];
	$url.=$_SERVER['REQUEST_URI'];
	$url = str_replace('waiting','index', $url);
	if ($t=='x'){
		$p = 'o';
	}else{
		$p= 'x';
	}
	$url = str_replace('t='.$t,'t='.$p, $url); 
  echo 'Send this link to allow another person to join: '.$url
  ?>
  </h3>
</body>
</html>
