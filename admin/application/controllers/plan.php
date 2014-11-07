<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Plan extends CI_Controller {

    public function index() {
        $this->load->model("plan_m");
        $data["planes"] = $this->plan_m->get_todos();
        $data["vista"] = array("plan/index", "planes");
        $data["menu"] = array("plan/menu", "inicio");
        $this->load->view("template", $data);
    }

    public function ver($idPlan) {
        $this->load->model("plan_m");
        $this->load->model("asignatura_m");
        $plan = $this->plan_m->get($idPlan);
        
        // CORREGIR
        if (!empty($plan)) {
            $data["plan"] = $plan;
            $data["js"] = array("plan");
            $data["asignaturas"] = $plan->get_asignaturas();
            $data["vista"] = array("plan/ver_asignaturas", "planes");
            $data["menu"] = array("plan/menu", "inicio");
            $this->load->view("template", $data);
        }    
    }

}

?>