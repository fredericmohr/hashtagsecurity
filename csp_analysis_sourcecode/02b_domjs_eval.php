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
Hello there,
<script src="js/02b_domjs_eval.js" type="text/javascript"></script>

<br><br>In this example, we use a different javascript to print the user.<br> In this case, we are able to inject new javascript directly into the script file and can alter it. Normally we could bypass CSP with this technique since the injected code isn't "inline". However, CSP also blocks all eval() type functions. If you see the username displayed above, then something is wrong. Try opening this site in FireFox and InternetExplorer and compare the results.<br><br>
<br>
<b>We use the following js code:</b><br>
<xmp>var pos=document.URL.indexOf("user=")+5;  //finds the position of value
var userInput=document.URL.substring(pos,document.URL.length); //copy the value into userInput variable

//Instead of using document.write directly, well use eval to execute the whole string
var s = "document.write(user)";
eval(s);</xmp>
<br><br>

<b>Inject:</b><br>
No need for injection, since the code is blocked by CSP in any case.
If you want, you can try to the following "username". 
If your CSP is enabled it should block it, if not your browser will execute the javascript.<xmp>?name=bob);alert(1);</xmp>

<b>Note: </b>This is an example why eval() should not be used and why CSP blockes it by default.<br>You can enable eval() type functions by appending unsafe-eval to your script-src section in your CSP. - You shouldn't though! Seriously!!<br><br>

		<p><a href="http://www.twitter.com/HashtagSecurity">@HashtagSecurity</a> - <a href="http://www.hashtagsecurity.com/csp">Blogpost</a></p>
	</div>
</div>

</body>
</html>
