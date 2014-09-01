<?php
	session_start();
	include "../conexion.php";
	$re=mysql_query("select * from usuarios where usuario='".$_POST['Usuario']."' AND
		      password='".$_POST['Password']."'") or die(mysql_error());

	while($f=mysql_fetch_array($re)){
		$arreglo[]=array('Nombre'=>$f['nombre'],
			'Apellido'=>$f['apellido'],'Imagen'=>$f['imagen']);
	}

	if(isset($arreglo)){
		$_SESSION['Usuario']=$arreglo;
		header("Location: ../admin.php");
	}else{
		header("Location: ../login.php?error=datos no validos");
	}

?>