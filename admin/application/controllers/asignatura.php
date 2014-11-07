<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asignatura extends CI_Controller {
    
    public function index() {
        
        $data["vista"] = array("asignatura/index","asignaturas");
        $data["menu"] = array("asignatura/menu","inicio");
        $this->load->view("template",$data);
    }
    
     public function obtener_previas_ajax($idAsignatura) {
         $this->load->model("asignatura_m");
         $asignatura=  $this->asignatura_m->get($idAsignatura);
         $asignatura->get_previas_ajax();
         
     }
    
}

?>