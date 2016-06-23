<?php
if (!securePage($_SERVER['PHP_SELF'])){die();}
//Links for logged in user
if(isUserLoggedIn()) {
	echo "
	<ul>
	<li><b>Menu:</b></li>
	<li><a href='account.php'>My Board</a></li>
	<li><a href='user_settings.php'>My Settings</a></li>
	<li><a href='instruction.php'>Instruction</a></li>
	<li><a href='logout.php'>Logout</a></li>
	</ul>";
	//Links for permission level 2 (default admin)
	if ($loggedInUser->checkPermission(array(2))){
	echo "
	<ul>
	<li><b>Admin Menu:</b></li>
	<li><a href='admin_configuration.php'>Configuration</a></li>
	<li><a href='admin_users.php'>Manage Users</a></li>
	<li><a href='admin_permissions.php'>Manage Permissions</a></li>
	<li><a href='admin_pages.php'>Manage Pages</a></li>
	<li><a href='report.php'>Report</a></li>
	</ul>";
	}
} 
//Links for users not logged in
else {
	echo "
	<ul>
	<li><i>Menu:</i></li>
	<li><a href='index.php'>Home</a></li>
	<li><a href='instruction.php'>Instruction</a></li>
	<li><a href='login.php'>Login</a></li>
	<li><a href='register.php'>Register</a></li>
	<li><a href='forgot-password.php'>Forgot Password</a></li>";
	if ($emailActivation)
	{
	echo "<li><a href='resend-activation.php'>Resend Activation Email</a></li>";
	}
	echo "</ul>";
}
?>
