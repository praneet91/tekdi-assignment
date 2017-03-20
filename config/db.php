<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
$host = 'localhost';
$dbName = 'tekdi';
$username = 'root';
$password = '';

$con = mysql_connect($host, $username, $password);
$dbSelect = mysql_select_db($dbName, $con);