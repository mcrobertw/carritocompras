<!--

Video 1******
http://www.youtube.com/watch?v=hoAEhGh0xwY

Archivos e: www.mediafire.com/download/2734w2k94103nd9/ArchivosIniciales.rar

VARIABLES POST EN FORMULARIOS O PETICIONES AJAX
METODO GET SON VISIBLES PARA EL USUARIO
-->

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
			include 'conexion.php';
			$re=mysql_query("select * from producto") or die (mysql_error());

			while($f=mysql_fetch_array($re)){

				
		 ?>
		

		<div class="producto">
			<center>
					<img src="./productos/<?php echo $f['imagen'];?>"><br>
					<span><?php echo $f['nombre'];?></span><br>
					<a href="./detalles.php?id=<?php echo $f['id']; ?>">ver</a>
			</center>
		</div>

		<?php 
			}
		 ?>
		<!--
		<div class="producto">
			<center>
					<img src="./productos/computadora.jpg"><br>
					<span>Computadora</span><br>
					<a href="./detalles.php">ver</a>
			</center>
		</div>
		-->
	</section>
</body>
</html>