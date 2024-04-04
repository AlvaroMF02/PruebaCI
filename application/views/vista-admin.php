<?php

// Cerrar sesion
if (isset($_POST["btnSalir"])) {
	session_destroy();
	redirect(base_url() . "Controlador", "location");
}

// Borrar empleado
if (isset($_POST["btnBorrar"])) {
	$this->Empresa_model->borrar_empleado($_POST["idEmple"]);
	// redirect(base_url() . "Controlador", "location");	// forma para actulizar la página mejorable?		Hacer un fadeOut() con JQuery
}


?>



<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Diseños -->
	<link rel="stylesheet" href="<?php echo base_url() ?>styles/estilo.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">


	<title>Vista Administrador</title>

</head>

<body>
	<h1>Empleados de la empresa</h1>
	<?php echo "<p>Bienvenido " . $_SESSION["nombre"] . "</p>" ?>
	<form method="post">
		<button name="btnSalir" class='btn btn-outline-danger'>Salir</button>
	</form>

	<div id="tabla">
		<form method="post">
			<button class='btn btn-success' name="btnInseEmple" id="btnEmplead">Añadir Empleado</button>
		</form>
		<table id="empleados" class="table table-light table-hover">
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
				// echo "<td> <form method='post' action='vista-admin.php'><button class='btn btn-outline-info' name='btnEditar'>Editar</button> <input hidden name='idEmpl' value='".$em->id."'> <button type='button' class='btn btn-outline-danger' name='btnConfiBorrar' data-bs-toggle='modal' data-bs-target='#confirmBorr'>Borrar</button></form></td>";
				echo "<td> <form method='post'><button class='btn btn-outline-info' name='btnEditar'>Editar</button> <button type='button' class='btn btn-outline-danger' name='btnConfiBorrar' onClick=idEmpl('" . $em->id . "') data-bs-toggle='modal' data-bs-target='#confirmBorr'>Borrar</button></form></td>";
				echo "</tr>";
			}

			?>
		</table>

		<!-- Modal -->
		<div class="modal fade" id="confirmBorr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="exampleModalLabel">¿Seguro que desea borrar al empleado?</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form method="post">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
							<!-- <button  name="btnBorrar" class='btn btn-danger' value="<?php // echo $_POST["idEmpl"]
																							?>">Borrar</button> -->
							<input hidden type="text" name="idEmple" id="idEmple" value="">
							<button name="btnBorrar" class='btn btn-danger' onclick=pasaPhp() id="borrarDefin">Borrar</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Carga del js -->
	<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
	<script>
		// recojo el id y lo guardo
		let idEmpleado = null

		function idEmpl(id = null) {
			if (id != null) {
				idEmpleado = id
			}
		}
		// en el borrar del modal creo un input y guardo el valor a 
		function pasaPhp() {
			if (idEmpleado != null) {
				document.getElementById("idEmple").value = idEmpleado;
			}
		}

		$("#borrarDefin").on("click",function(){
			$(this).fadeOut();
		})

	</script>



</body>

</html>