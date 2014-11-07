<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Test_previas extends CI_Controller {

    
    /*
     * desc Test de la función del método que devuelve la lista
     *      de estudiantes con asignaturas aprobadas
     */
    
    public function estudiantes() {

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

    /*
     * desc test de la clase previas
    */
    public function index() {
            
        $this->load->library("unit_test");
        
        // asignatura sin previas
        $this->load->model("previa_m");
        
        $p = $this->previa_m->get_por_asignatura("CGD",1);
        echo $this->unit->run($p,NULL,"Previa_m->get_por_asignatura");
        
        // asignaturas con sólo una previa
        $p = $this->previa_m->get_por_asignatura("IINFO2",1);
        echo $this->unit->run($p->previas[0],"CINFO1","Previa_m->get_por_asignatura");
        
        // asignaturas con tres previas
        $previas = array("CINFO1","IINFO2","IINFO3");
        $p = $this->previa_m->get_por_asignatura("IINFO4",1);
        $valor = $p->get_previas_completas();
        echo $this->unit->run($previas,$valor,"Previm->get_previas_completas");
        
        // asignaturas con muchas previas
        $previas = array("CDN","CDT1","CDYC1","CERGO1","CSEM","CTMAQ","ICOM","IDT2",
                        "IDT3","IDYC2","IDYC3","IERGO2","IMKTG","IREND","ITEC1","ITEC2");
        $p = $this->previa_m->get_por_asignatura("IDYC4",1);
        $valor = $p->get_previas_completas();
        
        echo $this->unit->run($previas,$valor,"Previm->get_previas_completas");
        
    }

    public function plan() {
        $this->load->model("plan_m");
        $plan = $this->plan_m->get(1);
        $errores = $plan->get_previas_sin_aprobar();
        print_r($errores);
    }
    
}
