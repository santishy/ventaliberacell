<?php if($this->session->userdata('tipo')!=2 && $ancla==0){?>
<div class="col-md-3">
	<strong style="background-color:red"><?=validation_errors()?></strong>
	<div class="panel panel-info sombras">
	  	<div class="panel-body">
		<p class="tit">Agregar Producto</p>    
		<hr>
		<form action="<?=base_url()?>producto/agregarProducto" method="post" rule="form">
			<div class="form-group">
				<label>Categoria</label>
				<select name="id_categoria" class="form-control">
					<?php foreach($query->result() as $row)
					{ ?>
						<option value="<?=$row->id_categoria?>" <?php if(set_value('id_categoria')==$row->id_categoria) echo 'selected';?>><?=$row->categoria?></option>
					<?php }?>
				</select>
			</div>
			<div class="form-group">
				<span id="helpBlock" class="help-block">Agregar otra categoria sino existe <a href="<?=base_url()?>categoria/agregarCategoria" class="btn btn-primary btn-xs active" role="button"><span class="glyphicon glyphicon glyphicon-plus-sign" aria-hidden="true"></span></a></span>
			</div>
			<div class="form-group">
				<label>Nombre</label>
				<input class="form-control" name="nombre_producto" plaheholder="Introduce el nombre">
			</div>
			<div class="form-group">
				<label>Modelo</label>
				<input class="form-control" name="modelo" plaheholder="Introduce la medida">
			</div>
			<div class="form-group">
				<label>Color</label>
				<input type="text" name="color" class="form-control">
			</div>
			<div class="form-group">
				<label>Marca</label>
				<select class="form-control" name="id_marca" id="id_marca">
					<?php foreach ($marcas->result() as $row) {?>
					<option value="<?=$row->id_marca?>"><?=$row->marca?></option>	
					<?php }?>
				</select>
				<div class="form-group">
					<span class="help-block">Agregar otra Marca sino existe <a id="btnMarca"  href="#" class="btn btn-primary btn-xs active" ><span class="glyphicon glyphicon glyphicon-plus-sign" aria-hidden="true"></span></a></span>
				</div>
			</div>
			<!--div class="form-group">
				<label>Precio de compra</label-->
				<input class="form-control" name="precio_compra" type="hidden" value="1" plaheholder="Introduce el nombre">
			<!--/div-->
			<div class="form-group">
				<button class="btn btn-info">Guardar</button>
			</div>
		</form>
	 	</div>
	</div>
	<strong style="background-color:red"><?=validation_errors()?></strong>
</div>
<?php }?>
<div class="<?php if(isset($ancho)) echo $ancho;?>">
	<div class="panel panel-primary sombras">
	  <!-- Default panel contents -->
	  <div class="panel-body">
	  	<div class="col-md-12">
		  	<p class="tit col-md-8">Productos</p>
		  	<div class="col-md-4" ><a href="<?=base_url()?>Producto/limpiar" style="color:white;font-weight:bold;float:right;background-color:#0080ff" class="btn btn-default btn-block">Limpiar</a></div>
		  	<hr>  
	  	</div>
	  	<div class="row">
	  		<div class="col-md-7">
	  				<nav class="navbar navbar-default navbar-precio">
					  <div class="container-fluid">
					    <!-- Brand and toggle get grouped for better mobile display -->
					    <div class="navbar-header">
					      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					        <span class="sr-only">Toggle navigation</span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					      </button>
					      <a class="navbar-brand" style="color:#0080ff;"href="#">Precios de venta</a>
					    </div>

					    <!-- Collect the nav links, forms, and other content for toggling -->
					    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					      <ul class="nav navbar-nav">
					        <li><a href="#" id="btnModalPrecio"><span class="glyphicon glyphicon-usd"> </span> Aplicar Precio<span class="sr-only">(current)</span></a></li>
					        <li><a href="#" id="allSelect"><span class="glyphicon glyphicon-ok"></span> Seleccionar Todo</a></li>
					      </ul>
					    </div><!-- /.navbar-collapse -->
					  </div><!-- /.container-fluid -->
				    </nav>
		  		<form action="<?=base_url()?>producto/buscar" method="post" >
		  			<!--div class="form-group">
		  				<label>Categoria</label>
			  			<select name="cate" class="form-control" id="cate-precio">
							<?php foreach($query->result() as $row)
							{ ?>
								<option value="<?=$row->categoria?>" <?php if(set_value('id_categoria')==$row->id_categoria) echo 'selected';?>><?=$row->categoria?></option>
							<?php }?>
						</select>
		  			</div-->
					<div class="input-group">
					  <span class="input-group-addon " id="basic-addon1 "><span class="glyphicon glyphicon-search"></span></span>
					  <input type="search" name="clave"class="form-control" placeholder="Nombre Modelo" aria-describedby="basic-addon1">
					</div>
				</form>
		  	</div> 
		  	<div class="col-md-5 pass-venta">
		  		<form action="<?=base_url()?>venta/terminarVenta" id="frmVenta" method="post">
		  		
					<div class="form-group">
						<label>Terminar Venta</label>
						<input type="password" name="pass" id="pass" class="form-control" placeholder="Contraseña" style="margin-right:5px">
						
					</div>
					<div class="form-group">
						<button type="button" id="btnVenta" class="btn btn-default btn-block" style="color:#669999;font-weight:bold;border:2px solid #00b3b3"><span class="glyphicon glyphicon-ok"></span> Listo</button>
					</div>
				</form>
		  	</div>
	  	</div>
	  	<div class="row">
		  	<div class="col-md-5">
		  		<p id="mns-cart"><?php $items=$this->cart->total_items();if(isset($items)) echo $this->cart->total_items();?> </p>
		  	</div>
		  	<div class="col-md-7" style="margin-top:10px;">
		  	</div>
	  	</div>
	  </div>
	  <!-- Table -->
	  <table class="table tabla table-striped table-hover" id="tabla-productos">
	  	<thead>
	  		<th>ID</th>
	  		<TH>NOMBRE</TH>
	  		<TH>MODELO</TH>
	  		<TH>MARCA</TH>
	  		<TH>CATEGORIA</TH>
	  		<th>COLOR</th>
	  		<TH>EXIST</TH>
	  		<th>$</th>
	  		<th>OPCIONES</th>
	  	</thead>
	  	<tbody>
	  		<form action="<?=base_url()?>producto/agregarPrecioVenta" id="frmChecks">
		  		<?php $cont=0;foreach($productos->result() as $row) 
		  		{?>
		  		<tr>
		  			<td><?=$row->id?></td>
		  			<td><?=$row->nombre_producto?></td>
		  			<td><?=$row->modelo?></td>
		  			<td><?=$row->marca?></td>
		  			<td><?=$row->categoria?></td>
		  			<td><?=$row->color?></td>
		  			<td class="exist"> 
		  				<!--label>Total</label>
						<p><?=$row->existencia?></p>
						<label>Color</label>
						<p--><?=$row->exist?><!--/p-->
					</td>
					<td>
						<input type="hidden" name="id_producto_<?=$cont?>" value="<?=$row->id_producto?>">
						<input type="checkbox" name="check_<?=$cont?>" class="check" value="1">
					</td>
					<td class="opciones"data-idc=<?=$row->id?> data-name="<?=$row->nombre_producto?>" data-color="<?=$row->id_color?>" data-id="<?=$row->id_producto?>" data-categoria="<?=$row->categoria?>" data-precio="<?=$row->precio?>">
						<div style='display:inline-block'>
		  					<button data-toggle="tooltip" data-placement="top" title="Vender" type="button" class="btn btn-primary  uno btn-xs"><span class="glyphicon glyphicon-flash"></span></button>
		  				</div> 
		  				<div style='display:inline-block'>
		  					<button data-toggle="tooltip" data-placement="top" title="Comprar" type="button" class="btn btn-default btnComprar btn-xs"><span class="glyphicon glyphicon-shopping-cart"></span> Comprar</button>
		  				</div>
		  				<div style='display:inline-block'>
		  					<button data-toggle="tooltip" data-placement="top" title="Tomar Foto" type="button" class="btn btn-default btnPic  btn-xs"><span class='glyphicon glyphicon-picture'></span></button>
		  				</div>
		  				<div style='display:inline-block'>
		  					<button data-toggle="tooltip" data-placement="top" title="Vender" type="button" class="btn btn-default  btnVender btn-xs"><span class="glyphicon glyphicon-shopping-cart"></span> Vender</button>
		  				</div>
		  				<div style='display:inline-block'>
		  					<?php if($this->session->userdata('tipo')!=2){?>
		  							<button data-toggle="tooltip" data-placement="top" title="Editar" type="button" class="btn btn-default  editar btn-xs"><span class="glyphicon glyphicon-pencil"></span> Editar</button>
		  							<?PHP }?>
		  				</div>
		  			</td>
		  		</tr>
	  		<?php $cont++; }?>
	  		<input type="hidden" name="cont" value="<?=$cont?>">
	  		</form>
	  	</tbody>
	  </table>
	</div>
	<div class="well"><?=$paginacion?></div>
