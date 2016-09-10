$(document).on('ready',function()
{
	if($("#frm_envio").data('ban')==1 || $("#frm_envio").data('ban')=="1")
		$('#frm_envio').find('input,button').attr('disabled',true);
	btnVenta=$("#btnVenta");
	btnVenta.on('click',function(){

		if($("#pass").val().length>0)
			venta();
		else
			alert("complete la contraseña")
	});
});
function venta()
{
	var ruta=$("#frmVenta").attr('action');
	var entro=false;
	$.ajax({
		url:ruta,
		beforeSend:function(){

		},
		type:'post',
		data:{pass:$("#pass").val()},
		dataType:'json',
		success:function(resp)
		{
			console.log(resp);
			if(resp.ban!=2 && resp.ban!='2')
				if(resp.banderas!=100)
					if(resp.ban==1)
					{
						
						window.open($("#btnInsertarVenta").data('ruta'),'_blank');
						$("#mns-cart").html("Terminada");
						$("#pass").val("");
						$('#numProductos').text(0);
					}
					else
						alert('No se pudo realizar la compra');
				else
					alert("Esta vacio el carrito de ventas");
			else
				alert('Esa no es tu contraseña');

		},
		error:function(xhr,error,estado)
		{
			alert(xhr+" "+error+" "+estado);
		},
		complete:function(argument) 
		{
			
		}
	})
}