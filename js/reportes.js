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
  $("#tabla-reportes").dataTable( {
        "bJQueryUI": false,
        "sDom": 'T<"clear">lfrtip',
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bSort": false,
        "bInfo": false,
        "bAutoWidth": true,
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
	$("#de").datepicker({
      showAnim:"drop",
      showButtonPanel: true
     });
	$("#hasta").datepicker({
      showAnim:"drop",
      showButtonPanel: true
     });
});