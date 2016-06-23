<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Prevent the user visiting the logged in page if he/she is already logged in
if(isUserLoggedIn()) { header("Location: account.php"); die(); }

//Forms posted
if(!empty($_POST))
{
	$errors = array();
	$username = sanitize(trim($_POST["username"]));
	$password = trim($_POST["password"]);
	$remember_choice = trim($_POST["remember_me"]);
	//Perform some validation
	//Feel free to edit / change as required
	if($username == "")
	{
		$errors[] = lang("ACCOUNT_SPECIFY_USERNAME");
	}
	if($password == "")
	{
		$errors[] = lang("ACCOUNT_SPECIFY_PASSWORD");
	}

	if(count($errors) == 0)
	{
		//A security note here, never tell the user which credential was incorrect
		if(!usernameExists($username))
		{
			$errors[] = lang("ACCOUNT_USER_OR_PASS_INVALID");
		}
		else
		{
			$userdetails = fetchUserDetails($username);
			//See if the user's account is activated
			if($userdetails["active"]==0)
			{
				$errors[] = lang("ACCOUNT_INACTIVE");
			}
			else
			{
				//Hash the password and use the salt from the database to compare the password.
				$entered_pass = generateHash($password,$userdetails["password"]);
				
				if($entered_pass != $userdetails["password"])
				{
					//Again, we know the password is at fault here, but lets not give away the combination incase of someone bruteforcing
					$errors[] = lang("ACCOUNT_USER_OR_PASS_INVALID");
				}
				else
				{
					//Passwords match! we're good to go'
					
					//Construct a new logged in user object
					//Transfer some db data to the session object
					$loggedInUser = new loggedInUser();
					$loggedInUser->email = $userdetails["email"];
					$loggedInUser->user_id = $userdetails["id"];
					$loggedInUser->hash_pw = $userdetails["password"];
					$loggedInUser->remember_me = $remember_choice;
					$loggedInUser->remember_me_sessid = generateHash(uniqid(rand(), true));
					$loggedInUser->title = $userdetails["title"];
					$loggedInUser->displayname = $userdetails["display_name"];
					$loggedInUser->username = $userdetails["user_name"];
					
					//Update last sign in
					$loggedInUser->updateLastSignIn();
					if($loggedInUser->remember_me == 0)
						{
						    $_SESSION["userCakeUser"] = $loggedInUser;
						}
						else if($loggedInUser->remember_me == 1)
						{
						    updateSessionObj();
						                            
						    $stmt = $mysqli->prepare("INSERT INTO ".$db_table_prefix."sessions VALUES(?, ?, ?)");
						    $stmt->bind_param("iss", time(), serialize($loggedInUser), $loggedInUser->remember_me_sessid);
						    $stmt->execute();
						    $stmt->close();
						                            
						    setcookie("userCakeUser", $loggedInUser->remember_me_sessid, time()+parseLength($remember_me_length));
						}
					
					//Redirect to user account page
					header("Location: account.php");
					die();
				}
			}
		}
	}
}

require_once("models/header.php");

echo "
</div>
<div id='main' class='col-md-10'>";

echo resultBlock($errors,$successes);

echo "
<h2>Login:</h2>
<div id='regbox'>
<form name='login' action='".$_SERVER['PHP_SELF']."' method='post' class='form-horizontal'>
<div class='form-group'>
<label class='col-sm-2 control-label'>Username:</label>
<div class='col-sm-5'>
<input type='text' name='username' class='form-control'>
</div>
</div>
<div class='form-group'>
<label class='col-sm-2 control-label'>Password:</label>
<div class='col-sm-5'>
<input type='password' name='password' class='form-control'>
</div>
</div>
<div class='form-group'>
<div class='col-sm-offset-2 col-sm-5'>
    <div class='checkbox'>
        <label>
			<input type='checkbox' name='remember_me' value='1' />Remember Me?
		</label>
	</div>
</div>
</div>
<div class='form-group'>
<div class='col-sm-offset-2 col-sm-5'>
<input type='submit' value='Login' class='btn btn-default' />
</div>
</div>
</form>
</div>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";

?>
