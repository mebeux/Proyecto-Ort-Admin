<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plan extends CI_Controller {
    
    public function index() {
   $this->load->model("plan_m");
   $data["planes"]=$this->plan_m->get_todos();
   $data["vista"] = array("plan/index","planes");
        $data["menu"] = array("plan/menu","inicio");
        $this->load->view("template", $data);
    }
    
       public function traer_plan($idPlan){
       $this->load->model("plan_m");
        $this->load->model("asignatura_m");
      $plan=$this->plan_m->traer($idPlan);
      $asignaturas=$this->asignatura_m->traer_asignaturas_plan_teoricas($idPlan);
         $data["plan"]=$plan;
         $data["lista_asignaturas"]=$asignaturas;
         $data["vista"] = array("plan/ver_asignaturas_plan","planes");
        $data["menu"] = array("plan/menu","inicio");
        $this->load->view("template", $data);
       
   }
    
}

?>