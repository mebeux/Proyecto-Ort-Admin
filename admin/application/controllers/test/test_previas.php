<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Test_previas extends CI_Controller {

    public function index() {

        $this->load->library("unit_test");

// ******************************************************
        
        $idEstudiante = '26097433';
        $idAsignatura = 'CTMAQ';
        $idCurso = 1;

        $this->load->model("asignatura_m");
        $a = $this->asignatura_m->get($idAsignatura);
        $valor = $a->aprobada($idEstudiante);
        $nombre = "Estudiante con asignatura aprobada OK";
        echo $this->unit->run($valor["aprobado"], TRUE, $nombre);

        $nombre = "Estudiante con asignatura aprobada en curso";
        echo $this->unit->run($valor["tipo"],"CURSO",$nombre);

        $nombre = "Estudiante con asignatura aprobada en acta 1";
        echo $this->unit->run($valor["id_curso"],$idCurso,$nombre);
        
        /*
        $nombre = "Estudiante con asignatura reprobada OK";
        $idEstudiante='52025230';
        $idAsignatura = 'CINFO1';
        echo $this->unit->run($valor, FALSE, $nombre);
       */
        
    }

}
