<?php

class Edicion_m extends CI_Model {
    
    public $anio;
    public $plan;
    
    public function get($anio,$idPlan) {
        $param=array($idPlan,$anio);
        $sql="SELECT distinct anio_edicion, id_plan "
                . "FROM edicion where id_plan=? and anio_edicion=?;";
        $cmd = $this->db->query($sql,$param);
        
        $salida = NULL;
        
        if ($cmd->num_rows>0) {
            $fila = $cmd->row();
            $salida = new Edicion_m();
            $salida->anio = $cmd->row()->anio_edicion;
            $salida->plan = $cmd->row()->id_plan;
        }
        return $salida;
    }
    
    public function get_anios_plan($idPlan){
        $param=array($idPlan);
        $sql="SELECT distinct anio_edicion as anio_lectivo FROM edicion where id_plan=?;";
        $cmd=$this->db->query($sql,$param);
         if ($cmd->num_rows>0) {
             return $cmd->result();
         }
    }
    
    public function get_edicion_asignatura($idAsignatura) {
        
        $this->load->model("edicion_asignatura_m");
        return $this->edicion_asignatura_m->get($id_Asignatura,$this->plan,$this->anio);
        
    }
    
    public function get_edicion_todas_asignaturas() {
        
        $this->load->model("edicion_asignatura_m");
        return $this->edicion_asignatura_m->get_todas_por_edicion($this->plan,$this->anio);
        
    }
    
    public function aprobo_previas($idAsignatura,$idEstudiante) {

        $edicion_asignatura = $this->get_edicion_asignatura($idAsignatura);
        return $edicion_asignatura->aprobo_previas($idEstudiante);
    }
    
    
}
