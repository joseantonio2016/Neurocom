

<?php 
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'partials/import_ew_previo.php'; 
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'partials/tb_viewitem.php'; 

 ?>

<h3> Importar desde Ebay</h3>
<div class="form">
        <div class="form-group">
	<label for="id_imp" class="col-sm-2 control-label">Ingresa AppID </label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="id_imp" name="id_imp" placeholder="Ingresa AppID valido" value="<?=$user_active;?>">
    </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Ambito del App</label>
    <div class="col-sm-10">
        <label class="radio-inline">
  <input type="radio" id="prod_imp" name="amb_imp" value="production" <?=$ambi[0];?> > Produccion
</label>
<label class="radio-inline">
  <input type="radio" id="sand_imp" name="amb_imp" value="sandbox" <?=$ambi[1];?> > Sandbox
</label>
    </div>
        
    </div>

    <div id="import-form" class="form">

    <h4>Buscar articulo</h4>
    <div class="form-sm-10">
        <label for="iditem" class="control-label">Ingresa ID del articulo Ebay </label>
        <div class="form-inline">
            <input type="text" class="form-control col-sm-2" id="iditem" name="iditem" placeholder="Id Item Ebay">
    <a role="button" href="#TB_inline?width=630&height=450&inlineId=my-content-id" id="search_iditem" class="btn btn-info col-sm-2 thickbox">Detalles de Articulo</a>
        </div>
    </div>

<h4>Buscar listas de articulos</h4>

  <div class="form-group">
    <label for="kw_item" class="col-sm-4 control-label">Articulos o productos por palabras claves</label>
    <input type="text" class="form-control col-sm-4" id="kw_item" name="kw_iditem" placeholder="Keywords">
    <button type="submit" id="search_kwitem" class="btn btn-primary col-sm-2">Buscar Articulos</button>
    <button type="submit" id="search_kwprod" class="btn btn-secondary col-sm-2">Buscar Productos</button>
  </div>
    <div class="row-fluid">
    	<div class="col-md-12">
		
		<h5>Examinando Categorias de Ebay</h5>
		</div>
    	<div class="div-scrollbar columns" id="scroll_gc">
			<select size="15" id="fcat"><?php echo $browse ?></select>
			<span></span>
			<div class="ionise"></div>
		</div>
    </div>
    <div class="form-inline">
    <input type="text" class="form-control col-sm-2" id="id_cat" name="id_cat" placeholder="Ingresar Id de categoria">
    <button type="submit" id="search_idcat " class="btn btn-info col-sm-2">Detalles de Categoria</button>
    </div>
<br>
<h5>Refinar busqueda con:</h5>
<div class="form-inline">
    <button type="text" class="btn btn-primary col-sm-2" id="set_filter" name="set_filter">Filtros</button>
    <button type="submit" id="set_opt " name ="set_opt" class="btn btn-secondary col-sm-2">Opciones</button>
</div>
<br>
<a role="button" class="btn btn-info col-sm-4" id="previo_search"  >Ver Resultados</a>
<br>
<br>        <div class="row-fluid col-md-5">
        <h5>Examinando Categorias de la Tienda</h5>
            <div class="dropdown-sin-2" id="princ_categ_tienda">
            <select style="display:none" multiple placeholder="Selecciona categoria(s)"></select>
            </div>
            <input type="hidden" id="conteo_gc" value="-1" />
        </div>
     
    
<h5>Importar:</h5>
<div class="form-inline">
    <button type="submit" class="btn btn-primary col-sm-2" id="imp_now" name="imp_now" >Ahora</button>
    <button type="submit" id="imp_prog " name ="imp_prog" class="btn btn-secondary col-sm-2">Programar</button>
        </div>
    
 </div>
