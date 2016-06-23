<?php

echo "
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<link rel='shortcut icon' href='favicon.ico'/>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>".$websiteName."</title>
<link href='".$template."' rel='stylesheet' type='text/css' />
<link rel='stylesheet' href='models/site-templates/bootstrap.min.css' />
<script src='models/jquery-2.1.4.min.js' type='text/javascript'></script>
<script src='models/funcs.js' type='text/javascript'></script>
</head>
<body>
<a href='#content' class='scrollToTop'></a>
<div id='wrapper' class='container'>
<hr>
<div class='row head'>
<div class='col-md-2 logodiv'>
<img class='logo' src='logo.png' />
</div>
<div class='col-md-10'>
<p class='text-right lead socials'><a href='https://goo.gl/WDxAkJ'><img src='models/shadow_f.png' /></a> <a href='https://goo.gl/j6MLao'><img src='models/shadow_t.png' /></a></p>
<h1><strong><span class='pcsg'>pro</span><span class='pcsy'>cu</span><span class='pcsg'>s: procrastination <span class='pcsy'>cure</span> system</span></strong></h1>
<br /><p class='text-right'><small>&copy; <abbr title='Mikhail Gospodarikov'>mig0s</abbr></small></p>
</div>
</div>
<hr>
<div id='content' class='row'>

<div id='left-nav' class='col-md-2 menu'>";

include("left-nav.php");

?>
