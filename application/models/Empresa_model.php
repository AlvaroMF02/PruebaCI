<?php

class Empresa_model extends CI_Model
{

    // Consultas a la base de datos
    public function ver_login($usuario, $clave)
    {
        // $this->db->select("*"); coge * por defecto
        // $this->db->from("administradores");
        $this->db->where("usuario", $usuario)
            ->where("clave", $clave)
            ->limit(1);
        // $this->db->where("clave", $clave);

        $query = $this->db->get("administradores");
        // $query = $this->db->get("administradores")->result_array(); 
        // $query = $this->db->get("administradores")->result_row();  result_row_array(); 

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return -1;
        }
    }

    // Muestra los empleados que no esten borrados
    public function get_empleados()
    {
        $this->db->select("*");
        $this->db->from("empleados");
        $this->db->where("borrado", 0);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    // Inserción de un empleado
    public function insertar_empleado($datosForm)
    {
        $empleado["nombre"] = $datosForm["nombre"];
        $empleado["apellido1"] = $datosForm["apellido1"];
        $empleado["apellido2"] = $datosForm["apellido2"];
        $empleado["direccion"] = $datosForm["direccion"];

        $this->db->insert("empleados", $empleado);
    }

    // Edita un empleado
    public function editar_empleado($datosForm)
    {
        $empleadoEdit["nombre"] = $datosForm["nombre"];
        $empleadoEdit["apellido1"] = $datosForm["apellido1"];
        $empleadoEdit["apellido2"] = $datosForm["apellido2"];
        $empleadoEdit["direccion"] = $datosForm["direccion"];

        $this->db->where("id", $datosForm["id"]);
        $this->db->update("empleados", $empleadoEdit);
    }

    // Actualiza un empleado para ponerlo como borrado
    public function borrar_empleado($id)
    {
        $borrado["borrado"] = 1;

        $this->db->where("id", $id);
        $this->db->update("empleados", $borrado);
        // $this->db->update("empleados", $borrado,["id"=>$id]);    sin el where de arriba
    }

    // -------------------- API --------------------

    // mostrar todos los empleados
    public function get_all_employee()
    {
        $this->db->select("*");
        $this->db->from("empleados");

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    // Consultas a la base de datos             mandar token e iniciar session
    public function api_login($usuario, $clave)
    {
        $this->db->select("nombre,usuario");
        $this->db->from("administradores");
        $this->db->where("usuario", $usuario);
        $this->db->where("clave", $clave);

        $query = $this->db->get();
        $resul = $query->result();

        $sesion["nombre"] = $resul[0]->nombre;
        $sesion["usuario"] = $resul[0]->usuario;

        $this->session->set_userdata($sesion);

        $sesion["token"] = $this->session->userdata("__ci_last_regenerate");


        if ($query->num_rows() > 0) {
            return $sesion;
        } else {
            return "Ese usuario no existe";
        }
    }
}
