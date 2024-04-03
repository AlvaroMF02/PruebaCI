<?php

class Empresa_model extends CI_Model{

    // Consultas a la base de datos
    public function ver_login($usuario,$clave){
        $this->db->select("*");
        $this->db->from("administradores");
        $this->db->where("usuario",$usuario);
        $this->db->where("clave",$clave);

        $query = $this->db->get();

        if($query->num_rows()>0){
            return $query->result();
        }else{
            return -1;
        }
    }


    public function get_empleados(){
        $this->db->select("*");
        $this->db->from("empleados");

        $query = $this->db->get();

        // print_r($query->result());

        if($query->num_rows()>0){
            return $query->result();
        }else{
            return NULL;
        }
    }


    public function insertar_empleado(){
        $empleado["nombre"] = "ejemplo";
        $empleado["apellido1"] = "ejemplo";
        $empleado["apellido2"] = "ejemplo";
        $empleado["direccion"] = "ejemplo";

        $this->db->insert("empleados",$empleado);
    }

}

?>