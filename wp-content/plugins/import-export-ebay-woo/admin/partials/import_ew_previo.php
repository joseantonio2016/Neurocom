<?php
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'partials/ie_ebaywoo_current_user_check.php';

$browsecat = '';
$ambi = array('checked', '');
if(empty($user_active))
        echo "<p class='bg-danger aviso col-4'><b>Ingrese primero un AppID de Ebay</b><p><br>";
 
 $ambi = array('checked', '');
 if($ie_ew_current_id['amb']===0)$ambi = array('', 'checked');

if (false === ($browsecat = get_transient ('browsecat')))
     $browsecat = get_cats_parents_ebay($user_active, $ie_ew_current_id);

 function get_cats_parents_ebay($user_active,$ie_ew_current_id){
    if(empty($user_active))return "";
    $amb = $ie_ew_current_id['amb'];
    $siteid = $ie_ew_current_id['siteid'];
    $endpoint_imp="http://open.api.ebay.com/Shopping?";
     if($amb===0)
    $endpoint_imp="http://open.api.sandbox.ebay.com/Shopping?";
        
    $url_imp  = $endpoint_imp."callname=GetCategoryInfo"
                ."&appid=$user_active"
                ."&siteid=$siteid"
                ."&CategoryID=-1"
                ."&version=863"
                ."&IncludeSelector=ChildCategories";
        $xml = simplexml_load_file($url_imp);
        if($xml->Ack != 'Success'){
            delete_transient('browsecat');
            return "";
        }
            $ret='';
            foreach($xml->CategoryArray->Category as $cat){
            if($cat->CategoryLevel!=0):
            $ret.='<option value="'.$cat->CategoryID.'">'.$cat->CategoryName.'</option>';
            endif;
                }
                //echo "esto no debe cargarse en cada carga de esta pagina";
            set_transient ('browsecat', $ret, 6*HOUR_IN_SECONDS);
            return $ret;
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
    array_push($arrcat, obj_cat($cat->term_id,$cat->name));
 }
 $cats_js = json_encode($arrcat);
     ?>