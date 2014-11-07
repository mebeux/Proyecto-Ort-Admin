<?php

//include_once("cperiodo.php");

class Estudiante_m extends CI_Model {

    function __construct() {
        parent::__construct();
    }

// variables para el manejo de la base
    var $base;
    var $id;
    var $nro;
    var $inscr;
    var $nombre;
    var $apellido;
    var $credencial;
    var $sexo;
    var $fecha_nacimiento;
    var $direccion;
    var $direccion_2;
    var $departamento;
    var $ciudad;
    var $telefono;
    var $correo;
    var $turno;
    var $prep;
    var $observacion;
    var $trabaja;
    var $valida;
    var $documentacion;
    var $operador;
    var $sancion;
    var $id_sancion;
    var $descr_sancion;
    var $fecha_sancion;
    var $carrera;

    function set_ci($cual) {
        $this->id = trim($cual);
    }

    function set_nombre($cual) {
        $this->nombre = trim($cual);
    }

    function set_apellido($cual) {
        $this->apellido = trim($cual);
    }

    function set_sexo($cual) {
        $this->sexo = $cual;
    }

    function set_credencial($cual) {
        $this->credencial = trim($cual);
    }

    function set_direccion($cual) {
        $this->direccion = trim($cual);
    }

    function set_direccion_2($cual) {
        $this->direccion_2 = trim($cual);
    }

    function set_telefono($cual) {
        $this->telefono = trim($cual);
    }

    function set_turno($cual) {
        $this->turno = trim($cual);
    }

    function set_correo($cual) {
        $this->correo = trim($cual);
    }

    function set_fecha_nacimiento($cual) {
        $this->fecha_nacimiento = trim($cual);
    }

    function set_preparatorio($cual) {
        $this->prep = trim($cual);
    }

    function set_operador($cual) {
        $this->operador = $cual;
    }

    function set_ciudad($cual) {
        $this->ciudad = trim($cual);
    }

    function set_departamento($cual) {
        $this->departamento = trim($cual);
    }

    function set_celular($cual) {
        $this->celular = trim($cual);
    }

    function get_id() {
        return $this->id;
    }

    public function get_ci() {

        // $this->load->library("cedula");

        return $this->cedula->poner_guiones($this->id);
    }

    function ver_nro() {
        return $this->nro;
    }

    function get_nombre() {
        return $this->nombre;
    }

    function get_apellido() {
        return $this->apellido;
    }

    function get_sexo() {
        return $this->sexo;
    }

    function get_fecha_nacimiento() {
        return $this->fecha_nacimiento;
    }

    function get_anio_nacimiento() {
        $anio = substr($this->fecha_nacimiento, 0, 4);
        if ((int) $anio < 1900 || $anio == null)
            return null;
        else
            return $anio;
    }

    function get_mes_nacimiento() {

        $mes = substr($this->fecha_nacimiento, 5, 2);
        if ((int) $mes < 1 || $mes == null)
            return null;
        else
            return $mes;
    }

    function get_dia_nacimiento() {
        $dia = substr($this->fecha_nacimiento, 8, 2);
        if ((int) $dia < 1 || $dia == null)
            return null;
        else
            return $dia;
    }

    function get_direccion() {
        return $this->direccion;
    }

    function get_direccion_2() {
        return $this->direccion_2;
    }

    function get_ciudad() {
        return $this->ciudad;
    }

    function get_credencial() {
        return $this->credencial;
    }

    function get_departamento() {
        return $this->departamento;
    }

    function get_telefono() {
        return $this->telefono;
    }

    function get_celular() {
        return $this->celular;
    }

    function get_correo() {
        return $this->correo;
    }

    function get_turno() {
        return $this->turno;
    }

    function get_preparatorio() {
        return $this->prep;
    }

    function get_trabaja() {
        return $this->trabaja;
    }

    function get_observaciones() {
        return $this->observacion;
    }

    function get_valida() {
        return $this->valida;
    }

    function get_documentacion() {
        return $this->documentacion;
    }

    function tiene_sancion() {
        return $this->sancion;
    }

// fecha hasta la que está vigente la sanción
    function fecha_sancion() {
        return $this->fecha_sancion;
    }

    function motivo_sancion() {
        return $this->descr_sancion;
    }

    public function get_id_carrera() {
        return $this->carrera->get_id();
    }

