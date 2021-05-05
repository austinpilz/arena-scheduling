<?php
mysql_connect("localhost:8889", "root", "root") or die(mysql_error);
mysql_select_db("Career") or die(mysql_error);
$ip = getenv("REMOTE_ADDR");
$date = date("m/d/y");
?>