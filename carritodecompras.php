<!--
	video2:	http://www.youtube.com/watch?v=-Wsw4n2qYRQ
	video3: http://www.youtube.com/watch?v=G1T2QEM3Tr0
	video4: https://www.youtube.com/watch?v=BK3EKM0Ir2c
	video5: https://www.youtube.com/watch?v=1wy5F_q0coQ
	video6: https://www.youtube.com/watch?v=4KVgmFU26iE
	video7: https://www.youtube.com/watch?v=AkCStu-k10U
	video11: https://www.youtube.com/watch?v=kpekUCLuwOE
-->
<?php
	/*session_unset();
	$_SESSION="";*/
	session_start();
	include './conexion.php';
	if(isset($_SESSION['carrito']))
	{
		if(isset($_GET['id']))
		{
				$arreglo=$_SESSION['carrito'];
				$encontro=false;
				$numero=0;
				for($i=0;$i<count($arreglo);$i++){
					if($arreglo[$i]['Id']==$_GET['id']){
						$encontro=true;
						$numero=$i;
					}
				}

				if($encontro==true){
					$arreglo[$numero]['Cantidad']=$arreglo[$numero]['Cantidad']+1;
					$_SESSION['carrito']=$arreglo;
				}else{

					$nombre="";
					$precio=0;
					$imagen="";

					$re=mysql_query("select * from productos where id=".$_GET['id']);

					
					while ($f=mysql_fetch_array($re)) {
						//print_r($f);
						$nombre=$f['nombre'];
						$precio=$f['precio'];
						$imagen=$f['imagen'];
					
					}
					$datosNuevos=array('Id'=>$_GET['id'],
										'Nombre'=>$nombre,
										'Precio'=>$precio,							
										'Imagen'=>$imagen,
										'Cantidad'=>1);
					array_push($arreglo, $datosNuevos);
					$_SESSION['carrito']=$arreglo;
				}
		}
	}else{
		if(isset($_GET['id'])){
			
			$nombre="";
			$precio=0;
			$imagen="";

			$re=mysql_query("select * from productos where id=".$_GET['id']);

			
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
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="./js/scripts.js"></script>
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
						<span>Cantidad: 
							<input type="text" value="<?php echo $datos[$i]['Cantidad'];?>"
							data-precio="<?php echo $datos[$i]['Precio'];?>"
							data-id="<?php echo $datos[$i]['Id'];?>"
							class="cantidad"> 
						</span><br>
						<span>Subtotal: <?php echo $datos[$i]['Precio']*$datos[$i]['Cantidad'];?></span><br>
						<a href="#" class="eliminar" data-id="<?php echo $datos[$i]['Id'] ?>">Eliminar</a>
						
					</center>	
				</div>
		<?php	
				$total+=($datos[$i]['Precio']*$datos[$i]['Cantidad']);

				}
			}else{
				echo '<center><h2>El carro de compras esta vacio</h2></center>';
			}
			echo '<center><h2 id="total">Total: '. $total .' </h2></center>';

			if($total!=0)
			{
			  //echo '<center><a href="compras/compras.php" class="aceptar">Comprar</a></center>';
				?>

				<form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="formulario">
					<input type="hidden" name="cmd" value="_cart">
					<input type="hidden" name="upload" value="1">
					<input type="hidden" name="business" value="mcrobertw@hotmail.com">
					<input type="hidden" name="currency_code" value="USD">
					
					<?php
						for($i=0;$i<count($datos);$i++){
					?>
						<input type="hidden" name="item_name_<?php echo $i+1;?>" value="<?php echo $datos[$i]['Nombre'];?>">
						<input type="hidden" name="amount_<?php echo $i+1;?>" value="<?php echo $datos[$i]['Precio'];?>">
						<input type="hidden" name="quantity_<?php echo $i+1;?>" value="<?php echo $datos[$i]['Cantidad'];?>">
					<?php
						}
					?>

					
					
					<center>
						<input type="submit" value="comprar" class="aceptar" style="width:200px">
					</center>
				</form>
				<?php


			}  
		?>
		<center><a href="./">Ver catalogo</a></center>



		

	</section>
</body>
</html>

<!--
- Para el carrito de compras se escoge el "METODO 2" del siguiente link:
https://www.paypal.com/cgi-bin/webscr?cmd=p/pdn/howto_checkout-outside#methodtwo

- La nomenclatura en cuanto a unidades monetarias según paises, esta en el siguiente link:
https://developer.paypal.com/docs/classic/api/currency_codes/

-->