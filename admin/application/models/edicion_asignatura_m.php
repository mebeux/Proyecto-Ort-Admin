<?php

class Edicion_asignatura_m extends CI_Model {

    public $id;
    public $anio;
    public $anio_asignatura;
    public $id_asignatura;
    public $id_plan;
    public $teorica;
    // nombre de la asignatura
    public $nombre;
    private $id_previa;
    public $previas;

    public function get($idAsignatura, $idPlan, $anio) {

        $this->db->where("id_asignatura", $idAsignatura);
        $this->db->where("id_plan", $idPlan);
        $this->db->where("anio_edicion", $anio);
        $this->db->order_by("unidad_proyecto", "desc"); 
        $cmd = $this->db->get("edicion");

        if ($cmd->num_rows > 0) {
            $fila = $cmd->row();
            $salida = $this->_cargar_datos($fila);
            return $salida;
        }
        return NULL;
    }
    
    public function get_todas_por_edicion($idPlan, $anio) {

        $this->db->where("id_plan", $idPlan);
        $this->db->where("anio_edicion", $anio);
        $this->db->order_by("unidad_proyecto", "asc");
        $cmd = $this->db->get("edicion");
        $salida=array();
        if ($cmd->num_rows > 0) {
            foreach ($cmd->result() as $fila){   
            $row = $this->_cargar_datos($fila);
            array_push($salida, $row);
        }
        return $salida;
        }
        return NULL;
    }

    public function get_nombre() {
        return $this->nombre;
    }

    public function get_previas() {

        if (!empty($this->id_previa) && (is_null($this->previas))) {
            $this->previas = $this->_get_previas();
        }
        return $this->previas;
    }

    // determina si el estudiante aprobó la previas del curso
    function aprobo_previas($idEstudiante) {

        $salida = array("estado" => TRUE, "previas" => array());

        // las previas son asignaturas
        $previas = $this->get_previas();

        if (!empty($previas)) {
            foreach ($this->get_previas() as $previa) {

                $valor = $this->_asignatura_aprobada($previa, $idEstudiante);

                if (!$valor["aprobado"]) {

                    $salida["estado"] = 0;
                    $nombrePrevia = $this->_get_nombre_previa($previa);
                    $aux = array("id_previa" => $previa, 
                            "nombre"=>$nombrePrevia);
                    $salida["previas"][] = $aux;
                }
            }
        }
        return $salida;
    }

    private function _get_nombre_previa($idPrevia) {
        $this->load->model("asignatura_m");
        return $this->asignatura_m->get($idPrevia,$this->id_plan)->nombre;
    }
    
    private function _cargar_datos($fila) {
        $salida = new Edicion_asignatura_m;
        $salida->id = $fila->id;
        $salida->id_previa = $fila->id_previa;
        $salida->id_plan = $fila->id_plan;
        $salida->id_asignatura = $fila->id_asignatura;
        $salida->nombre = $fila->nombre_edicion;
        $salida->anio = $fila->anio_edicion;
        $salida->teorica = $fila->teorica_edicion;
        $salida->anio_asignatura = $fila->anio_asignatura;
        return $salida;
    }

    private function _asignatura_aprobada($idAsignatura, $idEstudiante) {

        $this->load->model("asignatura_m");
        $asignatura = $this->asignatura_m->get($idAsignatura, $this->id_plan);
        $valor = $asignatura->aprobada($idEstudiante);
        return $valor;
    }

    private function _get_previas() {

        $this->load->model("previa_m");
        $previas = $this->previa_m->get($this->id_previa);
        return $previas->get_previas_completas();
    }

}
