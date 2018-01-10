$(document).ready(function() {
    
    $("#alta").click(function(event){

        event.preventDefault();

        $('#ABMEmpleadossBody').fadeOut('medium', function(){

            $("#ABMEmpleadossBody").load("./Front-end/HTML/ABM/Empleados/alta.html",function(){

                $.getScript("./Front-end/JS/ABM/Empleados/alta.js"); 
                $('#ABMEmpleadossBody').fadeIn('medium');

            });

        });
  
    });

    $("#baja").click(function(event){

        event.preventDefault();

        $('#ABMEmpleadossBody').fadeOut('medium', function(){

            $("#ABMEmpleadossBody").load("./Front-end/HTML/ABM/Empleados/baja.html",function(){

                $.getScript("./Front-end/JS/ABM/Empleados/baja.js"); 
                $('#ABMEmpleadossBody').fadeIn('medium');

            });

        });
  
    });

    $("#modificacion").click(function(event){

        event.preventDefault();

        $('#ABMEmpleadossBody').fadeOut('medium', function(){

            $("#ABMEmpleadossBody").load("./Front-end/HTML/ABM/Empleados/modificacion.html",function(){

                $.getScript("./Front-end/JS/ABM/Empleados/modificacion.js"); 
                $('#ABMEmpleadossBody').fadeIn('medium');

            });

        });
  
    });
    
    $("#suspension").click(function(event){

        event.preventDefault();

        $('#ABMEmpleadossBody').fadeOut('medium', function(){

            $("#ABMEmpleadossBody").load("./Front-end/HTML/ABM/Empleados/suspension.html",function(){

                $.getScript("./Front-end/JS/ABM/Empleados/suspension.js"); 
                $('#ABMEmpleadossBody').fadeIn('medium');

            });

        });
  
    });

});