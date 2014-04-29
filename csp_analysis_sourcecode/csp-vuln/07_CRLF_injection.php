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
<h1>CRLF vulnerability CSP bypass</h1>
The following script is prone to CRLF (carriage return / line feed) injection, which allows an attacker to manipulate headers sent in the server response.<br>
<b>Vulnerable Code:</b> (/07_redirect2.php)<pre>
&lt?php 
header('Location: '.$_GET['url']); 
?&gt
</pre>
<br>
The idea on how to exploit this to bypass CSP is pretty obvious, depending on the browser you can either write an entirely new CSP or add lines to it like the one below. Some browsers add the additional CSP, some choose between the first or the last CSP header.<br><br>
<b>Exploit Example:</b><xmp>redir.php?url=%0D%0AContent-Security-Policy: script-src 'unsafe-inline';%0D%0A</xmp>

The vulnerability was fixed in PHP version 5.1.2, but there was another Problem, as can be seen in PHP bug #60227<br>
This Bug has already been fixed in PHP version 5.3.11<br>
<br> 
Excerpt: Bug #60227 - header() cannot detect the multi-line header with CR.  (https://bugs.php.net/bug.php?id=60227)<br>
As of PHP 5.1.2, header() can no longer be used to send multiple response headers in a single call to prevent the HTTP Response Splitting Attack.<br>
header() only checks the linefeed (LF, 0x0A) as line-end marker, it doesn't check the carriage-return (CR, 0x0D).<br>
<br>
However, some browsers including Google Chrome, IE also recognize CR as the line-end (it is reported by Mr. Tokumaru).<br>
The current specification of header() still has the vulnerability against the HTTP header splitting attack.<br>
<br>
<b>Test script:</b> (/07_redirect.php)<pre id="code">&lt?php 
header('Location: '.$_GET['url']);
print_r($_COOKIE);
?&gt
</pre>

<b>Exploit:</b><xmp>cspv.mohrphium.com/07_redirect.php?url=http://example.com%20%0DSet-Cookie:+NAME=foo</xmp>
	
Normally, the result should be Array () ,but in some Browsers the Carriage-Return is executed.<br>
<h4>Browser tests:</h4>
<b>IE 8</b><br>
<img src="data/images/CRLF_csp.png">
<br><br><b>FireFox 28</b><br>
<img src="data/images/CRLF_csp1.png">
<br><br><b>Chrome 14</b><br>
<img src="data/images/CRLF_csp2.png">
<br><br><b>Chromium 33</b> - This Chrome version seems to automatically generate a SessionID (the script hasn't changed!)<br>
<img src="data/images/CRLF_csp3.png">
<br><br>
<b>Summary:</b>
So does that mean that CRLF is off the table? Not necessarily! The PHP header CRLF vulnerability isn't the only one, just one of the most famous. Depending on the script language and implementation, there are surely other to be found.
<br><br><b>Sources:</b><br>
<a href="http://blog.opensecurityresearch.com/2011/12/evading-content-security-policy-with.html">CSP bypass with multiple CSPs through CRLF vulnerability</a>
		<p><a href="http://www.twitter.com/HashtagSecurity">@HashtagSecurity</a> - <a href="http://www.hashtagsecurity.com/csp">Blogpost</a></p>
	</div>
</div>

</body>
</html>
