<?php 

	$conexion=mysqli_connect('localhost','root','','prueba_laravel');

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Peliculas</title>
</head>
<body>

<br>

	<table border="1" >
		<tr>
			<td>Id</td>
			<td>Pelicula</td>
			<td>Director</td>
			<td>Pais</td>
		</tr>

		<?php 
		$sql="SELECT * from peliculas";
		$result=mysqli_query($conexion,$sql);

		while($mostrar=mysqli_fetch_array($result)){
		 ?>

		<tr>
			<td><?php echo $mostrar['id'] ?></td>
			<td><?php echo $mostrar['pelicula'] ?></td>
			<td><?php echo $mostrar['director'] ?></td>
			<td><?php echo $mostrar['pais'] ?></td>
		</tr>
	<?php 
	}
	 ?>
	</table>

</body>
</html>