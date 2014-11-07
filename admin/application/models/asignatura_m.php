<?php


class asignatura_m extends CI_Model {
    
    var $nombre;
    var $id;
    var $plan;
    var $cicloComun;
    var $unidadProecto;
    var $teorica;
    var $anioAsignatura;
    
    public function traer($id_asignatura) {
        
        $aux = new asignatura_m();
        
        $this->db->where("id_asignatura",$id_asignatura);
        $cmd  = $this->db->get("asignaturas");
        $fila = $cmd->row_array();
        $aux->nombre = $fila["nombre_asignatura"];
        $aux->id = $fila["id_asignatura"];
        return $aux;
       
    }
    
    public function get_nombre(){
        return $this->nombre;
    }
    
    public function get_id() {
        return $this->id;
    }
    
    public function traer_asignaturas_plan_teoricas($id_plan){
         
        $sql="SELECT a.id_asignatura, a.nombre_asignatura, pa.* FROM asignaturas a
INNER JOIN plan_asignaturas pa ON pa.id_asignatura = a.id_asignatura
WHERE pa.id_plan=\"".$id_plan."\"  ORDER BY pa.anio_asignatura ASC, pa.teorica DESC;";
        $cmd  = $this->db->query($sql);
        $lista = $cmd->result();
        return $lista;
    }
    
}