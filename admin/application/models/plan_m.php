<?php

class Plan_m extends CI_Model {

    var $id;
    var $nombre;
    var $anios;
    public $asignaturas = null;

    public function get_nombre() {
        return $this->nombre;
    }

    public function get_id() {
        return $this->id;
    }

    public function get_anios() {
        return $this->anios;
    }

    public function get($idPlan) {

        $aux = new plan_m();

        $this->db->where("id_plan", $idPlan);
        $cmd = $this->db->get("plan");
        $fila = $cmd->row_array();
        $aux->nombre = $fila["nombre_plan"];
        $aux->id = $fila["id_plan"];
        $aux->anios = $fila["anios"];
        return $aux;
    }

    public function get_todos() {

        $this->db->select("id_plan AS id, nombre_plan AS nombre, anios");
        $this->db->order_by("anio_plan", "DESC");
        $cmd = $this->db->get("plan");
        $filas = $cmd->result();
        return $filas;
    }

    /*
     * @desc Lista de estudiantes que tienen por lo menos una aprobación
     *              de asignatura 
     * @return arreglo que incluye la ID del estuidante, y la ID del curso o 
     *          examen 
     */
    public function get_aprobaron_asignatura() {
        $this->load->model("asignatura_m");
        return $this->asignatura_m->get_aprobaron_asignatura($this->id);
    }
        

    /*
     * @desc Lista de estudiantes que tienen por lo menos una previa sin aprobar 
     * @return arreglo que incluye la ID del estuidante, y la ID del curso o 
     *          examen 
     */
    public function get_previas_sin_aprobar() {

        $tabla = $this->get_aprobaron_asignatura();
        $salida = array();
        
        foreach ($tabla as $fila) {

            $edicion = $this->_get_edicion($fila["tipo"],
                        $fila["id_asignatura"],
                        $fila["periodo"]);
            
            // si la edición no está definida obtiene las previas del plan
            if (is_null($edicion)) {
                $edicion = $this->get_asignatura($fila["id_asignatura"]);
            }
            
            $valor = $edicion->aprobo_previas($fila["id"]);

            if (!$valor["estado"]) {
                $salida[] = $this->_cargar_error_previas($fila,
                                 $valor,
                                 $edicion->get_nombre());
            }
            
        }    
            
        return $salida;
    }

    /*
     *   @desc Obtiene la edición del plan o el periódo correspondiente, es invocada
     *          por get_previas_sin_aprobar
     * 
     */
    private function _get_edicion($tipo,$idAsignatura,$idPeriodo) {
        
        if (strtolower($tipo)=="curso") {
            $this->load->model("edicion_asignatura_m");
            $salida = $this->edicion_asignatura_m;
        } else {        
            $this->load->model("periodo_asignatura_m");
            $salida = $this->periodo_asignatura_m;
        }
        return $salida->get($idAsignatura,$this->id,$idPeriodo);
    }
        
    
    private function _cargar_error_previas($fila,$valor,$nombreAsignatura) {

        $this->load->model("estudiante_m");
        $estudiante = $this->estudiante_m->get($fila["id"]);
        
        $nombreEstudiante = "{$estudiante->nombre} {$estudiante->apellido}";
        
        $salida =   array(  "id_estudiante"=>$fila["id"],
                            "nombre"=>$nombreEstudiante,
                            "id_asignatura"=>$fila["id_asignatura"],
                            "asigantura"=>$nombreAsignatura,
                            "id_periodo"  =>$fila["periodo"],
                            "previas"   =>$valor["previas"]);
        return $salida;
    }
    
    private function _get_asignaturas() {

        $sql = "SELECT a.id_asignatura AS id, a.nombre_asignatura AS nombre, pa.* 
                    FROM asignaturas a
                    INNER JOIN plan_asignaturas pa 
                    ON pa.id_asignatura = a.id_asignatura
                    WHERE pa.id_plan=?  
                    ORDER BY pa.anio_asignatura ASC, pa.teorica DESC, a.nombre_asignatura";

        $param = array("id_plan" => $this->id);

        $cmd = $this->db->query($sql, $param);
        $this->asignaturas = $cmd->result();
    }

    private function get_asignatura($idAsignatura) {
        $this->load->model("asignatura_m");
        return $this->asignatura_m->get($idAsignatura,$this->id);
    }
    
    public function get_asignaturas() {

        if (is_null($this->asignaturas)) {
            $this->_get_asignaturas();
        }

        return $this->asignaturas;
    }

}
