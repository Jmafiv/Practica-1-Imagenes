<?php

  $codigo = $_POST['codigo'];

  $descripcion = $_POST['descripcion'];

  $precio_compra = $_POST['precio_compra'];

  $precio_venta = $_POST['precio_venta'];

  $stock = $_POST['stock'];

  ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Control bd</title>
</head>

<body>

    <h3>

    Modificación de datos del artículo

  </h3>

  

    <form action="index.php" method="post">

  <table>

    <tr><td>Código: </td><td><input type="text" name="codigo" value="<?=$codigo?>" readonly="readonly"></td></tr>

      <tr><td> Descripción:</td><td> <input type="text" name="descripcion" value="<?=$descripcion?>" size="40"></td></tr>

      <tr><td> Precio de compra: </td><td><input type="text" name="precio_compra" value="<?=$precio_compra?>" size="20"></td></tr>

      <tr><td> Precio de venta: </td><td><input type="text" name="precio_venta" value="<?=$precio_venta?>" size="20"></td></tr>

      <tr><td> Stock: </td><td><input type="number" name="stock" value="<?=$stock?>"></td></tr>
      <tr><td> Imagen:</td><td>
        <?php
          $conexion=new mysqli("localhost","root","","examen");
          $conexion->set_charset("utf8");
          $sqlImage = "SELECT * from images where id = (SELECT imagenes FROM articulo WHERE codigo = '$codigo')";
          $resultado=$conexion->query($sqlImage);
          $fila=$resultado->fetch_array();
          $filas = $resultado->num_rows;
          if ($filas != 0){
            extract($fila);
            echo "<img src='images/imagen.php?id=$imagenes'>";
          }
          else{
            echo "<img src='images/sinfoto.gif'>";
          }
          mysqli_close($conexion);
        echo "</td>";
        ?>
    </tr>
        <tr><td colspan="2"><input type="file" name="foto"></td></tr>

 <tr><td>

        <input type="submit"  name="accion" value="Modificar">

        <input type="submit"  name="accion" value="Cancelar">
</td></tr></table>

    </form>

