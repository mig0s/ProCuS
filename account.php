<?php

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once("models/header.php");
$ids = new ArrayObject(array());
GLOBAL $mysqli;
GLOBAL $loggedInUser;
$userID = $loggedInUser->user_id;
$sql = "SELECT * FROM usersachieves WHERE boardid IN ( SELECT id FROM board WHERE userid = '$userID')";
$result = mysqli_query($mysqli,$sql);

while($out = mysqli_fetch_assoc($result)) {
	$ids->append($out['id']);
}

function boardOut()
{
	GLOBAL $mysqli;
	GLOBAL $loggedInUser;
	$userID = $loggedInUser->user_id;
	$sql = "SELECT * FROM usersachieves WHERE boardid IN ( SELECT id FROM board WHERE userid = '$userID')";
	$result = mysqli_query($mysqli,$sql);
	$idsOut = new ArrayObject(array());

	while($out = mysqli_fetch_assoc($result)) {
		$idsOut->append($out['id']);

		if ($out['level'] == '1') {
	    	echo "<div id='lvl1' class='record'>&nbsp;</div>";
		}
			elseif ($out['level'] == '2')
		{
			echo "<div id='lvl2' class='record'>&nbsp;</div>";
		}
			elseif ($out['level'] == '3')
		{
			echo "<div id='lvl3' class='record'>&nbsp;</div>";
		}
			elseif ($out['level'] == '4')
		{
			echo "<div id='lvl4' class='record'>&nbsp;</div>";
		}
			elseif ($out['level'] == '5')
		{
			echo "<div id='lvl5' class='record'>&nbsp;</div>";
		}
	}
}

function boardAdd($level)
{
	GLOBAL $mysqli;
	GLOBAL $loggedInUser;
	GLOBAL $ids;
	if (count($ids) > 199) {
		echo '<script type="text/javascript">alert("You have reached the limit of 200 records!");window.location.href="account.php";</script>';
	} else {
	$userID = $loggedInUser->user_id;
	$boardid = mysqli_query($mysqli,"SELECT id FROM board WHERE userid = '$userID'");
	$board = mysqli_fetch_assoc($boardid);
	$sql = "INSERT INTO usersachieves (boardid, level) VALUES ('{$board['id']}', '$level')";
	mysqli_query($mysqli,$sql);
	echo '<script type="text/javascript">window.location.href="account.php";</script>'; 
	}
}

function boardDel(){
	GLOBAL $mysqli;
	GLOBAL $loggedInUser;
	GLOBAL $ids;
	$id = (string) $ids[count($ids)-1];
	$sql = "DELETE FROM usersachieves WHERE id = '$id'";
	mysqli_query($mysqli,$sql);
	echo '<script type="text/javascript">window.location.href="account.php";</script>'; 
}

function counter(){
	GLOBAL $mysqli;
	GLOBAL $loggedInUser;
	$userID = $loggedInUser->user_id;
	$sql = "SELECT count(id) as result_count FROM usersachieves WHERE boardid IN ( SELECT id FROM board WHERE userid = '$userID')";
	$result = mysqli_query($mysqli,$sql);
	$out = mysqli_fetch_assoc($result);
	echo "<h2>Achievements: ".$out[result_count]."</h2>";
}

echo "
</div>
<div id='main' class='col-md-10'>
<div id='regbox'>
<p class='lead'>
Welcome, $loggedInUser->displayname. You are with us since " . date("M d, Y", $loggedInUser->signupTimeStamp()) . ".
</p>
<form method='post'>
<input class='btn btn-lg btn-danger' type='submit' value='1' name='add1'></input>
<input class='btn btn-lg btn-warning' type='submit' value='2' name='add2'></input>
<input class='btn btn-lg btn-success' type='submit' value='3' name='add3'></input>
<input class='btn btn-lg btn-info' type='submit' value='4' name='add4'></input>
<input class='btn btn-lg btn-primary' type='submit' value='5' name='add5'></input>
<input class='btn btn-lg' type='submit' value='Cancel' name='del'></input>
</form>
<div class='board'>";
counter();
boardOut();
echo "</div><hr></div></div>
<div id='bottom'></div>
</div>
</body>
</html>";

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