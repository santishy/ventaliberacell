<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelUser');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		
		$this->load->library('funciones');
		$this->load->library('cart');
		$this->form_validation->set_message('required', '%s es un campo requerido');
		$this->form_validation->set_message('valid_email', '%s No es un email valido');
		$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
	}
	public function getPendientes()
	{
		date_default_timezone_set('America/Monterrey');
		$fecha=date('Y-m-d',strtotime('+4 day'));
		$query=$this->ModelUser->totalUrgentes($fecha);
		$numero=0;
		foreach ($query->result() as $row)
		{
			$numero=$row->numero;
		}
		return $numero;
	}
	
	
	function agregarUser()
	{
		$data[0]=1;
		$this->funciones->logueado($data,$this->session->userdata('id_user'),$this->session->userdata('tipo'));
		$this->form_validation->set_rules('nombre_user','Nombre','required|callback_comprobarUser');
		$this->form_validation->set_rules('usuario','Us','required');
		$this->form_validation->set_rules('pass','Password','required|md5');
		$this->form_validation->set_rules('correo','Correo','required|valid_email');
		$this->form_validation->set_rules('tipo','Tipo','required');
		$this->form_validation->set_rules('direccion','Direccion','required');
		if($this->form_validation->run()==false)
		{
			$this->vistaAU("");
		}
		else
		{
			$data=$this->input->post();
			$query=$this->ModelUser->agregarUser($data);
			$this->vistaAU("Usuario Agregado");
		}

	}
	function vistaAU($mns="")//vista agregarUsuario
	{
		$permisos[0]=1;
		$this->funciones->logueado($permisos,$this->session->userdata('id_user'),$this->session->userdata('tipo'));
		$vec['query']=$this->ModelUser->getUsuarios();
		$vec['mensaje']=$mns;
		$this->load->view('general/header',$vec);
		$this->load->view('general/scripts');	
		$this->load->view('users/agregar');
		
	}
	function comprobarUser()
	{
		$permisos[0]=1;
		$permisos[1]=2;
		$permisos[2]=3;
		$this->funciones->logueado($permisos,$this->session->userdata('id_user'),$this->session->userdata('tipo'));
		$usuario=$this->input->post('usuario');
		$nombre=$this->input->post('nombre_user');
		$direccion=$this->input->post('direccion');
		$query=$this->ModelUser->comprobarUser($usuario);
		if($query->num_rows()>0)
		{
			$this->form_validation->set_message('comprobarUser','Ese user ya existe ');
			return false;
		}
		else
		{
			$query=$this->ModelUser->comprobarUsuario($nombre,$direccion);
			if($query->num_rows()>0)
			{
				$this->form_validation->set_message('comprobarUser','ya existe un usuario con el mismo nombre y direccion');
				return false;
			}
			else
				return true;
		}
	}
	function eliminarUser()
	{
		$permisos[0]=1;
		$this->funciones->logueado($permisos,$this->session->userdata('id_user'),$this->session->userdata('tipo'));
		$id=$this->input->post('id_user');
		$data['estado']=0;
		$query=$this->ModelUser->eliminarUsuario($id,$data);
		$this->vistaAU('Usuario Eliminado');
	}

}
?>