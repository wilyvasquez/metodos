<?php if ( ! defined('BASEPATH')) exit('no se permite acceso directo al scrip');

/**
* 
*/
class Metodosmodelo extends CI_Model
{
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function crearCurso($data){
		$this->db->insert('marcas',array('nombre'=>$data['nombre'],'observaciones'=>$data['obs']));
		return $this->db->insert_id();
	}
	function obtenerCursos(){
		$query = $this->db->get('marcas');
		if($query->num_rows()>0) return $query->result_array();
		else return false;
	}
	function obtenerCurso($id){
		$this->db->where('id',$id);
		$query = $this->db->get('marcas');
		if($query->num_rows() > 0) return $query->result_array();
		else return false;
	}

	function actualizarCurso($id,$data){
		$datos =array(
			'nombre'=> $data['nombre'],
			'observaciones'=> $data ['obs']
			);
		$this->db->where('id',$id);
		$query = $this->db->update('marcas',$datos);
	}

	function eliminarCurso($id){
		$this->db->delete('marcas',array('id'=>$id));
	}

}

?>