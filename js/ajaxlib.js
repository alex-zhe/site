function init() {
    document.getElementById('form').onsubmit=function() {
        document.getElementById('form').target = 'frame'; //'upload_target' is the name of the iframe
    }
	}

function auth()
{

var http = getXmlHttp();
var url = "auth.php";
var login = document.getElementById('login').value;
var pass = document.getElementById('pass').value;

var params = "login="+login+"&pass="+pass;
http.open("POST", url, true);
http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

http.onreadystatechange = function() {
	if(http.readyState == 4 && http.status == 200) {
		console.log(http.responseText);
	}
}
http.send(params);
}

function render(param)
{
var http=getXmlHttp();
http.open("GET","tpl/"+param,true);
http.onreadystatechange = function() {//Call a function when the state changes.
	if(http.readyState == 4 && http.status == 200) {
	//alert(http.responseText);	
	console.log(http.responseText);
	var obj = JSON.parse(http.responseText);
	
		for(p in obj)
		{
			if(document.getElementById(p))
			{
				document.getElementById(p).innerHTML=obj[p];
			}
		}
	}
}
http.send();

}


function getXmlHttp(){
  var xmlhttp;
  try {
    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
  } catch (e) {
    try {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (E) {
      xmlhttp = false;
    }
  }
  if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
    xmlhttp = new XMLHttpRequest();
  }
  return xmlhttp;
}
