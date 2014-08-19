<?php 
	$server="localhost";
	$username="root";
	$password="";
	$db='carritocompras';
	$con=mysql_connect($server,$username,$password)or die("no se puede establecer la conexión");
	$sdb=mysql_select_db($db,$con)or die("La base de datos no existe");
	
?>