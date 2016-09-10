<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1" />
	<title>Inicio de sesión</title>
	<link rel="stylesheet" href="<?=base_url()?>css/normalize.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>css/style-login.css">
	<link rel="stylesheet" href="<?=base_url()?>css/fonts/style.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container-fluid" style="width:100%;height:100%">
		<div class="row" style="width:100%;height:100%">
			<div id="login-container" class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<p class="titulo">Login</p>
				 	<div class="panel-body">
				    	<form action="<?=base_url()?>login/checkLogin" method="post">
				    		<div class="input-group" style="margin-bottom:5px">
							 	<span class="input-group-addon icon-user login-icon" id="basic-addon1"></span>
							  	<input type="text" name="usuario" class="form-control login-input" placeholder="Usuario" aria-describedby="basic-addon1" required>
							</div>
							<div class="input-group"  style="margin-bottom:10px">
							 	<span class="input-group-addon icon-key login-icon" id="basic-addon1"></span>
							  	<input type="password" name="pass" class="form-control login-input" placeholder="Password" aria-describedby="basic-addon1" required>
							</div>
							<div class="form-group" style="margin-bottom:10px;">
								<button class="btn btn-block btn-login"><span class="glyphicon glyphicon-log-in"> Ingresar</span></button>
							</div>
				    	</form>
				    	<div class="alerta"><?=$msj?></div>
				  	</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>