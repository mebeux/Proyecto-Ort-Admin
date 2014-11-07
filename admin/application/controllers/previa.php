<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Previa extends CI_Controller {

    public function index() {

        $data["vista"] = array("previa/index","previas");
        $data["menu"] = array("previa/menu","inicio");
        
        $data["js"] = array("previa");
        
        $this->load->model("plan_m");
        $data["planes"] = $this->plan_m->get_todos();
        
        $this->load->view("template",$data);
    }

    public function plan($idPlan) {
 
        $this->load->model("plan_m");
        $plan = $this->plan_m->get($idPlan);
        
        if (!empty($plan)) {
            $data["informe"] = $plan->get_previas_sin_aprobar();
        } else {
            $data["informe"] = array();
        }   

        $this->load->view("previa/error_plan_json",$data);
    }
    
}