<?php

//include_once("cperiodo.php");

class Estudiante_m extends CI_Model {

    public $id;
    public $inscr;
    public $nombre;
    public $apellido;
    public $credencial;
    public $sexo;
    public $fecha_nacimiento;
    public $direccion;
    public $direccion_2;
    public $departamento;
    public $ciudad;
    public $telefono;
    public $correo;
    public $turno;
    public $prep;
    public $observacion;
    public $trabaja;
    public $valida;
    public $documentacion;
    public $operador;
    public $sancion;
    public $id_sancion;
    public $descr_sancion;
    public $fecha_sancion;
    public $carrera;

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

    public function get($idEstudiante) {

        $this->db->where("id_estudiante", $idEstudiante);
        $cmd = $this->db->get("estudiantes");

        if ($cmd->num_rows > 0) {
            $fila = $cmd->row();
            $salida = $this->_cargar_datos($fila);
            return $salida;
        }

        return NULL;
    }

    private function _cargar_datos($fila) {

        $salida = new Estudiante_m();
        $salida->id = $fila->id_estudiante;
        $salida->nombre = $fila->nombre_estudiante;
        $salida->apellido = $fila->apellido_estudiante;
        $salida->sexo = $fila->sexo;
        $salida->fecha_nacimiento = $fila->fecha_nacimiento;
        $salida->credencial = $fila->credencial_estudiante;
        $salida->direccion = $fila->direccion_estudiante;
        $salida->direccion_2 = $fila->direccion_2;
        $salida->departamento = $fila->departamento;
        $salida->ciudad = $fila->ciudad_estudiante;
        $salida->telefono = $fila->telefono_estudiante;
        $salida->celular = $fila->celular_estudiante;
        $salida->correo = $fila->mail_estudiante;
        $salida->prep = $fila->preparatorio;
        $salida->trabaja = $fila->trabaja;
        return $salida;
    }

}

?>
