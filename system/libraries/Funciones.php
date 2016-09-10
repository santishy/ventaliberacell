<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CI_Funciones{
	
	function traducirDia($dia)
	{
		$data=array('Monday'=>'Lunes','Tuesday'=>'Martes','Wednesday'=>'Miercoles'
			,'Thursday'=>'Jueves','Friday'=>'Viernes','Saturday'=>'Sabado','Sunday'=>'Domingo');
		if(isset($data[$dia]))
			return $data[$dia];
		else
			return 'Indefinido';
	}
	public function logueado($data,$user=0,$tipo=0)//se envia el permiso
	{
		if($user==0)
			redirect(base_url().'login/cerrarSesion');
		$ban=true;
		for ($i=0; $i <count($data); $i++) 	
			if($tipo==$data[$i])
			{
				$ban=false;
				break;
				
			}		
		if($ban)
			redirect(base_url().'login/restriccion');

	}
	function stringTipo($tipo){
		switch ($tipo) {
			case 1:
				return 'ADMINISTRADOR';
				break;
			case 2:
				return 'VENDEDOR';
				break;
			case 3:
				return 'CAPTURISTA';
				break;
			default:
				# code...
				break;
		}
	}
	function imprimirDia($str)
	{
		switch ($str) {
			case 'Monday':
				$i=0;
				break;
			case 'Tuesday':
				$i=1;
				break;
			case 'Wednesday':
				$i=2;
				break;
			case 'Thursday':
				$i=3;
				break;
			case 'Friday':
				$i=4;
				break;
			case 'Saturday':
				$i=5;
				break;
			default:
				$i=6;
				break;
		}
		return $i;
	}
	
}

?>