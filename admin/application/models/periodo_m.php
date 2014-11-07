<?php

class Periodo_m extends CI_Model {
    
    public $id;
    public $examenes;
    public $mes;
    public $anio;
    public $unidad_proyecto;
    public $actual=null;
   
    public function get($idPeriodo) {
       $sql="SELECT id_periodo as periodo, 
                    anio_lectivo as anio,
                    unidad_proyecto,
                    periodo_actual as actual
                    FROM  periodos
                    WHERE id_periodo=?;";
       $param=array($idPeriodo);
        $fila=$this->db->query($sql,$param);
        
        if ($fila->num_rows>0) {
            $fila=$fila->row();
            $salida = new Periodo_m();
            $salida->id = $fila->periodo;
            $salida->mes=  substr($fila->periodo, -4, 2);
            $salida->anio = $fila->anio;
             $salida->unidad_proyecto = $fila->unidad_proyecto;
            $salida->actual = $this->get_actual();
            return $salida;
        }
        return NULL;
    }
     public function get_actual() {
         if(empty($this->actual)){
       $sql="SELECT id_periodo as periodo, 
                    anio_lectivo as anio,
                    unidad_proyecto,
                    periodo_actual as actual
                    FROM  periodos
                    WHERE periodo_actual=?;";
       $param=array(1);
        $cmd=$this->db->query($sql,$param);
        
        if ($cmd->num_rows>0) {
            $this->actual=$cmd->row();
        }
         }
        
              return $this->actual;
         
    }
    
    public function get_todos(){
        $sql="SELECT id_periodo as periodo, 
                    anio_lectivo as anio,
                    unidad_proyecto,
                    periodo_actual as actual
                    FROM  periodos;";
      
        $cmd=$this->db->query($sql);
        if ($cmd->num_rows>0) {
            return $cmd->result();
        }
        return NULL;
    }
    
    public function get_examenes() {

      if (empty($this->examenes)) {
        $this->load->model("examen_m");
        $this->examenes = $this->examen_m->get_examenes_por_periodo($this->id);
        return $this->examenes;
      }
     }
     
  public function to_array() {
        
        $salida = array("id"=>$this->id,
                "anio"  =>$this->anio,
                "mes"   =>$this->mes,
                "unidad_proyecto"  =>$this->unidad_proyecto);
        
        $salida["examenes"] = $this->get_examenes();
        return $salida; 
    }
 
    
}