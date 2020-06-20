<?php 
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'partials/import_ew_previo.php'; 
add_thickbox(); 
?>

<div class="row" id="my-content-id" style="display:none;">
    <div id="arriba" class="row">
  <div class="col-8">
    <h6 id="title_it"></h6>
    <div class="row">
      <div class="col-4">Precio </div>
      <div class="col-8" id="price_it"></div>
    </div>
    <div class="row">
      <div class="col-4">Condicion</div>
      <div class="col-8" id="condition_it"></div>
    </div>
    <div class="row">
      <div class="col-4">Ubicacion</div>
      <div class="col-8" id="location_it"></div>
    </div>
    <div class="row">
      <div class="col-4">Tipo de lista</div>
      <div class="col-8" id="typelist_it"></div>
    </div>
    <div class="row">
      <div class="col-4">Situacion </div>
      <div class="col-8" id="statuslist_it"></div>
    </div>
    <div class="row">
      <div class="col-4">Categoria</div>
      <div class="col-8" id="categ_it"></div>
    </div> 
  </div>
  <div class="col-4">
    <img id= "img_it" src="" height="180" alt='No hay imagen del articulo'>
  </div>
</div>

<hr>

 
    <div id="abajo" class="row">
      <div class="col-8">
        <div class="d-block"><h6 align="center">Para importar el producto a este sitio:</h6></div>
 <input type="radio" class="form-control" id="catstore1" name="choosecat" value="cat_store" checked >
<label for="catstore1">Elegir categoria de la tienda</label>
  <div class="dropdown_catstore cates1 cat_store" id="tick1_categ_tienda">
        <select style="display:none" multiple placeholder="Selecciona categoria(s)"></select>
      </div><br>
 <input type="radio" class="form-control" id="catebay1" name="choosecat" value="cat_eba" >
<label for="catebay1">Usar categorizacion de Ebay</label>
<div class="cates1 cat_eba" id="divebacat1"><small  id="pathcat1"></small></div>

<label for="rel_imp1"><small>Opcional. Relacione con sus propios productos con sus ID</small></label>
         <input type="text" class="form-control" id="rel_imp1" name="rel_imp1" value="" placeholder="Uno o mas IDs de productos separado por comas" >
      </div>
      <div class="col-4" >
        <a role="button" class="btn btn-info btn-block" id="url_view_it" target="_blank">Ver en Ebay</a> 
       <input type="button" class="btn btn-primary btn-block" id="importar_1" value="Importar">
<button class="btn btn-secondary btn-block" onclick="tb_remove();" id="btn_close_t1">Cerrar</button>
      </div>
      </div>

  </div>

<div class="row" id="result-keywords" style="display:none;">
   <p>Hola muchachos</p>

  </div>
