<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Venta extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('funciones');
		$this->load->model('ModelVenta');
		$this->load->library('cart');
		$this->form_validation->set_message('required', '%s es un campo requerido');
		$this->form_validation->set_message('valid_email', '%s No es un email valido');
		$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
	}
	function terminarVenta()
	{
		$permisos[0]=1;
		$permisos[1]=2;
		$permisos[2]=3;
		$this->funciones->logueado($permisos,$this->session->userdata('id_user'),$this->session->userdata('tipo'));
		$entro=false;
		//$credito=$this->input->post('credito');
		//$data['credito']=$credito;
		$pass=md5($this->input->post('pass'));
		$query=$this->ModelVenta->getUserPass($pass);
		if($query->num_rows()>0)
		{
			$arreglo=$query->row_array();
			//$arreglo['id_user'];
			$data['fecha_venta']=$this->session->userdata('fecha_venta');
			$query=$this->ModelVenta->insertarVenta($data);
			$query=$this->ModelVenta->maxIdVenta();
			foreach ($query->result() as $row) 
			{
				$id_venta=$row->id_venta;
				$this->session->set_userdata('id_venta',$id_venta); // comprobar fallas al regresar de clientes para otra parte .. etc
			}
			if(isset($id_venta))
			{
				$i=0;
				if($this->cart->total_items()>0)
				{
					foreach ($this->cart->contents() as $item) 
					{
						$arr['id_venta']=$id_venta;
						$arr['cantidad_venta']=$item['qty'];
						$arr['id_producto']=$item['id'];
						$arr['id_precio']=$item['id_precio'];
						$arr['precio']=$item['price'];
						$arr['id_color']=$item['id_color'];
						$arr['id_user']=$arreglo['id_user'];
						$ban[$i++]=$this->ModelVenta->vender($arr);// regresa banderas del procedure		
						unset($arr);
					}
					$json['banderas']=$ban;
				}
				else
					$json['banderas']=100;
				$json['ban']=1;
				/*if($this->session->userdata('id_cliente'))
					$json['cliente']=1;
				else
					$json['cliente']=0;*/
				//$json['total']=$this->cart->total();
				$this->cart->destroy();
				if($this->session->userdata('fecha_venta'))
					$this->session->unset_userdata('fecha_venta');
				$this->session->unset_userdata('carrito');	
				//echo json_encode($json);
			}	
			else
			{
				$json['ban']=0;
				//echo json_encode($json);
			}
		}
		else
		{
			$json['ban']=2;
		}
		echo json_encode($json);
	}
	function idVenta()
	{
		$this->session->set_userdata('id_venta',$this->uri->segment(3));
		redirect(base_url().'venta/crearNota');
	}
	function crearNota()
	{
		$permisos[0]=1;
		$permisos[1]=2;
		$permisos[2]=3;
		$this->funciones->logueado($permisos,$this->session->userdata('id_user'),$this->session->userdata('tipo'));
		$query=$this->ModelVenta->getNota($this->session->userdata('id_venta'));
		$row=$query->row_array();
		require_once('fpdf/fpdf.php');
		$pdf=new FPDF('P','mm',array(80,200));
		$pdf->AddPage();
		$pdf->Image(base_url().'img/logo.jpg',20,5,40,10);
		$pdf->SetMargins(5,10,5);
		$pdf->SetFont('Arial','B',9);
		$pdf->Ln(10);
		$pdf->Cell(0,5,'ISCOCOMPUTADORAS S.A DE C.V.',0,1,'C');
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(0,5,'***SUPERCEL***',0,1,'C');
		$pdf->Cell(0,1,'JALISCO # 121 COLONIA LLANOS DE SAHUAYO',0,1,'C');
		$pdf->Cell(0,5,'TEL 01 353 128 1362',0,1,'C');
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(0,1,'SAHUAYO MICHOACAN',0,1,'C');
		$pdf->Ln(5);
		$pdf->Cell(0,5,$row['fecha_venta'],'TB',1,'C');
		$pdf->SetFont('Arial','B',8);
		$pdf->Ln(5);
		$pdf->SetTextColor(255,255,255);
		$pdf->SetFont('Arial','B',10);
		//$pdf->Cell(,5,'',1,0,'L',1);
		$pdf->Cell(15,5,'',0,0,'C',0);
		$pdf->Cell(20,5,'Nota:',1,0,'C',1);
		$pdf->SetFont('Arial','',10);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(20,5,$row['id_venta'],1,1,'C',0);
		
		$pdf->SetFont('Arial','',8);
		//$pdf->Cell(0,1,utf8_encode($row['nombre']).' '.utf8_encode($row['apellido_paterno']).' '.utf8_encode($row['apellido_materno']),0,1);
		$pdf->Ln(5);
		$pdf->SetFont('Arial','B',10);
		$pdf->SetFont('Arial','',8);
		$query=$this->ModelVenta->getVenta($this->session->userdata('id_venta'));
		$pdf->SetFont('Arial','B',9);
		$pdf->SetTextColor(255,255,255);
		$pdf->Cell(27,5,'Producto','TRL',0,'C',1);
		$pdf->Cell(30,5,'Modelo','TR',0,'C',1);
		$pdf->Cell(13,5,'Cant.','TR',1,'C',1);
		$pdf->SetFont('Arial','',8);
		$pdf->SetTextColor(0,0,0);
		foreach ($query->result() as $fila) 
		{
			$pdf->Cell(27,5,$fila->categoria,1,0,'L');	
			$pdf->Cell(30,5,$fila->modelo,1,0,'L');	
			$pdf->Cell(13,5,$fila->cantidad_venta,1,0,'L');	
			$pdf->Ln();
		}
		
		$pdf->SetFont('Arial','',8);
		//$pdf->Cell(30,5,'$'.number_format($row['interes'],2,".",","),'BR',1,'L');
		$pdf->SetFont('Arial','B',10);
		$pdf->SetTextColor(255,255,255);
		$pdf->Cell(40,5,'TOTAL','BRL',0,'C',1);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(30,5,'$'.number_format($row['total_venta'],2,".",","),'BR',1,'C',0);
		$pdf->Ln();
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(15,5,'Atendio:',0,0,'L');
		$pdf->Cell(65,5,$row['id_user'],0,0,'L');
		$pdf->Ln();
		$pdf->Cell(70,5,"********************************************************",0,0,'L');
		//$pdf->Cell(23,6,utf8_encode($color),0,0,'L');
		//if($row['credito']=='SI')
		//	$pdf->Cell(50,5,'$'.number_format($row['total_venta'],2,".",","),0,0,'L');
		//else
			//$pdf->Cell(50,5,'$'.number_format($row['monto'],2,".",","),0,0,'L');
		//$pdf->MultiCell(0,3,utf8_encode($falla),0,'L');
		
		//$this->eliminarVarSession();
		$pdf->output();
		return $pdf;
	}
	function reporteVentas()
	{
		$permisos[0]=1;
		$this->funciones->logueado($permisos,$this->session->userdata('id_user'),$this->session->userdata('tipo'));
		$this->form_validation->set_rules('de','De','required');
		$this->form_validation->set_rules('hasta','Hasta','required');
		if($this->form_validation->run()===false)
		{
			$this->vistaReporteVentas();
			//echo 'hola';
		}
		else
		{

			$de=$this->input->post('de');
			$hasta=$this->input->post('hasta');
			$this->vistaReporteVentas($this->consultaCorte($de,$hasta));
		}
	}
	function consultaCorte($de,$hasta)
	{
		$permisos[0]=1;
		$this->funciones->logueado($permisos,$this->session->userdata('id_user'),$this->session->userdata('tipo'));
		$data['query']=$this->ModelVenta->getVentas($de,$hasta);
		$data['saldo']=0;//lo que se debe
		$data['total']=0;// total de ventas
		$data['total_venta']=0;//ingresos reales
		$data['total_credito']=0;//lo que debe ser ssolo con creditos
		foreach ($data['query']->result() as $row)
		{
			$data['total']+=$row->cantidad_venta*$row->precio;
		}
		return $data;
	}
	function consultaComision($de="",$hasta="")
	{
		$permisos[0]=1;

		$this->funciones->logueado($permisos,$this->session->userdata('id_user'),$this->session->userdata('tipo'));
		$data['query']['users']=$this->ModelVenta->getComisionistas()->result_array();
		for($i=0;$i< count($data['query']['users']);$i++)
		{
			$data['query']['comisionistas'][$i]=$this->ModelVenta->getComisiones($data['query']['users'][$i]['id_user'],$de,$hasta);
			
		}
		return $data;
	}

	function vistaReporteVentas($data="")
	{
		$permisos[0]=1;
		$this->funciones->logueado($permisos,$this->session->userdata('id_user'),$this->session->userdata('tipo'));
		$this->load->view('general/header',$data);
		$this->load->view('general/scripts');
		$this->load->view('productos/corte');
		$this->load->view('productos/modales');
		$this->load->view('general/footer');
	}
	function vistaReporteComision($data="")
	{
		$permisos[0]=1;
		$this->funciones->logueado($permisos,$this->session->userdata('id_user'),$this->session->userdata('tipo'));
		$this->load->view('general/header',$data);
		$this->load->view('general/scripts');
		$this->load->view('productos/comisiones');
		$this->load->view('productos/modales');
		$this->load->view('general/footer');
	}
	function cortePredifinido()
	{
		$permisos[0]=1;
		$this->funciones->logueado($permisos,$this->session->userdata('id_user'),$this->session->userdata('tipo'));
		date_default_timezone_set('America/Monterrey');
		$hasta=date('Y-m-d'); 
		$op=$this->uri->segment(3);
		$de=$this->devolverRango($op);
		$this->vistaReporteVentas($this->consultaCorte($de,$hasta));
	}
	function comisionPredifinido()
	{
		$permisos[0]=1;
		$this->funciones->logueado($permisos,$this->session->userdata('id_user'),$this->session->userdata('tipo'));
		date_default_timezone_set('America/Monterrey');
		$hasta=date('Y-m-d'); 
		$op=$this->uri->segment(3);
		$de=$this->devolverRango($op);
		$this->vistaReporteComision($this->consultaComision($de,$hasta));
	}
	function vender($data)
	{
		$permisos[0]=1;
		$permisos[1]=2;
		$permisos[2]=3;
		$this->funciones->logueado($permisos,$this->session->userdata('id_user'),$this->session->userdata('tipo'));
		$query=$this->db->query('call vender('.$data['id_venta'].','.$data['cantidad_venta'].','.$data['id_producto'].','.$data['id_precio'].','.$data['precio'].','.$data['id_color'].','.$data['id_user'].',@ban);');
		//$query->next_result();
		$query=$this->db->query('SELECT @ban');
		foreach ($query->result_array() as $row) 
		{
			$ban=$row['@ban'];
		}
		return $ban;
	}
	function devolverRango ($rango)
	{
		switch ($rango) {
			case 'dia':
				$resp=date('Y-m-d');  
				break;
			case 'semana':
				$resp=date('Y-m-d', strtotime('-1 week')); 
				break;
			case 'mes':
				$resp=date('Y-m-d',strtotime('-1 month')); 
				break;
			default:
				$resp=date('Y-m-d');  
				break;
		}
		return $resp;
	}
	function reporteComisiones()
	{
		$permisos[0]=1;
		$this->funciones->logueado($permisos,$this->session->userdata('id_user'),$this->session->userdata('tipo'));
		$this->form_validation->set_rules('de','De','required');
		$this->form_validation->set_rules('hasta','Hasta','required');
		if($this->form_validation->run()===false)
		{
			$this->vistaReporteComision();
			//echo 'hola';
		}
		else
		{

			$de=$this->input->post('de');
			$hasta=$this->input->post('hasta');
			$this->vistaReporteComision($this->consultaComision($de,$hasta));
		}
	}
	function eliVenta()
	{
		$permisos[0]=1;
		$this->funciones->logueado($permisos,$this->session->userdata('id_user'),$this->session->userdata('tipo'));
		$id_venta=$this->input->post('id');
		$id_producto=$this->input->post('id_producto');
		$json['ban']=$this->ModelVenta->eliVenta($id_venta,$id_producto);
		echo json_encode($json);
	}
}3536935944