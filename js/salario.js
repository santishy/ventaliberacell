$(document).on('ready',function()
{
	console.log('hola')
	modalSalario=$("#modalSalario");
	btnAddSalario=$("#btnAddSalario");
	btnAddSalario.on('click',function(){
		addSalario()
	});
	modalSalario.modal
	({
		keyboard:true,
		backdrop:false,
		show:false
	});
	var btnSalario=$(".btnSalario");
	btnSalario.on('click',function(){
		limpiar();
		idsalario=$(this).parent().data('id');
		$("#id_salario").val(idsalario);
		$("#id_empleado").val($(this).data('id'));
		console.log(idsalario);
		getSalario();
		modalSalario.modal('show');
	})
});
function addSalario()
{
	var ruta=$("#frmSalario").attr('action');
	$.ajax({
		url:ruta,
		beforeSend:function(){
			btnAddSalario.attr('disabled',true);
		},
		type:'post',
		data:$("#frmSalario").serialize(),
		dataType:'json',
		success:function(resp)
		{
			if(resp.ban)
				modalSalario.modal('hide');
			else
				alert('complete todos los campos');
		},
		complete:function()
		{
			btnAddSalario.attr('disabled',false);
		},
		error:function(xhr,estado,error)
		{
			alert(xhr+" "+error+" "+stado);
		}
	})
}
function getSalario()
{
	var ruta=modalSalario.data('ruta');
	$.ajax({
		url:ruta,
		beforeSend:function(){

		},
		data:{id_salario:idsalario},
		type:'post',
		dataType:'json',
		success:function(data)
		{
			if(!jQuery.isEmptyObject(data))
			{
				$("#tipo").val(data[0].tipo);
				$("#salario").val(data[0].salario);
				$("#id_empleado").val(data[0].id_empleado);
				$("#id_salario").val(data[0].id_salario);
			}
		},
		complete:function(){

		}
	})
}
function limpiar()
{
	$("#frmSalario").find('input').val("");
}