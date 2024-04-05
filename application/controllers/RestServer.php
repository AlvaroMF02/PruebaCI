<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

require APPPATH . '/libraries/RestController.php';
require APPPATH . '/libraries/Format.php';

class RestServer extends RestController
{

	// Metodo obligatorio para conectar con la bd?
	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->model("Empresa_model");
	}

	// Metodo get para pasar a todos los empleados
	public function getEmployee_get(){
		$this->response($this->Empresa_model-> get_all_employee());
	}

	// hace el login, pasando usuario y contr, gestiona el token y la sesion
	public function login_post(){
		$user = $this->post("user");
		$passw = $this->post("passwd");

		$this->response($this->Empresa_model->api_login($user,$passw));
	}

}
