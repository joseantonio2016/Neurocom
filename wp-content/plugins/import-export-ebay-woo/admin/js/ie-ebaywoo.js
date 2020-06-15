$(document).ready(function(){
	$("#saveKeys").on('click', function(e){
        //e.preventDefaults();
        var eappid = $("#eAppId").val();
        var edevid = $("#eDevId").val();
        var ecertid = $("#eCertId").val();
        var etoken = $("#eToken").val();
        var ambito = $("input[name='typeID']:checked").val();//register_eybadev_ajax
        console.log('hola '+ebay_ajax);
        //console.log('hola '+eappid+' ajax '+ebay_ajax);
        var datos = {
                appid : eappid,
                devid : edevid,
                certid : ecertid,
                token : etoken,
                ambito : ambito
            }
        $.post(ebay_ajax+"?action=register_ebaydev", datos, function(result){
            console.log('hola '+result);
            $("#resultSaveKeys").html(result);
        });
      });
})