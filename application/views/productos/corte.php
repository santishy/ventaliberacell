<div class="col-md-12">
	<div class="panel panel-primary sombras">
	  		<div class="panel-heading"><h3>Reporte de Ventas</h3></div>
	 	<div class="panel-body">
	 		<div class="container-body">
	 			<div class="col-md-4">
	 				<h3>Ver por estado:</h3>
	 				<hr>
		 			<ul class="nav nav-pills nav-stacked">
		  				<li role="presentation">
		  					<a style="color:#008FB2;font-weight:bold" class="btn btn-default" href="<?=base_url()?>venta/cortePredifinido/dia">Dia</a>
		  				</li>
		  				<li role="presentation">
							<a style="color:#008FB2;font-weight:bold" class="btn btn-default" href="<?=base_url()?>venta/cortePredifinido/semana">Semana</a>
		  				</li>
		  				<li role="presentation">
							<a style="color:#008FB2;font-weight:bold" class="btn btn-default" href="<?=base_url()?>venta/cortePredifinido/mes">Mes</a>			
		  				</li>
					</ul>
					<?=validation_errors()?>
				</div>
				<div class="col-md-4">
	 				<h3>Corte por fechas</h3>
	 				<hr>
	 				<form action="<?=base_url()?>venta/ReporteVentas" method="post">
	 					<div class="form-group">
	 						<label>De:</label>
	 						<input name="de" id="de" class="form-control" value="">
	 					</div>
	 					<div class="form-group">	
	 						<label>Hasta:</label>
	 						<input name="hasta" id="hasta"class="form-control" value="">
	 					</div>
	 					<div class="form-group">
	 						<button class="btn btn-default">Realizar</button>
	 					</div>
	 				</form>
				</div>
				<?php if(isset($total)){?>
				<div class="col-md-4">
					<h3>Resultados:</h3>
					<hr>
					<p class="reporte"><label>Total de Ventas:</label> $<?=number_format($total,2)?></p>
					
				</div>
				<?php }?>
			</div>
		</div>
		<table class="table table-striped tabla" id="tabla-reportes">
			<thead>
				<th>Nota</th>
				<th>Nombre</th>
				<th>Precio</th>
				<th>Cantidad</th>
				<th>Fecha</th>	
				<th>Subtotal</th>
				<th>Op</th>
			</thead>
			<tbody>
				<?php
				if(isset($query)) foreach ($query->result() as $row)
				{
				?>
				<tr>
					<td><?=$row->id_venta?></td>
					<td><?=$row->nombre_producto?> - <?=$row->modelo?></td>
					<td><?=number_format($row->precio,2)?></td>
					<td><?=$row->cantidad_venta?></td>
					<td><?=$row->fecha_venta?></td>
					<td><?=number_format(($row->cantidad_venta*$row->precio),2)?></td>
					<td data-id="<?=$row->id_venta?>" data-prod="<?=$row->id_producto?>"><button type="button" class="btn btn-danger glyphicon glyphicon-trash btn-xs btnVenta"></button></td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	<div>
</div>
<div id="modalVenta" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" data-ruta="<?=base_url()?>venta/EliVenta">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" style="color:red">Desea eliminar la venta?</h4>
      </div>
      <div class="modal-body">
       		<p style="font-weight:bold">Al eliminar esta venta, se eliminara las comisiones asignadas por dicha venta al empleado correspondiente.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" id="btnEliVenta" class="btn btn-primary">Aceptar</button>
      </div>
    </div>
  </div>
</div>
<script src="<?=base_url()?>js/reportes.js"></script>
<script src="<?=base_url()?>js/dropventa.js"></script>