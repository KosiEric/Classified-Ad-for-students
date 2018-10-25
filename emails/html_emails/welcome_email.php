<?php
$now = date('h:i:s a');
$today = date('D d M Y');
$username = "Kosi Eric";
$body = "<!DOCTYPE html>
<html lang = 'en-us' dir = 'ltr'>
<head>
<style type = 'text/css'>
p {
  margin-left : 10px;  
  margin-right : 10px;
}
</style>
</head>
<body>
<div style = 'color:dimgrey;line-height: 20px;font-family: \"Segoe UI\",Arial,sans-serif;
font-size: 14px;
width: 400px;border: 1px solid rgba(220 , 220 , 220 , 0.5);word-spacing: 3px;margin: 40px auto;padding: 0px 0px 20px 0px;background-color: #f5f8fa;border-radius: 5px;'>
<a style = 'text-decoration:none;' href = '{$_SERVER['HTTP_HOST']}/' title = 'Gidimi.com'><h2 style = 'background-color: #10bbb3;
color: #fff;
text-align: center;
border-top-left-radius: 4px;
font-size: 18px;
padding: 4px 0px;
cursor: pointer;
border-top-right-radius: 4px;
margin-top: auto;'>Welcome to Gidimi</h2></a>
<p> Hi <b>{$username}</b> Welcome to Gidimi.</p>
<p> We at Gidimi  we are glad to have you on board.</p><br />
<p>At Gidimi we see people like you as our No.1 priority, Our No.1 reason for existence.<br />
<br />we place users like you above every other priority.
</p>
<p>
We ease the process of buying/selling within your campus.
</p><br />


<p>We are here to put smile on peoples faces, Especially  You!<br /><br />


You can follow us on twitter <a target = '_blank' href = 'https://twitter.com/GidimiOfficial' style = 'color : blue;text-decoration: none;' title = 'Gidimi on Twitter'>@GidimiOfficial</a> Thanks.<br /><br />

Regards. Gidimi, <b style = 'color : green;'>New way to discover</b><br /><br />
$today  $now
</p>
</div>
</body>
</html>";
?>