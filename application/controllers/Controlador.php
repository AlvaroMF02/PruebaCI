<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controlador extends CI_Controller
{

	// Carga la página con toda la vista del admin
	public function index()
	{
		$data["empleados"] = $this->Empresa_model->get_empleados();
		$this->loadViews("vista-admin", $data);
	}

	// Vista del login
	public function login()
	{

		if (isset($_POST["usuario"]) && isset($_POST["clave"])) {
			$usuario = $_POST["usuario"];
			$clave = md5($_POST["clave"]);

			// Guardo los datos del admin que se ha logeado		si no existe devuelve -1
			$datosLogin = $this->Empresa_model->ver_login($usuario, $clave);

			// Si me devuelve datos creo la sesion del admin
			if (is_array($datosLogin)) {
				$sesion["id"] = $datosLogin[0]->id;
				$sesion["nombre"] = $datosLogin[0]->nombre;
				$sesion["usuario"] = $datosLogin[0]->usuario;
				$sesion["clave"] = $datosLogin[0]->clave;

				$this->session->set_userdata($sesion);
				// print_r($_SESSION);
			} else {
				$sesion["error"] = "Contraseña o usuario incorrecta";
				$this->session->set_userdata($sesion);
			}
		}
		$this->loadViews('login');
	}

	// Cargar las vistas al hacer el login
	public function loadViews($view, $data = null)
	{
		// Si la sesion esta iniciada carga la vista del admin
		if (isset($_SESSION["nombre"])) {
			// Para redireccionar al controlador cuando se pone login
			if ($view == "login") {
				redirect(base_url() . "Controlador", "location");
			}
			// $this->load->view('vista-admin',$data);
			$this->load->view($view, $data);
		} else {
			if ($view == "login") {
				$this->load->view('login');
			} else {
				redirect(base_url() . "Controlador/login", "location");
			}
		}
	}

	// en que parte se ejecuta esto ???			url
	// public function verEmpleados()
	// {				// data esta bien comprobado

	// 	if ($_SESSION["nombre"]) {
	// 		$data["empleados"] = $this->Empresa_model->get_empleados();
	// 		$this->loadViews("vista-admin", $data);
	// 	} else {
	// 		redirect(base_url() . "Controlador/login", "location");
	// 	}
	// }
}
