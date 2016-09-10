<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('ModelUser');
		
	}
	
	public function index()
	{
		/*$data['articles'] = $this->ModelArticulo->getArticle();
		$data['title'] = "ISCO COMPUTADORAS S.A de C.V";
		$this->load->view('includes/header',$data);
		$this->load->view('inicio');*/
		$this->checkLogin();

	}
	function restriccion()
	{
		$this->load->view('general/header');
		$this->load->view('users/restriccion');
		$this->load->view('general/scripts');
		$this->load->view('general/footer');
	}
	function checkLogin(){
		$this->form_validation->set_rules('pass', 'Password', 'trim|required|md5');
		$this->form_validation->set_rules('usuario','User','trim|required');
		if($this->form_validation->run()==false){
			$this->login("");
		}
		else{
			$usuario = $this->input->post('usuario');
			$pass = $this->input->post('pass');
			$query = $this->ModelUser->login($usuario,$pass);
			if($query->num_rows()>0)
			{
				foreach($query->result() as $row)
				{
					$this->session->set_userdata('user',$row->usuario);
					$this->session->set_userdata('id_user',$row->id_user);
					$this->session->set_userdata('tipo',$row->tipo);
				}
				redirect(base_url().'producto/allProductos');
			}
			else
			{
				$this->login('Usuario incorrecto o desactivado');
			}
		}
	
	}


	function login($msj){
		$data['msj'] = $msj;
		$this->load->view('users/login',$data);
	}
	function cerrarSesion()
	{
		$this->session->unset_userdata('tipo');
		$this->session->unset_userdata('user');
		$this->session->unset_userdata('id_user');
		$this->session->sess_destroy();
		redirect(base_url().'login');
	}
}
?>
