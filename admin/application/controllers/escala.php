<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Escala extends CI_Controller {
    
    public function index() {
        
        $data["vista"] = array("escala/index","escala");
        $data["menu"] = array("escala/menu","inicio");
        $this->load->view("template",$data);
    }
    
}

?>