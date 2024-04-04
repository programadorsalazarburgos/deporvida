  function fnProcesaInfo(comp){

  var valor = comp.id;

       if(valor == 'opcion1'){
                $("#oculto").css("display", "block");
                $("#sectionprincipal").css("display", "none");
                
            }else{
                $("#oculto").css("display", "none");
                $("#sectionprincipal").css("display", "block");
                
            }


}