</div>
<div class="bottom-cart">
	<div id="boton-carro" class="boton-carro">
		<span class="glyphicon glyphicon-arrow-down"></span>
	</div>
	<div  class="ver-carrito col-md-4 col-md-offset-8 col-lg-4 col-lg-offset-4">
		<p  class="p-linea"> <span id="item1-carrito">Terminar </span>
			<a id="link-movimiento"href="#" class="btn btn-primary btn-xs">
				<span class="glyphicon glyphicon-ok"></span>
			</a>
		</p>
		<p class="p-linea">Productos 
			<span id="numProductos" class="badge"><?=$items?></span>
		</p>
		<p>
			<a id="ver-carrito" href="#" class="link" data-base="<?=base_url()?>" data-ruta="<?=base_url()?>producto/activarLink">Ver Carrito
				<span class="glyphicon glyphicon-list-alt"></span>
			</a>
		</p>
	</div>
</div>
<!--modal para modificar los productos................................... -->
<div id="modalProducto" class="modal fade bs-example-modal-sm"  tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" data-ruta="<?=base_url()?>producto/getProducto">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar Producto</h4>
      </div>
      <div class="modal-body">
        	<form id="frmProducto" action="<?=base_url()?>producto/modiProducto" method="post" rule="form">
			<div class="form-group">
				<label>Categoria</label>
				<select name="id_categoria" id="id_categoriaE" class="form-control">
					<?php foreach($query->result() as $row)
					{ ?>
						<option value="<?=$row->id_categoria?>"><?=$row->categoria?></option>
					<?php }?>
				</select>
			</div>
			<div class="form-group">
				<label>Nombre</label>
				<input class="form-control" name="nombre_producto" id="nombre_productoE" plaheholder="Introduce el nombre" value="<?=set_value('nombre_producto')?>">
			</div>
			<div class="form-group">
				<label>Modelo</label>
				<input type="hidden" name="id_producto" id="id_productoE" value="<?=set_value('modelo')?>">
				<input class="form-control" name="modelo" id="modeloE" plaheholder="Introduce la medida">
			</div>
			<div class="form-group">
				<label>Color</label>
				<!--input type="hidden" name="idcol" id="idcol"-->
				<input type="text" name="color"  id="colorE" class="form-control">
				<input type="hidden" name="id_color" id="id_colorE">
			</div>
			<div class="form-group">
				<label>Marca</label>
				<select class="form-control" name="id_marca" id="id_marcaE">
					<?php foreach ($marcas->result() as $row) {?>
					<option value="<?=$row->id_marca?>"><?=$row->marca?></option>	
					<?php }?>
				</select>
			</div>
			<div class="form-group">
				<label>Descripcion</label>
				<textarea name="descripcion" id="descripcionE" class="form-control">value="<?=set_value('descripcion')?></textarea>
			</div>
		</form>
      </div>
      <div class="modal-footer">
      	<button type="button" id="btnDesactivarProducto"class="btn btn-danger"data-ruta="<?=base_url()?>producto/desactivarProducto">Desactivar</button>
        <button type="button" style="font-weight:bold;color:blue;"class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" style="font-weight:bold;color:blue;" id="btnEditarProducto" class="btn btn-default">Editar</button>
      </div>
    </div>
  </div>
