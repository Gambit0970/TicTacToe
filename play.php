<?php
require_once "./common/top.php"
?>
<script>
	function updateVariable(value) {
		var xhr = new XMLHttpRequest();
		xhr.open("POST", "update.php", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.onreadystatechange = function() {
		if (xhr.readyState === 4 && xhr.status === 200) {
		// do something if the request was successful
		}
		};
		xhr.send("value=" + encodeURIComponent(value));
	}
    document.addEventListener("keydown", function(event) {
		validKeys = ["ArrowUp","ArrowDown","ArrowLeft","ArrowRight"," "]
		
		if (validKeys.includes(event.key)) {
			updateVariable(event.key);
			location.reload();
		}
    });
</script>
<body>
  <h1>Play Tic Tac Toe online</h1>
  <h2>Controls</h2>
  Use the arrow keys to move round the grid.<br>
  Use the space bar to choose the square you would like to select.<br>
  <br>
  <br>
  <div class="grid-container">
  <?php
    $kPress = $_SESSION['kPress'];
	$cRow = $_SESSION['cRow'];
	$cCol = $_SESSION['cCol'];
	$tGrid = $_SESSION['grid'];
	$sel = ($cRow*3)+$cCol+1;
    for ($row = 0; $row < 3; $row++) {
		for ($col = 0; $col < 3; $col++) {
			$sq = ($row*3)+$col+1;
			if ($tGrid[$row][$col]==" "){
				if ($sel == $sq) {
					$cell = '<div class="grid-mtsel" id='.$sq.'>';
				} else {
					$cell = '<div class="grid-empty" id='.$sq.'>';
				}
				$cell = $cell.$sq.'</div>';
			} else {
				if ($sel == $sq) {
					$cell = '<div class="grid-sel" id='.$sq.'>';
				} else {
					$cell = '<div class="grid-item" id='.$sq.'>';
				}
				$cell = $cell.$tGrid[$row][$col].'</div>';
			}
			echo $cell;
		}
	}
  ?>
  </div>
  <h3>
  <?php
  if (checkWin()=="D"){
	  $_SESSION['over']=True;
	  echo "GAME OVER..... IT WAS A DRAW!";
  } elseif (checkWin()=="x" or checkWin()=="o"){
	  $_SESSION['over']=True;
	  echo strtoupper($_SESSION[checkWin()].' wins!!!!!!');
  } else {
	  if ($_GET['t']!=getSymbol()){
		  echo $_SESSION[getSymbol()]."'s turn";
	  }else{
		  echo 'Your turn';
	  }
  }
  ?>
  </h3>
  <?php
  if (checkWin()=="D" or checkWin()=="x" or checkWin()=="o"){
	  echo '<a href="restart.php">Press Me!</a>';
  }
  ?>
</body>
</html>
