$(document).ready(function() {

    $('#homeBody').fadeOut('medium', function(){
    
        $("#homeBody").load("./Front-end/HTML/tablaEstacionados.html",function(){
        
            $.getScript("./Front-end/JS/tablaEstacionados.js"); 
            $('#homeBody').fadeIn('medium');
        
        });
    
    });

});