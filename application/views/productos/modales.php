<div id="modal_compras" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" data-ruta="<?=base_url()?>producto/sessionCart">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Compras</h4>
      </div>
      <div class="modal-body">
        <form name="frm_compras" id="frm_compras">
          <div class="form-group">
            <label>Fecha</label>
            <input type="text" class="form-control" name="fecha_compra" id="fecha_compra" value="<?=$fecha_compra?>">
          </div>
          <div class="form-group">
            <label for="cant_compra">Cantidad</label>
              <input type="text" name="cant_compra" id="cant_compra"class="form-control">
              <input type="hidden" name="id_producto" id="id_producto">
              <input type="hidden" name="id_color" id="id_color">
              <input type="hidden" name="idclr" id="idclr">
              <input type="hidden" name="categoria" id="categoria">
              <input type="hidden" name="nombre_producto" id="nombre_producto">
              <input type="hidden" name="op" value="c">
          </div>
          <div class="form-group">
            <label>Precio de compra</label>
            <input name="precio_compra" id="precio_compra" class="form-control">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btnInsertarCarrito" class="btn btn-primary">Comprar</button>
      </div>
    </div>
  </div>
</div>


<!--modal de precios de precios................................ -->

<div id="modal_precios" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" data-ruta="<?=base_url()?>producto/agregarPrecio">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Precios de Venta</h4>
      </div>
      <div class="modal-body">
        <form name="frm_precios" id="frm_precios">
          <div class="form-group">
            <label for="cant_compra">Tipo</label>
              <input type="text" name="tipo" id="tipo" class="form-control">
              <input type="hidden" name="id_producto" id="id_productoV">
              <input type="hidden" name="op" id="tipoInsection">
              <input type="hidden" name="cate" id="cate">
          </div>
          <div class="form-group">
            <label>Precio de Venta</label>
            <input name="precio" id="precio" class="form-control">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btnInsertarPrecio" class="btn btn-primary">Agregar</button>
      </div>
    </div>
  </div>
</div>
<!-- modal de ventas................................................. -->
<div id="modal_ventas" class="modal fade bs-example-modal-sm"data-rutav="<?=base_url()?>producto/sessionCart" data-rutap="<?=base_url()?>producto/getPrecios" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" data-ruta="<?=base_url()?>producto/agregarPrecio">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Precios de Venta</h4>
      </div>
      <div class="modal-body">
        <form name="frm_ventas" id="frm_ventas">
          <div class="form-group">
            <label for="cant_compra">Fecha de venta</label>
              <input type="text" class="form-control" name="fecha_venta" id="fecha_venta" value="<?=$fecha_compra?>">
              <input type="hidden" name='id_productoV' id="id_productoVT">
              <input type='hidden' name="name" id='nombre_productoV'>
              <input type="hidden" name="id_color" id="id_colorV">
              <input type="hidden" name="categoria" id="categoriaV">
              <input type="hidden" name="op" value="v">
          </div>
          <div class="form-group">
            <label>Precio de Venta</label>
            <select name="id_precio" id="precio_venta" class='form-control'>
            </select>
          </div>
          <!--div class="form-group">
            <label>Credito</label>
            <select name="credito" id="credito" class='form-control'>
              <option value='si'>SI</option>
              <option value='no'>NO</option>
            </select>
          </div-->
          <div class="form-group">
            <label>Cantidad</label>
            <input type='text' name='cant_venta' id="cant_venta" class='form-control'>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btnInsertarVenta" class="btn btn-primary" data-ruta="<?=base_url()?>venta/crearNota">Vender</button>
      </div>
    </div>
  </div>
</div>
<!-- confirmacion- - .......................................................-->
<div id="modal_credito" class="modal fade bs-example-modal-sm"data-rutav="<?=base_url()?>producto/sessionCart" data-rutap="<?=base_url()?>producto/getPrecios" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" data-ruta="<?=base_url()?>producto/agregarPrecio">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">TIPO DE VENTA</h4>
      </div>
      <div class="modal-body">
       <h3>Credito?</h3>
      </div>
      <div class="modal-footer">
        <form action="<?=base_url()?>producto/terminarVenta" method="post">
          <input type="hidden" name="credito" value="SI">
          <button class="btn btn-info" data-dismiss="modal">Si</button>
        </form>
        <form action="<?=base_url()?>producto/terminarVenta" method="post">
          <input type="hidden" name="credito" value="NO">
          <button type="button" id="btnInsertarVenta" class="btn btn-primary">No</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?=base_url()?>js/compras.js">
</script>
<script type="text/javascript" src="<?=base_url()?>js/ventas.js"></script>

