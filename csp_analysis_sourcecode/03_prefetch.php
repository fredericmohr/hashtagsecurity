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
<h1>CSP Prefetch() bypass</h1>
Hello there, <script src="js/02a_domjs_docwrite.js" type="text/javascript"></script>
<br>As in <a href="">this blogpost</a> described, CSP doesn't block ressources that are cached by the browser during idle time using the FireFox prefetch, or the Chrome prerender function.<br>
However from what I saw, it's still not a CSP bypass because even though CSP allows the browser to load the script, it still blocks the attempt to execute it. <br>
So while the prefetching is allowed (file is cached)<xmp><link id=1 rel="prefetch" href="http://pastebin.com/raw.php?i=1GM3BdJD"></xmp>
Calling the cached script to execute is not allowed and thus blocked: <xmp><script src="http://pastebin.com/raw.php?i=1GM3BdJD"></script></xmp>

<br>
I haven't tried this because I don't think it will work but theoretically if the files can be prefetched, maybe the locally cached version (client side) can be called directly without linking to the external source.<br>
If that is possible, it would be interesting to see how CSP reacts to this file include. Technically it should block it since it's still a source violation.


<br><br><br>
		<p><a href="http://www.twitter.com/HashtagSecurity">@HashtagSecurity</a> - <a href="http://www.hashtagsecurity.com/csp">Blogpost</a></p>
	</div>
</div>

</body>
</html>
