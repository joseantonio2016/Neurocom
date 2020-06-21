<?php 
$ie_ew_current_id = array();
if (false === ($ie_ew_current_id = get_transient ('ie_ew_current_id'))) {
    // No estaba allí, así que regenere los datos y guarde el transitorio
    $ie_ew_current_id = get_option( 'ie_ebay_woo_current_user',
                        array('user'=>'','amb'=>1,'siteid'=>0));
     set_transient ('ie_ew_current_id', $ie_ew_current_id, 12*HOUR_IN_SECONDS);
}
$user_active = $ie_ew_current_id['user'];
?>