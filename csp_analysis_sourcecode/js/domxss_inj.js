//var pos=document.URL.indexOf("user=")+5;  //finds the position of value
//var userInput=document.URL.substring(pos,document.URL.length); //copy the value into userInput variable

//document.write(unescape(userInput)); //writes content to the webpage

//var userInput = "runMe";
// find object
//var fn = window[userInput];
 
// execute function
//fn();

/*function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

var additionalScripts = getParameterByName('as');
eval(atob(additionalScripts));/**/

var t=escape('".$_GET['t']."')
