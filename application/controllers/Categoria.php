<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categoria extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('funciones');
		$this->load->model('ModelProducto');
		$this->form_validation->set_message('required', '%s es un campo requerido');
		$this->form_validation->set_message('valid_email', '%s No es un email valido');
		$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
	}
	public function index()
	{
		
	}
	public function buscarCategoria()
	{
		$permisos[0]=1;
		$permisos[1]=3;
		$this->funciones->logueado($permisos,$this->session->userdata('id_user'),$this->session->userdata('tipo'));
		$clave=$this->input->post('clave');
		$data['query']=$this->ModelProducto->buscarCategoria($clave);
		//$data['urgentes']=$this->getPendientes();
		$this->load->view('general/header',$data);
		$this->load->view('general/scripts');
		$this->load->view('productos/categorias');
		$this->load->view('general/footer');
	}
	public function editarCategoria()
	{
		$permisos[0]=1;
		$permisos[1]=3;
		$this->funciones->logueado($permisos,$this->session->userdata('id_user'),$this->session->userdata('tipo'));
		$this->form_validation->set_rules('clave','Categoria','required|callback_comprobarCategoriaMod');
		if($this->form_validation->run()===false)
		{
			$this->buscarCategoria();
		}
		else
		{
			$data['categoria']=$this->input->post('clave');
			$id=$this->input->post('id_categoria');
			$vec['res']=$this->ModelProducto->editarCategoria($data,$id);
			if($vec['res'])
				$vec['mensaje']="Modificación correcta. << ".$data['categoria']." >>";
			//$vec['urgentes']=$this->getPendientes();
			$this->load->view('general/header',$vec);
			$this->load->view('general/scripts');
			$this->load->view('productos/categorias');
			$this->load->view('general/footer');
		}
	}
	public function vistaAgregarCategoria()
	{
		//$this->logueado();
		//	$data['query']=$this->ModelProducto->buscarCategoria($this->input->post('clave'));
		$permisos[0]=1;
		$permisos[1]=3;
		$this->funciones->logueado($permisos,$this->session->userdata('id_user'),$this->session->userdata('tipo'));
		$this->load->view('general/header');
		$this->load->view('general/scripts');
		$this->load->view('productos/categorias');
		$this->load->view('general/footer');
	}
	public function agregarCategoria()
	{
		$permisos[0]=1;
		$permisos[1]=3;
		$this->funciones->logueado($permisos,$this->session->userdata('id_user'),$this->session->userdata('tipo'));
		$this->form_validation->set_rules('categoria','Categoria','required|callback_comprobarCategoria');
		if($this->form_validation->run()===false)
		{
			$this->vistaAgregarCategoria();
		}
		else
		{
			$categoria['categoria']=strtoupper($this->input->post('categoria'));
			$query=$this->ModelProducto->agregarCategoria($categoria);
			redirect(base_url().'producto/allproductos');
		}
	}
	public function comprobarCategoria($str)
	{
		$permisos[0]=1;
		$permisos[1]=3;
		$this->funciones->logueado($permisos,$this->session->userdata('id_user'),$this->session->userdata('tipo'));
		$query=$this->ModelProducto->getCategoria($str);
		if($query->num_rows()>0)
		{
			$this->form_validation->set_message('comprobarCategoria','La categoria %s , ya existe');
			return false;
		}
		else
		{
			return true;
		}
	}
	public function comprobarCategoriaMod()
	{
		$permisos[0]=1;
		$permisos[1]=3;
		$this->funciones->logueado($permisos,$this->session->userdata('id_user'),$this->session->userdata('tipo'));
		$id=$this->input->post('id_categoria');
		$categoria=$this->input->post('clave');
		$query=$this->ModelProducto->comprobarCategoria($id,$categoria);
		if($query->num_rows()>0)
		{
			$this->form_validation->set_message('comprobarCategoriaMod','La categoria %s , ya existe');
			return false;
		}
		else
			return true;
	}
	public function getPendientes()
	{
		$permisos[0]=1;
		$permisos[1]=3;
		$this->funciones->logueado($permisos,$this->session->userdata('id_user'),$this->session->userdata('tipo'));
		date_default_timezone_set('America/Monterrey');
		$fecha=date('Y-m-d',strtotime('+4 day'));
		$query=$this->ModelProducto->totalUrgentes($fecha);
		$numero=0;
		foreach ($query->result() as $row)
		{
			$numero=$row->numero;
		}
		return $numero;
	}
	public function registrarMarca()
	{
		$permisos[0]=1;
		$permisos[1]=3;
		$this->funciones->logueado($permisos,$this->session->userdata('id_user'),$this->session->userdata('tipo'));
		$data=$this->input->post();
		$json['ban']=$this->validarEmpty($data);
		$marca=$data['marca'];
		if($json['ban'])
		{
			$query=$this->ModelProducto->comprobarMarca($data['marca']);
			if($query->num_rows()>0)
			{
				$json['res']=0;
			}
			else
			{
				$json['res']=$this->ModelProducto->registrarMarca($data);
				$query=$this->ModelProducto->getMarca($marca);
				foreach ($query->result() as $row) 
				{
					$json['marca']=$row->marca;
					$json['id_marca']=$row->id_marca;
				}
			}
		}
		echo json_encode($json);
	}
	function validarEmpty($data)
	{
		$permisos[0]=1;
		$permisos[1]=2;
		$permisos[2]=3;
		$this->funciones->logueado($permisos,$this->session->userdata('id_user'),$this->session->userdata('tipo'));
		if(empty($data))
			$ban=false;
		else
			$ban=true;
		foreach($data as $key => $value) 
		{
			if(empty($data[$key]))
			{
				$ban=false;
				continue;
			}
		}
		return $ban;
	}
}
?>