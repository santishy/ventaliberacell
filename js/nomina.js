$(document).on('ready',function()
{
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
	$("#tablaNomina").dataTable( {
        "bJQueryUI": false,
        "sDom": 'T<"clear">lfrtip',
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bSort": false,
        "bInfo": false,
        "bAutoWidth": false,
        "oLanguage": {
            "sSearch":"Búsqueda",
            "sEmptyTable": "No hay registros",
        },
        "oTableTools": {
            "aButtons": [ 
                    {
                    "sExtends": "copy",
                        "sButtonText": "Copiar  |"
                    },
                    {
                        "sExtends": "xls",
                        "sButtonText": "Excel  |"
                    },
                    {
                        "sExtends": "pdf",
                        "sButtonText": "Pdf  |"
                    },
                    {
                        "sExtends":"print",
                        "sButtonText":"Imprimir tamaño carta"
                    }
            ]

        }
        
    } );
	$("#fecha").datepicker({
      showAnim:"drop",
      showButtonPanel: true
     });
	$("#fecha2").datepicker({
      showAnim:"drop",
      showButtonPanel: true
     });
	$("#fecha3").datepicker({
      showAnim:"drop",
      showButtonPanel: true
     });
	modalDias=$("#modalDias");
	modalHrs=$("#modalHrs");
	modalPrestamo=$("#modalPrestamo");
	modalPrestamo.modal
	({
		keyboard:true,
		backdrop:false,
		show:false
	});
	modalDias.modal
	({
		keyboard:true,
		backdrop:false,
		show:false
	});
	$('.prestamos').on('click',function(){
		id_empledo=$(this).parent().parent().parent().parent().data('id');
		$(".id_empleado").val(id_empledo);
		modalPrestamo.modal("show");	
	});
	$('.diasT').on('click',function()
	{
		id_empledo=$(this).parent().parent().parent().parent().data('id');
		$(".id_empleado").val(id_empledo);
		modalDias.modal("show");
	})
	$("#btnAddDiaTrabajo").on('click',addDiaTrabajo);
	$('.hrsE').on('click',function(){
		id_empledo=$(this).parent().parent().parent().parent().data('id');
		$(".id_empleado").val(id_empledo);
		modalHrs.modal("show");
	})
	$('#btnAddHr').on('click',addHr);
	$("#btnAddPrestamo").on('click',addPrestamo);
});
function addDiaTrabajo()
{
	var ruta=$("#frmDias").attr('action');
	$.ajax({
		url:ruta,
		beforeSend:function(){

		},
		type:'post',
		dataType:'json',
		data:$("#frmDias").serialize(),
		success:function(resp)
		{
			if(resp.ban==true || resp.ban=="true")
			{
				if(resp.res==1 || resp.res=="1")
				{
					modalDias.modal('hide');
				}
			}
			else
				alert('complete los datos');
		},
		error:function(xhr,error,estado){
			alert(xhr+" "+error+" "+estado);
		},
		complete:function(){

		}
	});
}
function addHr()
{
	var ruta=$("#frmHrs").attr('action');
	$.ajax({
		url:ruta,
		beforeSend:function(){},
		data:$("#frmHrs").serialize(),
		type:'post',
		dataType:'json',
		success:function(resp)
		{
			if(resp.ban)
			{
				if(resp.res)
				{
					modalHrs.modal('hide');
				}
				else
				{
					modalHrs.modal('hide');
					alert('Necista crear un dia de trabajo');
				}
			}
			else
			{
				alert('complete los campos');
			}
		},
		error:function(xhr,error,estado){
			alert(xhr+" "+error+" "+estado);
		},
		complete:function()
		{

		}
	})
}
function addPrestamo()
{
	var ruta=$("#frmPrestamo").attr('action');
	$.ajax({
		url:ruta,
		beforeSend:function(){

		},
		dataType:'json',
		type:'post',
		data:$("#frmPrestamo").serialize(),
		success:function(resp)
		{
			if(resp.ban)
			{
				if(resp.res)
				{
					modalPrestamo.modal('hide');
				}
				else
				{
					modalPrestamo.modal('hide');
					alert('Algo ocurrio');
				}
			}
			else
			{
				alert('complete los campos');
			}
		},
		error:function(xhr,error,estado){
			alert(xhr+" "+error+" "+estado);
		},
		complete:function()
		{

		}
	})
}