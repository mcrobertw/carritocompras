<!--
	video2:	http://www.youtube.com/watch?v=-Wsw4n2qYRQ
	video3: http://www.youtube.com/watch?v=G1T2QEM3Tr0
-->
<?php
	/*session_unset();
	$_SESSION="";*/
	session_start();
	include './conexion.php';
	if(isset($_SESSION['carrito']))
	{
		$arreglo=$_SESSION['carrito'];
		$encontro=false;
		$numero=0;
		for($i=0;i<count($arreglo);$i++){
			if($arreglo[$i]['Id']==$_GET['id']){
				$encontro=true;
				$numero=$i;
			}
		}

		if($encontro==true){
			$arreglo[$numero]['Cantidad']=$arreglo[$numero]['Cantidad']+1;
			$_SESSION['carrito']=$arreglo;
		}

	}else{
		if(isset($_GET['id'])){
			
			$nombre="";
			$precio=0;
			$imagen="";

			$re=mysql_query("select * from producto where id=".$_GET['id']);

			
			while ($f=mysql_fetch_array($re)) {
				//print_r($f);
				$nombre=$f['nombre'];
				$precio=$f['precio'];
				$imagen=$f['imagen'];
			
			}
			$arreglo[]=array('Id'=>$_GET['id'],
								'Nombre'=>$nombre,
								'Precio'=>$precio,							
								'Imagen'=>$imagen,
								'Cantidad'=>1);
			$_SESSION['carrito']=$arreglo;
		}
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8"/>
	<title>Carrito de Compras</title>
	<link rel="stylesheet" type="text/css" href="./css/estilos.css">
	<script type="text/javascript" href="./js/scripts.js"></script>
</head>
<body>
	<header>
		<h1>Carrito de Compras</h1>
		<a href="./carritodecompras.php" title="Ver carrito de compras"></a>
		<img src="./imagenes/carrito.png">
	</header>
	<section>
		<?php
			$total=0;
			if(isset($_SESSION['carrito']))
			{
				$datos=$_SESSION['carrito'];
				$total=0;
				for($i=0;$i<count($datos);$i++)
				{
					/*print_r($datos[$i]);*/
		?>
				<div class="producto">	
					<center>
						<img src="./productos/<?php echo $datos[$i]['Imagen'];?>"><br>
						<span><?php echo $datos[$i]['Nombre'];?></span><br>
						<span>Precio: <?php echo $datos[$i]['Precio'];?></span><br>
						<span>Cantidad: <input type="text" value="<?php echo $datos[$i]['Cantidad'];?>"> </span>
						<span>Subtotal: <?php echo $datos[$i]['Precio']*$datos[$i]['Cantidad'];?></span><br>
						
					</center>	
				</div>
		<?php	
				$total=($datos[$i]['Precio']*$datos[$i]['Cantidad']);

				}
			}else{
				echo '<center><h2>El carro de compras esta vacio</h2></center>';
			}
			echo '<center><h2>Total: '. $total .' </h2></center>';
		?>
		<center><a href="./">Ver catalogo</a></center>


	</section>
</body>
</html>