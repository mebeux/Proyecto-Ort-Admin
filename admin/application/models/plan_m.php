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

        $sql = "SELECT DISTINCT id_estudiante AS id, id_asignatura, tipo, periodo
                FROM 
                    (SELECT id_estudiante,id_asignatura,
                            \"CURSO\" AS tipo, anio_lectivo AS periodo 
                        FROM cursos c
                        INNER JOIN cursos_estudiantes ec 
                        ON c.id_curso = ec.id_curso 
                        WHERE id_plan = ? AND aprobado = TRUE 
                    UNION SELECT id_estudiante, id_asignatura,
                            \"EXAMEN\" AS tipo, anio_lectivo AS periodo
                        FROM examenes e 
                        INNER JOIN examenes_estudiantes ee 
                        ON e.id_examen = ee.id_examen 
                        WHERE id_plan=? AND aprobado = TRUE) 
                AS t
                ORDER BY id_estudiante";

        $param = array($this->id, $this->id);
        $cmd = $this->db->query($sql, $param);
        $tabla = $cmd->result();

        return $tabla;
    }
        

    /*
     * @desc Lista de estudiantes que tienen por lo menos una previa sin aprobar 
     * @return arreglo que incluye la ID del estuidante, y la ID del curso o 
     *          examen 
     */
    public function get_previas_sin_aprobar() {

        $tabla = $this->get_aprobaron_asignatura();
        $salida = array();

        $this->load->model("edicion_asignatura_m");
        
        foreach ($tabla as $fila) {
             $edicion_asignatura = $this->edicion_asignatura_m->get($fila["periodo"]);
             $valor = $edicion_asignatura->aprobo_previas();
             
             if ($valor["error"]) {
                 $salida[] = array("id_estudiante"=>$fila["id_estudiante"],
                     "id_asignatura"=>$fila["id_asignatura"],
                     "nombre_asignatura"=>$edicion_asignatura->get_nombre(),
                     "id_periodo"  =>$fila["periodo"],
                     "id_previa"   =>$valor["id_previa"],
                     "nombre_previa"=>$valor["nombre_previa"]);
             }
        }

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

    public function get_asignaturas() {

        if (is_null($this->asignaturas)) {
            $this->_get_asignaturas();
        }

        return $this->asignaturas;
    }

}