    public function get_nombre_carrera() {
        return $this->carrera->get_nombre();
    }

    public function traer($cual) {


        $cmd = $this->db->query("SELECT *  FROM estudiantes  e
                INNER JOIN inscrip_carreras ic on e.id=ic.id_estudiante 
                WHERE e.id=? ORDER BY  ic.fecha_inscripcion DESC", array($cual));

        if ($cmd->num_rows() == 0) {
            return null;
        } else {

            $salida = new Estudiante_m();

            $fila = $cmd->row();
            $salida->id = $fila->id_estudiante;
            $salida->nombre = $fila->nombre;
            $salida->apellido = $fila->apellido;
            $salida->sexo = $fila->sexo;
            $salida->fecha_nacimiento = $fila->fecha_nacimiento;
            $salida->credencial = $fila->credencial;
            $salida->direccion = $fila->direccion;
            $salida->direccion_2 = $fila->direccion_2;
            $salida->departamento = $fila->departamento;
            $salida->ciudad = $fila->ciudad;
            $salida->telefono = $fila->telefono;
            $salida->celular = $fila->celular;
            $salida->correo = $fila->mail;
            $salida->prep = $fila->preparatorio;
            $salida->trabaja = $fila->trabaja;
            $salida->load->model('carrera_m');
            $salida->carrera = $salida->carrera_m->traer($fila->id_carrera);

            $sql = "SELECT * FROM sanciones WHERE id_estudiante=? AND fecha_hasta >= CURDATE() AND vigente=true";

            $cmd = $this->db->query($sql, array($salida->id));

            if ($cmd->num_rows() > 0) {
                $fila = $cmd->row();
                $salida->sancion = true;
                $salida->id_sancion = (int) $fila->id;
                $salida->descr_sancion = $fila->descripcion;
                $salida->fecha_sancion = $fila->fecha_hasta;
            } else {
                $salida->sancion = false;
                $salida->id_sancion = 0;
                $salida->descr_sancion = "";
            }

            return $salida;
        }
    }

    function ver_grupo($anio = 0) {

        $prd = new CPeriodo();
        $periodo = $prd->ver_actual();

// busca el curso que ingresó en el formulario de inscripción
        $sql = "SELECT DISTINCT id_grupo as grupo FROM inscrip_examenes WHERE id_estudiante = \"$this->ci\" AND periodo=\"$periodo\" ";

        if ($anio > 0)
            $sql .= " WHERE id_curso IN (SELECT id_asignatura FROM asignaturas_examenes WHERE anio=$anio) ";

        $sql .= " ORDER BY id DESC LIMIT 1";

        $bd = new CBase();
        $filas = $bd->listar($sql);

// si no tiene inscripcioens, recupera el último grupo en el que el estudiante estuvo inscripto.
        if (!isset($filas) || count($filas) == 0) {

            $sql = "SELECT DISTINCT ac.id as id, ac.id_grupo as grupo FROM actas_alumnos al " .
                    "INNER JOIN actas_cursos ac ON al.id_acta = ac.id WHERE al.id_estudiante=\"$this->ci\" " .
                    "WHERE ac.id_curso IN (SELECT id_asignatura FROM asignaturas_examenes WHERE anio=$anio) ORDER BY ac.id DESC LIMIT 1";

            echo $sql;

            $filas = $bd->listar($sql);
        }

        return $filas[0]["grupo"];
    }

    function buscar_grupo($anio = 0) {


        $this->load->model('periodo_m');
        $periodo = $this->periodo_m->get_actual();

        if ($anio >= 1) {

            // busca primero si el estudiante ya se ha inscripto con algún curso en el año
            $sql = "SELECT DISTINCT i.id_grupo as grupo FROM inscrip_examenes i INNER JOIN " .
                    " asignaturas_examenes a ON i.id_curso = a.id_asignatura " .
                    "WHERE anio=$anio AND id_estudiante = \"" . $this->get_id() . "\" AND i.periodo=\"$periodo\"";

            $filas = $this->db->query($sql)->result();

            if (!isset($filas) || count($filas) == 0) {

                $sql = "SELECT DISTINCT ac.id_grupo as grupo FROM actas_alumnos al " .
                        "INNER JOIN (actas_cursos ac INNER JOIN plan p ON ac.id_curso = p.id_asignatura) " .
                        " ON ac.id=al.id_acta " .
                        "WHERE anio=$anio AND id_estudiante = \"" . $this->get_id() . "\"";

                $filas = $this->db->query($sql)->result();

                if (!isset($filas) || count($filas) == 0)
                    return "";
                else
                    return $filas[0]->grupo;
            } else {

                return $filas[0]->grupo;
            }
        } else
            return ver_grupo($anio);
    }

    public function existe($cual) {

        if (trim($cual) == "" || !(isset($cual)))
            return false;

        $cmd = $this->bd->query("SELECT * 
                    FROM estudiantes WHERE id=?", array($cual));
        $cant = $cmd->num_rows();

        if ($cant > 0)
            return true;
        else
            return false;
    }

    function guardar() {

        if (trim($this->ci != "")) {

            if ($this->existe($this->ci))
                return $this->modificar();
            else
                return $this->agregar();
        } else
            return false;
    }

    function modificar() {
        $param = array($this->nombre, $this->apellido, $this->sexo, $this->fecha_nacimiento, $this->credencial,
            $this->direccion, $this->departamento, $this->ciudad, $this->correo, $this->telefono, $this->celular, $this->get_id());
        $sql = "UPDATE estudiantes SET " .
                "nombre = ? , " .
                "apellido = ? , " .
                "sexo = ? , " .
                "fecha_nacimiento = ? , " .
                "credencial = ? , " .
                "direccion = ? , " .
                "departamento = ? , " .
                "ciudad = ? , " .
                "mail = ? , " .
                "telefono = ? , " .
                " celular = ?  " .
                "WHERE id = ? ";
        $this->db->query($sql, $param);
    }

    private function agregar() {

        $base = new CBase();

        $sql = "INSERT INTO estudiantes (id, nombre, apellido, sexo, " .
                " fecha_nacimiento, direccion, ciudad, departamento, credencial, " .
                " telefono, celular, mail, trabaja) " .
                "VALUES (" .
                "\"$this->ci\", " .
                "\"$this->nombre\", " .
                "\"$this->apellido\", " .
                "\"$this->sexo\", " .
                "\"$this->fecha_nacimiento\", " .
                "\"$this->direccion\", " .
                "\"$this->ciudad\", " .
                "\"$this->departamento\", " .
                "\"$this->credencial\", " .
                "\"$this->telefono\", " .
                "\"$this->celular\", " .
                "\"$this->correo\", " .
                "\"$this->trabaja\"" .
                " )";
        $sql = utf8_decode($sql);

        $this->nro = $cant;

        $base = new CBase();

        $base->ejecutar($sql, false);
    }

    function buscar($params, $orden,$periodo) {

        $salida = array();
        $criterio = "";

        foreach ($params as $campo => $valor) {
            if ($campo!="orden" && $campo != "tipo" && $valor!= "todos") {
                $campoBase= $this->_mapear_campo($campo, $valor);
                $this->db->like($campoBase,$valor, 'after');
            }
        }

        $this->db->order_by("estudiantes.".$orden);
        
        $this->db->distinct();
        $this->db->select("estudiantes.id as ci, nombre, apellido, 
                    valida");
        
        $this->db->from("estudiantes");
        $this->db->join("inscrip_examenes",
                    "inscrip_examenes.id_estudiante=estudiantes.id");
        
        /*
        $sql = "SELECT DISTINCT " .
                "FROM estudiantes e INNER JOIN inscrip_examenes i ON e.id = i.id_estudiante " .
                "WHERE $criterio AND periodo=\"$periodo\" ";
        $sql .= "ORDER BY $orden";
         * 
         */
        $salida = $this->db->get()->result_array();

        return $salida;
    }

    private function _mapear_campo($campo) {
        
        $retorno=$campo;
        
        $en_estud = array("id");
        
        foreach($en_estud as $c) {
            if ($campo==$c) {
                $retorno = "estudiantes.$campo";
                return $retorno;
            }
        }
        
        return $retorno;
    }

    function validar() {

        $base = new CBase();
        $sql = "UPDATE estudiantes SET fecha_ingreso = CURDATE() " .
                "WHERE id = \"$this->ci\"";
        $base->ejecutar($sql, false);
    }

    function esta_inscripto_examen($idcurso, $periodo) {

        $param = array($this->get_id(), $idcurso, $periodo);
        $sql = "SELECT count(id) AS cant FROM inscrip_examenes " .
                "WHERE id_estudiante=? AND id_curso=?" .
                "AND periodo=?";

        $fila = $this->db->query($sql, $param)->row();

        if ($fila->cant == 0)
            return false;
        else
            return true;
    }

    function inscribir_examen($idcurso, $categoria, $grupo, $periodo, $operador = "") {

        $valida = 0;
        if ($operador != "")
            $valida = 1;

        if (!$this->esta_inscripto_examen($idcurso, $periodo)) {

            $param = array($idcurso, $this->get_id(), $categoria, $grupo, $valida, $operador, $periodo);
            $sql = "INSERT INTO inscrip_examenes (id_curso,id_estudiante,categoria,id_grupo,valida,id_operador,periodo,fecha)" .
                    "VALUES ( ?, ?, ?, ?, ?, ?, ?, CURDATE())";
        } else {
            $param = array($idcurso, $this->get_id(), $periodo, $categoria, $grupo, $operador, $valida, $this->get_id(), $idcurso, $periodo);
            $sql = "UPDATE inscrip_examenes " .
                    "SET id_curso = ? , " .
                    "id_estudiante = ? , " .
                    "periodo = ? , " .
                    "categoria = ? , " .
                    "id_grupo = ? , " .
                    "id_operador = ? , " .
                    "valida = ? " .
                    "WHERE id_estudiante=? AND id_curso=?" .
                    "AND periodo=?";
        }


        $this->db->query($sql, $param);
    }

    function ver_inscripciones_cursos($periodo) {

        $sql = "SELECT id_curso as id, nombre, turno, periodo FROM inscrip_cursos i INNER JOIN asignaturas a " .
                "ON a.id = i.id_curso WHERE periodo=$periodo AND id_estudiante=\"" . $this->ci . "\"";

        $base = new CBase();
        $tabla = $base->listar($sql);

        return $tabla;
    }

    function inscripcion_carrera($periodo) {

        $sql = "SELECT DISTINCT id_carrera as carrera, anio FROM inscrip_cursos i INNER JOIN plan p " .
                "ON i.id_curso = p.id_asignatura";

        $base = new CBase();
        $tabla = $base->listar($sql);

        return $tabla;
    }

    function tiene_inscripciones_cursos($periodo) {

        $sql = "SELECT count(id) as cant FROM inscrip_cursos WHERE id_estudiante=\"" . $this->ci . "\" AND periodo=$periodo";
        $base = new CBase();

        $fila = $base->ejecutar($sql, true);
        $cant = $fila["cant"];

        if ($cant > 0)
            return true;
        else
            return false;
    }

    function tiene_inscripciones_examenes($periodo) {

        $sql = "SELECT count(id) as cant FROM inscrip_examenes WHERE id_estudiante=\"" . $this->ci . "\" AND periodo=$periodo";
        $base = new CBase();

        $fila = $base->ejecutar($sql, true);
        $cant = $fila["cant"];

        if ($cant > 0)
            return true;
        else
            return false;
    }

    function ver_inscripciones_examenes($periodo) {
        $param = array($periodo, $this->get_id());
        $sql = "SELECT DISTINCT id_curso as id, nombre, i.id_grupo as grupo, i.periodo as periodo, i.categoria as categoria, teorica " .
                "FROM inscrip_examenes i INNER JOIN asignaturas_examenes a " .
                "ON a.id_asignatura = i.id_curso WHERE i.periodo=? AND id_estudiante=?";




        return $this->db->query($sql, $param)->result();
    }

    function borrar_inscripciones_examenes($periodo) {

        $sql = "DELETE FROM inscrip_examenes WHERE id_estudiante=\"" . $this->ci . "\" AND periodo=\"$periodo\"";

        $bd = new CBase();
        $bd->ejecutar($sql, false);
    }

    function esta_cursando($id_asignatura, $periodo) {

        $anio = substr($periodo, 0, 4);
        $param = array($id_asignatura, $this->get_id(), $anio);
        $sql = "SELECT count(ac.id) as cant FROM actas_cursos ac INNER JOIN actas_alumnos al " .
                " ON ac.id=al.id_acta " .
                " WHERE id_curso=?" .
                " AND id_estudiante=? AND anio_lectivo=?";

        $fila = $this->db->query($sql, $param);

        if ($fila->num_rows() > 0)
            return true;
        else
            return false;
    }

    function tiene_aprobada($id_asignatura) {

        # determina si un estudiante tiene ya aprobada una asignatura
        # busca en actas de cursos
        $param = array($id_asignatura, $this->get_id());
        $sql = "SELECT count(ac.id) as cant FROM actas_cursos ac INNER JOIN actas_alumnos al ON ac.id=al.id_acta " .
                " WHERE id_curso =? AND id_estudiante=? AND aprobado=1";

        $fila = $this->db->query($sql, $param)->row();

        if ($fila->cant > 0)
            return true;
        else {

            $sql = "SELECT count(ae.id) as cant FROM actas_examenes ae INNER JOIN actas_examenes_alumnos al ON ae.id = al.id_acta " .
                    " WHERE id_curso =? AND id_estudiante=? AND aprobado=1";

            $fila = $this->db->query($sql, $param)->row();

            if ($fila->cant > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    function ver_carrera() {

        $sql = "SELECT id_carrera FROM inscrip_carreras " .
                " WHERE id_estudiante =\"{$this->ci}\" AND egresado != 1";

        $bd = new CBase();
        $fila = $bd->ejecutar($sql, true);

        if (isset($fila["id_carrera"]))
            return $fila["id_carrera"];
        else
            return "";
    }

    function borrar_sancion() {

        $sql = "UPDATE sanciones SET vigente=false WHERE id_estudiante=\"{$this->get_id()}\"";

        $this->db->query($sql);
        $this->sancion = false;
        $this->id_sancion = 0;
        $this->descr_sancion = "";
    }

    // devuelve una cadena con la lista de grupos ingresados por el estudiante
    function mostrar_inscripciones_grupos($id_estudiante, $periodo) {

        $param = array($id_estudiante, $periodo);
        $sql = "SELECT DISTINCT id_grupo FROM inscrip_examenes WHERE id_estudiante = ? " .
                " AND periodo=? ORDER BY id_grupo";



        $tabla = $this->db->query($sql, $param)->result();

        $valor = "";

        for ($i = 0; $i < count($tabla); $i++) {
            $fila = $tabla[$i];
            $valor .= ($valor == "") ? "" : " / ";
            $valor .= $fila->id_grupo;
        }

        return $valor;
    }

    function cant_sancionados() {

        $sql = "SELECT count(id) AS cant FROM sanciones WHERE vigente=true";
        $bd = new CBase();
        $fila = $bd->ejecutar($sql, true);
        return (int) $fila["cant"];
    }

    function listar_sancionados($desde = 0, $hasta = 0, $orden = "") {

        $sql = "SELECT s.id as id, e.id as ci, nombre, apellido,fecha_hasta,descripcion FROM sancionados WHERE vigente=true AND fecha_hasta > CURDATE()";

        if ($orden != "")
            $sql .= " ORDER BY $orden";
        else
            $sql .= " ORDER BY id_estudiante";

        if ($desde > 0)
            $sql .= " LIMIT($desde, $hasta)";

        $bd = new CBase();

        return $bd->listar($sql);
    }

    function mostrarPendientes($desde, $fecha) {

        $sql = "SELECT max(i.id) as id, e.id as ci, nombre, apellido, fecha, id_operador, if(valida=1,\"definitiva\",\"pendiente\") as estado " .
                "FROM estudiantes e LEFT JOIN inscrip_examenes i ON e.id = i.id_estudiante ";

        if ($desde > 0)
            $sql .= " WHERE i.id > $desde ";

        $sql .= " AND id_operador = \"\" AND fecha=\"$fecha\" ";

        $sql.=" ORDER BY i.id LIMIT 1";

        $CI = & get_instance();
        $fila = $CI->db->query($sql)->row();

        if (count($fila) > 0) {
            echo "{ \"id\" : \"" . $fila->id . "\", " .
            " \"ci\" : \"" . $fila->ci .
            "\", \"nombre\" : \"" . $fila->nombre . "\", \"apellido\" : \"" .
            $fila->apellido . "\", \"estado\" : \"" . $fila->estado . "\" }";
        } else
            echo "{ \"id\" : \"\", \"ci\" : \"\", \"nro\" : \"\", \"nombre\" : \"\" , \"apellido\" : \"\" }";
    }

}

?>
