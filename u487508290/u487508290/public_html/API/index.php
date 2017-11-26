<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

include_once $_SERVER['DOCUMENT_ROOT']."/API/composer/vendor/autoload.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/API/validationAPI.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/API/empleadoAPI.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/API/loginAPI.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/API/cocheraAPI.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/API/vehiculoAPI.php";

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

$app->group('/login', function () {
 
	$this->post('[/]', \loginAPI::class . ':CargarUno'); //Nuevo login y trae un SessionToken
	//{email} y {password}

});

$app->group('/cocheras', function () {

	$this->post('[/]', \cocheraAPI::class . ':busqueda'); 
	//Trae mas usadas/menos usadas/sin usar, se pueden pasar filtros opcionales (fechaInicio/fechaFin) en formato(yyyy/mm/dd)

})->add(\validationAPI::class . ':adminValidationMiddleware');

$app->group('/empleados', function () {
 
	$this->get('[/]', \empleadoAPI::class . ':TraerTodos');

	$this->get('/{id}', \empleadoAPI::class . ':traerUno');

	$this->post('[/]', \empleadoAPI::class . ':CargarUno');

	$this->delete('[/]', \empleadoAPI::class . ':BorrarUno');

	$this->put('[/]', \empleadoAPI::class . ':ModificarUno');

	$this->post('/busqueda[/]', \empleadoAPI::class . ':busqueda'); //Pasar el {filtro} (logins/operaciones)
	//Se pueden pasar filtros opcionales (fechaInicio/fechaFin) en formato(yyyy/mm/dd)

	$this->post('/suspension[/]', \empleadoAPI::class . ':suspension'); //Pasar el {id} del empleado a suspender, y {motivo} (alta/cancelar)

})->add(\validationAPI::class . ':adminValidationMiddleware');

$app->group('/vehiculos', function () {
 
	$this->get('[/]', \vehiculoAPI::class . ':TraerTodos')->add(\validationAPI::class . ':adminValidationMiddleware');
	//Se pueden pasar filtros opcionales (fechaInicio/fechaFin) en formato(yyyy/mm/dd)

	$this->get('/{id}', \vehiculoAPI::class . ':traerUno')->add(\validationAPI::class . ':adminValidationMiddleware');

	$this->post('[/]', \vehiculoAPI::class . ':CargarUno')->add(\validationAPI::class . ':adminValidationMiddleware');

	$this->delete('[/]', \vehiculoAPI::class . ':BorrarUno')->add(\validationAPI::class . ':adminValidationMiddleware');

	$this->post('/modificar[/]', \vehiculoAPI::class . ':ModificarUno')->add(\validationAPI::class . ':adminValidationMiddleware');

	$this->post('/entrada[/]', \vehiculoAPI::class . ':entrada')->add(\validationAPI::class . ':usuarioLogeadoValidationMiddleware'); //5- Cuando ingresa el vehículo se le toma la patente, color y marca, cochera

	$this->post('/salida[/]', \vehiculoAPI::class . ':salida')->add(\validationAPI::class . ':usuarioLogeadoValidationMiddleware'); //6-Cuando sale el vehículo se ingresa la patente y se muestran los datos del vehículo con el importe a pagar.
        //3-Cobro por hora$10 o media estadía $90(12hs) o estadia$170(24hs).

});

$app->run();