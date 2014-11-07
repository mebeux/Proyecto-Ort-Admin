<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Previa extends CI_Controller {
    
    public function index() {
        
        $data["vista"] = array("previa/index","ediciones");
        $data["menu"] = array("previa/menu","inicio");
        $this->load->view("template",$data);
    }
    
}

?>