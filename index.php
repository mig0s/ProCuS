<?php
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once("models/header.php");
if(isUserLoggedIn()) {
	echo '<script type="text/javascript">window.location.href="account.php";</script>';
} else {
echo "
</div>
<div id='main' class='col-md-10'>
<div class='jumbotron'>
<h1>Help yourself to make a progress today!</h1>
<br />
<h2>ProCuS is the project that will help you make things happen. It is a unique solution of the procrastination problem.</h2>
<br /><p class='lead'>Have you ever delayed something until the day after tomorrow what you know you should have done the day before yesterday?</p>
<p class='lead'>
Exercise, study, a piece of work or even a simple cleaning in the room - all those activities we used to delay until the very last moment. Anyway, it is normal if you do this only rarely. But what if procrastination started to hold back your relationships or getting your work done?</p>
<p class='lead'>
In this case, you have to do something with it, and we are ready to help you.
</p>
<p class='lead'>We have done a research in psychology that defines reasons and ways out of procrastination. As a solution, we chose a technique from Rational Emotive Behavior Therapy. The main point of this method is marking your activity and achievements systematically. Then, the system will show you the results. It is very important to have a visual on your progress. You cannot constantly keep in mind the list of all your accomplishments, it will be fatal to any changes, because motivation is quickly eroding, and it leads to fail. When we see everything that we have done, we feel some changes in ourselves, and it motivates further activity.</p>
<h2>How exactly does it work?</h2>
<p class='lead'>You simply have to make a note after any kind of good job you have done. Then look at your achievements and move on with new beginnings. It's like to-do list, but with no list and with completion records only!</p>
<h2>Is it that simple?</h2>
<p class='lead'>Yes, it is. If you will follow the instruction and track your progress properly, you will stay motivated until you stop suffering from procrastination.</p>
<h2>Take a small step today and reach the stars tomorrow!</h2>
<br /><p>Get started with <a class='btn btn-success btn-lg' href='/instruction.php' role='button'>Instruction</a></p>
</div>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";
}
?>
