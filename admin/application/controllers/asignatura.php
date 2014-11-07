<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asignatura extends CI_Controller {
    
    public function index() {
        
        $data["vista"] = array("asignatura/index","asignaturas");
        $data["menu"] = array("asignatura/menu","inicio");
        $this->load->view("template",$data);
    }
    
     public function ver($idAsignatura,$idPlan,$tipo=1) {
         
         $this->load->model("asignatura_m");
         $asignatura=  $this->asignatura_m->get($idAsignatura,$idPlan);
         
         if ($tipo==2) {
             $data["asignatura"] = $asignatura->to_array();
             $this->load->view("asignatura/ver_json",$data);
         }    
         
     }
     
    
}

?>