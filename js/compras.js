var tipo=null; // esta variable es para ingresar los precios de venta y elegir entre una categoria completa o invidual
$(document).on('ready',function()
{	
	  
	modalVentas=$('#modal_ventas');
	btnCompras=$('.btnComprar');
	frmCompras=$('#frm_Compras');
	btnIC=$('#btnInsertarCarrito'); // boton de la modal insertar al carrito
	var fecha=$('#fecha_compra');
	var btnInsertarVenta=$('#btnInsertarVenta');
	btnVender=$('.btnVender');
	//$("#ver-carrito").on('click',activarLink);//hacerlo con ajax
	//----------------------------------------------
	$(function($){
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'yy-mm-dd',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
	});
	fecha.datepicker({showButtonPanel:true,showAnim:"drop"});
	 $('[data-toggle="tooltip"]').tooltip()
	 $('.btnComprar').tooltip();
	//-------------- agregar precios-------------------------------------------------------
	btnPrecios=$('.btnPrecios');
	$('#modal_precios').modal
	({
		keyboard:true,
		backdrop:false,
		show:false
	});// creando la modal
	$("#btnModalPrecio").on('click',function(){
		$("#modal_precios").modal("show");
	});
	seleccion=true;
	$("#allSelect").on('click',function(){
		if(seleccion)
		{
			$(".check").attr('checked',seleccion);
			seleccion=false;
			console.log('seleccionados')
		}
		else
		{
			$(".check").attr('checked',seleccion);
			seleccion=true;
			console.log('des seleccionados')
		}
			
	});
	/*$("#cate-precio").on("change",function (){
		$('#tipoInsection').val(2);
		$("#id_productoV").val("null");
		$("#modal_precios").modal("show");
	});*/
	btnPrecios.on('click',function()
		{
			$('#tipoInsection').val(1);
			$('#precio').val("");
			var cadena='{"id":"id_productoV"}';
			data=JSON.parse(cadena);
			rellenarForm(data,$(this));
			
			$('#modal_precios').modal('show');
		});
	$('#btnInsertarPrecio').on('click',insertarPrecio);
	//---------------------- creando la modal -------------------COMPRAS------------------------
	$('#modal_compras').modal
	({
		keyboard:true,
		backdrop:false,
		show:false
	});
	btnCompras.on('click',function(){
		$('#cant_compra').val('');
		$('#precio_compra').val('');
		var cadena='{"id":"id_producto","idc":"idclr","name":"nombre_producto","categoria":"categoria","color":"id_color"}';
		arr=JSON.parse(cadena);
		rellenarForm(arr,$(this));
		$('#modal_compras').modal('show');
	});// evento del boton comprar
	btnIC.on('click',insertarCarrito);
	
	$('.boton-carro').click(function(){//------boton boton-carro para ver el carrito y desplegar la barra inferior-----
		activarLink();
		if($('.bottom-cart').css('bottom')!='0px')
		{
			$('.boton-carro span').removeClass('glyphicon').removeClass('glyphicon-arrow-down').addClass('glyphicon glyphicon-arrow-up');
			$('.bottom-cart').animate({bottom:'0'});	
		}
		else
		{
			$('.boton-carro span').removeClass('glyphicon glyphicon-arrow-down').addClass('glyphicon glyphicon-arrow-down');
			$('.bottom-cart').animate({bottom:'-25%'});
		}
	});
	//--------------------------------VENTAS---------------------------------------------------
	modalVentas.modal
	({
		keyboard:true,
		backdrop:false,
		show:false
	});
	btnVender.on('click',function(){
		$('#frm_ventas').find(':text').each(function()
		{
			if($($(this)).attr('name')!="fecha_venta")
				$($(this)).val('');
		});
		filldata($(this),false);
		//alert(document.frm_ventas.id_productoV.value)
		getPreciosV();
		modalVentas.modal('show');
	});
	$(".uno").on('click',function(){
		filldata($(this),true)
		insertarCarritoV();
	})
	function filldata(ele,op)
	{
		var cadena='{"id":"id_productoVT","name":"nombre_productoV","categoria":"categoriaV","color":"id_colorV"}';
		$("#precio_venta").empty();
		arr=JSON.parse(cadena);
		rellenarForm(arr,ele,op);
	}
	btnInsertarVenta.on('click',function()
	{

		if(typeof $('#precio_venta').val() == 'undefined' || $('#precio_venta').val() === null || $('#precio_venta').val() === '')
			alert('Agregue un precio a este producto, para continuar');
		else
			insertarCarritoV();
	});
});//fin del documento

