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
<h1>DOM based XSS</h1>
Hello there,
<script src="js/02a_domjs_docwrite.js" type="text/javascript"></script>
<br>In this case, the username is shown because we didn't use inline javascript!

<br><br>
This is a typical example of a DOM based XSS vulnerability.
You can change the name by changing the value name= in the URL field.
<br>
We used the same code as before, but moved it to js/domxss.js and included it with <xmp><script src="js/02a_domjs_docwrite.js" type="text/javascript"></script></xmp>
Now it is executed, but the CSP is still active. That's because we have moved the code from "inline" to a file in a subdirectory. Since all scripts from localhost (default-src: 'self') are executed, this doesn't violate our CSP rule.
<br><br>
<h3>Attack Examples:</h3>
Here are a few example XSS attacks. Try them out and see the results.
<br><b>Classic alert injection</b><br>
Even though the XSS vulnerability is valid, the code appears inside 02a_domjs_docwrite.php as "inline" code in script-tags. That means that it will be blocked by our Content Security Policy.
<xmp>bob<script>alert('XSSed')</script></xmp>

<br><b>Escaping</b><br>
This one can't work, because document.write() handles the input as a string, so it's not interpreted!
<xmp>bob));alert(XSS);//</xmp>

<br><b>HTML injection</b><br>
In this case we don't violate the CSP since it's only html and doesn't contain javascript. CSP does not block "inline" html - of course!
<xmp><h1>deface!</h1><!--</xmp><div id="hidden">--></div>

<b>HTML with CSS</b><br>
Without CSP we could place a full page sized div on top of everything to cover up the whole site and insert our own fake one. But because of CSPs inline CSS blocking (which can't be disabled) we are limited to pure HTML styling only. In the following example the HTML is inserted while all CSS is blocked.
<xmp><div style="width:100%;height:100%;z-index:90;position:fixed;top:0%;left:0%;background-color:"><h1>deface</h1></div></xmp>

<br><b>The data: directive</b><br>
There is another way to inject javascript. If the CSP containt the script-src data: directive, it allows you to insert javascript directly into the src="" option of the script tag, therefore allowing you to place inline scripts after all.
<xmp><script src="data:text/javascript,document.write('bob');alert('XSS');"></script></xmp>
<br>
This attack is interesting, because the "script-src data:" directive isn't seen as evil by most people (even though it's stated <a href="https://developer.mozilla.org/en-US/docs/Security/CSP/CSP_policy_directives#Data" >here</a> otherwise). <br>It is bad practice, but unlike unsafe-eval and unsafe-inline, data: probably won't let you end up on the wrong side of a witch hunt. The reason for this is, that eval has a bad reputation anyway and allowing unsafe-inline is kind of an obvious misstep. Adding "script-src data:" is a less obvious, but just as bad mistake and thus more often too find.
<br><br><br>
<b>Sources:</b><br>
<a href="http://security.stackexchange.com/questions/52558/exploit-document-write-with-unsanitized-user-input">Security SE - exploit document.write with unsanitized user input</a><br>
<br>
<br>
<br>
<p><a href="http://www.twitter.com/HashtagSecurity">@HashtagSecurity</a> - <a href="http://www.hashtagsecurity.com/csp">Blogpost</a></p>
</div>
</div>

</body>
</html>
