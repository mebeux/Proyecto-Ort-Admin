<?php

class Edicion_m extends CI_Model {
    
    public $anio;
    public $plan;
    
    public function get($anio,$idPlan) {
        
        $this->db->where("anio_lectivo",$anio);
        $this->db->where("id_plan",$plan);
        $cmd = $this->db->get("edicion");
        
        $salida = NULL;
        
        if ($cmd->num_rows>0) {
            $fila = $cmd->row;
            $salida = Edicion_m();
            $this->anio = $cmd->id_edicion;
            $this->plan = $cmd->id_plan;
        }
    }
    
    public function get_edicion_asignatura($idAsignatura) {
        
        $this->load->model("edicion_asignatura_m");
        return $this->edicion_asignatura_m->get($id_Asignatura,$this->plan,$this->anio);
        
    }
    
    public function aprobo_previas($idAsignatura,$idEstudiante) {

        $edicion_asignatura = $this->get_edicion_asignatura($idAsignatura);
        return $edicion_asignatura->aprobo_previas($idEstudiante);
    }
    
    
}