</div>
<div id="modalMarca" class="modal fade bs-example-modal-sm"  tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" data-ruta="<?=base_url()?>Categoria/registrarMarca">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Nueva Marca</h4>
      </div>
      <div class="modal-body">
        <form id="frmMarca" action="<?=base_url()?>producto/addMarca" method="post" rule="form">
			<div class="form-group">
				<label>Marca</label>
				<input class="form-control" name="marca" id="" plaheholder="Introduce el nombre">
			</div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" style="font-weight:bold;color:blue;"class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" style="font-weight:bold;color:blue;" id="btnRegistrarMarca" class="btn btn-default">Agregar</button>
      </div>
    </div>
  </div>
</div>
<div id="modalFoto" class="modal fade bs-example-modal-sm"  tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" data-ruta="<?=base_url()?>Producto/guardarFoto">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tomar Foto</h4>
      </div>
      <div class="modal-body">
      	<video id="video" style="width:100%"></video>
       	<img src="" id="img" class="img-responsive" style="width:100%">
       	<canvas id="canvas"></canvas>
      </div>
      <div class="modal-footer">
        <button type="button" style="font-weight:bold;color:blue;"class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" style="font-weight:bold;color:blue;" id="btnFoto" class="btn btn-default">Tomar</button>
        <button type="button" style="font-weight:bold;color:green;" id="btnSavePic" class="btn btn-default">Guardar</button>
      </div>
    </div>
  </div>
