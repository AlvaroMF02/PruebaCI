<?php

// Cerrar sesion
if (isset($_POST["btnSalir"])) {
	session_destroy();
	redirect(base_url() . "Controlador", "location");
}

// Borrar empleado
if (isset($_POST["btnBorrar"])) {
	$this->Empresa_model->borrar_empleado($_POST["idEmple"]);
	redirect(base_url() . "Controlador", "location");
}

// Insertar empleado
if (isset($_POST["insertarEmple"])) {

	$datosForm["nombre"] = $_POST["nombre"];
	$datosForm["apellido1"] = $_POST["apellido1"];
	$datosForm["apellido2"] = $_POST["apellido2"];
	$datosForm["direccion"] = $_POST["direccion"];

	$this->Empresa_model->insertar_empleado($datosForm);
	redirect(base_url() . "Controlador", "location");
}

// Editar empleado
if (isset($_POST["editarEmpleado"])) {

	$datosForm["id"] = $_POST["id"];
	$datosForm["nombre"] = $_POST["nombre"];
	$datosForm["apellido1"] = $_POST["apellido1"];
	$datosForm["apellido2"] = $_POST["apellido2"];
	$datosForm["direccion"] = $_POST["direccion"];

	print_r($datosForm);

	$this->Empresa_model->editar_empleado($datosForm);
	redirect(base_url() . "Controlador", "location");
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
		<p><button name="btnSalir" class='btn btn-outline-danger'>Cerrar sesión</button></p>
	</form>

	<div id="tabla">
		<form method="post">
			<button type="button" class='btn btn-success' name="btnInseEmple" id="btnEmplead" data-bs-toggle='modal' data-bs-target='#formInsert'>Añadir Empleado</button>
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
				echo "<td> <form method='post'><button type='button' class='btn btn-outline-info' data-bs-toggle='modal' data-bs-target='#formEdit'
					name='btnModEdit' onClick=idEditarEmpl('" . $em->id . "','" . $em->nombre . "','" . $em->apellido1 . "','" . $em->apellido2 . "','" . $em->direccion . "')>Editar</button> ";

				echo "<button type='button' class='btn btn-outline-danger' name='btnConfiBorrar' onClick=idEmpl('" . $em->id . "') 
					data-bs-toggle='modal' data-bs-target='#confirmBorr'>Borrar</button></form></td>";
				echo "</tr>";
			}

			?>
		</table>
		<!-- Modal para insertar a un empleado -->
		<div class="modal fade" id="formInsert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="exampleModalLabel">Rellene los datos</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form method="post">
							<div class="mb-3">
								<label for="nombre" class="form-label">Nombre</label>
								<input type="text" class="form-control" id="nombre" name="nombre" required>
							</div>
							<div class="mb-3">
								<label for="apellido1" class="form-label">1º Apellido</label>
								<input type="text" class="form-control" id="apellido1" name="apellido1" required>
							</div>
							<div class="mb-3">
								<label for="apellido2" class="form-label">2º Apellido</label>
								<input type="text" class="form-control" id="apellido2" name="apellido2">
							</div>
							<div class="mb-3">
								<label for="direccion" class="form-label">Dirección</label>
								<input type="text" class="form-control" id="direccion" name="direccion" required>
							</div>
							<button type="submit" class="btn btn-primary" name="insertarEmple">Inscribir</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal para editar a un empleado -->
		<div class="modal fade" id="formEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="exampleModalLabel">Edite los datos</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form method="post">
							<input type="text" hidden class="form-control" id="idEdit" name="id" required>
							<div class="mb-3">
								<label for="nombre" class="form-label">Nombre</label>
								<input type="text" class="form-control" id="nombreEdit" name="nombre" value="" required>
							</div>
							<div class="mb-3">
								<label for="apellido1" class="form-label">1º Apellido</label>
								<input type="text" class="form-control" id="apellido1Edit" name="apellido1" required>
							</div>
							<div class="mb-3">
								<label for="apellido2" class="form-label">2º Apellido</label>
								<input type="text" class="form-control" id="apellido2Edit" name="apellido2">
							</div>
							<div class="mb-3">
								<label for="direccion" class="form-label">Dirección</label>
								<input type="text" class="form-control" id="direccionEdit" name="direccion" required>
							</div>
							<button type="submit" class="btn btn-primary" name="editarEmpleado">Editar</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal para la confirmación del borrado -->
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
							<input hidden type="text" name="idEmple" id="idEmple" value="">
							<button name="btnBorrar" class='btn btn-danger' onclick=pasaPhp() id="borrarDefin">Borrar</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Carga del js de BootsTrap-->
	<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
	<script>
		// recojo el id y lo guardo
		let idEmpleado = null

		function idEmpl(id = null) {
			if (id != null) {
				idEmpleado = id
			}
		}
		// en el borrar del modal creo un input y guardo el valor
		function pasaPhp() {
			if (idEmpleado != null) {
				document.getElementById("idEmple").value = idEmpleado;
			}
		}

		// para conseguir los datos del empleado
		function idEditarEmpl(id, nom, ap1, ap2, dir) {
			if (nom != null) {
				document.getElementById("idEdit").value = id;
				document.getElementById("nombreEdit").value = nom;
				document.getElementById("apellido1Edit").value = ap1;
				document.getElementById("apellido2Edit").value = ap2;
				document.getElementById("direccionEdit").value = dir;
			}
		}
	</script>



</body>

</html>