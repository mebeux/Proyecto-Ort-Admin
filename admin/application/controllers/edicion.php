<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edicion extends CI_Controller {
    
    public function index() {
        
      $this->load->model("plan_m");
        $data["planes"] = $this->plan_m->get_todos();
        $data["vista"] = array("edicion/index", "ediciones");
        $data["menu"] = array("edicion/menu", "inicio");
        $this->load->view("template", $data);
    }
    
    
   public function ver_anios_por_plan($idPlan) {
        $this->load->model("plan_m");
        $data["planes"] = $this->plan_m->get_todos();
         $plan = $this->plan_m->get($idPlan);
    
            $data["plan"] = $plan;
        $this->load->model("edicion_m");
        $data["ediciones"] = $this->edicion_m->get_anios_plan($idPlan);
        $data["vista"] = array("edicion/ver_anios_plan_edicion", "ediciones");
        $data["menu"] = array("edicion/menu", "inicio");
        $this->load->view("template", $data);
    }

       public function ver($anio_edicion,$idPlan) {
        $this->load->model("asignatura_m");
        $this->load->model("plan_m");
        $this->load->model("edicion_m");
        $edicion=$this->edicion_m->get($anio_edicion,$idPlan);
        $data["planes"] = $this->plan_m->get_todos();
        $plan = $this->plan_m->get($idPlan);
        $data["plan"] = $plan;
        $data["js"] = array("plan");
        $data["asignaturas"] = $edicion->get_edicion_todas_asignaturas();
        $data["vista"] = array("edicion/ver_asignaturas", "ediciones");
        $data["menu"] = array("edicion/menu", "ver");
        $this->load->view("template", $data);
            
    }
    
    
    
    
    
    
    
    
}
?>