<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Periodo extends CI_Controller {
    
   public function index() {
        $this->load->model("periodo_m");
        $data["periodos"] = $this->periodo_m->get_todos();
        $data["actual"]=$this->periodo_m->get_actual();
        $data["vista"] = array("periodos/index", "periodos");
        $data["menu"] = array("periodos/menu", "inicio");
        $this->load->view("template", $data);
    }
    
    
     public function ver($idPeriodo) {
        $this->load->model("periodo_m");
        $periodo = $this->periodo_m->get($idPeriodo);
        
        // CORREGIR
        if (!empty($periodo)) {
            $this->load->model("plan_m");
            $data["planes"] = $this->plan_m->get_todos();
            $data["periodo"] = $periodo;
            $data["actual"]=$this->periodo_m->get_actual();
            $data["js"] = array("periodo");
            $data["asignaturas"] = $periodo->get_asignaturas();
            $data["vista"] = array("periodos/ver_asignaturas", "periodos");
            $data["menu"] = array("periodos/menu", "ver");
            $this->load->view("template", $data);
        }    
    }
     /*
       public function crear_formulario() {
           $this->load->model("periodo_m");
           $data["actual"]=$this->periodo_m->get_actual();
            $data["vista"] = array("periodos/crear_periodo", "periodos");
            $data["menu"] = array("periodos/menu", "crear");
            $this->load->view("template", $data);
        }    
    
   
        public function crear() {
           $this->load->model("periodo_m");
          $anio= $this->input->post("anio");
            $mes= $this->input->post("meses");
             $up= $this->input->post("up");
              $pp= $this->input->post("pp");
              
              $periodo= new Periodo_m();
              $periodo->anio=$anio;
              $periodo->mes=$mes;
              $periodo->id=$anio.$mes;
              $periodo->actual=$periodo->id;
             if($up!=false){
                 $periodo->unidad_proyecto=1;
             }else{
                 $periodo->unidad_proyecto=0;
             }
               if($pp!=false){
                 $periodo->practica_profesional=1;
             }else{
                 $periodo->practica_profesional=0;
             }
             $periodo->crear();
           $data["periodos"] = $this->periodo_m->get_todos();
        $data["actual"]=$this->periodo_m->get_actual();
        $data["vista"] = array("periodos/index", "periodos");
        $data["menu"] = array("periodos/menu", "inicio");
            $this->load->view("template", $data);
        }    
    
        public function editar_formulario() {
           $this->load->model("periodo_m");
           $actual=$this->periodo_m->get_actual();
           $periodo = $this->periodo_m->get($actual->periodo);
           $data["actual"]=$actual;
            $data["periodo"]=$periodo;
            $data["examenes"] = $periodo->get_examenes();
            $data["js"] = array("periodo_form","periodo");
            
            $data["vista"] = array("periodos/editar_periodo", "periodos");
            $data["menu"] = array("periodos/menu", "editar");
            $this->load->view("template", $data);
        } 
    
        public function editar() {
           $this->load->model("periodo_m");
          $anio= $this->input->post("anio");
            $mes= $this->input->post("meses");
             $up= $this->input->post("up");
              $pp= $this->input->post("pp");
              $id_viejo=$this->input->post("id_viejo");
              $periodo= new Periodo_m();
              $periodo->anio=$anio;
              $periodo->mes=$mes;
              $periodo->id=$anio.$mes;
              $periodo->actual=$periodo->id;
             if($up!=false){
                 $periodo->unidad_proyecto=1;
             }else{
                 $periodo->unidad_proyecto=0;
             }
               if($pp!=false){
                 $periodo->practica_profesional=1;
             }else{
                 $periodo->practica_profesional=0;
             }
              $lista_eliminar_examen=array();
             if($this->input->post("cantExam")>0){
             for ($i=1;$i<$this->input->post("cantExam");$i++){
                 if($this->input->post("eliminar".$i)!=0){
                 array_push($lista_eliminar_examen, $this->input->post("eliminar".$i));
                 }
             }
             }
             $periodo->editar( $lista_eliminar_examen,$id_viejo);
           $data["periodos"] = $this->periodo_m->get_todos();
        $data["actual"]=$this->periodo_m->get_actual();
        $data["vista"] = array("periodos/index", "periodos");
        $data["menu"] = array("periodos/menu", "inicio");
            $this->load->view("template", $data);
        }    
  
      */ }
    

    


?>