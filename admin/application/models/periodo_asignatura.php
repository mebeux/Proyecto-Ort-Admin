<?php

class Periodo_asignatura extends CI_Model {

    public function get($idAsignatura,$idPlan,$idPeriodo) {
        
        $this->db->where("id_asigantura",$idAsignatura);
        $this->db->where("id_plan",$idPlan);
        $this->db->where("id_periodo",$idPeriodo);
        $fila = $this->db->get("periodos")->row();

        $this->id = $fila->id;
        $this->id_previas = $fila->id_previas;
        
    }
    
    
   // determina si el estudiante aprobó la previas del curso
    function aprobo_previas($idEstudiante) {

        $salida = array("estado"=>TRUE,"previas"=>array());

        $this->previas = array();

        // las previas son asignaturas
        foreach ($this->get_previas() as $previa) {
            if (!$previa->aprobada($idEstudiante)) {
                
                $aux = array("id_previa"=>$previa->id,
                                "tipo"=>$previa->tipo,
                                "perido"=>$previa->periodo);
                $salida["previas"][] = $aux;
            }
        }
        
        return $salida;
    }    

}    