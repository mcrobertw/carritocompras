<?php
	session_start();
	$arreglo=$_SESSION['carrito'];
	$total;
	$numero=0;
	for($i=0;$i<count($arreglo);$i++){
		if($arreglo[$i]['Id']==$_POST['Id']){
			$numero=$i;
		}
	}
	$arreglo[$numero]['Cantidad']=$POST['Cantidad'];
	for($i=0;$i<count($arreglo);$i++){
		//$total=$total+($arreglo[$i]['Precio']*$arreglo[$i]['Cantidad']);
		$total=($arreglo[$i]['Precio']*$arreglo[$i]['Cantidad'])+$total;
	}
	$_SESSION['carrito']=$arreglo;
	echo $total;
?>