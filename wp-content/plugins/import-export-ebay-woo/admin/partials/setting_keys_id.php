<?php 
 
  $ie_ew_current_id = get_option( 'ie_ebay_woo_current_user');
  if(isset($ie_ew_current_id['user'])){
      echo "<br><span class='exito'>AppID activo: <b>".$ie_ew_current_id['user']."</b></span><br><br>";
  }
?> 
<h3> Registrar o actualizar Keys</h3>
<div class="form">
  <div id="arriba">
      <div class="row conf">
      <div class="col-2 nextlin">
        <label for="eAppId">Ingresa AppID </label>
      </div>
      <div class="col-10">
        <input type="text" class="form-control col-sm-4" id="eAppId" name="eAppId" placeholder="Ingresa AppID (obligatorio)">
      </div>
    </div>
    <div class="row conf">
      <div class="col-2 nextlin">
        <label for="eDevId">Ingresa DevID </label>
      </div>
      <div class="col-10">
         <input type="text" class="form-control col-sm-4" id="eDevId" name="eDevId" placeholder="Ingresa DevID aqui">
      </div>
    </div>
    <div class="row conf">
      <div class="col-2 nextlin">
        <label for="eCertId">Ingresa CertID </label>
      </div>
      <div class="col-10">
         <input type="text" class="form-control col-sm-4" id="eCertId" name="eCertId" placeholder="Ingresa CertID aqui">
      </div>
    </div>
    <div class="row conf">
      <div class="col-2 nextlin">
        <label for="eMail">Ingresa Email </label>
      </div>
      <div class="col-10">
         <input type="text" class="form-control col-sm-4" id="eMail" name="eMail"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Ingresa Email vinculado entre PayPal y Ebay" >
      </div>
    </div>
    <div class="row conf">
      <div class="col-2">
        <label >Ambito del AppID</label>
      </div>
      <div class="col-10 d-inline">
          <input type="radio" class="form-control" id="production" name="typeID" value="production" checked >
<label for="typeID">Produccion</label>
<input type="radio" class="form-control" id="sandbox" name="typeID" value="sandbox" >
<label for="typeID">Sandbox</label>
      </div>
    </div>
     <div class="row conf">
      <div class="col-2 nextlin">
        <label for="esiteId">Seleccione siteID </label>
      </div>
      <div class="col-10">
         <select placeholder="Select" id="site_id_s">
          <option value="0" selected>(0) United States</option>
          <option value="2">(2) Canada (English)</option>
          <option value="3">(3) United Kingdom</option>
          <option value="77" >(77) Germany</option>
          <option value="15">(15) Australia</option>
          <option value="16">(16) Austria</option>
          <option value="193" >(193) Switzerland</option>
          <option value="186">(186) Spain</option>
          <option value="71">(71) France</option>
          <option value="23">(23) Belgium (French)</option>
          <option value="210">(210) Canada (French)</option>
          <option value="201" >(201) Hong Kong</option>
          <option value="205">(205) Ireland</option>
          <option value="203">(203) India</option>
          <option value="101">(101) Italy</option>
          <option value="100">(100) Motors</option>
          <option value="207">(207) Malaysia</option>
          <option value="146">(146) Netherlands</option>
          <option value="123">(123) Belgium (Dutch)</option>
          <option value="211">(211) Philippines</option>
          <option value="212">(212) Singapore</option>
        </select>
      </div>
    </div>
    <div class="row conf">
      <div class="col-2">
        <label for="eToken">Ingresa Token </label>
      </div>
      </div>
       <div class="row">
      <div class="col-6">
        <textarea type="text" class="form-control" id="eToken" name="eToken" placeholder="Ingresa Token aqui" rows="4" cols="50" ></textarea>
      </div>
      </div>
    </div>

<div id="botones" class="conf">
 <button id="delKeys" type="submit" class="btn btn-warning col-sm-1">Eliminar</button>
 <button id="newKeys" type="submit" class="btn btn-info col-sm-1">Nuevo</button>
 <button id="updKeys" type="submit" class="btn btn-secondary col-sm-1">Actualizar</button>
  <button id="saveKeys" type="submit" class="btn btn-primary col-sm-1">Guardar</button>
</div>
<div id="result_setting">
  
</div>

  <script type="text/javascript">
    $(document).ready(function(){
  $("#saveKeys").on('click', function(e){
        //e.preventDefaults();
        var eappid = $("#eAppId").val();
        var edevid = $("#eDevId").val();
        var ecertid = $("#eCertId").val();
        var etoken = $("#eToken").val();
        var siteid = $('#site_id_s').val();
        var email = $('#eMail').val();
        
        var ambito = $("input[name='typeID']:checked").val();//register_eybadev_ajax
        var datos = {
                appid : eappid,
                devid : edevid,
                certid : ecertid,
                email : email,
                token : etoken,
                siteid : siteid,
                ambito : ambito
            }
            
        $.post(ebay_ajax+"?action=register_ebaydev", datos, function(result){
            $("#result_setting").html(result);
        });
      });
})
  </script> 
  
