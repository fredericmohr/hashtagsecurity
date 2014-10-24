var pos=document.URL.indexOf("user=")+5;  //finds the position of value
var userInput=document.URL.substring(pos,document.URL.length); //copy the value into userInput variable
document.write(unescape(userInput)); //writes content to the webpage

