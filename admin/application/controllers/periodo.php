<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Periodo extends CI_Controller {
    
    public function index() {
        
        $data["vista"] = array("periodo/index","periodos");
        $data["menu"] = array("periodo/menu","inicio");
        $this->load->view("template",$data);
    }
    
}

?>