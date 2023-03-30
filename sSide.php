<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
if (!isset($_SESSION['session_id'])){
	header('Location: index.php');
}
if (!isset( $_SESSION['kPress'])){
	initGame();
}elseif ($_SESSION['over']==True){
	True;
}elseif ($_GET['t']!=getSymbol()){
	True;
}elseif ($_SESSION['kPress']=="ArrowUp"){
	chgRow(-1);
}elseif ($_SESSION['kPress']=="ArrowDown"){
	chgRow(+1);
}elseif ($_SESSION['kPress']=="ArrowLeft"){
	chgCol(-1);
}elseif ($_SESSION['kPress']=="ArrowRight"){
	chgCol(+1);
}elseif ($_SESSION['kPress']==" "){
	cellSelect();
}
function initGame() {
	$_SESSION['grid'] = array (
		array(" "," "," "),
		array(" "," "," "),
		array(" "," "," ")
		);;
	$_SESSION['cRow'] = 0;
	$_SESSION['cCol'] = 0;
	$_SESSION['moves'] = 0;
	$_SESSION['kPress'] = "Load";
	$_SESSION['choice'] = true;
}
function chgRow($n){
	$_SESSION['cRow'] = ($_SESSION['cRow'] + $n + 3) % 3;	
}
function chgCol($n){
	$_SESSION['cCol'] = ($_SESSION['cCol'] + $n + 3) % 3; 
}
function cellSelect(){
	$row = $_SESSION['cRow'];
	$col = $_SESSION['cCol'];
	$tGrid = $_SESSION['grid'];
	if ($tGrid[$row][$col]== " "){
		$tGrid[$row][$col] = getSymbol();
		$_SESSION['moves'] += 1;
		swapTurn();
	}
	$_SESSION['grid'] = $tGrid;
}
function getSymbol(){
	if ($_SESSION['choice']==true){
		return 'x';
	} else {
		return 'o';
	}
}
function swapTurn(){
	if ($_SESSION['choice']==true){
		$_SESSION['choice']=false;
	} else {
		$_SESSION['choice']=true;
	}
}
function checkWin(){
	$row = $_SESSION['cRow'];
	$col = $_SESSION['cCol'];
	$tGrid = $_SESSION['grid'];
	if ($tGrid[$row][$col] == " "){
		$win = '-';
	} elseif ($row == $col){
		if ($tGrid[0][0] == $tGrid[1][1] and $tGrid[1][1] == $tGrid[2][2]){
			$win = $tGrid[1][1];
		}			
	} elseif ($row + $col == 2){
		if ($tGrid[0][2] == $tGrid[1][1] and $tGrid[1][1] == $tGrid[2][0]){
			$win = $tGrid[1][1];
		}
	} elseif ($tGrid[$row][0] == $tGrid[$row][1] and $tGrid[$row][1] == $tGrid[$row][2]){
		$win=$tGrid[$row][0];
	} elseif ($tGrid[0][$col] == $tGrid[1][$col] and $tGrid[1][$col] == $tGrid[2][$col]){
		$win=$tGrid[0][$col];
	} elseif ($_SESSION['moves']>8){
		$win="D";
	}
	return $win;
}
?>
