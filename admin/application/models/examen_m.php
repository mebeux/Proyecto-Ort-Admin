<?php
class Examen_m extends CI_Model {

   public $id;
   public $nombre_asignatua;
   public $id_periodo;
   public $fecha;
   public $categoria;
   public $docentes;

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
    public function get($idExamen) {

        $sql = "SELECT e.id_examen as id,
		 asig.nombre_asignatura as asignatura,
		 e.id_periodo,
		 e.fecha_examen, 
		 e.categoria,
                 e.id_periodo
		 FROM examenes e
		 INNER JOIN asignaturas asig
		 ON asig.id_asignatura=e.id_asignatura
		 WHERE e.id_examen=?;";
        
        $param = array($idExamen);
        
        $cmd = $this->db->query($sql,$param);
        
        if ($cmd->num_rows > 0) {
            
            $fila = $cmd->row();
            $salida = new Examen_m();
            $salida->id = $fila->id;
            $salida->nombre_asignatua = $fila->asignatura;
            $salida->id_periodo = $fila->id_periodo;
            $salida->categoria = $fila->categoria;
            $salida->fecha = $fila->fecha_examen;
            
            $salida->docentes = $salida->get_docentes_examen();
            return $salida;
        }

        return null;
    }
public function get_docentes_examen(){
    
      $sql="SELECT  ed.id_docente,
                    d.nombre_docente,
                    d.apellido_docente,
                    ed.id_examen
                    FROM examenes_docentes ed
                    INNER JOIN docentes d
                    ON d.id_docente = ed.id_docente
                    WHERE ed.id_examen=?;";
    
    $cmd=  $this->db->query($sql, $this->id);
    if($cmd->num_rows>0){
        return $cmd->result();
    }
    return NULL;
}

  public function to_array() {
        
        $salida = array("id"=>$this->id,
                "asignatura"  =>$this->nombre_asignatua,
                "id_periodo"   =>$this->id_periodo,
                 "fecha"   =>$this->fecha,
                "categoria"   =>$this->categoria,);
        
        $salida["docentes"] = $this->get_docentes_examen();
        return $salida; 
    }
  
}
?>