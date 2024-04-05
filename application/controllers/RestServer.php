<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

require APPPATH . '/libraries/RestController.php';
require APPPATH . '/libraries/Format.php';

class RestServer extends RestController
{
	// Metodo get
	public function test_get(){
		$uwu = array("a","b","c");
		$this->response($uwu);
	}

}
