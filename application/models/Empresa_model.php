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

    // Muestra los empleados que no esten borrados
    public function get_empleados(){
        $this->db->select("*");
        $this->db->from("empleados");
        $this->db->where("borrado",0);

        $query = $this->db->get();

        if($query->num_rows()>0){
            return $query->result();
        }else{
            return NULL;
        }
    }

    // Inserción de un empleado
    public function insertar_empleado(){
        $empleado["nombre"] = "ejemplo";
        $empleado["apellido1"] = "ejemplo";
        $empleado["apellido2"] = "ejemplo";
        $empleado["direccion"] = "ejemplo";

        $this->db->insert("empleados",$empleado);
    }

    // Actualiza un empleado para ponerlo como borrado
    public function borrar_empleado($id){
        $borrado["borrado"] = 1;

        $this->db->where("id", $id);
        $this->db->update("empleados", $borrado);
    }

}

?>