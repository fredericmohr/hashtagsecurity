var JSONObject= {
"name":"Robert Ross",
"alias":"not set",
"status":"Away",
};

//set alias if URL contains user=
if(window.location.href.indexOf("user=") > -1) 
{
	var pos=document.URL.indexOf("user=")+5;
	var userInput=document.URL.substring(pos,document.URL.length);
	JSONObject.alias = unescape(userInput);

}


document.getElementById("jstatus").innerHTML=JSONObject.status;
document.getElementById("jalias").innerHTML=JSONObject.alias;
document.getElementById("jname").innerHTML=JSONObject.name;


