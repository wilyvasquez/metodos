<?php if ( ! defined('BASEPATH')) exit('no se permite acceso directo al scrip');
/**
* 
*/
class Metodos extends CI_Controller
{
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('metodosmodelo');
	}

    function index(){
        $data['segmento'] = $this->uri->segment(3);
        //$this->load->view('codigo/header');
        if(!$data['segmento']){
            $data['cursos'] = $this->metodosmodelo->obtenerCursos();     
        }
        else{
            $data['cursos'] = $this->metodosmodelo->obtenerCurso($data['segmento']);
        }
        header('Content-Type: application/json');
        echo json_encode($data['cursos']);
            //print_r($data['cursos']);
            //$this->load->view('cursos/cursos',$data);
    }

	function nuevo(){
        $this->load->view('codigo/header');
        $this->load->view('cursos/formulario');
    }
     
    function recibirDatos(){
        $data = array(
            'nombre' => $this ->input->post('nombre') ,
            'obs' => $this ->input->post('obs') 
        );
        $exito = $this->metodosmodelo->crearCurso($data);
        header('Content-Type: application/json');
        if($exito){             
            echo json_encode(array('mensaje'=> "Insertado",'id'=>$exito));
        }else{
            echo json_encode(array('mensaje'=> "error"));
        }
       // $this->load->view('codigo/header');
       // $this->load->view('codigo/bienvenido'); 

    }

    function editar(){
        $data['id']= $this->uri->segment(3);
        $data['curso'] = $this->metodosmodelo->obtenerCurso($data['id']);
        $this->load->view('codigo/header');
        $this->load->view('cursos/editar',$data);
    }

    function actualizar(){
        $data =array(
            'nombre'=> $this->input->post('nombre'),
            'videos' => $this->input->post('videos')
            );
        $this->metodosmodelo->actualizarCurso($this->uri->segment(3),$data);
        $this->load->view('codigo/header');
        $this->load->view('codigo/bienvenido'); 
    }

    function borrar(){
        $id= $this->uri->segment(3);
        $this->metodosmodelo->eliminarCurso($id);
    }
}
?>