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
<h1>Blocked Inline JS Example</h1>
Hello there,

<script>
        var pos=document.URL.indexOf("user=")+5;  //finds the position of value
        var userInput=document.URL.substring(pos,document.URL.length); //copy the value into userInput variable
        document.write(unescape(userInput)); //writes content to the webpage
</script>
<br>there should be a username, but it has been blocked :) 
<br>(Unless you are using InternetExplorer...)


<br><br>
This is an example on how CSP blocks inline javascript. If the JS would have been executed, the username specified in the URL ?name=bob would have been greeted with "Hello there, bob".<br><br>
When a CSP violation occurs, FireFox and other browser will display a message like the one below. (Note: The X-Content-Policy header has been left there for tests with FF v.11 and below.)
<img src="data/images/P01-01_FireFox_CSP_Violation.png">Most tests have been done with the current FF version 28.<br><br><br>
Take a look at the JS code example below. In the next example we use the exact same code, but the js has been moved to js/02a_domxss_docwrite.js and included in the site.
Because the CSP allows javascript from the same domain, the code can be executed. But that also means that the obvious XSS vulnerability in this code will be executed as well.
<br><br><br>
<h4>Javascript code used: (inline)</h4> Try to find out exactly what the code does and why it is blocked by CSP.
<xmp><script>
        var pos=document.URL.indexOf("user=")+5;  //finds the position of value
        var userInput=document.URL.substring(pos,document.URL.length); //copy the value into userInput variable
        document.write(unescape(userInput)); //writes content to the webpage
</script>
</xmp>
<br>
<b>Sources:</b><br>
<a href="http://www.breakthesecurity.com/2012/05/dom-based-cross-site-scriptingxss.html">BrakeTheSecurity - DOM XSS Code Example</a><br>
<br><br><br>

		<p><a href="http://www.twitter.com/HashtagSecurity">@HashtagSecurity</a> - <a href="http://www.hashtagsecurity.com/csp">Blogpost</a></p>
	</div>
</div>

</body>
</html>
