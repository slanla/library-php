<?php
function pageNotFound(){
  header("HTTP/1.0 404 Not Found");
  header("Status: 404 Not Found");
  ?><!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head>
<title>404 Not Found</title>
</head><body>
<h1>Page Not Found*</h1>
<p>The requested URL <?=$_SERVER['REDIRECT_URL'];?> was not found on this server.</p>
<p>Additionally, a 404 Not Found
error was encountered while trying to use an ErrorDocument to handle the request.</p>
</body></html><?php
  exit();
}