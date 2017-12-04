$(document).ready(function() {

     $("#home").click(function(event){

        event.preventDefault();

        $('#appBody').fadeOut('medium', function(){

            $("#appBody").load("./Front-end/HTML/mainAppBody.html",function(){

                $.getScript("./Front-end/JS/mainAppBody.js"); 
                $('#appBody').fadeIn('medium');

            });

        });

    });

	$("#entrada").click(function(event){

        event.preventDefault();

        $('#appBody').fadeOut('medium', function(){

            $("#appBody").load("./Front-end/HTML/entrada.html",function(){

                $.getScript("./Front-end/JS/entrada.js"); 
                $('#appBody').fadeIn('medium');

            });

        });

    });   

    $("#salida").click(function(event){

        event.preventDefault();

        $('#appBody').fadeOut('medium', function(){

            $("#appBody").load("./Front-end/HTML/salida.html",function(){

                $.getScript("./Front-end/JS/salida.js"); 
                $('#appBody').fadeIn('medium');

            });

        });

    });

    $("#grillas").click(function(event){

        event.preventDefault();

        $('#appBody').fadeOut('medium', function(){

            $("#appBody").load("./Front-end/HTML/grillas.html",function(){

                $.getScript("./Front-end/JS/grillas.js"); 
                $('#appBody').fadeIn('medium');

            });

        });

    });

    $("#LogOut").click(function(event){

        event.preventDefault();

        localStorage.removeItem("SessionToken");

        $('#appBody').fadeOut('medium', function(){

            $("#appHeader").html("");

            $("#appBody").load("./Front-end/HTML/login.html",function(){

                $.getScript("./Front-end/JS/login.js"); 
                $('#appBody').fadeIn('medium');

            });

        });

    });

});