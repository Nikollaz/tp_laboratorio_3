$(document).ready(function() {
    
    $("#ABM").click(function(event){

        event.preventDefault();

        $('#AdminsBody').fadeOut('medium', function(){

            $("#AdminsBody").load("./Front-end/HTML/ABM/ABM.html",function(){

                $.getScript("./Front-end/JS/ABM/ABM.js"); 
                $('#AdminsBody').fadeIn('medium');

            });

        });
  
    });

    $("#Busquedas").click(function(event){

        event.preventDefault();

        $('#AdminsBody').fadeOut('medium', function(){

            $("#AdminsBody").load("./Front-end/HTML/Busquedas/busquedas.html",function(){

                $.getScript("./Front-end/JS/Busquedas/busquedas.js"); 
                $('#AdminsBody').fadeIn('medium');

            });

        });
  
    });

});