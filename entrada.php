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

<h3>

      Entrada de mercancía

  </h3>

<table>

    <tr><td>Código:</td><td> <?=$codigo?></td></tr>

    <tr><td>Descripción:</td><td> <?=$descripcion?></td></tr>

    <tr><td>Precio de compra:</td><td> <?=$precio_compra?></td></tr>

    <tr><td>Precio de venta: </td><td><?=$precio_venta?></td></tr>

    <tr><td>Stock: </td><td><?=$stock?></td></tr>

  
     

        <tr>

          <td>

            <form action="index.php" method="POST">

              
              Unidades que entran al almacén: </td><td> <input type="number" min="0"  name="unidades" ></td></tr>

              <input type="hidden" name="codigo" value="<?=$codigo?>">

             <tr><td> <input type="submit" name="accion" value="Entrada">            

              <td><input type="submit"  name="accion" value="Cancelar">


            </form>

          </td>

          

          

        </tr>

      </table>

    </div> 

  </div>

  <br><br>
 

