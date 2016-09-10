$(document).on('ready',function(){
	idViaje=null;
	idGasto=null;
	elemento=null;
	modalGastos=$("#modalGastos");
	addGasto=$("#addGasto");
	modalGondola=$("#modalGondola");

	$("#tablaGondola").DataTable( {
		"bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bSort": false,
        "bInfo": false,
        "bAutoWidth": false,
        "bJQueryUI":false,
        "oLanguage": {
            "sSearch":"Búsqueda",
        },
        dom: 'T<"clear">lfrtip'
    } );
	modalGondola.modal
	({
		keyboard:true,
		backdrop:false,
		show:false
	});
	addGasto.modal
	({
		keyboard:true,
		backdrop:false,
		show:false
	});
	modalGastos.modal
	({
		keyboard:true,
		backdrop:false,
		show:false
	});
	$(".link-gasto").on('click',function()
	{
		idViaje=$(this).data('id');
		console.log(idViaje);
		modalGastos.modal("show");
		getGastos();
	});
	$(".itemGasto").on('click',function(){
		idViaje=$(this).parent().parent().parent().data('id');
		elemento=$(this);
		addGasto.modal('show');

	})
	$("#btnAddGasto").on('click',function(){
		
		$("#id_viaje").val(idViaje);
		fAddGasto()
	});
	$(".itemGondola").on('click',function(){
		idViaje=$(this).parent().parent().parent().data('id');
		$("#id_viajeG").val(idViaje);
		getViaje();
		modalGondola.modal("show");
	});
	$("#btnEditarViaje").on('click',function(){
		modiGondola();
	})
});
function getGastos()
{
	var ruta=$("#modalGastos").data('ruta');
	$.ajax({
		url:ruta,
		type:"post",
		data:{id_viaje:idViaje},
		dataType:'json',
		beforeSend:function()
		{

		},
		success:function(data)
		{
			tabla=document.getElementById('tabla-gastos');
			if($("#tabla-gastos").find('tbody').length)
				$("#tabla-gastos").find('tbody').remove();
			tbody=document.createElement('tbody');
			tbody.setAttribute('id','t-body');
			for(var i=0;i<data.length;i++)		
			{
				tr=document.createElement('tr');
				td=document.createElement('td');
				td2=document.createElement('td');
				td3=document.createElement('td');
				td.innerHTML=data[i].concepto;
				tr.appendChild(td);
				td2.innerHTML=data[i].gasto;
				tr.appendChild(td2);
				boton=document.createElement('button');
				boton.classList.add('btn','btn-danger','btn-xs');
				boton.dataset.gasto=data[i].id_gasto;
				boton.setAttribute('type','button');
				span=document.createElement('span');
				span.classList.add('glyphicon','glyphicon-trash','eliminarGasto');
				boton.appendChild(span);
				td3.appendChild(boton);
				tr.appendChild(td3);
				tbody.appendChild(tr);
			}
			tabla.appendChild(tbody);
			
			if($('.eliminarGasto').length)
				$('.eliminarGasto').on('click',function(){
					eliminarGasto($(this));
				});
		},
		error:function(xhr,error,estado)
		{
			alert(xhr+" "+error+" "+estado);
		},
		complete:function()
		{

		}
	})
}
function eliminarGasto(ele)
{
	gasto=ele.parent().data('gasto');
	
	var ruta=$("#modalGastos").data('eliminar');
	$.ajax({
		url:ruta,
		beforeSend:function(){

		},
		dataType:'text',
		data:{id_gasto:gasto},
		type:'post',
		success:function(data)
		{
			if(data==1 || data=="1")
				ele.parent().parent().parent().remove();
		},
		error:function(xhr,error,estado)
		{
			alert(xhr+" "+error+" "+estado);
		},
		complete:function()
		{

		}
	})
}
function fAddGasto()
{
	var ruta=$("#addGasto").data('ruta');
	$.ajax({
		url:ruta,
		beforeSend:function(){

		},
		type:'post',
		data:$("#frmGasto").serialize(),
		dataType:'json',
		success:function(data)
		{
			if(data.ban==1 || data.ban=="1")
				if(data.query==1 || data.query=="1")
				{
					addGasto.modal("hide");
				}
			else
				alert("No se agrego");
			else 
				alert('complete sus campos');
		},	
		error:function(xhr,error,estado)
		{
			alert(xhr+" "+error+" "+estado);
		},
		complete:function(){
			
		}
	})
}
function getViaje()
{
	var ruta=$("#modalGondola").data('ruta');
	$.ajax({
		url:ruta,
		beforeSend:function(){},
		type:"post",
		data:{id_viaje:idViaje},
		dataType:"json",
		success:function(data)
		{
			$.each(data[0],function(key,value)
			{
				$("#"+key).val(value);
				console.log("#"+key);
			});
		},
		error:function(xhr,error,estado)
		{
			alert(xhr+" "+error+" "+estado);
		},
		complete:function(){

		}
	});
}
function modiGondola()
{
	var ruta=$("#frmGondola").attr('action');
	$.ajax({
		url:ruta,
		beforeSend:function(){

		},
		type:'post',
		data:$("#frmGondola").serialize(),
		dataType:'json',
		success:function(resp)
		{
			if(resp.ban==1 || resp.ban=="1")
			{
				if(resp.query==1 || resp.query=="1")
				{
					modalGondola.modal("hide");
				}
			}
			else 
				alert('Complete los campos');
		},
		error:function(xhr,error,estado)
		{
			alert(xhr+" "+error+" "+estado);
		},
		complete:function()
		{
			
		}
	})
}