<?php
	session_start();
	unset($_SESSION['Usuario']); 
		//Si se usa un session_destroit entonces destruiria incluso al carrito
	header("Location: ../index.php");
?>