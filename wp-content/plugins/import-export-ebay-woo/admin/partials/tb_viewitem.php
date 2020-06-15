<?php 
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'partials/import_ew_previo.php'; 
add_thickbox(); 
?>

<div class="row" id="my-content-id" style="display:none;">
  <div id="arriba">
    <div class="row">
  <div class="col-8">
    <h6 id="title_it"></h6>
    <div class="row">
      <div class="col-4">Precio </div>
      <div class="col-8" id="price_it"></div>
    </div>
    <div class="row">
      <div class="col-4">Condicion</div>
      <div class="col-8" id="condition_it">.col-8</div>
    </div>
    <div class="row">
      <div class="col-4">Ubicacion</div>
      <div class="col-8" id="location_it">.col-8</div>
    </div>
    <div class="row">
      <div class="col-4">Tipo de lista</div>
      <div class="col-8" id="typelist_it">.col-8</div>
    </div>
    <div class="row">
      <div class="col-4">Estado </div>
      <div class="col-8" id="statuslist_it">.col-8</div>
    </div>
    <div class="row">
      <div class="col-4">Categoria</div>
      <div class="col-8" id="categ_it">.col-8</div>
    </div>
    
  </div>
  <div class="col-4">
    <img id= "img_it" src="" height="200" alt='No hay imagen del articulo'>
    <div id="btn_it">
      <a role="button" class="btn btn-info btn-block" target="_blank">Mas detalles</a>
       
         
    </div>
 
  </div>
</div>
  </div>

  <div id="abajo">
    <div class="row">
      <div class="col-3">
        <p>Para importar:</p>
        <input type="button" class="btn btn-primary btn-block"  value="Importar">
<button class="btn btn-secondary btn-block" onclick="tb_remove();" id="btn_close_t1">Cerrar</button>
          
      </div>
      <div class="col-8" >
        <input type="radio" class="form-control" id="catebay1" name="choosecat" value="cat_eba" >
<label for="catebay1">Usar categorizacion de Ebay</label><br>
<input type="radio" class="form-control" id="catstore1" name="choosecat" value="cat_store" checked >
<label for="choosecat">Elegir categoria de la tienda</label>
<div class="dropdown-sin-2" id="tick1_categ_tienda">
        <select style="display:none" multiple placeholder="Selecciona categoria(s)"></select>
      </div>
      </div>
      <div class="col-3">
      Para relacionar:
      </div>
      <div class="col-8" >
        <p> Digite IDs de productos que quiera relacionar con el importado de Ebay, para mas de un ID separe por comas o espacios</p>
        <input type="text" class="form-control" id="rel_imp1" name="rel_imp1" value="" placeholder="Digite IDs de los productos a promocionar" >
      </div>
      </div>
    </div>
  </div>

