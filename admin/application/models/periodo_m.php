<?php

class Periodo_m extends CI_Model {

    public $id;
    public $asignaturas;
    public $mes;
    public $anio;
    public $unidad_proyecto;
    public $practica_profesional;
    public $actual = null;

    public function get($idPeriodo) {
        $sql = "SELECT id_periodo as periodo, 
                    anio_lectivo as anio,
                    unidad_proyecto,
                    practica_profesional,
                    periodo_actual as actual
                    FROM  periodos
                    WHERE id_periodo=?;";
        $param = array($idPeriodo);
        $fila = $this->db->query($sql, $param);

        if ($fila->num_rows > 0) {
            $fila = $fila->row();
            $salida = new Periodo_m();
            $salida->id = $fila->periodo;
            $salida->mes = substr($fila->periodo, 4);
            $salida->anio = $fila->anio;
            $salida->unidad_proyecto = $fila->unidad_proyecto;
            $salida->practica_profesional = $fila->practica_profesional;
            $salida->actual = $this->get_actual()->periodo;
            return $salida;
        }
        return NULL;
    }

    public function get_actual() {
        if (empty($this->actual)) {
            $sql = "SELECT id_periodo as periodo, 
                    anio_lectivo as anio,
                    unidad_proyecto,
                    practica_profesional,
                    periodo_actual as actual
                    FROM  periodos
                    WHERE periodo_actual=?;";
            $param = array(1);
            $cmd = $this->db->query($sql, $param);

            if ($cmd->num_rows > 0) {
                $this->actual = $cmd->row();
            }
        }

        return $this->actual;
    }

    public function get_todos() {
        $sql = "SELECT id_periodo as periodo, 
                    anio_lectivo as anio,
                    unidad_proyecto,
                    practica_profesional,
                    periodo_actual as actual
                    FROM  periodos;";

        $cmd = $this->db->query($sql);
        if ($cmd->num_rows > 0) {
            return $cmd->result();
        }
        return NULL;
    }

    public function get_asignaturas() {

        if (empty($this->asignaturas)) {
            $this->load->model("asignatura_m");
            $this->asignaturas = $this->asignatura_m->get_asignaturas_por_periodo($this->id);
            return $this->asignaturas;
        }
    }

    public function to_array() {

        $salida = array("id" => $this->id,
            "anio" => $this->anio,
            "mes" => $this->mes,
            "unidad_proyecto" => $this->unidad_proyecto,
            "practica_profesional" => $this->prectica_profesional);

        $salida["asignaturas"] = $this->get_asignaturas();
        return $salida;
    }

    public function crear() {
        $data = array(
            'periodo_actual' => 0);
        $this->db->where('periodo_actual', 1);
        $this->db->update('periodos', $data);


        $data2 = array(
            'id_periodo' => $this->id,
            'periodo_actual' => 1,
            'anio_lectivo' => $this->anio,
            'unidad_proyecto' => $this->unidad_proyecto,
            'practica_profesional' => $this->practica_profesional);

        $this->db->insert('periodos', $data2);
    }
      public function editar($lista_asignaturas_eliminar, $id_viejo) {
         $data = array(
            'id_periodo' => $this->id,
            'periodo_actual' => 1,
            'anio_lectivo' => $this->anio,
            'unidad_proyecto' => $this->unidad_proyecto,
            'practica_profesional' => $this->practica_profesional);
        $this->db->where('id_periodo', $id_viejo);
        $this->db->update('periodos', $data);
        
        foreach($lista_asignaturas_eliminar as $asignatura){
            $this->db->delete('asignaturas', array('id_asignatura' => $asignatura)); 
        }

    }

}
