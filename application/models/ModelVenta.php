<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelVenta extends CI_Model {
	function __construct ()
	{
		parent::__construct();
	}
	function getVentas($desde,$hasta)
	{
		$query=$this->db->query('call getVentas("'.$desde.'","'.$hasta.'")');
		$query->next_result();
		return $query;
	}
	function getComisionistas()
	{
		//$this->db->where('tipo','comisionista');
		$this->db->select('id_user,nombre_user');
		$query=$this->db->get('administradores');

		return $query;
	}
	function getComisiones($id_user,$desde,$hasta)
	{
		$query=$this->db->query('call getComisiones('.$id_user.',"'.$desde.'","'.$hasta.'")');
		$query->next_result();
		return $query;
	}
	function eliVenta($id_venta,$id_producto)
	{
		$query=$this->db->query('call eliVenta('.$id_venta.','.$id_producto.',@ban)');
		$query=$this->db->query('SELECT @ban');
		foreach ($query->result_array() as $row) 
		{
			$ban=$row['@ban'];
		}
		return $ban;
	}
	/* checar que se puede borrar de este codigo repetido en otro model*** */
	function getVenta($id)
	{
		$query=$this->db->query('select *from productos p left join det_precios_ventas dpv on p.id_producto=dpv.id_producto left join precios ps on ps.id_precio=
    	dpv.id_precio left join det_ven_prodp dv on dpv.id=dv.id left join ventas v on v.id_venta=dv.id_venta left join categorias ct on ct.id_categoria=p.id_categoria where v.id_venta='.$id.';');
    	return $query;
	}
	function getNota($id)
	{
		$query=$this->db->query('call getNota('.$id.');');
		$query->next_result();
		return $query;
	}
	function insertarVenta($data)
	{
		$query=$this->db->insert('ventas',$data);
		return $query;
	}
	function maxIdVenta()
	{
		$query=$this->db->query('select max(id_venta) as id_venta from ventas');
		return $query;
	}
	function vender($data)
	{
		$query=$this->db->query('call vender('.$data['id_venta'].','.$data['cantidad_venta'].','.$data['id_producto'].','.$data['id_precio'].','.$data['precio'].','.$data['id_color'].','.$data['id_user'].',@ban);');
		//$query->next_result();
		$query=$this->db->query('SELECT @ban');
		foreach ($query->result_array() as $row) 
		{
			$ban=$row['@ban'];
		}
		return $ban;
	}
	function getUserPass($pass)
	{
		$this->db->where('pass',$pass);
		$query=$this->db->get('administradores');
		return $query;
	}
	/***************** aki acaba lo que se repite en model producto*/
}