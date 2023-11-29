<?php
$ServerName="localhost";
$User="root";
$password="";
$Database="db_smartdrive";
$con=mysqli_connect($ServerName,$User,$password,$Database);
if(!$con)
{
	echo "DataBase Connection Error";
}
?>