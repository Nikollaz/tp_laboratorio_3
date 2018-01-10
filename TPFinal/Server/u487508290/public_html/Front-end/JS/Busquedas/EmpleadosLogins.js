$(document).ready(function() {
    
    function toHHMMSS(a) {
        var sec_num = parseInt(a, 10); // don't forget the second param
        var hours   = Math.floor(sec_num / 3600);
        var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
        var seconds = sec_num - (hours * 3600) - (minutes * 60);
        
        if (hours   < 10) {hours   = "0"+hours;}
        if (minutes < 10) {minutes = "0"+minutes;}
        if (seconds < 10) {seconds = "0"+seconds;}
        return hours+':'+minutes+':'+seconds;
    }
    
    function cargarTablaVehiculos(vehiculos){
        
        if ( $.fn.dataTable.isDataTable( '#tablaLogins' ) ) {
            var table = $('#tablaLogins').DataTable();
            table.destroy();
        }
        
        $("#loginsEmpleados").html("");

        /*
            Cargar de contenido por values
        */
        
        var counter = 0;

        $.each(vehiculos, function(key, logins) {
            
             $("#loginsEmpleados").append("<tr id='loginsEmpleadosRow"+counter.toString()+"'>");

            $.each(logins, function(key, value) {
                
                if(key==="empleado" || key ==="fecha"){
                    
                    $("#loginsEmpleadosRow"+counter.toString()).append("<td>" + value + "</td>");
                    
                }

            });
                        
            $("#loginsEmpleados").append("</tr>");
            
            counter++;

        });
        
        $("#tablaLogins").dataTable({
            "iDisplayLength": 10,
            "aLengthMenu": [[10, 25, 50, 100,  -1], [10, 25, 50, 100, "All"]]
        });

    }
    
    function cargarVehiculos(desde, hasta) {
        
    	var data = "filtro=logins" + "&" +
    	    "fechaInicio=" + desde + "&" +
     		"fechaFin=" + hasta;
        
        $.ajax({
            type: "POST",
            url: SERVER + "/empleados/busqueda",
            dataType: "text",
            data: data,
            crossDomain: true,
            headers: {
                'SessionToken' : localStorage.getItem("SessionToken")
            },
            beforeSend: function() {

                $("#carga").html(LOADING_GIF);

            },
            success: function(response) {

                response = JSON.parse(response);

                if(response.Estado === "Error"){
                    
                    $("#carga").html("");

                } else {

                    $("#carga").html("");
                    
                    cargarTablaVehiculos(response);

                }
            }
        });
    }

    cargarVehiculos("","");

    $("#btnFiltrar").click(function(){
            
        cargarVehiculos($("#fechaInicio").val(),$("#fechaFin").val());
        
    });
});