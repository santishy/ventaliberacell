<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset='utf-8'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/style.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
   <link rel="stylesheet" href="<?=base_url()?>css/fonts/style.css" />
   <link rel="stylesheet"  href="<?=base_url()?>css/bootstrap.min.css">
   <link href='https://fonts.googleapis.com/css?family=Roboto+Mono' rel='stylesheet' type='text/css'>
	<title>ISCO</title>
</head>
<nav class="navbar navbar-inverse" style="">
  <div class="container-fluid" >
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a style="color:#FFA366" class="navbar-brand" href="#">ISCO</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav" >
        <LI><a href="<?=base_url()?>login/cerrarSesion" class="active" >Cerrar Sesion</a></LI>
        <li> <a href="<?=base_url()?>producto/eliminarBusquedaList" class="active">Crear Pedido</a></li>
        <li> <a href="<?=base_url()?>producto/anclarPanelProd" class="active" > <span class="glyphicon glyphicon-pushpin"></span> Panel Producto </a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Productos <span class="caret"></span></a>
          <ul class="dropdown-menu" style="color:white">
            <li><a href="<?=base_url()?>producto/eliminarBusqueda">Acciones</a></li>
            <!--<li><a href="#"></a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>-->
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reportes<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=base_url()?>venta/reporteVentas">Ventas</a></li>
            <li><a href="<?=base_url()?>venta/reporteComisiones">Comisiones</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuarios <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=base_url()?>user/agregarUser">Ver lista</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  
  </div>
</nav>
<body>
  <div class="container-fluid">
    <div class="row">
      