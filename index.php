<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>Beaver Fight: Following Canada's political showdown on Twitter</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
var request;

function getHTTPObject() 
{
    var xhr = false;
    if (window.XMLHttpRequest) 
    {
        xhr = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        try 
        {
            xhr = new ActiveXObject("Msxml2.XMLHTTP");
        } 
        catch(e) 
        {
            try 
            {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            } 
            catch(e) 
            {
                xhr = false;
            }
        }
    }
    return xhr;
}

function getContent()
{
    request = getHTTPObject();
    request.onreadystatechange = sendData;
    request.open("GET", "trigger.php", true);
    request.send(null);
}

function sendData()
{
    var dC = document.getElementById("dCo");
    if(request.readyState == 4)
    {        
        dC.innerHTML = request.responseText;
    }
    else if(request.readyState == 1)
    {
        dC.innerHTML = "Updating content..." . request.responseText
    }
}
window.onload = function()
{
  setInterval("getContent();", 10000);
}
</script>
<style type="text/css" media="screen">
	body{width:780px;margin:20px auto;font:12pt/14pt "helvetica neue",calibri,arial,sans-serif;}
	ol{list-style-type:none;margin:0;padding:0;}
	.img{float:left;margin:0 20px 20px 0;width:48px;height:48px;}
	small{display:block;text-align:right;}
	li{margin-bottom:20px;padding:20px;border:2px solid #900;}
	li a img{border:none;}
	.tools{font-size:8pt;}
	#footer{font-size:10pt;}
	noscript .alert{
		background:salmon;
		colour:red;
		border:2px solid red;
		padding:20px;
		margin:20px 0;
		display:block;
	}
</style>
</head>
<body>
<h1>Beaverfight.ca</h1>

<?php echo dirname(__FILE__); ?>
<p>Real-time tweets about Canada's current federal political scene. </p>
<div id="dCo"><noscript class="alert"><p class="alert">For automatic updates to work Javascript is required. For non-Javascript version <a href="/nojs_index.php">click here</a>.</p></noscript></div>

<?php
include ('_template/footer.inc.html');
?>