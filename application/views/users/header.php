<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1" />
	<title>ADMINISTRADOR DEL SITIO</title>
	<link rel="stylesheet" href="<?=base_url()?>css/normalize.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>css/style.css" />
	<link rel="stylesheet" href="<?=base_url()?>css/style-sm.css" />
	<link rel="stylesheet" href="<?=base_url()?>css/menu.css" />
	<link rel="stylesheet" href="<?=base_url()?>css/jquery-ui.min.css" />
	<link rel="stylesheet" href="<?=base_url()?>css/jquery-ui.structure.min.css" />
	<link rel="stylesheet" href="<?=base_url()?>css/fonts/style.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script  src="<?=base_url()?>js/jquery-ui.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="<?=base_url()?>">ISCO COMPUTADORAS</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Utilidad<span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="<?=base_url()?>configuracion/obtenerListaUtilidad">Ver Lista</a></li>
	             <li><a href="<?=base_url()?>configuracion/editarRangos">Editar Rangos</a></li>
	          </ul>
	        </li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Clientes<span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="<?=base_url()?>configuracion/verenvios">Ver Lista</a></li>
	          </ul>
	        </li>
	      </ul>
	      <form class="navbar-form navbar-left" role="search">
	        <div class="form-group">
	          <input type="text" class="form-control" placeholder="Search">
	        </div>
	        <button type="submit" class="btn btn-default">Submit</button>
	      </form>
	      <ul class="nav navbar-nav navbar-right">
	        
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuarios<span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="<?=base_url()?>user/agregarUser">Acciones</a></li>
	          </ul>
	        </li>
	        <li class="active"><a href="<?=base_url()?>login/cerrarSesion">Cerrar </a></li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
