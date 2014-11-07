<?php

class Periodo_asignatura_m extends CI_Model {

    public $id_asignatura;
    public $id_plan;
    public $nombre;
    public $id_previas;
    public $periodo;

    public function get($idAsignatura, $idPlan, $idPeriodo) {

        $this->db->where("id_asignatura", $idAsignatura);
        $this->db->where("id_plan", $idPlan);
        $this->db->where("id_periodo", $idPeriodo);
        $cmd = $this->db->get("periodos_asignaturas");

        if ($cmd->num_rows > 0) {

            $fila = $cmd->row();
            $salida = $this->_cargar_datos($fila);
            return $salida;
        }
        return NULL;
    }

    public function get_nombre() {
        return $this->nombre;
    }

    // determina si el estudiante aprobó la previas del curso
    function aprobo_previas($idEstudiante) {

        $salida = array("estado" => 1, "previas" => array());

        $this->previas = array();

        // las previas son asignaturas
        $previas = $$this->get_previas();

        if (!empty($previas)) {

            foreach ($previas as $previa) {

                $valor = $this->_asignatura_aprobada($previa, $idEstudiante);
                $nombrePrevia = $this->_get_nombre_previa($previa);

                if (!$valor["aprobado"]) {

                    $salida["estado"] = 0;
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
    
    private function _asignatura_aprobada($idAsignatura, $idEstudiante) {

        $this->load->model("asignatura_m");
        $asignatura = $this->asignatura_m->get($idAsignatura, $this->id_plan);
        $valor = $asignatura->aprobada($idEstudiante);
        return $valor;
    }

    public function get_previas() {

        if (!empty($this->id_previa) && (is_null($this->previas))) {
            $this->previas = $this->_get_previas();
        }
        return $this->previas;
    }

    private function _get_previas() {

        $this->load->model("previa_m");
        $previas = $this->previa_m->get($this->_id_previa);
        return $previas->get_previas_completas();
    }

    private function _cargar_datos($fila) {
        $salida = new Periodo_asignatura_m();
        $salida->id_asignatura = $fila->id_asignatura;
        $salida->id_plan = $fila->id_plan;
        $salida->id_previas = $fila->id_previas;
        $salida->periodoo = $fila->id_periodo;
        $salida->nombre = $fila->nombre_asignatura_examen;
        return $salida;
    }

}
