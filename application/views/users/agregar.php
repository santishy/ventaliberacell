<div class="container-fluid">
	<div class="row">
		<div class="col-md-4 col-md-offset-1">
			<div class="panel panel-default sombras">
				<div class="panel-body">
					<p class="tit">Usuario</p>
					<hr>
			    	<form method="post" action="<?=base_url()?>user/agregarUser">
			    		<div class="form-group">
			    			<label for="nombre">Nombre</label>
			    			<input type="text" name="nombre_user" value="<?=set_value('nombre_user')?>" class="form-control">
			    		</div>
			    		<div class="form-group">
			    			<label for="nombre">Correo</label>
			    			<input type="text" value="<?=set_value('correo')?>" name="correo" class="form-control">
			    		</div>
			    		<div class="form-group">
			    			<label for="direccion">Direccion</label>
			    			<input type="text" name="direccion" value="<?=set_value('direccion')?>" class="form-control">
			    		</div>
			    		<div class="form-group">
			    			<label>Usuario</label>
			    			<input type="text" name="usuario" value="<?=set_value('usuario')?>" class="form-control">
			    		</div>
			    		<div class="form-group">
			    			<label>Pass</label>
			    			<input type="password" pattern="(\w){8,16}" title="De 8 a 16 caracteres" name="pass" class="form-control">
			    		</div>
			    		<div class="form-group">
			    			<label>Tipo</label>
			    			<select name="tipo" class="form-control">
			    				<option value="1">Administrador</option>
			    				<option value="2">Vendedor</option>
			    				<option value="3">Capturista</option>
			    			</select>
			    		</div>
			    		<div class="form-group">
			    			<button class="btn btn-info">Guardar</button>
			    			<?php echo validation_errors(); ?>
			    			<?=$mensaje?>
			    		</div>
			    	</form>
			  	</div>
			</div>
		</div><!--col-md-5-->
		<div class="col-md-6">
			<div class="panel panel-default sombras">
				<div class="panel-body">
					<p class="tit">Lista de usuarios</p>
					<HR>
					<table class="table table-borderead tabla">
						<thead>
							<th>Nombre</th>
							<th>Usuario</th>
							<th>Correo</th>
							<th>Tipo</th>
							<th>Opciones</th>
						</thead>
						<tbody>
							<?php foreach ($query->result() as $row) 
							{?>
								<tr>
									<td><?=$row->nombre_user?></td>
									<td><?=$row->usuario?></td>
									<td><?=$row->correo?></td>
									<td><?php echo $this->funciones->stringTipo($row->tipo);?></td>
									<td>
										<form action="<?=base_url()?>user/eliminarUser" method="post">
											<input name="id_user" type="hidden" value="<?=$row->id_user?>">
											<button class='btn btn-danger btn-xs'><span class="glyphicon glyphicon-trash"></span></button>
										</form>
									</td>
								</tr>
							<?php }?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div><!--row-->
</div>