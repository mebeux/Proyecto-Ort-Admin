<?php

class Edicion_asignatura_m  {
    
    
    public function get($idAsignatura,$idPlan) {
    }

    public function get_previas() {
        
        if (is_null($this->previas)) {
            $this->previas = $this->previas_m->get($id_previa); 
        }
    }

    // determina si el estudiante aprobó la previas del curso
    function aprobo_previas($idEstudiante) {

        $flag = 1;
        $salida = array();

        $tabla = array();

        $this->previas = array();

        // las previas son asignaturas
        foreach ($this->get_previas() as $previa) {
            if (!$previa->aprobada($id_estuidante)) {
                return false;
            }
        }
        
        return true;
    
    }    
            
  
    
}
