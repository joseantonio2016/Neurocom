
<?php 
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'partials/import_ew_previo.php'; 
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'partials/tb_viewitem.php'; 

 ?>


<div class="form">
    <h3> Importar desde Ebay</h3>

        <div class="form-row col-md-12 col-lg-10">
	<label for="id_imp" class="col-sm-8 col-md-2 control-label">AppID:</label>
   
      <input type="text" class="form-control col-sm-8 col-md-6" id="id_imp" name="id_imp" placeholder="Ingresa AppID valido" value="<?=$user_active;?>">
    
    </div>
    <div class="form-row col-md-12 col-lg-10">
        <label class="col-sm-8 col-md-2 control-label">Ambito del App</label>
    <div class="col-sm-10 col-md-8">
        <label class="radio-inline">
  <input type="radio" id="prod_imp" name="amb_imp" value="production" <?=$ambi[0];?> > Produccion
</label>
<label class="radio-inline">
  <input type="radio" id="sand_imp" name="amb_imp" value="sandbox" <?=$ambi[1];?> > Sandbox
</label>
    </div>
        
    </div>
 <br>

    <div class="form col-md-12 col-lg-10">
        <h4>Para importar un articulo de Ebay</h4>
        <div class="form-row">
            <label for="iditem" class="control-label col-sm-10 col-md-2">ID articulo:</label> 
            <input type="text" class="form-control col-sm-4 col-md-3" id="iditem" name="iditem" placeholder="Ingresa numero del articulo">
    <a role="button" href="#TB_inline?width=630&height=450&inlineId=my-content-id" id="search_iditem" class="btn btn-info col-sm-4 col-md-3 thickbox">Detalles de Articulo</a>
        </div>
    </div>

<br>

<div class="form col-md-12 col-lg-10">
    <h4>Para buscar listas de articulos</h4>
    <div class="form-row">
    <label for="kw_item" class="col-sm-8 col-md-2 control-label">
        <strong>Palabras clave:</strong></label>
    <div class="form-group col-sm-8 col-md-6">
        <input type="text" class="form-control" id="kw_item" name="kw_iditem" placeholder="Escribe palabras clave para buscar">
        <div class="form-row">
            <a role="button" id="search_kwitem" href="#TB_inline?width=630&height=450&inlineId=result-keywords" class="btn btn-primary col-6">Buscar Articulos</a>
            <a role="button" id="search_kwprod" class="btn btn-secondary col-6">Buscar Productos</a>
        </div>
    </div>
  </div>
</div>

    <div class="row-fluid">
		<h5>Examinar Categorias de Ebay</h5>
    	<div class="div-scrollbar columns" id="scroll_gc">
			<select size="15" id="fcat"><?=$browsecat;?></select>
			<span></span>	
		</div>
    </div>
<div class="form col-md-12 col-lg-10">
     <div class="form-row">
    <label for="id_cat" class="col-sm-8 col-md-2 control-label">Categoria Ebay:</label>
    <input type="text" class="form-control col-sm-8 col-md-3" id="id_cat" name="id_cat" placeholder="Ingresa Id de categoria">
    <a role="button" id="search_idcat " class="btn btn-info col-sm-8 col-md-3">Detalles de Categoria</a>
    </div>
    <div class="ionise"></div>
</div>

<br>
<h5>Refinar busqueda:</h5>
<div class="form-group">
   <p> Lo establecido en el submenu Filtros y Opciones</p>
<div class="form-inline">
     
  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
  <label class="form-check-label" for="defaultCheck1">

    Aplicar Filtros (Marcas y aspectos propios del producto)
  </label>
</div>
<div class="form-inline">
  <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" >
  <label class="form-check-label" for="defaultCheck2">
    Aplicar Opciones (Rango de precios, condicion de venta, etc)
  </label>
</div>
</div>

<a role="button" class="btn btn-info col-sm-4" id="previo_search"  >Ver Resultados</a>


<br>
<br>     
<h5>Para importar la lista resultante:</h5>

<p><strong>Elija en que categorias vinculara su lista</strong></p>
   <div class="row-fluid col-md-5">
        <p>Usar Categorias de la Tienda</p>
            <div class="dropdown_catstore" id="princ_categ_tienda">
            <select style="display:none" multiple placeholder="Selecciona categoria(s)"></select>
            </div>
            <input type="hidden" id="conteo_gc" value="-1" />
        </div>
     
    
<br>
<div class="form-inline">
    <button type="submit" class="btn btn-primary col-sm-2" id="imp_now" name="imp_now" >Ahora</button>
    <button type="submit" id="imp_prog " name ="imp_prog" class="btn btn-secondary col-sm-2">Programar</button>
        </div>
    
 
