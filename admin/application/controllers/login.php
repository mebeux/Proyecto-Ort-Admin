<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index() {
        
        $data["vista"] = "login_index";
        $this->load->view("template",$data);
    }

}