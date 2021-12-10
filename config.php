<?php

session_start();

$dbc = mysqli_connect("localhost","id16520003_root","Saniya#@$123","id16520003_project");

if ($dbc->connect_error) 
{
  die("Connection failed: " . $dbc->connect_error);
}

?>