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
    public function insertar_empleado($datosForm){
        $empleado["nombre"] = $datosForm["nombre"];
        $empleado["apellido1"] = $datosForm["apellido1"];
        $empleado["apellido2"] = $datosForm["apellido2"];
        $empleado["direccion"] = $datosForm["direccion"];

        $this->db->insert("empleados",$empleado);
    }

    // Muestra un empleado por su id
    // public function get_empleado($id){
    //     $this->db->select("*");
    //     $this->db->from("empleados");
    //     $this->db->where("id",$id);

    //     $query = $this->db->get();

    //     if($query->num_rows()>0){
    //         return $query->result();
    //     }else{
    //         return NULL;
    //     }
    // }

    // Edita un empleado
    public function editar_empleado($datosForm){
        $empleadoEdit["nombre"] = $datosForm["nombre"];
        $empleadoEdit["apellido1"] = $datosForm["apellido1"];
        $empleadoEdit["apellido2"] = $datosForm["apellido2"];
        $empleadoEdit["direccion"] = $datosForm["direccion"];

        $this->db->where("id", $datosForm["id"]);
        $this->db->update("empleados", $empleadoEdit);
    }

    // Actualiza un empleado para ponerlo como borrado
    public function borrar_empleado($id){
        $borrado["borrado"] = 1;

        $this->db->where("id", $id);
        $this->db->update("empleados", $borrado);
    }

}

?>