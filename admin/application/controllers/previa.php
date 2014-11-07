<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Previa extends CI_Controller {

    public function index() {

        $idPlan = 1;
        
        $this->load->model("plan_m");

        $plan = $this->plan_m->get($idPlan);
        
        $data["estudiantes"] = $plan->get_aprobaron_asignatura();
        
        $data["vista"] = array("previa/index","ediciones");
        $data["menu"] = array("previa/menu","inicio");
        $this->load->view("template",$data);
    }

    
}