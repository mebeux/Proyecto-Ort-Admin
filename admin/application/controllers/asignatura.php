<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asignatura extends CI_Controller {
    
    public function index() {
        
        $data["vista"] = array("asignatura/index","asignaturas");
        $data["menu"] = array("asignatura/menu","inicio");
        $this->load->view("template",$data);
    }
    
}

?>