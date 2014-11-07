<?php

class Asignatura_m extends CI_Model {

    public $id;
    public $id_plan;
    private $id_escala;
    private $id_previa;
    public $nombre;
    public $anio;
    public $previas = null;
    public $escala = null;
    public $teorica;
    public $unidad_proyecto;
    public $practica_profesional;

    public function get_previas() {

        if (is_null($this->previas)) {
            $this->_get_previas();
        }

        return $this->previas;
    }

    public function get_escala() {

        if (is_null($this->escala)) {
            $this->_get_escala();
        }
        return $this->escala;
    }

    public function get($id, $idPlan) {

        $sql = "SELECT a.id_asignatura AS id_asignatura,id_plan,nombre_asignatura,
                    anio_asignatura,id_escala,id_previa 
                FROM asignaturas a
                INNER JOIN plan_asignaturas p
                ON a.id_asignatura = p.id_asignatura
                WHERE a.id_asignatura=? AND id_plan=?";

        $param = array($id, $idPlan);

        $cmd = $this->db->query($sql, $param);

        if ($cmd->num_rows > 0) {

            $fila = $cmd->row();
            $salida = new Asignatura_m();
            $salida->id = $fila->id_asignatura;
            $salida->id_plan = $fila->id_plan;
            $salida->id_previa = $fila->id_previa;
            $salida->id_escala = $fila->id_escala;
            $salida->anio = $fila->anio_asignatura;

            $salida->nombre = $fila->nombre_asignatura;
            return $salida;
        }

        return null;
    }
    
        public function get_unidad($id, $idPlan) {

        $sql =" SELECT  id_asignatura,id_plan,
                    anio as anio_asignatura,id_escala,id_previa, nombre_asignatura_examen as nombre_asignatura 
                FROM periodos_asignaturas p
                WHERE p.id_asignatura=? AND p.id_plan=?;";

        $param = array($id, $idPlan);

        $cmd = $this->db->query($sql, $param);

        if ($cmd->num_rows > 0) {

            $fila = $cmd->row();
            $salida = new Asignatura_m();
            $salida->id = $fila->id_asignatura;
            $salida->id_plan = $fila->id_plan;
            $salida->id_previa = $fila->id_previa;
            $salida->id_escala = $fila->id_escala;
            $salida->anio = $fila->anio_asignatura;
           
            $salida->nombre = $fila->nombre_asignatura;
            return $salida;
        }

        return null;
    }
        public function get_asignaturas_unidad($idPeriodo, $idPlan,$anio) {
           $param=array($idPlan,  substr($idPeriodo, 0, 4),$anio);
        $sql =" SELECT * FROM edicion where id_plan=? and unidad_proyecto=1 and anio_edicion=? and anio_asignatura=?;";

        $cmd = $this->db->query($sql, $param);
        $listaSalida=array();
        if ($cmd->num_rows > 0) {
            foreach ($cmd->result() as $fila){
            
            $salida = new Asignatura_m();
            $salida->id = $fila->id_asignatura;
            $salida->id_plan = $fila->id_plan;
            $salida->id_previa = $fila->id_previa;
            $salida->id_escala = $fila->id_escala;
            $salida->anio = $fila->anio_asignatura;
             $salida->previas=$salida->get_previas();
            $salida->nombre = $fila->nombre_edicion;
            array_push($listaSalida, $salida);
        }
            return $listaSalida;
        }

        return null;
    }
    

    public function get_asignaturas_por_periodo($id_periodo) {
        $sql = "SELECT pa.*,
                pl.nombre_plan,
                pl.id_plan as id_plan_Num
                FROM periodos_asignaturas pa
                INNER JOIN plan pl
                ON pl.id_plan=pa.id_plan
                WHERE id_periodo=?
                ORDER BY id_plan, anio, unidad_proyecto;";

        $cmd = $this->db->query($sql, $id_periodo);
        if ($cmd->num_rows > 0) {
            return $cmd->result();
        }
        return NULL;
    }

    /*
     * @desc determina si el estudiante ha aprobado el curso
     *  la asignatura
     * @return arreglo que contiene el estado del resultado 
     *           y el número de acta en caso de aprobación
     */

