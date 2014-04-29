<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>CSP Attacks</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="generator" content="CSP Attacks">
	<meta name="viewport" content="width=device-width">

</head>


<body>
<div class="wrapper">
	<?php include "navi.html";?>


	<div id="content">
<h1>DOM JS Script - Code injection</h1>
<div id="username"></div>
<script src="js/02d_domjs_data_uri.js" type="text/javascript"></script>
<br><br>In this example, we use a fairly strange piece of javascript to print the user.<br> In this case, we are able to inject new javascript directly into the script file and can alter it, thus bypassing the CSP "block inline js" rule entirely.<br><br>
<br>
<b>We use the following js code:</b><br><xmp>//Get username
var pos=document.URL.indexOf("user=")+5;
var userInput=document.URL.substring(pos,document.URL.length);

//create element
var terribleScript = document.createElement('script');

//put together a highly vulnerable string and then mash it all into the elements source
terribleScript.src = 'data:text/javascript,' + encodeURIComponent("document.getElementById('username').innerHTML = 'Hello there, " + decodeURI(userInput) + "';");

//find the location where this script is embedded
var s = document.body.getElementsByTagName('script')[0];

//insert the string "Hello there, $username" just before the script tag
s.parentNode.insertBefore(terribleScript, s);
</xmp>
<br><br>
By default (that is, if you clicked on the link in the navigation on the left), username is set to bob.<xmp>/02d_domjs_data_uri.php?user=bob</xmp>The username is added dynamically to the page. However, the javascript used to do so is a very bad example.
<br>Try to insert the following:<xmp>bob';alert('XSS');//</xmp>

<b>Note: </b>This example should not be very common. In fact, I had to tinker with js quite a bit and with the help of <a href="http://halls-of-valhalla.org/beta/">Scott Finlay</a> and some talented people over at stackoverflow, this example was created.<br>
Hopefully you will never run into this kind of vulnerability in the wild but if you do, please tell me about it!<br><br>
<img src="data/images/P02-01_DOMXSS_success.png">


		<p><a href="http://www.twitter.com/HashtagSecurity">@HashtagSecurity</a> - <a href="http://www.hashtagsecurity.com/csp">Blogpost</a></p>
	</div>
</div>

</body>
</html>
