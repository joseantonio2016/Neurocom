<?php

$browse = '';

$ambi = array('checked', '');
$ie_ew_current_id = get_option( 'ie_ebay_woo_current_user');
$user_active = "";
if(isset($ie_ew_current_id['user'])){
    $user_active = $ie_ew_current_id['user'];
    $amb = $ie_ew_current_id['amb'] or 1;
    $siteid = $ie_ew_current_id['siteid'] or 0;
    $endpoint_imp = "";
   
     if($amb==1){
     		$endpoint_imp="http://open.api.ebay.com/Shopping?";
     		$ambi=array('checked', '');
     	}else{
     		$endpoint_imp="http://open.api.sandbox.ebay.com/Shopping?";
     		$ambi=array('', 'checked');
     	}

     $url_imp .= $endpoint_imp."callname=GetCategoryInfo"
     			."&appid=$user_active"
     			."&siteid=$siteid"
     			."&CategoryID=-1"
     			."&version=863"
     			."&IncludeSelector=ChildCategories";
     	$xml = simplexml_load_file($url_imp);
     	if($xml->Ack == 'Success'){
     		foreach($xml->CategoryArray->Category as $cat){
			if($cat->CategoryLevel!=0):
			$browse.='<option value="'.$cat->CategoryID.'">'.$cat->CategoryName.'</option>';
			endif;
				}
     		}else echo "<p><b>eBay retorna errores</b></p>";
 }else{
    echo "<p class='bg-danger aviso col-4'><b>Registre primero un AppID Ebay activo en Setting</b><p><br>";
 } 


//OBTENER CATEGORIAS
     $cats_all = get_terms( array(
                'taxonomy' => 'product_cat',
                'hide_empty' => false,
                'orderby'=>'parent',
                'order'=>'DESC') );

function obj_cat($term_id,$term_name){
                    return (object)array('id'=>$term_id,'name'=>$term_name,'groupId'=>1,'groupName'=>'Categorias','disabled'=>false,'selected'=>false);
                }

 $arrcat=array();

 foreach($cats_all as $cat){
    $objCatChild =obj_cat($cat->term_id,$cat->name);
    array_push($arrcat, $objCatChild);
 }
 $cats_js = json_encode($arrcat);
     ?>