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

	<h1>JSON based XSS injection</h1>
	Hello there, <script src="js/02a_domjs_docwrite.js"></script><br>
	In this example, the user can write comments, which are stored in a JSON file.<br>
	Without the CSP, we would be able to inject javascript between the datasets of the JSON object.<br>
	You can see the full php source code <a href="comments.php.txt">here</a> and the JSON file <a href="data/comments.json">here.</a><br>
	<br>
	<?php include "comments.php";?>

	<br><br>
	<h3>Attack Examples</h3>
	<br>To execute normal inline-js, you can add the following code: <xmp><<script>alert(1);<</script></xmp> Of course, this will be blocked by our CSP.
	<br>
	The idea is, to inject UTF-7 encoded javascript into the JSON file, and include the JSON file as javascript file throught the XSS vulnerability. Since the code isn't inline but stored in a local file (data/comments.json), we can bypass the CSP.<br>
	<br><b>This is our JSON file, containing to comment objects.</b><xmp>[{"text":"html-tags are not filtered on purpose, js however is blocked by our CSP"},{"text":"I am about to inject some js"}]</xmp>
	What we want to achieve is break out of the JSON objects and add some javascript between them. The finished JSON code should look like this: <xmp>[{"text":"html-tags are not filtered on purpose, js however is blocked by our CSP"},{"test":"start injection"}];alert(1);[{"text":"success"}]</xmp>
	<b>This is our payload</b><br> However, if we just insert it like this,<xmp>start injection"}];alert(1);[{"text":"success</xmp> we end up with that exact text printed as a comment on the website. That's because JSON escapes special chars like this: <xmp>[{"text":"html-tags are not filtered on purpose, js however is blocked by our CSP"},{"text":"start injection\"}];alert(1);[{\"text\":\"success"}]</xmp><br>

	<b>UTF-7 Payload:</b><br>
	We can get around that problem by encoding the input with UTF-7, which gives us this string: <xmp>start injection+ACIAfQBdADs-alert(1)+ADsAWwB7ACI-text+ACI:+ACI-success</xmp>
	If we inject it, we get the following JSON file: <xmp>[{"text":"html-tags are not filtered on purpose, js however is blocked by our CSP"},{"text":"start injection+ACIAfQBdADs-alert(1)+ADsAWwB7ACI-text+ACI:+ACI-success"}]</xmp> 
	Run the whole thing through an UTF-7 decoder and we get exactly what we wanted: <xmp>[{"text":"html-tags are not filtered on purpose, js however is blocked by our CSP"},{"text":"start injection"}];alert(1);[{"text":"success"}]</xmp>
	<br>
	<b>Loading...</b><br>
	So now we have a strange comment on the page but no javascript is executed. Of course not, we still need to load the json file as javascript. This can be done either through the user=bob XSS vulnerability or as another comment. <xmp><script charset="UTF-7" src="data/comments.json"></script></xmp>
	<br><b>Problems?</b><br>
	So where is the catch? <br>
	Technically every step of this attack is still possible up to the part where the browser should load the script. The problem is that Chrome, with its strict MIME-Type checking feature prohibits you from loading non-js files (such as .json) as javascript.<br>
	<img src="data/images/json_csp4.png"><br>
	FireFox is a little more forgiving when it comes to that, but in order to be HTML5 compliant, Mozilla completely removed all UTF-7 support in Firefox 5. That means, that while FF tries to load the JSON file, it won't decode it and thus won't recognize the hidden javascript. Since FireFox doesn't recognize the JS, it won't throw an error message but will fail silently. All you get is a nice "GET data/comments.json - 200 OK" message.<br>
	<br>If you still want to try it out, you can do so with FireFox version 4.0.1
	<img src="data/images/json_csp7.png"><br>


	<br><br><b>Sources:<br></b>
	<a href="http://haacked.com/archive/2008/11/20/anatomy-of-a-subtle-json-vulnerability.aspx/">haacked.com - Anatomy of a sublte JSON vulnerability</a><br>
	<a href="http://h43z.blogspot.de/2012/06/phps-jsonencode-and-xss.html">h43z - php's json_encode and xss</a><br>
	<a href="http://blog.sofasurfer.ch/wp-content/uploads/2011/03/comment.txt">sofasurfer.ch - JSON Comment System</a><br>
	<a href="http://sla.ckers.org/forum/read.php?4,33869,33869">SLA.CKERS.org - javascript hijacking</a><br>
	<a href="http://security.stackexchange.com/questions/47489/utf-7-xss-attacks-in-modern-browsers">Security SE - UTF-7 XSS attacks in modern browsers</a><br>
	<a href="http://security.stackexchange.com/questions/11091/is-this-json-encoding-vulnerable-to-cdata-injection">Security SE - Is this JSON encoding vulnerable to CDATA injection?</a><br>
	<a href="http://toolswebtop.com/text/process/encode">ToolsWebTop - UTF-7 Encoder/Decoder</a><br>
	<a href="http://www.thespanner.co.uk/2009/11/23/bypassing-csp-for-fun-no-profit/">The Spanner - Bypassing CSP for fun, no profit</a><br>
	<a href="https://owasp.teammentor.net/article/16c073b9-e951-4f25-a282-e867d2d808f7">TeamMentor - AJAX Injection Attack</a><br>
	<a href=""></a><br>
	<br><br><br>

		<p><a href="http://www.twitter.com/HashtagSecurity">@HashtagSecurity</a> - <a href="http://www.hashtagsecurity.com/csp">Blogpost</a></p>
	</div>
</div>

</body>
</html>
