<?php
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

header('location : /account.php');

if(isset($_POST['add1'])){
	boardAdd('1');
}
if(isset($_POST['add2'])){
	boardAdd('2');
}
if(isset($_POST['add3'])){
	boardAdd('3');
}
if(isset($_POST['add4'])){
	boardAdd('4');
}
if(isset($_POST['add5'])){
	boardAdd('5');
}
if(isset($_POST['del'])){
	boardDel();
}

function boardOut()
{
	GLOBAL $mysqli;
	GLOBAL $loggedInUser;
	$userID = $loggedInUser->user_id;
	$sql = "SELECT * FROM usersachieves WHERE boardid IN ( SELECT id FROM board WHERE userid = '$userID')";
	$result = mysqli_query($mysqli,$sql);
	echo "<h2>Output:</h2>";
	while($out = mysqli_fetch_assoc($result)) {
		if ($out['level'] == '1') {
	    	echo "<div id='lvl1' value='{$out['id']}'>{$out['level']} </div>";
		}
			elseif ($out['level'] == '2')
		{
			echo "<div id='lvl2' value='{$out['id']}'>{$out['level']} </div>";
		}
			elseif ($out['level'] == '3')
		{
			echo "<div id='lvl3' value='{$out['id']}'>{$out['level']} </div>";
		}
			elseif ($out['level'] == '4')
		{
			echo "<div id='lvl4' value='{$out['id']}'>{$out['level']} </div>";
		}
			elseif ($out['level'] == '5')
		{
			echo "<div id='lvl5' value='{$out['id']}'>{$out['level']} </div>";
		}
	}
}

function boardAdd($level)
{
	GLOBAL $mysqli;
	GLOBAL $loggedInUser;
	$userID = $loggedInUser->user_id;
	$boardid = mysqli_query($mysqli,"SELECT id FROM board WHERE userid = '$userID'");
	$board = mysqli_fetch_assoc($boardid);
	$sql = "INSERT INTO usersachieves (boardid, level) VALUES ('{$board['id']}', '$level')";
	mysqli_query($mysqli,$sql);

}

function boardDel(){
	echo 'deleted';
}

?>