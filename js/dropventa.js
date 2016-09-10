var id_venta=null;
var fila=null;
$(document).on('ready',function()
{
	modalVenta=$("#modalVenta");
	modalVenta.modal
	({
		keyboard:true,
		backdrop:false,
		show:false
	});
	$(".btnVenta").on('click',function(){
		id_venta=$(this).parent().data('id');
		prod=$(this).parent().data('prod');
		fila=$(this).parent();
		modalVenta.modal('show');
	});
	$("#btnEliVenta").on('click',function(){
		var ruta=$("#modalVenta").data('ruta');
		$.ajax({
			url:ruta,
			beforeSend:function(){

			},
			type:'post',
			data:{id:id_venta,id_producto:prod},
			dataType:'json',
			success:function(resp){
				if(resp.ban==1)
				{
					modalVenta.modal('close');
					fila.remove();
				}
				else
					alert('No se pudo eliminar la venta')
			},
			error:function(error,estado,xhr)
			{
				alert(error+" "+xhr+" "+estado);
			},
			complete:function(){
				
			}
		})
	})
});