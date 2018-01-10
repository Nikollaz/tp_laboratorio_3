$(document).ready(function() {
    
    $("#Empleados").click(function(event){

        event.preventDefault();

        $('#ABMBody').fadeOut('medium', function(){

            $("#ABMBody").load("./Front-end/HTML/ABM/Empleados/ABMEmpleados.html",function(){

                $.getScript("./Front-end/JS/ABM/Empleados/ABMEmpleados.js"); 
                $('#ABMBody').fadeIn('medium');

            });

        });
  
    });

    $("#Vehiculos").click(function(event){

        event.preventDefault();

        $('#ABMBody').fadeOut('medium', function(){

            $("#ABMBody").load("./Front-end/HTML/ABM/Vehiculos/ABMVehiculos.html",function(){

                $.getScript("./Front-end/JS/ABM/Vehiculos/ABMVehiculos.js"); 
                $('#ABMBody').fadeIn('medium');

            });

        });
  
    });

});