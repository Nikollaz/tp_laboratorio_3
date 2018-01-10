<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

include_once $_SERVER['DOCUMENT_ROOT']."/API/composer/vendor/autoload.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/API/validationAPI.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/API/empleadoAPI.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/API/loginAPI.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/API/cocheraAPI.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/API/vehiculoAPI.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/API/MWparaCORS.php";

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

$app->group('/login', function () {
    
	/* [USADO] */ $this->post('[/]', \loginAPI::class . ':CargarUno'); //Nuevo login y trae un SessionToken
	//{email} y {password}

})->add(\MWparaCORS::class . ':HabilitarCORSTodos');

$app->group('/cocheras', function () {

    /* [USADO] */ $this->get('[/]', \cocheraAPI::class . ':TraerTodas')->add(\validationAPI::class . ':usuarioLogeadoValidationMiddleware');

	/* [USADO] */ $this->post('[/]', \cocheraAPI::class . ':busqueda')->add(\validationAPI::class . ':adminValidationMiddleware'); 
	//Trae mas usadas/menos usadas/sin usar, se pueden pasar filtros opcionales (fechaInicio/fechaFin) en formato(yyyy/mm/dd)

})->add(\MWparaCORS::class . ':HabilitarCORSTodos');

$app->group('/empleados', function () {
 
	/* [USADO] */ $this->get('[/]', \empleadoAPI::class . ':TraerTodos');

	/* [USADO] */ $this->get('/{id}', \empleadoAPI::class . ':traerUno');

	/* [USADO] */ $this->post('[/]', \empleadoAPI::class . ':CargarUno');

	/* [USADO] */ $this->delete('[/]', \empleadoAPI::class . ':BorrarUno');

	/* [USADO] */ $this->put('[/]', \empleadoAPI::class . ':ModificarUno');

	/* [USADO] */ $this->post('/busqueda[/]', \empleadoAPI::class . ':busqueda'); //Pasar el {filtro} (logins/operaciones)
	//Se pueden pasar filtros opcionales (fechaInicio/fechaFin) en formato(yyyy/mm/dd)

	/* [USADO] */ $this->post('/suspension[/]', \empleadoAPI::class . ':suspension'); //Pasar el {id} del empleado a suspender, y {motivo} (alta/cancelar)

})->add(\MWparaCORS::class . ':HabilitarCORSTodos')->add(\validationAPI::class . ':adminValidationMiddleware');

$app->group('/vehiculos', function () {
 
	/* [USADO] */ $this->get('[/]', \vehiculoAPI::class . ':TraerTodos')->add(\validationAPI::class . ':usuarioLogeadoValidationMiddleware');
	//Se pueden pasar filtros opcionales (fechaInicio/fechaFin) en formato(yyyy/mm/dd)

	/* [USADO] */ $this->get('/{id}', \vehiculoAPI::class . ':traerUno')->add(\validationAPI::class . ':usuarioLogeadoValidationMiddleware');

	/* [USADO] */ $this->post('[/]', \vehiculoAPI::class . ':CargarUno')->add(\validationAPI::class . ':adminValidationMiddleware');

	/* [USADO] */ $this->delete('[/]', \vehiculoAPI::class . ':BorrarUno')->add(\validationAPI::class . ':adminValidationMiddleware');

	/* [USADO] */ $this->post('/modificar[/]', \vehiculoAPI::class . ':ModificarUno')->add(\validationAPI::class . ':adminValidationMiddleware');

	/* [USADO] */ $this->post('/entrada[/]', \vehiculoAPI::class . ':entrada')->add(\validationAPI::class . ':usuarioLogeadoValidationMiddleware'); //5- Cuando ingresa el vehículo se le toma la patente, color y marca, cochera

	/* [USADO] */ $this->post('/salida[/]', \vehiculoAPI::class . ':salida')->add(\validationAPI::class . ':usuarioLogeadoValidationMiddleware'); //6-Cuando sale el vehículo se ingresa la patente y se muestran los datos del vehículo con el importe a pagar.
        //3-Cobro por hora$10 o media estadía $90(12hs) o estadia$170(24hs).

})->add(\MWparaCORS::class . ':HabilitarCORSTodos');

$app->run();