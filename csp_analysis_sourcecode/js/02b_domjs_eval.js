var pos=document.URL.indexOf("user=")+5;  //finds the position of value
var userInput=document.URL.substring(pos,document.URL.length); //copy the value into userInput variable

//Instead of using document.write directly, well use eval to execute the whole string
var s = "document.write(user)";


eval(s);


