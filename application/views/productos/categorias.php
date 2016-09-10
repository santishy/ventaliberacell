<div class="col-md-4">
	<div class="panel panel-default sombras">
	  	<div class="panel-body">
		<p class="tit">Agregar Categorias</p>    
		<hr>
		<form action="<?=base_url()?>categoria/agregarCategoria" method="post" rule="form">
			<div class="form-group">
				<label>Categoria</label>
				<input class="form-control" name="categoria" plaheholder="Introduce el nombre">
			</div>
			<div class="form-group">
				<button class="btn btn-info">Guardar</button>
			</div>
		</form>
	 	</div>
	</div>
	<?=validation_errors()?>
</div>
<div class="col-md-4">
	<div class="panel panel-default sombras">
	  	<div class="panel-body">
			<p class="tit">Buscar Categoria</p>    
			
			<div class="col-md-12">
				<hr>
				<form action="<?=base_url()?>categoria/buscarCategoria" method="post">
					<div class="input-group">
					  <span class="input-group-addon " id="basic-addon1 "><span class="glyphicon glyphicon-search"></span></span>
					  <input type="search" name="clave"class="form-control" placeholder="Buscar" aria-describedby="basic-addon1">
					</div>
				</form>
				<?php if(isset($mensaje)){?>
				<hr>
				<div class="alert alert-info" role="alert">
					<?=$mensaje?>
				</div>
				<?php }?>
			</div>

			<?php if(isset($query)){foreach ($query->result() as $row)
			{?>

			<div class="col-md-12">
				<hr>
				<p class="tit">Modificar</p>
				<form action="<?=base_url()?>categoria/editarCategoria" method="post"> 
					<div class="form-group">
						<input type="text" name="clave" class="form-control" value="<?=$row->categoria?>">
						<input type="hidden" name="id_categoria" value="<?=$row->id_categoria?>">
					</div>
					<div class="form-group">
						<button class="btn btn-info">Editar</button>
					</div>
				</form>

			</div>
			<?php }}?>
	 	</div>
	</div>
</div>

