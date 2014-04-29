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
<script src="js/02c_domjs_function.js" type="text/javascript"></script>

<br><br>In this example, we use a different javascript to print the user.<br> In this case, we are able to inject new javascript directly into the script file and can alter it, thus bypassing the CSP "block inline js" rule entirely.<br><br>
<br>
<b>We use the following js code:</b><br>
This example works similar to the eval() one, but uses function instead.<xmp>function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
var additionalScripts = atob(getParameterByName('as'));
var tmpFunc = new Function("alert(1)");
tmpFunc();</xmp>
Even though it is documented <a href="http://www.w3.org/TR/CSP/">here</a>, quote "When called as a constructor, the function Function must throw a security exception. [ECMA-262]" most blogs only mention the blocking of inline-js and the eval() function. As you can see, this example is blocked as well.
<br><br>
<b>Inject:</b><br>
No need for injection, since the code is blocked by CSP in any case.
<br><br><b>Thanks</b> to <a href="http://halls-of-valhalla.org/beta/">Scott Finlay</a> for sending me this example.<br><br>
<b>Sources:</b><br>
<a href="http://www.w3.org/TR/CSP/">W3.org - CSP RFC</a><br>
<a href="https://wiki.mozilla.org/Security/CSP/Specification">Mozilla - CSP Specification</a><br>


<br><br>



		<p><a href="http://www.twitter.com/HashtagSecurity">@HashtagSecurity</a> - <a href="http://www.hashtagsecurity.com/csp">Blogpost</a></p>
	</div>
</div>

</body>
</html>
