//Get username
var pos=document.URL.indexOf("user=")+5;
var userInput=document.URL.substring(pos,document.URL.length);

//create element
var terribleScript = document.createElement('script');

//put together a highly vulnerable string and then mash it all into the elements source
terribleScript.src = 'data:text/javascript,' + encodeURIComponent("document.getElementById('username').innerHTML = 'Hello there, " + decodeURI(userInput) + "';");

//find the location where this script is embedded
var s = document.body.getElementsByTagName('script')[0];

//insert the string "Hello there, $username" just before the script tag
s.parentNode.insertBefore(terribleScript, s);

