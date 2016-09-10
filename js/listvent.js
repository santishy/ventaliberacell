$(document).on('ready',function()
{
	$("#ventana").modal
	({
		keyboard:true,
		backdrop:false,
		show:false
	});
	var btnDestino=$(".t-destino");
	btnDestino.on('click',function(){
		getDestinos($(this));
		
	});
	$(".listaVenta").on('click',function(){
		var id_venta=$(this).parent().parent().data('id');
		getVentas(id_venta);
		$('#ventana').modal('show');

	});
});
function getVentas(id)
{
	var ruta=$(".tabla").data('ruta');
	var body=$("#body-ventana");
	body.find('p,hr').remove();
	$.ajax({
		url:ruta,
		beforeSend:function()
		{
			$('#ventana').find('h4').text('');
			$('#ventana h4').append('Espere...');
		},
		type:'post',
		data:{id_venta:id},
		dataType:'json',
		success:function(resp)
		{
			if(!jQuery.isEmptyObject(resp))
			{
				
				$('#ventana').find('h4').text('');
				$('#ventana h4').append('Ventas');
				for(var i=0;i<resp.length;i++)
				{
					body.append('<p><label>Nombre</label>: '+resp[i].nombre_producto+'</p>');
					body.append('<p><label>Medida</label>: '+resp[i].medida+'</p>');
					body.append('<p><label>Categoria</label>: '+resp[i].categoria+'</p>');
					body.append('<p><label>Precio</label>: '+resp[i].precio+'</p>');
					body.append('<p><label>Cantidad</label>: '+resp[i].cantidad_venta+'</p>');
					body.append('<hr>');		
				}
				body.append('<p><label>Total</label>: '+resp[0].total_venta+'</p>')
				body.find('p').addClass('p');
			}
		},
		error:function(xhr,error,estado)
		{
			alert(xhr+" "+error+" "+estado);
		},
		complete:function()
		{

		}
	});
}
function getDestinos(e)
{
	var ruta= e.data('ruta');
	var id=e.data('id');
	var body=$("#body-ventana");
	$.ajax({
		url:ruta,
		beforeSend:function(){

		},
		data:{id_pedido:id},
		type:'post',
		dataType:'json',
		success:function(resp)
		{
			if(!jQuery.isEmptyObject(resp))
			{
				body.find('p,hr').remove();
				$('#ventana').find('h4').text('');
				$('#ventana h4').append('Destinos');
				for(var i=0;i<resp.length;i++)
				{
					body.append('<p><label>Estado</label>: '+resp[i].estado+'</p>');
					body.append('<p><label>Ciudad</label>: '+resp[i].ciudad+'</p>');
					body.append('<p><label>Lugar</label>: '+resp[i].lugar+'</p>');
					body.append('<p><label>Telefono</label>: '+resp[i].telefono+'</p>');
					body.append('<p><label>Flete</label>: '+resp[i].telefono+'</p>');
					body.append('<p><label>Fecha de entrega</label>: '+resp[i].fecha_entrega+'</p>');
					body.append('<hr>');		
				}
				body.find('p').addClass('p');
			}
		},
		complete:function()
		{
			$("#ventana").modal('show');
		},
		error:function(error,xhr,estado)
		{
			alert(error+' '+estado+' '+estado);
		}
	})
}