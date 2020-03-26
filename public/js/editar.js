$(document).ready(function () {
   
    // the file input
    var $el4 = $('#foto'), initPlugin = function() {
        $el4.fileinput({previewClass:''});
    };

    // initialize plugin
    initPlugin();    

    $("#modificarIMG").val('falso');

    $("#div_foto").hide();
    $("#imagenActual").show();

    $("#modificarIMG").click(function() { 
        if($("#modificarIMG").is(':checked')) {  
            $("#imagenActual").hide("slow");
            $("#div_foto").show("slow");
            
            $("#modificarIMG").val('verdadero');
        } else {      
            $el4.fileinput('clear');
            $("#modificarIMG").val('falso');
            $("#div_foto").hide("slow");
            $("#imagenActual").show("slow");
            
        }  
    });
        
});