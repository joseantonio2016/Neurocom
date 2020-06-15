<?php
$browse = '';
$endpoint_imp = "";
$ambi = array('', '');
$dir_gc = dirname(__FILE__);
$ie_ew_current_id = get_option( 'ie_ebay_woo_current_user');
if($ie_ew_current_id){
    global $wpdb;
    $tbl_usr = $wpdb->prefix.'ie_ebay_woo_usr';
    $query = "SELECT * FROM $tbl_usr WHERE appid='$ie_ew_current_id'";
     $u = $wpdb->get_var($query, 5);
     $siteID_imp = '0';
     if($u==1||$u==0) {
     	if($u==1){
     		$endpoint_imp="http://open.api.ebay.com/Shopping?";
     		$ambi=array('checked', '');
     	}else{
     		$endpoint_imp="http://open.api.sandbox.ebay.com/Shopping?";
     		$ambi=array('', 'checked');
     	}
     	$url_imp .= $endpoint_imp."callname=GetCategoryInfo"
     			."&appid=$ie_ew_current_id"
     			."&siteid=$siteID_imp"
     			."&CategoryID=-1"
     			."&version=677"
     			."&IncludeSelector=ChildCategories";
     	$xml = simplexml_load_file($url_imp);
     	if($xml->Ack == 'Success'){
     		foreach($xml->CategoryArray->Category as $cat){
			if($cat->CategoryLevel!=0):
			$browse.='<option value="'.$cat->CategoryID.'">'.$cat->CategoryName.'</option>';
			endif;
				}
     		}else echo "<p><b>eBay retorna errores</b></p>";
        }else echo "<p>AppID no registrado</p>";
     }else $ie_ew_current_id='';

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