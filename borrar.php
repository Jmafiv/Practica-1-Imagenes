
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Control bd</title>
</head>

  <h3 class="text-center">Se borrará el siguiente artículo de la base de datos:</h3>

  <hr>




      

<?php

  $codigo = $_POST['codigo'];

  $descripcion = $_POST['descripcion'];

  $precio_compra = $_POST['precio_compra'];

  $precio_venta = $_POST['precio_venta'];

  $stock = $_POST['stock'];

  ?>
   
Código: <?=$codigo?>
      Descripción: <?=$descripcion?><br>

      Precio de compra: <?=$precio_compra?><br>

      Precio de venta: <?=$precio_venta?><br>

      Stock: <?=$stock?><br>



      <hr>¿Está seguro?



      <table>

        <tr>

          <td>

            <form action="index.php" method="post">

              
              <input type="hidden" name="codigo" value="<?=$codigo?>">

              <input type="submit" name="accion" value="Eliminar">

              <input type="submit"  name="accion" value="Cancelar">

            </form>

          </td>

          <td>&nbsp;</td>

         

        </tr>

      </table>

    </div>

  </div>