</div>
<script>
	window.addEventListener('load',init);
	var imgData;
	function init()
	{
		
		$(".btnPic").on('click',function(){$("#modalFoto").modal('show');activarVideo()});
		$("#btnSavePic").on('click',guardarFoto);
	}
	function activarVideo()
	{
		var video=document.querySelector('#video'), canvas=document.querySelector('#canvas'),
		img=document.querySelector('#img'),btnFoto=document.querySelector('#btnFoto');
		navigator.getUserMedia = ( navigator.getUserMedia ||
                       navigator.webkitGetUserMedia ||
                       navigator.mozGetUserMedia ||
                       navigator.msGetUserMedia);
		if(navigator.getUserMedia)
		{
			navigator.getUserMedia({video:true},function(stream){
				video.src=window.URL.createObjectURL(stream);
				video.play();
			},function(e){console.log(e)})
		}else alert('Tiene un navegador obsoleto');
		video.addEventListener('loadedmetadata',function(){
			canvas.width=video.videoWidth;
			canvas.height=video.videoHeight;
		},false);
		btnFoto.addEventListener('click',function(){
			canvas.getContext('2d').drawImage(video,0,0);
			imgData=canvas.toDataURL('image/png');
			img.setAttribute('src',imgData);
		})
	}
	function guardarFoto()
	{
		var ruta=$("#modalFoto").data('ruta');
		$.ajax({
			url:ruta,
			beforeSend:function(){

			},
			type:'post',
			data:{dataImg:imgData},
			dataType:'text',
			success:function(resp)
			{
					
			},
			complete:function()
			{

			},
			error:function(error,xhr){
				alert(error+" "+xhr)
			}
		})
	}
</script>
