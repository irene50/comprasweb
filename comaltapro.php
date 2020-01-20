<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web compras</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
<h1>ALTA PRODUCTOS - Irene Gomez</h1>
<?php
include "conexion.php";


/* Se muestra el formulario la primera vez */
if (!isset($_POST) || empty($_POST)) { 
	$categorias=obtenerCategorias($db);
	
	
    /* Se inicializa la lista valores*/
	echo '<form action="" method="post">';
?>
<div class="container ">
<!--Aplicacion-->
<div class="card border-success mb-3" style="max-width: 30rem;">
<div class="card-header">Datos Producto</div>
<div class="card-body">
		<div class="form-group">
        ID PRODUCTO <input type="text" name="idproducto" placeholder="idproducto" class="form-control">
        </div>
		<div class="form-group">
        NOMBRE PRODUCTO <input type="text" name="nombre" placeholder="nombre" class="form-control">
        </div>
		<div class="form-group">
        PRECIO PRODUCTO <input type="text" name="precio" placeholder="precio" class="form-control">
        </div>
	<div class="form-group">
	<label for="categoria">Categorías:</label>
	<select name="categoria">
		<?php foreach($categorias as $categoria) : ?>
			<option> <?php echo $categoria ?> </opction>
		<?php endforeach; ?>
	
	</select>
	</div>
	</BR>
<?php
	echo '<div><input type="submit" value="Alta Producto"></div>
	</form>';
} else { 
    $idproducto=$_POST['idproducto'];
    $nombre=$_POST['nombre'];
    $precio=$_POST['precio'];

    $idcategoria=$_POST['categoria'];
	$sql = "SELECT ID_CATEGORIA FROM CATEGORIA WHERE NOMBRE= '$idcategoria' ";
	$resultado=mysqli_query($db, $sql);//el resultado no es valido, hay que tratarlo
    $row=mysqli_fetch_assoc($resultado);    
    $id=$row['ID_CATEGORIA'];
	$sql = "INSERT INTO PRODUCTO (ID_PRODUCTO, NOMBRE, PRECIO, ID_CATEGORIA) VALUES ('$idproducto', '$nombre', '$precio', '$id')";

   
    if (mysqli_query($db, $sql)) {
        echo "Datos introducidos correctamente en tabla empleado<br>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
    }

	
	
	
}
?>

<?php
// Funciones utilizadas en el programa
function obtenerCategorias($db){
	$categorias = array();
	
	$sql = "SELECT NOMBRE FROM CATEGORIA";
	
	$resultado = mysqli_query($db, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			$categorias[] = $row['NOMBRE'];
		}
	}
	return $categorias;
	
	
	
}


	




?>



</body>

</html>
