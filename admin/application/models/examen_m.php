<?php
class Examen_m extends CI_Model {

   var $id;
   var $nombre;
   var $id_periodo;

public function get_examenes_por_periodo($id_periodo){
    $sql="SELECT e.id_examen as id, 
		 p.nombre_plan,
		 a.nombre_asignatura,
		 e.id_periodo,
		 e.fecha_examen, 
		 e.categoria 
		 FROM examenes e
		 INNER JOIN asignaturas a
		 ON a.id_asignatura=e.id_asignatura
		 INNER JOIN plan p
		 ON p.id_plan=e.id_plan
		 WHERE e.id_periodo=?
                 ORDER BY nombre_plan;";
    
    $cmd=  $this->db->query($sql, $id_periodo);
    if($cmd->num_rows>0){
        return $cmd->result();
    }
    return NULL;
    
}
  
}
?>