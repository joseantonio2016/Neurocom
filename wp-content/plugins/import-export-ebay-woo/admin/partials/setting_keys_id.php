<?php 
  $user = array('','','','');
  $ambi = array('checked', '');
  $ie_ew_current_id = get_option( 'ie_ebay_woo_current_user');
  if($ie_ew_current_id){
    global $wpdb;
    $tbl_usr = $wpdb->prefix.'ie_ebay_woo_usr';
    $query = "SELECT * FROM $tbl_usr WHERE appid='$ie_ew_current_id'";
     $u = $wpdb->get_row($query, ARRAY_N);
     if($u){
      $user = array($u[1],$u[2],$u[3],$u[4]);
    if ($u[5]==0){ $ambi = array('', 'checked');}
        echo "<p>AppID registrado</p>";
     }
     else {
      echo "<p>AppID no comprobado ni registrado</p>";
     }
  }
?> 
<h3> Estableciendo Claves</h3>
<div class="form">
  <div class="form-group">
    <label for="eAppId">Ingresa AppID </label>
    <input type="text" class="form-control col-sm-4" id="eAppId" name="eAppId" placeholder="Ingresa AppID (obligatorio)" value="<?=$user[0];?>">
    <label for="eDevId">Ingresa DevID </label>
    <input type="text" class="form-control col-sm-4" id="eDevId" name="eDevId" placeholder="Ingresa DevID aqui" value="<?=$user[1];?>" >
    <label for="eCertId">Ingresa CertID </label>
    <input type="text" class="form-control col-sm-4" id="eCertId" name="eCertId" placeholder="Ingresa CertID aqui" value="<?=$user[2]; ?>" >
    <label for="eToken">Ingresa Token </label>
    <textarea type="text" class="form-control col-sm-4" id="eToken" name="eToken" placeholder="Ingresa Token aqui" rows="4" cols="30" ><?=$user[3]; ?></textarea>
       <h4>Ambito de aplicacion</h4>
    <input type="radio" class="form-control" id="production" name="typeID" value="production" <?=$ambi[0];?> >
<label for="typeID">Produccion</label><br>
<input type="radio" class="form-control" id="sandbox" name="typeID" value="sandbox" <?=$ambi[1];?> >
<label for="typeID">Sandbox</label><br>  

 <button id="delKeys" type="submit" class="btn btn-warning col-sm-1">Eliminar</button>
 <button id="newKeys" type="submit" class="btn btn-info col-sm-1">Nuevo</button>
 <button id="updKeys" type="submit" class="btn btn-secondary col-sm-1">Actualizar</button>
  <button id="saveKeys" type="submit" class="btn btn-primary col-sm-1">Guardar</button>
</div>
  </div>
  
