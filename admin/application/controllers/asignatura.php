<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asignatura extends CI_Controller {
    
    public function index() {
        
        $data["vista"] = array("asignatura/index","asignaturas");
        $data["menu"] = array("asignatura/menu","inicio");
        $this->load->view("template",$data);
    }
    
     public function ver_por_periodo($idAsignatura,$idPlan,$anio=0,$periodo=0,$tipo=1,$unidad=1) {
         if ($unidad==1) {
         $this->load->model("asignatura_m");
         $asignatura=  $this->asignatura_m->get($idAsignatura,$idPlan);
         if ($tipo==2) {
             
             $data["asignatura"] = $asignatura->to_array();
             $this->load->view("asignatura/ver_json",$data);
         }    
         }else{
              $this->load->model("asignatura_m");
         $asignatura=  $this->asignatura_m->get_unidad($idAsignatura,$idPlan);
         if ($tipo==2) {
             
             $data["asignatura"] = $asignatura->to_array_unidad($periodo, $idPlan,$anio);
             $this->load->view("asignatura/ver_json",$data);
         } 
         }
     }
     
       public function ver_por_plan($idAsignatura,$idPlan,$tipo=1) {
             $this->load->model("asignatura_m");
         $asignatura=  $this->asignatura_m->get($idAsignatura,$idPlan);
         if ($tipo==2) {
             
             $data["asignatura"] = $asignatura->to_array();
             $this->load->view("asignatura/ver_json",$data);
         }
     }
    
}

?>