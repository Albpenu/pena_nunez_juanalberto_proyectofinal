<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
	<?php
		include("conexion.php");

		$sql = mysqli_query($connect,"SELECT * FROM subcategorias WHERE nombre_subcategoria = '".$_GET['subcat']."';");
		$valor = mysqli_fetch_assoc($sql);
		echo $valor['id_subcategoria'];
		echo "<h1>".$_GET['subcat']."</h1><br><label>***".$valor["descripcion"]."***</label><br><label>".$valor["fecha_ultima_actualizacion"]."</label>";	

		$sql = mysqli_query($connect, "SELECT * FROM posts WHERE id_subcategoria = '".$valor['id_subcategoria']."';");
	?>

	<table border="1px solid black" cellspacing="0">
				<thead style="background-color: #4d8cf2;">
					<th>Título</th>
					<th>Descripción</th>
					<th>Autor</th>
					<th>Fecha de subida</th>
				</thead>
				<tbody>
		<?php
			if (mysqli_num_rows($sql)>0) {
			    while($valor = mysqli_fetch_assoc($sql)) {
			    	$consulta = mysqli_query($connect, "SELECT * FROM usuarios WHERE id_usuario = '".$valor["id_usuario"]."';");
			    	$usu = mysqli_fetch_assoc($consulta);

			        echo "<tr><td id='".$valor["id_subcategoria"]."' align='center'><a href='view_post.php?post=".$valor["titulo"]."'>" .$valor["titulo"]. "</a></td><td align='center'>".substr($valor["contenido"], 0, 100)."...</td><td align='center'>".$usu["alias"]. "</td><td align='center'>".$valor["fecha_subida"]. "</td></tr>";
			    }
			} else {
			    echo "<tr><td colspan='4' align='center'>No hay posts para esta subcategoría. ¡¿A qué esperas?! ¡Ilústranos!</td></tr>";
			}
		?>
				</tbody>
	</table>
</body>
</html>