function insertarCarrito()
{
	var ruta=$("#modal_compras").data('ruta');
	$("#nombre_producto").val($("#nombre_producto").val().replace('/','-'));
	$.ajax({
		url:ruta,
		beforeSend:function()
		{

		},
		type:'post',
		data:$('#frm_compras').serialize(),
		dataType:'json',
		success:function(resp)
		{
			switch(resp.ban)
			{
				case 0:
					alert('Complete los datos, si persiste el problema consulte con su proveedor');
					break;
				case 1:
					//$('#ver-carrito').attr('href','');
					var cad=$('#ver-carrito').data('base');
					document.querySelector('#link-movimiento').setAttribute('href',cad+'producto/terminarCompra');
					document.querySelector('#ver-carrito').setAttribute('href',cad+'producto/verCarrito');
					$("#item1-carrito").text('Terminar Compra');
					$('#modal_compras').modal('hide');
					$('#numProductos').text(resp.total);
					$('.boton-carro span').removeClass('glyphicon glyphicon-arrow-down').addClass('glyphicon glyphicon-arrow-up');
					$('.bottom-cart').animate({bottom:'0'});
					break;
				case 2:
					alert('Necesita terminar o borrar las ventas cargadas, para poder comprar');
					break;
				default:
					alert('consulte a su proveedor');
			}
		},
		error:function(xhr,error,estado)
	    {
	        alert(xhr+" "+error+" "+estado)
	    },
	    complete:function(xhr)
	    {
	        
	    }
	})
}
function rellenarForm(data,obj,op)
{
	if(op)
	{
		$("#precio_venta").append('<option value="'+obj.parent().parent().data('precio')+'" selected="selected">Publico</option>');
		console.log($("#id_precio").val())
		$("#cant_venta").val("1");
	}
	$.each(data,function(i,v){
		$('#'+v).val(obj.parent().parent().data(i));
	});
}
function getPreciosV()
{
	var ruta=$('#modal_ventas').data('rutap');
	$.ajax
	({
		url:ruta,
		beforeSend:function(){
			$("#btnInsertarVenta").attr('disabled',true);
			$("#btnInsertarVenta").text('Espere...');
		},
		data:{id_producto:document.frm_ventas.id_productoV.value},
		type:'post',
		dataType:'json',
		success:function(resp)
		{
			for(var i=0;i<resp.length;i++)
				$('#precio_venta').append("<option value="+resp[i].id_precio+">"+resp[i].tipo+": $"+resp[i].precio+"</option>");
		},
		error:function(xhr,error,estado)
	    {
	        alert(xhr+" "+error+" "+estado)
	    },
	    complete:function(xhr)
	    {
	      
			$("#btnInsertarVenta").attr('disabled',false);
			$("#btnInsertarVenta").text('Vender');  
	    }
	});
}
function insertarPrecio()
{
	var ruta=$('#modal_precios').data('ruta');
	//$("#cate").val($("#cate-precio").val());
	articulos=$("#frmChecks,#frm_precios").serialize();
	
	$.ajax({
		url:ruta,
		data:articulos,
		type:'post',
		dataType:'text',
		beforeSend:function()
		{

		},
		success:function(resp)
		{
			var ban=true;
			resp=JSON.parse(resp)
			for(i=0;i<resp.length;i++)
				if(!resp[i].ban)
					ban=false;
			if(ban)
				$("#modal_precios").modal('hide')
		},
		error:function(xhr,error,estado)
		{
			alert(xhr+" "+error+" "+estado)
		},
		complete:function(xhr)
		{
			
		}
	});
}
function insertarCarritoV()
{
	var ruta=$("#modal_ventas").data('rutav');
	$.ajax({
		url:ruta,
		beforeSend:function()
		{

		},
		type:'post',
		data:$('#frm_ventas').serialize(),
		dataType:'json',
		success:function(resp)
		{
			switch(resp.ban)
			{
				case 0:
					alert('Complete todos sus datos');
					break;
				case 1:
					var cad=$('#ver-carrito').data('base');
					document.querySelector('#link-movimiento').setAttribute('href',cad+'cliente/vistaCliente');
					document.querySelector('#ver-carrito').setAttribute('href',cad+'producto/verCarritoV');
					$("#item1-carrito").text('Terminar Venta');
					$('#numProductos').text(resp.total);
					$('.boton-carro span').removeClass('glyphicon glyphicon-arrow-down').addClass('glyphicon glyphicon-arrow-up');
					$('.bottom-cart').animate({bottom:'0'});	
					$('#modal_ventas').modal('hide');
					$("#mns-cart").html("<label>Total:</label> $"+resp.subtotal+" <label> Numero de items:</label>"+resp.total);

					break;
				case 2:
					$('#modal_ventas').modal('hide');
					alert('Termine o elimine sus compras cargadas, para poder vender');
					break;
				case 3:
					alert('La cantidad de venta supera las existencias recargue la pagina');
					break;
				case 4:
					alert('Asegurese que tiene el precio PUBLICO de venta');
					break;
				default:
					alert('Consulte a su proveedor'+resp+" "+resp.ban);

			}
			
		},
		error:function(xhr,error,estado)
	    {
	        alert(xhr+" "+error+" "+estado)
	    },
	    complete:function(xhr)
	    {
	        
	    }
	})
}
function activarLink()
{
	var ruta= $('#ver-carrito').data('ruta');
	var op=0;
	$.ajax({
		url:ruta,
		beforeSend:function(){
			$("#item1-carrito").text('Espere...');
		},
		type:'post',
		data:{variable:'hola'},
		dataType:'json',
		success:function(resp)
		{
			if(resp.ban==1)
			{
				$('#ver-carrito').attr('href',resp.url);
				$('#link-movimiento').attr('href',resp.urlSig);
				op=2;
			}
			else
			{
				$('#ver-carrito').attr('href',resp.url);
				$('#link-movimiento').attr('href',resp.urlSig);
				op=1;
			}
		},
		complete:function(xhr)
		{
			if(op==1)
				$("#item1-carrito").text('Terminar Compra');
			else
				$("#item1-carrito").text('Terminar Venta');
		},
		error:function(xhr,error,estado)
		{
			alert(error+" "+xhr+" "+estado)
		}
	})
}