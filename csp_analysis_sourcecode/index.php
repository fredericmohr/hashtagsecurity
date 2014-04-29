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
		<h1>This site is protected by CSP</h1><br>
		This is a collection of examples of vulnerable code (XSS, Javascript). During my research for CSP bypass vulnerabilities I needed a lot of examples to try on. These are the results, both success and failure, each with a short explanation.
		<h4>Take a look at the header</h4>
		You can check for the Content-Security-Policy currently used with <xmp>curl --head yourdomain.com/csp-vuln/index.html</xmp><br>
		It should say somethin like this:<xmp>Content-Security-Policy: default-src 'self'; object-src 'self' data:; script-src 'self' data:;</xmp>


		<h4>Hosting this website</h4>
		This site is part of my research on CSP attacks for BSidesLND '14 - It will be available on github for everyone to host and play with.
		To host this page, you need an Apache webserver with PHP5 and the following config.
		<xmp>
########################################
#   CSP Attack - Vulnerable Examples   #
########################################
<VirtualHost *:80>
ServerAdmin you@mail
ServerName cspv.yourserver.com
DocumentRoot /var/www/csp-vuln

# The X-Content-Security-Policy header is deprecated, but you need it if you want to test old FF versions such as v.11 or v.5
Header always set Content-Security-Policy: "default-src 'self'; object-src 'self' data:; script-src 'self' data:; report-uri http://cspv.yourserver.com/reportv.php;"
Header always set X-Content-Security-Policy: "default-src 'self'; object-src 'self' data:; script-src 'self' data:; report-uri http://cspv.yourserver.com/reportv.php;"
# Please note, that the reportv.php file accepts all csp-violation-reports sent from browsers and stores them in a file on the server.

# If your site is publicly available, I suggest using htaccess to protect it. If you want it to be public, please check first if it poses no threat to your server - it wasn't intendet for public hosting!
# The file /var/local/private/.htpasswd_cspv can be created with 'htpasswd -c /var/local/private/.htpasswd_cspv username'
# Also, make sure that the whole directory belongs to your webserver-user, e.g. 'chown -R www-data:www-data /var/www/csp-vuln'. 
<Directory /var/www/csp-vuln >
        Options FollowSymLinks MultiViews
        AuthType Basic
        AuthName "private area"
        AuthBasicProvider file
        AuthUserFile /var/local/private/.htpasswd_cspv
        Require valid-user
	<Files "reportv.php">
	     Order allow,deny
	     Allow from all
	     Satisfy any
	</Files>
</Directory>
# Log Files
ErrorLog /var/log/apache2/cspv_error.log
LogLevel warn
CustomLog /var/log/apache2/cspv_access.log combined
</VirtualHost></xmp>
		

		If you host this page on your own server, try commenting out the Content-Security-Policy header option in your apache config to see how the site behaves with, or without the CSP.
		<h4>Follow the logs...</h4>
		To see if a site violates any CSP rules, right click on the page and go to "Inspect Element". Then click on Console and set the Filter to "Errors" only. Now reload the page and you can see the violation appering in your browsers console (if there is any).<br>
		<br>Leave your browsers console open since you will be needing it for all of the shown examples.
		<img src="data/images/P01-01_FireFox_CSP_Violation.png">Most tests have been done with the current FF version 28.<br><br>
		If you host this site yourself, check out the <a href="cspv.errors">this file </a>for detailed violation reports.
		<br><br><br>
		<b>CSP Tools:</b><br>
		<a href="https://github.com/Kennysan/CSPTools">GitHub - Kennysan CSPTools</a><br>
		<a href="https://github.com/oxdef/csp-tester">GitHub - oxdef CSP tester</a><br>
		<a href="https://github.com/bsterne/bsterne-tools/tree/master/csp-bookmarklet">GitHub - bsterne CSP Bookmarklet</a><br>
		<a href="http://caniuse.com/contentsecuritypolicy">caniuse.com - ContentSecurityPolicy</a><br>
		<a href="http://www.cspplayground.com/">CSP Playground</a><br>
		<a href=""> </a><br>
		<br><br><br>
		<p><a href="http://www.twitter.com/HashtagSecurity">@HashtagSecurity</a> - <a href="http://www.hashtagsecurity.com/csp">Blogpost</a></p>
	</div>
</div>

</body>
</html>
