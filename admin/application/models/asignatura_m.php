<?php

class Asignatura_m extends CI_Model {

    public $id;
    public $nombre;
    public $previas = null;
    
 public function traer($idAsignatura) {
        
        $aux = new asignatura_m();
        
        $this->db->where("id_asignatura",$id_asignatura);
        $cmd  = $this->db->get("asignaturas");
        $fila = $cmd->row_array();
        $aux->nombre = $fila["nombre_asignatura"];
        $aux->id = $fila["id_asignatura"];
        return $aux;
       
    }
    

    public function get($id) {

        $this->db->where("id_asignatura", $id);
        $cmd = $this->db->get("asignaturas");

        if ($cmd->num_rows > 0) {
            $fila = $cmd->row();
            $salida = new Asignatura_m();
            $salida->id = $fila->id_asignatura;
            $salida->nombre = $fila->nombre_asignatura;
            return $salida;
        }

        return null;
    }

    /*
     * @desc determina si el estuidante ha aprobado algún examen correspondiente
     * a la asignatura
     * @return arreglo que contiene el estado del resultado 
     *           y el número de acta en caso de aprobación
     */

    public function curso_aprobado($idEstudiante) {

        $sql = "SELECT ac.id_curso AS id_curso 
                 FROM cursos ac 
                 INNER JOIN cursos_estudiantes al 
                 ON ac.id_curso = al.id_curso 
                 WHERE id_estudiante=? AND id_asignatura = ? 
                 AND aprobado=TRUE";

        $param = array($idEstudiante, $this->id);
        $cmd = $this->db->query($sql, $param);

        if ($cmd->num_rows > 0) {
            $fila = $cmd->row();
            $salida = array("aprobado" => TRUE,
                "cantidad" => $cmd->num_rows,
                "id_curso" => $fila->id_curso);
            
        } else {
            $salida = array("aprobado" => FALSE,
                "cantidad" => 0,
                "id_curso" => 0);
        }
        return $salida;
    }

    /*
     * @desc determina si el estudiante ha aprobado más de una vez una asignatura 
     * @return un booleano 
     *      
     */

    public function doble_aprobacion($idEstudiante) {

        $salida = $this->curso_aprobado($idEstudiante);
        $cantCursos = $salida["cantidad"];
        $salida = $this->examen_aprobado($idEstudiante);
        $cantExamenes = $salida["cantidad"];
        return ($cantCursos + $cantExamenes) > 1;
    }

    /*
     * @desc determina si el estuidante ha aprobado algún examen correspondiente
     * a la asignatura
     * @return arreglo que contiene el estado del resultado 
     *           y el número de acta en caso de aprobación
     */

    public function examen_aprobado($idEstudiante) {

        $sql = "SELECT ac.id_examen AS id_examen 
                  FROM examenes ac 
                  INNER JOIN examenes_estudiantes al 
                  ON ac.id_examen = al.id_examen 
                  WHERE id_estudiante=? AND id_asignatura = ? 
                  AND aprobado=TRUE";

        $param = array($idEstudiante, $this->id);
        $cmd = $this->db->query($sql, $param);

        if ($cmd->num_rows > 0) {
            $fila = $cmd->row();
            $salida = array("aprobado" => TRUE,
                "cantidad" => $cmd->num_rows,
                "id_examen" => $fila->id_examen);
        } else {
            $salida = array("aprobado" => FALSE,
                "cantidad" => 0,
                "id_examen" => 0);
        }
        return $salida;
    }

    /*
     * @desc determina si el estudiante aprobó la asignatura
     * @return BOOL     
     */

    public function aprobada($idEstudiante) {

        $valor = $this->curso_aprobado($idEstudiante);
        
        $salida = array("aprobado"=>FALSE,"tipo"=>"");
        
        if ($valor["aprobado"]) {
            $salida = array("aprobado"=>TRUE,
                        "tipo"=>"CURSO",
                        "id_curso"=>$valor["id_curso"]
                    );
        }
        
        $valor = $this->examen_aprobado($idEstudiante);
        
        if ($valor["aprobado"]) {
            $salida = array("aprobado"=>TRUE,
                        "tipo"=>"EXAMEN",
                        "id_examen"=>$valor["id_examen"]
                    );
        }
        
        return $salida;
    }
    
        private function _get_previas() {


        $sql = "SELECT DISTINCT  a.nombre_asignatura AS nombre , a.id_asignatura AS id
                FROM previas p 
                INNER JOIN previas_asignaturas pa 
                ON pa.id_previa = p.id_previa 
		INNER JOIN asignaturas a 
                ON a.id_asignatura = pa.id_asignatura
		WHERE p.id_asignatura=? ";

        $param = array("p.id_asignatura" => $this->id);

        $cmd = $this->db->query($sql, $param);
        $this->previas = $cmd->result();
    }
    
    public function get_previas(){
         if (is_null($this->previas)) {
            $this->_get_previas();
        }

        return $this->previas;
        
    }
    
        function get_previas_ajax(){
   $salida=$this->get_previas();
    foreach ($salida as $fila) {
        
        if (count($fila) > 0) {
            echo "{ \"nombre\" : \"" . $fila->nombre . "\", " .
            " \"id\" : \"" . $fila->id ."\" };";
        } else
            echo "{ \"nombre\" : \", \"id\" : \"\"};";
        
    }
    }

 

}
