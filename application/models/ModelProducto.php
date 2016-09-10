<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelProducto extends CI_Model {
	function __construct ()
	{
		parent::__construct();
	}
	function getMarcas()
	{
		$this->db->select("*");
		$query=$this->db->get('marcas');
		return $query;
	}
	function obtenerCategoria($id_categoria)
	{	
		$this->db->where('id_categoria',$id_categoria);
		$query=$this->db->get('categorias');
		return $query;
	}
	function comprobarCategoria($id,$cat)
	{
		$this->db->where('categoria',$cat);
		$this->db->where('id_categoria !=',$id);
		$query=$this->db->get('categorias');
		return $query;
	}
	function agregarCategoria($data)
	{
		$query=$this->db->insert('categorias',$data);
		return $query;
	}
	function getCategoria($categoria)
	{
		$this->db->where('categoria',$categoria);
		$query=$this->db->get('categorias');
		return $query;
	}
	function editarCategoria($data,$id)
	{
		$this->db->where('id_categoria',$id);
		$query=$this->db->update('categorias',$data);
		return $query;
	}
	function buscarCategoria($clave)
	{
		$query=$this->db->query('select *from categorias where categoria like "%'.$clave.'%"');
		return $query;
	}
	function modiProducto($data)
	{
		$query=$this->db->query("call modiProducto(".$data['id_producto'].",'".$data['nombre_producto']."',
			".$data['id_categoria'].",'".$data['color']."','".$data['id_marca']."','".$data['modelo']."','".$data['descripcion']."',".$data['id_color'].",@ban);");
		//$query->next_result();
		$query=$this->db->query('SELECT @ban');
		foreach ($query->result_array() as $row) 
		{
			$ban=$row['@ban'];
		}
		return $ban;
	}
	function getCategorias()
	{
		$this->db->select('*');
		$query=$this->db->get('categorias');
		return $query;
	}
	function numRowsProductos($clave,$cate)
	{
		//$query=$this->db->query('select count(id_producto) as nume from productos where activo=1');
		$query=$this->db->query('call numBusquedaProd("'.$clave.'","'.$cate.'")');
		$query->next_result();
		$num=0;
		foreach ($query->result() as $row) 
		{
			$num=$row->nume;
		}
		return $num;
	}
	function numProductos()
	{
		$query=$this->db->query('call numProd()');
		$query->next_result();
		$num=0;
		foreach ($query->result() as $row) 
		{
			$num=$row->nume;
		}
		return $num;
	}
	function getProductos($clave,$cate,$uri,$tope)
	{
		//$query=$this->db->query('select *from productos p join categorias c on p.id_categoria=c.id_categoria where activo=1 limit '.$uri.','.$tope.';');
		$query=$this->db->query('call buscarProducto("'.$clave.'","'.$cate.'",'.$uri.','.$tope.');');
		$query->next_result();
		return $query;
	}
	function getAllProductos($uri,$tope)
	{
		//$query=$this->db->query('select *from productos p join categorias c on p.id_categoria=c.id_categoria where activo=1 limit '.$uri.','.$tope.';');
		$query=$this->db->query('call allProductos('.$uri.','.$tope.');');
		$query->next_result();
		return $query;
	}
	function agregarProducto($data)
	{
		$query=$this->db->insert('productos',$data);
		return $query;
	}
	function agregarColor($data)
	{
		$query=$this->db->insert('colores',$data);
		return $query;
	}
	function maxIdProd()
	{
		$query=$this->db->query('select max(id_producto) as maximo from productos');
		$id=0;
		foreach ($query->result() as $row) {
			$id=$row->maximo;
		}
		return $id;
	}
	function maxIdColor()
	{
		$query=$this->db->query('select max(id_color) as maximo from colores');
		$id=0;
		foreach ($query->result() as $row) {
			$id=$row->maximo;
		}
		return $id;
	}
	function addDetColor($id_color,$id_producto)
	{
		$data['id_color']=$id_color;
		$data['id_producto']=$id_producto;
		$query=$this->db->insert('det_color',$data);
		return $query;
	}
	function desactivarProducto($id)
	{
		$data['activo']=0;
		$this->db->where('id_producto',$id);
		$query=$this->db->update('productos',$data);
		return $query;
	}
	function desactivarDetalleColor($id){
		$data['activacion']=0;
		$this->db->where('id',$id);
		$query=$this->db->update('det_color',$data);
		return $query;
	}
	function compra($fecha)
	{
		$data['fecha_compra']=$fecha;
		$query=$this->db->insert('compras',$data);
		return $query;
	}
	function maxIdCompras()
	{
		$this->db->select_max('id_compra');
		$query=$this->db->get('compras');
		return $query;
	}
	function agregarCompra($data)
	{
		$query=$this->db->query('call agregarCompra('.$data['id_compra'].','.$data['id_producto'].','.$data['cant'].','.$data['precio'].','.$data['id_color'].','.$data['idc'].',@ban);');
		//$query->next_result();
		$query=$this->db->query('SELECT @ban');
		foreach ($query->result_array() as $row) 
		{
			$ban=$row['@ban'];
		}
		return $ban;
	}
	function agregarPrecio($data)
	{
		$this->db->insert('precios',$data);
		$query=$this->db->query('select max(id_precio) as id_precio from precios');
		return $query;
	}
	function getPrecio($tipo,$precio)
	{
		$this->db->where('precio',$precio);
		$this->db->where('tipo',$tipo);
		$this->db->select('*');
		$query=$this->db->get('precios');
		return $query;
	}
	function getPrecioIds($id_precio,$id_producto)
	{
		$query=$this->db->query('select *from precios p join det_precios_ventas d on d.id_precio=p.id_precio where d.id_precio='.$id_precio.' and d.id_producto='.$id_producto);
		return $query;
	}
	/*function getDetprecio($id_precio,$id_producto)
	{
		$this->db->where('id_precio',$id_precio);
		$this->db->where('id_producto',$id_producto);
		$query=$this->db->get('det_precios_ventas');
		return $query;
	}*/
	function getTipoPrecio($id_producto,$tipo)
	{
		$query=$this->db->query('select *from precios p join det_precios_ventas d on p.id_precio=d.id_precio where d.id_producto='.$id_producto.' and tipo="'.$tipo.'" and d.activo=1;');
		return $query;
	}
	function desactivarPrecio($activo,$id_producto,$id_precio)
	{
		$this->db->where('id_producto',$id_producto);
		$this->db->where('id_precio',$id_precio);
		$query=$this->db->update('det_precios_ventas',$activo);
		return $query;
	}
	/*function agregarPrecio($data)
	{
		$query=$this->db->query('call agregarPrecio('.$data['id_producto'].',"'.$data['tipo'].'",'.$data['precio'].',@ban);');
		//$query->next_result();
		$query=$this->db->query('SELECT @ban');
		foreach ($query->result_array() as $row) 
		{
			$ban=$row['@ban'];
		}
		return $ban;
	}
	function agregarPrecioCategoria($data)
	{
		$query=$this->db->query('call agregarPrecioCategoria("'.$data['tipo'].'",'.$data['precio'].',"'.$data['cate'].'",@ban);');
		$query=$this->db->query('SELECT @ban');
		foreach ($query->result_array() as $row) 
		{
			$ban=$row['@ban'];
		}
		return $ban;
	}*/
	function activarPrecio($data,$id_precio,$id_producto)
	{
		$this->db->where('id_precio',$id_precio);
		$this->db->where('id_producto',$id_producto);
		$query=$this->db->update('det_precios_ventas',$data);
		return $query;
	}
	function getPrecios($id)
	{
		$query=$this->db->query('select p.id_precio,p.tipo,p.precio from productos pr join det_precios_ventas d on pr.id_producto=d.id_producto join precios p on d.id_precio=p.id_precio where d.id_producto='.$id.';');
		return $query;
	}
	function getProdEspicificaciones($data)
	{
		$this->db->where('nombre_producto',$data['nombre_producto']);
		$this->db->where('modelo',$data['modelo']);
		$this->db->where('id_marca',$data['id_marca']);
		$this->db->where('id_categoria',$data['id_categoria']);
		$query=$this->db->get('productos');
		return $query;
	}
	function getColor($color)
	{
		$this->db->where('color',$color);
		$query=$this->db->get('colores');
		return $query;
	}	
	function getDetPrecio($id_precio,$id_producto)
	{
		$this->db->where('id_precio',$id_precio);
		$this->db->where('id_producto',$id_producto);
		$query=$this->db->get('det_precios_ventas');
		return $query;
	}
	function agregarDetPrecios($data)
	{
		$query=$this->db->insert('det_precios_ventas',$data);
		return $query;
	}
	/*function getDetPrecio($id_precio,$id_producto)
	{
		$this->db->where('precios.id_precio',$id_precio);
		$this->db->where('det_precios_ventas.id_producto',$id_producto);
		$this->db->from('precios');
		$this->db->join('det_precios_ventas','precios.id_precio=det_precios_ventas.id_precio');
		$query=$this->db->get();
		return $query;
	}*/
	function comprobarProducto($modelo,$nombre_producto,$id_categoria,$id_marca,$color)
	{
		$query=$this->db->query('select *from productos p join det_color dc on p.id_producto=dc.id_producto join
			colores c on dc.id_color=c.id_color where p.modelo="'.$modelo.'" and p.nombre_producto="'.$nombre_producto.'" 
			and p.id_categoria='.$id_categoria.' and p.id_marca='.$id_marca.' and color="'.$color.'"');
		return $query;
	}
	//ventas------------------------------------------------------------------
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
	function getProducto($id,$id_color)
	{
		$query=$this->db->query('select * from productos p join marcas m on m.id_marca=p.id_marca
		join det_color dc on p.id_producto=dc.id_producto join colores c on c.id_color=dc.id_color where p.id_producto='.$id.' and c.id_color='.$id_color.';');
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
	
	function totalUrgentes($fecha)
	{
		$query=$this->db->query('select count(id_pedido) as numero from pedidos where estado="pendiente" and fecha_entrega<"'.$fecha.'";');
		return $query;
	}
	function comprobarMarca($marca)
	{
		$this->db->where('marca',$marca);
		$query=$this->db->get('marcas');
		return $query;
	}
	function registrarMarca($data){
		$query=$this->db->insert('marcas',$data);
		return $query;
	}
	function getMarca($marca)
	{
		$this->db->where('marca',$marca);
		$query=$this->db->get('marcas');
		return $query;
	}
	function getDetColor($id_producto,$id_color)
	{
		$this->db->where('activacion',1);
		$this->db->where('id_producto',$id_producto);
		$this->db->where('id_color',$id_color);
		$query=$this->db->get('det_color');
		return $query;
	}
	function getUserPass($pass)
	{
		$this->db->where('pass',$pass);
		$query=$this->db->get('administradores');
		return $query;
	}
	function getNota($id)
	{
		$query=$this->db->query('call getNota('.$id.');');
		$query->next_result();
		return $query;
	}
	function getVenta($id)
	{
		$query=$this->db->query('select *from productos p left join det_precios_ventas dpv on p.id_producto=dpv.id_producto left join precios ps on ps.id_precio=
    	dpv.id_precio left join det_ven_prodp dv on dpv.id=dv.id left join ventas v on v.id_venta=dv.id_venta left join categorias ct on ct.id_categoria=p.id_categoria where v.id_venta='.$id.';');
    	return $query;
	}
	function getIDProductos($id,$uri,$tope)
	{
		$query=$this->db->query('call buscarIdProducto('.$id.')');
		$query->next_result();
		return $query;
	}
}
?>