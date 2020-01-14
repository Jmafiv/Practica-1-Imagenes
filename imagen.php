<?php 
extract($_GET);
$conexion=mysqli_connect ("localhost","root","","examen");
$sacar = "SELECT * FROM  images where id = (SELECT imagenes from articulo WHERE codigo='$id')"; // Busca la imagen de un artículo concreto
$resultado = mysqli_query($conexion,$sacar);
if ($registro = mysqli_fetch_array($resultado))
       {  
		  $tipo_foto=$registro['formato'];
		  header("Content-type: $tipo_foto");	  
		  echo $registro['imagen'];
	   }


mysqli_close($conexion);
?>