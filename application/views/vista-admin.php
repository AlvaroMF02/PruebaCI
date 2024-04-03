<?php

// Cerrar sesion
if (isset($_POST["btnSalir"])) {
	session_destroy();
	redirect(base_url() . "Controlador", "location");
}

// Borrar empleado
if (isset($_POST["btnBorrar"])) {
	echo "asdasdasd";
}


?>



<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo base_url() ?>styles/estilo.css">
	<title>Vista Administrador</title>

</head>

<body>
	<h1>Empleados de la empresa</h1>
	<?php echo "<p>Bienvenido " . $_SESSION["nombre"] . "</p>" ?>
	<form method="post">
		<button name="btnSalir">Salir</button>
	</form>

	<div id="tabla">
		<form method="post">
			<button name="btnInseEmple" id="btnEmplead">Añadir Empleado</button>
		</form>
		<table id="empleados">
			<tr>
				<th>Nombre</th>
				<th>Apellidos</th>
				<th>Dirección</th>
				<th>Acciones</th>
			</tr>
			<?php
			foreach ($empleados as $em) {
				echo "<tr>";
				echo "<td>" . $em->nombre . "</td>";
				echo "<td>" . $em->apellido1 . " " . $em->apellido2 . "</td>";
				echo "<td>" . $em->direccion . "</td>";
				echo "<td> <form method='post'><button name='btnEditar'>Editar</button> <button name='btnBorrar'>Borrar</button></form></td>";
				echo "</tr>";
			}

			?>
		</table>
	</div>

</body>

</html>