<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Control bd</title>
</head>
<body>
<?php
    $conexion = mysqli_connect("localhost", "root","", "examen");
    
    mysqli_set_charset($conexion,'utf8');
    
if (isset($_POST['accion']))
 {

    if($_POST['accion'] == "Nuevo articulo") 
	{

      // Inserta un nuevo artículo en la base de datos.

      // Comprueba si el código ya existe.

      $buscaCodigo = "SELECT * FROM articulo WHERE codigo='".$_POST['codigo']."'";
		//echo $buscaCodigo."<br>";
	 $consulta = mysqli_query($conexion,$buscaCodigo);
	  
      if (mysqli_num_rows($consulta) == 1) 
	  {
        echo '<script type="text/javascript">alert("Lo siento, ya existe un artículo con ese código en la base de datos");</script>';
      }
	  else 
	  {//no permitidocodigo de articulo vacío
		if (!empty($_POST['codigo']))
			{
			$inserta = "INSERT INTO articulo VALUES (\"$_POST[codigo]\", \"$_POST[descripcion]\", \"$_POST[precio_compra]\", \"$_POST[precio_venta]\", \"$_POST[stock]\")";
			mysqli_query($conexion,$inserta);
			}
      }

    }
    
    if($_POST['accion'] == "Modificar") 
	{// Modifica los datos de un artículo.
      $modifica = "UPDATE articulo SET  descripcion=\"$_POST[descripcion]\", precio_compra=\"$_POST[precio_compra]\", precio_venta=\"$_POST[precio_venta]\", stock=\"$_POST[stock]\" WHERE codigo=\"$_POST[codigo]\"";
      mysqli_query($conexion,$modifica);
    }

    if($_POST['accion'] == "Eliminar") 
	{// Elimina un artículo de la base de datos.
      $borra = "DELETE FROM articulo WHERE codigo=\"$_POST[codigo]\"";
      mysqli_query($conexion,$borra);
    }
    
    if($_POST['accion'] == "Entrada") 
	{// Entrada de stock. El almacén recibe mercancía.
        $entrada = "UPDATE articulo SET stock=stock+".$_POST['unidades']." WHERE codigo=\"$_POST[codigo]\"";
        mysqli_query($conexion,$entrada);     
    }
    
    if($_POST['accion'] == "Salida") 
	{
	  // Salida de stock. Sale mercancía del almacén.
      // Comprueba si hay suficiente stock
      if ($_POST['stock'] < $_POST['unidades']) 
	  {
		$cadena="Lo siento, no se pueden sacar ".$_POST["unidades"]." unidades del almacén, sólo hay ".$_POST["stock"]." disponibles";
       echo '<script type="text/javascript">alert("'.$cadena.'");</script>';
	  
      } 
	  else 
	  {
        $salida = "UPDATE articulo SET stock=stock-".$_POST['unidades']." WHERE codigo=\"$_POST[codigo]\"";
        mysqli_query($conexion,$salida);
      }

    }
 }
 // Listado /////////////////////////////////////////////////
$listadoArticulos = "SELECT codigo, descripcion, precio_compra, precio_venta, stock FROM articulo ORDER BY descripcion  ";
$consulta = mysqli_query($conexion,$listadoArticulos);
?>
<table  border="1">
<tr bgcolor="#FF9911"><th>Código</th><th>Descripción</th><th>Precio de<br>compra</th><th>Precio de<br>venta</th>
    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Margen&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Stock</th>
    <th><?php if (isset($_POST['accion']))
    {
		echo "<p><br>".$_POST['accion']."</p>";}
		else echo "nada<br>"?></th><th></th><th></th><th></th>
</tr>
<?php
    while ($registro = mysqli_fetch_array($consulta)) {
 ?>

      <tr>

        <td><?=$registro["codigo"]?></td>

        <td><?=$registro["descripcion"]?></td>

        <td><?=$registro["precio_compra"]?></td>

        <td><?=$registro["precio_venta"]?></td>

        <td><?=($registro["precio_venta"] - $registro["precio_compra"])?></td>

        <td><?=$registro["stock"]?></td>

        <td>
          <form action="borrar.php" method="post">
            <input type="hidden" name="codigo" value="<?=$registro["codigo"]?>">
            <input type="hidden" name="descripcion" value="<?=$registro["descripcion"]?>">
            <input type="hidden" name="precio_compra" value="<?=$registro["precio_compra"]?>">
            <input type="hidden" name="precio_venta" value="<?=$registro["precio_venta"]?>">
            <input type="hidden" name="stock" value="<?=$registro["stock"]?>">
            <button type="submit" >Eliminar</button>
          </form>
        </td>
        <td>
          <form action="modificar.php" method="post">
            <input type="hidden" name="codigo" value="<?=$registro["codigo"]?>">
            <input type="hidden" name="descripcion" value="<?=$registro["descripcion"]?>">
            <input type="hidden" name="precio_compra" value="<?=$registro["precio_compra"]?>">
            <input type="hidden" name="precio_venta" value="<?=$registro["precio_venta"]?>">
            <input type="hidden" name="stock" value="<?=$registro["stock"]?>">
            <button type="submit" >Modificar</button>
          </form>
        </td>						
        <td>
          <form action="entrada.php" method="post">
            <input type="hidden" name="codigo" value="<?=$registro["codigo"]?>">
            <input type="hidden" name="descripcion" value="<?=$registro["descripcion"]?>">
            <input type="hidden" name="precio_compra" value="<?=$registro["precio_compra"]?>">
            <input type="hidden" name="precio_venta" value="<?=$registro["precio_venta"]?>">
            <input type="hidden" name="stock" value="<?=$registro["stock"]?>">
            <button type="submit" >Entrada</button>
          </form>
        </td>						
        <td>
          <form action="salida.php" method="post">
            <input type="hidden" name="codigo" value="<?=$registro["codigo"]?>">
            <input type="hidden" name="descripcion" value="<?=$registro["descripcion"]?>">
            <input type="hidden" name="precio_compra" value="<?=$registro["precio_compra"]?>">
            <input type="hidden" name="precio_venta" value="<?=$registro["precio_venta"]?>">
            <input type="hidden" name="stock" value="<?=$registro["stock"]?>">
            <button type="submit" >Salida</button>
          </form>
        </td>						
      </tr>
<?php
//cierre del while del listado
}
?>
<!-- Añadir un nuevo articulo -->
<form action="index.php" method="post">
	<tr bgcolor="888EEE"><td><b>Código</b></td><td><b>Descripción</b></td><td><b>Precio de compra</b></td><td><b>Precio de venta</b></td><td></td><td><b>Stock</b></td>
	<td></td><td></td><td></td> <td></td></tr>
      <td><input type="text" name="codigo" size="10"></td>
      <td><input type="text" name="descripcion"></td>
      <td><input type="number" min="0" name="precio_compra" step="0.01" style="width: 7em"></td>
      <td><input type="number" min="0" name="precio_venta" step="0.01"style="width: 7em"></td>
      <td></td>
      <td><input type="number" min="0" name="stock" style="width: 7em"></td>
      <td colspan="2">
		<input type="submit"  name="accion" value="Nuevo articulo">       
      </td><td></td><td></td>
</form></tr>
</table>