    public function curso_aprobado($idEstudiante) {

        $sql = "SELECT ac.id_curso AS id_curso 
                 FROM cursos ac 
                 INNER JOIN cursos_estudiantes al 
                 ON ac.id_curso = al.id_curso 
                 WHERE id_estudiante=? AND id_asignatura = ? 
                 AND id_plan = ?
                 AND aprobado=TRUE";

        $param = array($idEstudiante, $this->id, $this->id_plan);
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
                    AND id_plan = ?
                  AND aprobado=TRUE";

        $param = array($idEstudiante, $this->id, $this->id_plan);
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

        $salida = array("aprobado" => FALSE, "tipo" => "");

        if ($valor["aprobado"]) {
            $salida = array("aprobado" => TRUE,
                "tipo" => "CURSO",
                "id_curso" => $valor["id_curso"]
            );
        } else {

            $valor = $this->examen_aprobado($idEstudiante);

            if ($valor["aprobado"]) {
                $salida = array("aprobado" => TRUE,
                    "tipo" => "EXAMEN",
                    "id_examen" => $valor["id_examen"]
                );
            }
        }

        return $salida;
    }

    // determina si el estudiante aprobó la previas del curso
    function aprobo_previas($idEstudiante) {

        $salida = array("estado" => TRUE, "previas" => array());

        $this->previas = array();

        // las previas son asignaturas
        foreach ($this->get_previas() as $previa) {

            $valor = $this->_asignatura_aprobada($previa, $idEstudiante);

            if (!$valor["aprobado"]) {

                $aux = array("id_previa" => $previa,
                    "tipo" => "examen",
                    "id_asignatura" => $this->id_asignatura,
                    "periodo" => $this->periodo);
                $salida["previas"][] = $aux;
            }
        }

        return $salida;
    }

    private function _asignatura_aprobada($idAsignatura, $idEstudiante) {

        $this->load->model("asignatura_m");
        $asignatura = $this->asignatura_m->get($idAsignatura, $this->id_plan);
        $valor = $asignatura->aprobada($idEstudiante);
        return $valor["aprobado"];
    }

    private function _get_previas() {

        if (!empty($this->id_previa)) {
            $this->load->model("previa_m");
            $this->previas = $this->previa_m->get($this->id_previa)->to_array();
            return;
        }

        $this->previas = array();
    }

    private function _get_escala() {

        $this->load->model("escala_m");
        $this->escala = $this->escala_m->get($this->id_escala);
    }

    /*
     * @desc Lista de estudiantes que tienen por lo menos una aprobación
     *              de asignatura dentro del plan idPlan 
     * @return arreglo que incluye la ID del estuidante, y la ID del curso o 
     *          examen 
     */

    public function get_aprobaron_asignatura($idPlan) {

        $sql = "SELECT DISTINCT id_estudiante AS id, id_asignatura, id_acta, tipo, periodo
                FROM 
                        (SELECT id_estudiante,id_asignatura,c.id_curso AS id_acta,
                                \"CURSO\" AS tipo, anio_lectivo AS periodo 
                            FROM cursos c
                            INNER JOIN cursos_estudiantes ec 
                            ON c.id_curso = ec.id_curso 
                            WHERE id_plan = ? AND aprobado = TRUE 
                    UNION 
                        SELECT id_estudiante, id_asignatura,e.id_examen AS id_acta,
                            \"EXAMEN\" AS tipo, id_periodo AS periodo
                            FROM examenes e 
                            INNER JOIN examenes_estudiantes ee 
                            ON e.id_examen = ee.id_examen 
                            WHERE id_plan=? AND aprobado = TRUE) 
                AS t
                ORDER BY id_estudiante";

        $param = array($idPlan, $idPlan);
        $cmd = $this->db->query($sql, $param);
        $tabla = $cmd->result_array();

        return $tabla;
    }

    public function to_array() {

        $salida = array("id" => $this->id,
            "id_plan" => $this->id_plan,
            "nombre" => $this->nombre);

        $salida["previas"] = $this->get_previas();
        $salida["escala"] = $this->get_escala();
        return $salida;
    }
     public function to_array_unidad($idPeriodo, $idPlan,$anio) {

        $salida = array("id" => $this->id,
            "id_plan" => $this->id_plan,
            "nombre" => $this->nombre);
        $i=0;
        $x=0;
    foreach ( $this->get_asignaturas_unidad($idPeriodo, $idPlan,$anio) as $asig){
            $salida["asignaturas"][$i]=$asig->to_array();
             $salida["previas"]=array();
             foreach ( $asig->previas as $prev){
                 if (!in_array($prev["nombre"], $salida["previas"],true)) {
                        $salida["previas"][$x]=  $prev["nombre"];
                 }      
           $x++;
        }
            $i++;
        }
        $salida["escala"] = $this->get_escala();
        return $salida;
    }

}
