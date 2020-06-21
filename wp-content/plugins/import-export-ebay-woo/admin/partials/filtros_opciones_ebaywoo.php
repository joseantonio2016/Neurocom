<?php 

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'partials/ie_ebaywoo_current_user_check.php';

  $user = $ie_ew_current_id['user'];
  if (false === ($ie_brands_filter_current = get_transient('ie_brands_filter_current'))) 
  	$ie_brands_filter_current = 0;
  if (false === ($ie_kw_cat_current = get_transient('ie_kw_cat_current'))) 
  	$ie_kw_cat_current = array('keywords'=>'','category'=>'');
  if(empty($user_active)){
    echo "<p class='bg-danger aviso col-4'><b>Debe tener un AppID de Ebay activo
       . Regrese al submenu anterio o registrese en Cuentasr</b><p><br>";
       die();
     }else
      echo "<br><span class='exito'>AppID activo: <b>".$user_active."</b></span><br><br>";
    
?> 
 

 <div class="form col-md-12 col-lg-10">
	<h3>Filtros y Opciones</h3>
	<br>
    <div class="form-row ">
    <label for="kw_itemf" class="col-sm-8 col-md-2 control-label">
        <strong>Palabras clave:</strong></label>
        <input type="text" class="form-control col-sm-8 col-md-4" id="kw_itemf" 
        placeholder="Ingresa palabras clave" value="<?=$ie_kw_cat_current['keywords'];?>" >
 
  </div>
  <br>
  <div class="form-row ">
    <label for="id_catf" class="col-sm-8 col-md-2 control-label"><strong>Categoria Ebay:</strong></label>
    <input type="text" class="form-control col-sm-8 col-md-4" id="id_catf" 
    placeholder="Ingresa Id de categoria" value="<?=$ie_kw_cat_current['category'];?>"  >
    </div>
    <br>
    <div class="form-row">
    	
    <button type="submit" id="imp_filters2" class="btn btn-primary col-sm-8 col-md-6 col-lg-4">Descargar filtros</button>
</div>
</div>

<hr>

<h3>FILTROS</h3>

<div class="row">
	<div class="nav flex-column nav-pills col-sm-2 col-md-2 col-lg-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
  <a class="nav-link active text-center" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Filtros</a>
  <a class="nav-link text-center" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Estado</a>
  <a class="nav-link text-center" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Precio</a>
  <a class="nav-link text-center" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Formato de Compra</a>
  <a class="nav-link text-center" id="v-pills-ubiitem-tab" data-toggle="pill" href="#v-pills-ubiitem" role="tab" aria-controls="v-pills-ubiitem" aria-selected="false">Ubicacion del articulo</a>
  <a class="nav-link text-center" id="v-pills-shipping-tab" data-toggle="pill" href="#v-pills-shipping" role="tab" aria-controls="v-pills-shipping" aria-selected="false">Opciones de entrega</a>
  <a class="nav-link text-center" id="v-pills-showonly-tab" data-toggle="pill" href="#v-pills-showonly" role="tab" aria-controls="v-pills-showonly" aria-selected="false">Mostrar solo</a>
  <a class="nav-link text-center" id="v-pills-seller-tab" data-toggle="pill" href="#v-pills-seller" role="tab" aria-controls="v-pills-seller" aria-selected="false">Vendedor</a>
</div>
<div class="tab-content col-sm-9 col-md-8 col-lg-7 bg-info" id="v-pills-tabContent">
  <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
  	<div id="content_drop_brand" class="row col-sm-12 col-md-11 col-lg-11">
  		<label class="col-sm-2 col-lg-3">Marca</label>
  		<div id="content_select" class="col-sm-10 col-lg-9">
  			<div class="dropdown_brands_filter" id="brands_filter">
        <select style="display:none" multiple placeholder="Filtra marca(s)"></select>
   </div>
  		</div>
  	</div>
  </div>
  <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">b</div>
  <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">c</div>
  <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">d</div>
  <div class="tab-pane fade" id="v-pills-ubiitem" role="tabpanel" aria-labelledby="v-pills-ubiitem-tab">e</div>
  <div class="tab-pane fade" id="v-pills-shipping" role="tabpanel" aria-labelledby="v-pills-shipping-tab">f</div>
  <div class="tab-pane fade" id="v-pills-showonly" role="tabpanel" aria-labelledby="v-pills-showonly-tab">g</div>
  <div class="tab-pane fade" id="v-pills-seller" role="tabpanel" aria-labelledby="v-pills-seller-tab">h</div>

</div>
</div>

<small id="userf" style="visibility: hidden;"><?=$user_active;?></small>
<pre id="response"></pre>
<script type="text/javascript">
		
	$('#brands_filter').dropdown({
      data: <?=$ie_brands_filter_current;?>,
      limitCount: 7,
      multipleMode: 'label',
      input: '<input type="text" maxLength="20" placeholder="Filtrar marca(s)...">'
    });


$("#imp_filters2").on("click",function(event) {
 
		 var kw = $("#kw_itemf").val();
		 var ct = $("#id_catf").val();
		var user = $("#userf").text();
		var datos = {
			keyf : kw,
			catf : ct,
			user : user
		}
		$.post(ebay_ajax+'?action=down_filter2',datos, function(response, status){
                  if(status !='success'){
                  alert('No responde solicitud');
                  return;
                }
                var res = JSON.parse(response);
                if(res.error!=undefined){
                      $("#response").html(res.error);
                      return;
                  }
                   	$("#response").html(res['success']);
                   	alert("Descargaras filtros");
                 	 window.location.reload();      
            });
	});




	
</script>