</div>
<script type="text/javascript">
$(document).ready(function(){
   $("#search_iditem").on("click", function(e){

                var iditem = $("#iditem").val();
                var appId = $("#id_imp").val();
                var datos = {
                appid : appId,
                iditem : iditem
            };
            $.post(ebay_ajax+'?action=search_item',datos, function(response, status){
                //if (status== 'success'){
                    //var res = JSON.parse(response);
 
                    var res = JSON.parse(response);
                   if(res.error!=undefined){
                      $("#title_it").html(res.error);
                      return;
                    }
                   if(status=='success'&&!res['error']){
                    $("#title_it").html(res.titulo1);
                    $("#price_it").html(res.pricenw+" USD");
                    $("#img_it").attr('src',res.picture);
                    $("#condition_it").html(res.conditi);
                    $("#location_it").html(res.locatio);
                    $("#typelist_it").html(res.listype);
                    $("#statuslist_it").html(res.statusl);
                    $("#categ_it").html(res.categnm);
                    $("#url_view_it").attr('href',res.viewurl);
                    $("#pathcat1").html(res.namecat);
                   }else{
                    e.preventDefault();
                    alert('No responde solicitud');
                   // alert("Error "+res.error);
                   }
                    
            });
                    
            });

  $('.dropdown_catstore').dropdown({
      data: <?=$cats_js; ?>,//json2.data,
      limitCount: 7,
      multipleMode: 'label',
      input: '<input type="text" maxLength="20" placeholder="Buscar categoria(s)...">'
    });

var arr = [];

    $("#set_filter").click(function(event) {
        //var tab_attribs = [];
//$('#princ_categ_tienda span').each(function () {
  //tab_attribs.push( $(this).attr("custom_attribute") );
//});
//var sel = querySelect
       // alert($("#princ_categ_tienda i").html());
     var arrsel = pct.getElementsByTagName('i');
     // arrsel.forEach(function(item){
     //    arr.push(item.attr('data-id'));
     // })
     arr = [];
     if(arrsel.length>0){
        for (const child of arrsel) {
            arr.push(child.getAttribute('data-id'));
        }
        alert(arr);
     }
     else alert("no hay nada");
     

    });

$('input:radio[name="choosecat"]').change(function(){
    var inputValue = $(this).attr("value");
    var targetBox = $("." + inputValue);
    $(".cates1").not(targetBox).hide();
    $(targetBox).show();
});

$("#importar_1").on("click", (e)=>{

                var iditem = $("#iditem").val();
                var appId = $("#id_imp").val();
                var datos = {
                appid : appId,
                iditem : iditem
            };
            $.post(ebay_ajax+'?action=get_ebay',datos, function(response, status){

                if(status=='success'){
                    if(res['success']){
                    alert("Lograste importar");
                    }else if(res['error']){
                        alert("Error "+res['error']);
                    }else{
                        alert('Error desconocido pero en success');
                    }
                   }else{
                    alert("Error desconocido no success");
                   }

            });

});
$('#fcat').change(function(){

            var catId = $('#fcat').val();
            var appId = $("#id_imp").val();
            var ambito = $("input[name='amb_imp']:checked").val();
            var datos = {
                appid : appId,
                catid : catId,
                ambito : ambito
            }
                $.post(ebay_ajax+'?action=get_categories',datos, function(response,status){
                 if(status=='success'){
                    var res = JSON.parse(response);
                    if(res.error!=undefined){
                      $('.ionise').html(res.error);
                      return;
                    }
                    if (!res.leaf){
                        $('.div-scrollbar > span').html('<select size="15" class="columns" data-pos="'+res.i+'" id="subcat_'+res.i+'">'+res.browse+
                            '</select><span class="subcat_'+res.i+'"></span>');
                        $("#id_cat").val(catId);
                        $('.ionise').html('');
                    }
                //$('.div-scrollbar > span').html(response);
                    }else alert('No responde solicitud');
                    
                });
            }); //select onchange

   $("#scroll_gc").on("change", ".columns", function(){
                //alert($(this).attr('data-pos'));
               var counter = $(this).attr('data-pos');//$("#counter_gc").val();
                var catId = $('#subcat_'+counter).val();
                var appId = $("#id_imp").val();
                var ambito = $("input[name='amb_imp']:checked").val();
                var datos = {
                appid : appId,
                catid : catId,
                ambito : ambito,
                counter : counter
            };
            $.post(ebay_ajax+'?action=get_categories',datos, function(response,status){
                if(status !='success'){
                  alert('No responde solicitud');
                  return;
                }
                var res = JSON.parse(response);
                if(res.error!=undefined){
                      $('.ionise').html(res.error);
                      return;
                  }
                  if (res.leaf){
                        $('span.subcat_'+counter).html('<img src="http://pics.ebaystatic.com/aw/pics/icon/iconSuccess_32x32.gif" alt="Leaf Category!">');
                         $(".ionise").html("<span><b>Categoria hoja seleccionada:</b> ID="+catId+"<ul><li>"+res.categorypath+"</li></ul></span>");
                    }else{  
                     
                        $('span.subcat_'+counter).html('<select size="15" class="columns" data-pos="'+res.i+'" id="subcat_'+res.i+'">'+res.browse+
                            '</select><span class="subcat_'+res.i+'"></span>');
                             $('.ionise').html('');
                    }
                    $("#id_cat").val(catId);
                
        });//fin post

            });
})
   


</script>
