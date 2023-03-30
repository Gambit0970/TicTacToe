<?php
session_start();
if (isset($_POST['create_session'])) {
	if (isset ($_GET['id'])){
		$session_id = $_GET['id'];
		$_SESSION['session_id'] = $session_id;
	}else{
		if (!isset($_SESSION['session_id'])) {
			$session_id = uniqid();
			$_SESSION['session_id'] = $session_id;
		}else{
			$session_id = $_SESSION['session_id'];
		}
	}
	setNames();
	header('Location: waiting.php?id='.$session_id.'&t='.$_SESSION['t']);
}
function setNames(){
	if (isset($_GET['t'])){
		$t = $_GET['t'];
	} else {
		$i = rand(0,100);
		if ($i % 2 == 0){
			$t = 'x';
		}else{
			$t = 'o';
		}
	}
	$_SESSION['t']=$t;
	$_SESSION[$t]=$_POST['uName'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1" charset="utf-8" http-equiv="refresh" content="5">
    <title>Tic Tac Toe game</title>

    <link rel='stylesheet' href='style.css' type='text/css'/>
</head>
<body>
  <h1>Play Tic Tac Toe online</h1>
  <h2>Welcome</h2>
  Enter your name to continue.<br>
  <br>
  <br>
  <br>
  <form method="post">
  <div>
  <label for="uName" >Please enter your name:</label>
  <input type="text" id="uName" name="uName">
  <?php
  if (!isset($_SESSION['session_id'])){
	  $text = "Create Game!";
  }else{
	  $text = "Join Game!";
  }
  echo '<button class="repeat" type="submit" name="create_session">'.$text.'</button>';

  ?>
  <div>
  </form>
</body>
</html>