</div>
<script type="text/javascript">
        $(document).ready(function(){
            //var cats_php = JSON.parse(<?=$cats_js;?>);
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
                    if (!res.leaf){
                        $('.div-scrollbar > span').html('<select size="15" class="columns" data-pos="'+res.i+'" id="subcat_'+res.i+'">'+res.browse+
                            '</select><span class="subcat_'+res.i+'"></span>');
                        $("#counter_gc").val("0");
                        $("#id_cat").val(catId);
                        $('.ionise').html('');
                    }
                //$('.div-scrollbar > span').html(response);
                    }else 
                    if(status=='error'){
                        alert('Error de solicitud');
                    }
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
                if(status =='success'){
                    var res = JSON.parse(response);
                    if (res.leaf){
                        $('span.subcat_'+counter).html('<img src="http://pics.ebaystatic.com/aw/pics/icon/iconSuccess_32x32.gif" alt="Leaf Category!">');
                         $(".ionise").html("<span><b>Categoria seleccionada:</b><ul><li>"+res.categorypath+"</li></ul></span>");
                    }else{  
                     
                        $('span.subcat_'+counter).html('<select size="15" class="columns" data-pos="'+res.i+'" id="subcat_'+res.i+'">'+res.browse+
                            '</select><span class="subcat_'+res.i+'"></span>');
                             $('.ionise').html('');
                    }
                    $("#id_cat").val(catId);
                
            }
        });//fin post

            });

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
                   // alert(res.titulo1[0]); 
                   //alert(res['error']);
                   if(status=='success'&&!res['error']){
                    $("#title_it").html(res.titulo1);
                    $("#price_it").html(res.pricenw+" USD");
                    $("#img_it").attr('src',res.picture);
                    $("#condition_it").html(res.conditi);
                    $("#location_it").html(res.locatio);
                    $("#typelist_it").html(res.listype);
                    $("#statuslist_it").html(res.statusl);
                    $("#categ_it").html(res.namecat);
                    $("#url_view_it").attr('href',res.viewurl);
                   }else{
                    e.preventDefault();
                    alert("Error "+res.error);
                   }
                    
            });
                    
            });

            $('.dropdown-sin-2').dropdown({
      data: <?=$cats_js; ?>,//json2.data,
      limitCount: 7,
      multipleMode: 'label',
      input: '<input type="text" maxLength="20" placeholder="Buscar categoria(s)...">'
    });
    
var pct = document.getElementById("princ_categ_tienda");
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

});

  //   $('#btn_close_t1').click(function(){
  //  $('#TB_window').fadeOut();
  // });

            //  $('#micat').change(function(){
            // var micat = $('#micat').val();
            //     $.get(ebay_ajax+'?action=get_micat&micat='+micat, function(response,status){
            //      if(status=='success'){
            //         var res = JSON.parse(response);
            //         if (!res.leaf){
            //             $('.div-scrollbar > span').html('<select size="5" class="columns" id="subcat_'+res.i+'">'+res.browse+
            //                 '</select><span class="subcat_'+res.i+'"></span>');
            //             $("#conteo_gc").val("0");
            //         }
            //         }else 
            //         if(status=='error'){
            //             alert('Error de solicitud');
            //         }
            //     });
            // }); //select onchange
            //[{"id":20,"name":"Ropa de hombre","groupId":21,"groupName":"Ropa","disabled":false,"selected":false},{"id":16,"name":"Ropa de mujer","groupId":21,"groupName":"Ropa","disabled":false,"selected":false},{"id":24,"name":"Primaria","groupId":23,"groupName":"Utiles escolares","disabled":false,"selected":false},{"id":25,"name":"Secundaria","groupId":23,"groupName":"Utiles escolares","disabled":false,"selected":false}]
//             <?xml version="1.0" encoding="UTF-8"?>
// <findItemsByCategoryRequest xmlns="http://www.ebay.com/marketplace/search/v1/services">
//   <categoryId>30059</categoryId>
//   <aspectFilter>
//     <aspectName>Brand</aspectName>
//     <aspectValueName>Canon</aspectValueName>
//   </aspectFilter>
//   <outputSelector>AspectHistogram</outputSelector>
//   <itemFilter>
//     <name>Condition</name>
//     <value>New</value>
//   </itemFilter>
// <itemFilter>
//     <name>ListingType</name>
//     <value>Auction</value>
//   </itemFilter>
//   <paginationInput>
//     <entriesPerPage>1</entriesPerPage>
//   </paginationInput>
// </findItemsByCategoryRequest>
// X-EBAY-SOA-SECURITY-APPNAME:JoseHuil-neurored-PRD-d2eae7200-83e626bd
// X-EBAY-SOA-OPERATION-NAME:findItemsByCategory

        </script>