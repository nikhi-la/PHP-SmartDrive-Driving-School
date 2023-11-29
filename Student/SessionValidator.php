<?php
session_start();
if($_SESSION["uid"]==null)
{
	headder("Location:../Guest/Login.php");
}
?>