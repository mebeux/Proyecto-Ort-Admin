<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Examen extends CI_Controller {
    
    public function index($idExamen,$tipo=1) {
              $this->load->model("examen_m");
         $examen=  $this->examen_m->get($idExamen);
         
         if ($tipo==2) {
             $data["examen"] = $examen->to_array();
             $this->load->view("examen/ver_json",$data);
         }  
   
    }
    
}

?>