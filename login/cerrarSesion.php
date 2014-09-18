<?php
	session_start();
	include "../conexion.php";
	$re=mysql_query("select * from usuarios where Usuario='".$_POST['Usuario']."'");
?>