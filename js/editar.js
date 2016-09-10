var c1=null;
var c2=null;
var c3=null;
var c4=null;
var c5=null;
var c6=null;
$(document).on('ready',function()
{
	var id=null;
	var ele=null;
	var idc=null;
	$("#modalProducto").modal
	({
		keyboard:true,
		backdrop:false,
		show:false
	});// creando la modal
	$('.editar').on('click',function(){
		id=$(this).parent().parent().data('id');
		idc=$(this).parent().parent().data('idc');
		color=$(this).parent().parent().data('color');
		c1=$(this).parent().parent().parent().find('td').eq(0);
		c2=$(this).parent().parent().parent().find('td').eq(1);
		c3=$(this).parent().parent().parent().find('td').eq(2);
		c4=$(this).parent().parent().parent().find('td').eq(3);
		c5=$(this).parent().parent().parent().find('td').eq(4);
		c6=$(this).parent().parent().parent().find('td').eq(5);
		ele=$(this);
		getProducto(id,color);
		$("#modalProducto").modal('show');
	})
	$('#btnEditarProducto').on('click',function(){
		editar();
		
	});
	$("#btnDesactivarProducto").on('click',function(){
		desactivarProducto(id,ele,idc);
	})
	$("#btnMarca").on('click',function(e){
		e.preventDefault();
		$("#modalMarca").modal("show");
	})
	$("#btnRegistrarMarca").on('click',registrarMarca);
});
function editar()
{
	$("#nombre_productoE").val($("#nombre_productoE").val().replace("\"","\\\""));
	$("#modeloE").val($("#modeloE").val().replace("\"","\\\""));
	$("#descripcionE").val($("#id_categoriaE option:selected").html()+" "+$("#nombre_productoE").val()+" "+$("#modeloE").val());
	var ruta=$("#frmProducto").attr('action');
	$.ajax({
		url:ruta,
		beforeSend:function(){
			$("#btnDesactivarProducto").css('disabled',true);
			$("#btnEditarProducto").css('disabled',true);
		},
		type:'post',
		data:$('#frmProducto').serialize(),
		dataType:'json',
		success:function(resp)
		{
			
			if(resp.ban=="true" || resp.ban==true)
			{
				if(resp.query==1 || resp.query=="1")
				{
					$("#modalProducto").modal('hide');
					c1.html($("#nombre_productoE").val());
					console.log('hola'+$("#nombre_productoE").val())
					c2.html($("#modeloE").val());
					c3.html(("#id_marcaE option:selected").html());
					c4.html($("#categoriaE option:selected").html());
					c5.html($("#colorE").val());
					c6.html($("#descripcionE").val());
				}
				else
					alert('Ya existe un producto con esas caracteristicas');
			}
			else
				alert('complete los campos');
		},
		error:function(xhr,estado,error)
		{
			alert(xhr+" "+error+" "+estado);
		},
		complete:function()
		{
			$("#btnDesactivarProducto").css('disabled',false);
			$("#btnEditarProducto").css('disabled',false);
		}
	});
}
function getProducto(id,color)
{
	var ruta=$("#modalProducto").data('ruta');
	$.ajax({
		url:ruta,
		beforeSend:function()
		{
			$("#btnDesactivarProducto").css('disabled',true);
			$("#btnEditarProducto").css('disabled',true);
		},
		type:'post',
		data:{id_producto:id,id_color:color},
		dataType:'json',
		success:function(resp)
		{
			$.each(resp[0],function(key,value)
			{
				$("#"+key+"E").val(value);
			});
		},
		error:function(xhr,estado,error)
		{
			alert(xhr+" "+error+" "+estado);
		},
		complete:function()
		{
			$("#btnDesactivarProducto").css('disabled',false);
			$("#btnEditarProducto").css('disabled',false);
		}
	});
}
function desactivarProducto(id,ele,idc)
	{
		var ruta=$("#btnDesactivarProducto").data('ruta');
		$.ajax({
			url:ruta,
			beforeSend:function(){
				$("#btnDesactivarProducto").css('disabled',true);
				$("#btnEditarProducto").css('disabled',true);
			},
			type:'post',
			data:{id_producto:id,id:idc},
			dataType:'text',
			success:function(resp)
			{
				if(resp=="1" || resp==1)
				{
					ele.parent().parent().parent().remove();
					$("#modalProducto").modal('hide');
				}
			},
			error:function(xhr,estado,error)
			{
				alert(xhr+" "+error+" "+estado);
			},
			complete:function()
			{
				$("#btnDesactivarProducto").css('disabled',false);
				$("#btnEditarProducto").css('disabled',false);
			}
			});
	}
	function registrarMarca()
	{
		var ruta=$("#modalMarca").data('ruta');
		$.ajax({
			url:ruta,
			beforeSend:function(){

			},
			type:'post',
			dataType:'json',
			data:$("#frmMarca").serialize(),
			success:function(resp)
			{
				if(resp.ban)
				{
					console.log(resp+" resp.res="+resp.res)
					if(resp.res)
					{
						var option= document.createElement('option');
						option.innerHTML=resp.marca;
						option.setAttribute('value',resp.id_marca);
						document.querySelector("#id_marca").appendChild(option);
						//$("#id_marca").appendTo('<option value="'+resp.id_marca+'">'+resp.marca+'</option>')

					}
				}
				$("#modalMarca").modal('hide');
			},
			error:function(error,estado,xhr)
			{
				alert(error+" "+estado+" "+xhr)
			},
			complete:function()
			{

			}
		})
	}