<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Periodo extends CI_Controller {
    
   public function index() {
        $this->load->model("periodo_m");
        $data["periodos"] = $this->periodo_m->get_todos();
        $data["vista"] = array("periodos/index", "periodos");
        $data["menu"] = array("periodos/menu", "inicio");
        $this->load->view("template", $data);
    }
    
    
     public function ver($idPeriodo) {
        $this->load->model("periodo_m");
        $periodo = $this->periodo_m->get($idPeriodo);
        
        // CORREGIR
        if (!empty($periodo)) {
            $data["periodo"] = $periodo;
            $data["js"] = array("periodo");
            $data["examenes"] = $periodo->get_examenes();
            $data["vista"] = array("periodos/ver_examenes", "periodos");
            $data["menu"] = array("periodos/menu", "inicio");
            $this->load->view("template", $data);
        }    
    }

    
}

?>