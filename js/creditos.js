var col3=0,col4=0,m=0;
$(document).on('ready',function(){
	modalAbono=$("#modalAbono");
	modalAbono.modal
	({
		keyboard:true,
		backdrop:false,
		show:false
	});
	$('.abono').on('click',function()
	{
		$("#monto").val("");
		$("#id_credito").val("");
		$("#id_credito").val($(this).parent().data('id'));
		col3=$(this).parent().parent().find('td:eq(3)')
		col4=$(this).parent().parent().find('td:eq(4)')
		modalAbono.modal('show')
	})
	$("#btnAbono").on('click',function(){
		var ruta=$("#frmAbono").attr('action');
		
		$.ajax({
			url:ruta,
			beforeSend:function()
			{
				$('#btnAbono').attr('disabled',true);
			},
			type:'post',
			data:$("#frmAbono").serialize(),
			dataType:'json',
			success:function(resp)
			{
				if(resp.ban=="true" || resp.ban==true)
				{
					if(resp.sql==1 || resp.sql=="1")
					{
						abonos=parseFloat(col3.text());
						saldo=parseFloat(col4.text());
						m=parseFloat($("#monto").val());
						col3.text(abonos+m);
						col4.text(saldo-m);
						col3.css({'color':'#4C804C','font-weight':'bold'});
						col4.css({'color':'#4C804C','font-weight':'bold'});
						$("#modalAbono").modal('hide');
					}
					else
					{
						$("#modalAbono").modal('hide');
						alert('La cantiadad de abono sobre pasa el saldo');
					}
				}
				else
					alert('complete todos los campos');
			},
			error:function(xhr,error,estado)
			{
				alert(error+" "+estado+" "+xhr);
			},
			complete:function()
			{
				$('#btnAbono').attr('disabled',false);
			}
		});
	});
});