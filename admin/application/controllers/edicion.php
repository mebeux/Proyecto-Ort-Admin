<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edicion extends CI_Controller {
    
    public function index() {
        
        $data["vista"] = array("edicion/index","ediciones");
        $data["menu"] = array("edicion/menu","inicio");
        $this->load->view("template",$data);
    }
    
}

?>