<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelUser extends CI_Model {

	function __construct ()
	{
		parent::__construct();
	}
	function totalUrgentes($fecha)
	{
		$query=$this->db->query('select count(id_pedido) as numero from pedidos where estado="pendiente" and fecha_entrega<"'.$fecha.'";');
		return $query;
	}
	function comprobarUser($usuario)
	{
		$this->db->where('estado',1);
		$this->db->where('usuario',$usuario);
		$query=$this->db->get('administradores');
		return $query;
	}
	function comprobarUsuario($nombre,$direccion)
	{
		$this->db->where('nombre_user',$nombre);
		$this->db->where('estado',1);
		$this->db->where('direccion',$direccion);
		$query=$this->db->get('administradores');
		return $query;
	}
	function agregarUser($data)
	{
		$query=$this->db->insert('administradores',$data);
		return $query;
	}
	function getUsuarios()
	{
		$this->db->where('estado',1);
		$this->db->select('*');
		$query=$this->db->get('administradores');
		return $query;
	}
	function eliminarUsuario($id,$data)
	{
		$this->db->where('id_user',$id);
		$query=$this->db->update('administradores',$data);
		return $query;
	}
	function login($usuario,$pass)
	{
		$this->db->where('estado',1);
		$this->db->where('usuario',$usuario);
		$this->db->where('pass',$pass);
		$query=$this->db->get('administradores');
		return $query;
	}
}
?>