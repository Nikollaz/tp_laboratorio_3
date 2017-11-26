<?php

include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/Entidades/vehiculo.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/Interfaces/IApiUsable.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/EntidadesPDO/vehiculoPDO.php";

class vehiculoAPI extends vehiculo implements IApiUsable{

    public function TraerTodos($request, $response, $args)
    {

        if
            ( 
                (!isset($_GET["fechaInicio"]) || $_GET["fechaInicio"] == "") &&
                (!isset($_GET["fechaFin"]) || $_GET["fechaFin"] == "")
            ){

            $vehiculos = vehiculoPDO::traervehiculos(null, null);
            $vehiculos = $this->empleadoSalidaNullifier($vehiculos);
            $response = $response->withJson($vehiculos, 200, JSON_UNESCAPED_UNICODE);  

        }  else if
            (
                (isset($_GET["fechaInicio"]) && $_GET["fechaInicio"] != "") &&
                (!isset($_GET["fechaFin"]) || $_GET["fechaFin"] == "")
            ){

            $vehiculos = vehiculoPDO::traervehiculos($_GET["fechaInicio"], null);
            $vehiculos = $this->empleadoSalidaNullifier($vehiculos);
            $response = $response->withJson($vehiculos, 200, JSON_UNESCAPED_UNICODE);  

        } else if
            (
                (isset($_GET["fechaInicio"]) && $_GET["fechaInicio"] != "") &&
                (isset($_GET["fechaFin"]) && $_GET["fechaFin"] != "")
            ){

            $vehiculos = vehiculoPDO::traervehiculos($_GET["fechaInicio"], $_GET["fechaFin"]);
            $vehiculos = $this->empleadoSalidaNullifier($vehiculos);
            $response = $response->withJson($vehiculos, 200, JSON_UNESCAPED_UNICODE);  

        } else {

            $newBody = [
                "Estado" => "Error",
                "Mensaje" => "Error en los parametros"
            ];

            $response->getBody()->write(json_encode($newBody));

        }

       
        return $response;
    }

    public function TraerUno($request, $response, $args)
    { 
        $id = $args['id'];
        $vehiculo = vehiculoPDO::traerVehiculoPorId($id);
        $vehiculo = $this->empleadoSalidaNullifier($vehiculo);
        $response = $response->withJson($vehiculo, 200);  
        return $response;
    }

    public function CargarUno($request, $response, $args)
    { 
        if
            ( 
                isset($_POST["patente"]) && $_POST["patente"] != "" &&
                isset($_POST["color"]) && $_POST["color"] != "" &&
                isset($_POST["marca"]) && $_POST["marca"] != "" &&
                isset($_FILES["foto"]) && $_FILES["foto"] != "" &&
                isset($_POST["emailEmpleadoIngreso"]) && $_POST["emailEmpleadoIngreso"] != "" &&
                isset($_POST["horaDeEntrada"]) && $_POST["horaDeEntrada"] != "" &&
                isset($_POST["cochera"]) && $_POST["cochera"] != "" &&
                isset($_POST["emailEmpleadoSalida"]) && $_POST["emailEmpleadoSalida"] != "" &&
                isset($_POST["horaDeSalida"]) && $_POST["horaDeSalida"] != "" &&
                isset($_POST["importe"]) && $_POST["importe"] != "" &&
                isset($_POST["tiempo_seg"]) && $_POST["tiempo_seg"] != ""
            )
        {

            $ArrayDeParametros = $request->getParsedBody();
            $vehiculo = new vehiculo();
            $vehiculo->patente = $ArrayDeParametros['patente'];
            $vehiculo->Color = $ArrayDeParametros['color'];
            $vehiculo->Marca = $ArrayDeParametros['marca'];
            $vehiculo->Foto = $_FILES['foto']['name'];
            $vehiculo->EmpleadoIngreso = $ArrayDeParametros['emailEmpleadoIngreso'];
            $vehiculo->HoraDeEntrada = $ArrayDeParametros['horaDeEntrada'];
            $vehiculo->Cochera = $ArrayDeParametros['cochera'];
            $vehiculo->EmpleadoSalida = $ArrayDeParametros['emailEmpleadoSalida'];
            $vehiculo->HoraDeSalida = $ArrayDeParametros['horaDeSalida'];
            $vehiculo->importe = $ArrayDeParametros['importe'];
            $vehiculo->tiempo_seg = $ArrayDeParametros['tiempo_seg'];

            if(vehiculoPDO::altaVehiculo($vehiculo) != 1){
                $newBody = [
                    "Estado" => "Error",
                    "Mensaje" => "No se pudo dar de alta el vehiculo"
                ];

                $response->getBody()->write(json_encode($newBody));
            }
            else{
                $newBody = [
                    "Estado" => "Ok",
                    "Mensaje" => "Vehiculo dado de alta con exito"
                ];

                $response->getBody()->write(json_encode($newBody));
            }

        } else if
            (
                !isset($_POST["patente"]) || 
                !isset($_POST["color"]) || 
                !isset($_POST["marca"]) ||
                !isset($_FILES["foto"]) ||
                !isset($_POST["emailEmpleadoIngreso"])||
                !isset($_POST["horaDeEntrada"])||
                !isset($_POST["cochera"])||
                !isset($_POST["emailEmpleadoSalida"]) ||
                !isset($_POST["horaDeSalida"]) ||
                !isset($_POST["importe"]) ||
                !isset($_POST["tiempo_seg"])
            )
        {
            $newBody = [
                "Estado" => "Error",
                "Mensaje" => "Hay parametros faltantes"
            ];

            $response->getBody()->write(json_encode($newBody));

        } else if
            (
                $_POST["patente"] == "" || 
                $_POST["color"] == "" || 
                $_POST["marca"] == "" ||
                $_FILES["foto"] == "" ||
                $_POST["emailEmpleadoIngreso"] == "" ||
                $_POST["horaDeEntrada"] == "" ||
                $_POST["cochera"] == "" ||
                $_POST["emailEmpleadoSalida"] == "" ||
                $_POST["horaDeSalida"] == "" ||
                $_POST["importe"] == "" ||
                $_POST["tiempo_seg"] == ""
            )
        {
            $newBody = [
                "Estado" => "Error",
                "Mensaje" => "Los parametros no pueden estar en blanco"
            ];

            $response->getBody()->write(json_encode($newBody));

        } 

        return $response;
    }

    public function BorrarUno($request, $response, $args)
    { 
        parse_str(file_get_contents('php://input'), $parametros);

        if
            ( 
                array_key_exists("id", $parametros) && $parametros["id"] != ""  
            )
        {
            $id = $parametros["id"];
            if(vehiculoPDO::bajaVehiculo($id) != 1){
                $newBody = [
                    "Estado" => "Error",
                    "Mensaje" => "No se pudo dar de baja el vehiculo"
                ];

                $response->getBody()->write(json_encode($newBody));
            }
            else{
                $newBody = [
                    "Estado" => "Ok",
                    "Mensaje" => "Vehiculo dado de baja con exito"
                ];

                $response->getBody()->write(json_encode($newBody));
            }

        } else if
            (
                !array_key_exists("id", $parametros)
            )
        {

            $newBody = [
                "Estado" => "Error",
                "Mensaje" => "Hay parametros faltantes"
            ];

            $response->getBody()->write(json_encode($newBody));

        } else if
            (
                $parametros["id"] == "" 
            )
        {

            $newBody = [
                "Estado" => "Error",
                "Mensaje" => "Los parametros no pueden estar en blanco"
            ];

            $response->getBody()->write(json_encode($newBody));

        }

        return $response;
    }

    public function ModificarUno($request, $response, $args)
    { 
        if
            ( 
                isset($_POST["id"]) && $_POST["id"] != "" &&
                isset($_POST["patente"]) && $_POST["patente"] != "" &&
                isset($_POST["color"]) && $_POST["color"] != "" &&
                isset($_POST["marca"]) && $_POST["marca"] != "" &&
                isset($_FILES["foto"]) && $_FILES["foto"] != "" &&
                isset($_POST["emailEmpleadoIngreso"]) && $_POST["emailEmpleadoIngreso"] != "" &&
                isset($_POST["horaDeEntrada"]) && $_POST["horaDeEntrada"] != "" &&
                isset($_POST["cochera"]) && $_POST["cochera"] != "" &&
                isset($_POST["emailEmpleadoSalida"]) && $_POST["emailEmpleadoSalida"] != "" &&
                isset($_POST["horaDeSalida"]) && $_POST["horaDeSalida"] != "" &&
                isset($_POST["importe"]) && $_POST["importe"] != "" &&
                isset($_POST["tiempo_seg"]) && $_POST["tiempo_seg"] != ""
            )
            
        {

            $ArrayDeParametros = $request->getParsedBody();

            $vehiculo = new vehiculo();
            $vehiculo->id = $ArrayDeParametros['id'];
            $vehiculo->patente = $ArrayDeParametros['patente'];
            $vehiculo->Color = $ArrayDeParametros['color'];
            $vehiculo->Marca = $ArrayDeParametros['marca'];
            $vehiculo->Foto = $_FILES['foto']['name'];
            $vehiculo->EmpleadoIngreso = $ArrayDeParametros['emailEmpleadoIngreso'];
            $vehiculo->HoraDeEntrada = $ArrayDeParametros['horaDeEntrada'];
            $vehiculo->Cochera = $ArrayDeParametros['cochera'];
            $vehiculo->EmpleadoSalida = $ArrayDeParametros['emailEmpleadoSalida'];
            $vehiculo->HoraDeSalida = $ArrayDeParametros['horaDeSalida'];
            $vehiculo->importe = $ArrayDeParametros['importe'];
            $vehiculo->tiempo_seg = $ArrayDeParametros['tiempo_seg'];
            
            if(vehiculoPDO::modificarVehiculo($vehiculo) != 1){
                $newBody = [
                    "Estado" => "Error",
                    "Mensaje" => "No se pudo modificar el vehiculo"
                ];

                $response->getBody()->write(json_encode($newBody));
            }
            else{
                $newBody = [
                    "Estado" => "Ok",
                    "Mensaje" => "Vehiculo modificado con exito"
                ];

                $response->getBody()->write(json_encode($newBody));
            }

        } else if
            (
                !isset($_POST["id"]) ||
                !isset($_POST["patente"]) || 
                !isset($_POST["color"]) || 
                !isset($_POST["marca"]) ||
                !isset($_FILES["foto"]) ||
                !isset($_POST["emailEmpleadoIngreso"])||
                !isset($_POST["horaDeEntrada"])||
                !isset($_POST["cochera"])||
                !isset($_POST["emailEmpleadoSalida"]) ||
                !isset($_POST["horaDeSalida"]) ||
                !isset($_POST["importe"]) ||
                !isset($_POST["tiempo_seg"])
            )
        {
            $newBody = [
                "Estado" => "Error",
                "Mensaje" => "Hay parametros faltantes"
            ];

            $response->getBody()->write(json_encode($newBody));

        } else if
            (
                $_POST["id"] == "" || 
                $_POST["patente"] == "" || 
                $_POST["color"] == "" || 
                $_POST["marca"] == "" ||
                $_FILES["foto"] == "" ||
                $_POST["emailEmpleadoIngreso"] == "" ||
                $_POST["horaDeEntrada"] == "" ||
                $_POST["cochera"] == "" ||
                $_POST["emailEmpleadoSalida"] == "" ||
                $_POST["horaDeSalida"] == "" ||
                $_POST["importe"] == "" ||
                $_POST["tiempo_seg"] == ""
            )
        {
            $newBody = [
                "Estado" => "Error",
                "Mensaje" => "Los parametros no pueden estar en blanco"
            ];

            $response->getBody()->write(json_encode($newBody));

        } 

        return $response;
    }

    private function empleadoSalidaNullifier($vehiculos)
    {

        foreach ($vehiculos as $key => $value) {
            if
                (
                    $vehiculos[$key]->HoraDeSalida == NULL &&
                    $vehiculos[$key]->importe == NULL &&
                    $vehiculos[$key]->tiempo_seg == NULL
                ){
                
                $vehiculos[$key]->EmpleadoSalida = NULL;
            }
        }

        return $vehiculos;
    }

    public function entrada($request, $response, $args)
    {
        //5- Cuando ingresa el vehículo se le toma la patente, color y marca.

        if
            ( 
                isset($_POST["patente"]) && $_POST["patente"] != "" &&
                isset($_POST["color"]) && $_POST["color"] != "" &&
                isset($_POST["marca"]) && $_POST["marca"] != "" &&
                isset($_POST["cochera"]) && $_POST["cochera"] != ""
            )
        {

            $ArrayDeParametros = $request->getParsedBody();

            if(vehiculoPDO::estacionadoValidation($ArrayDeParametros['patente']) != [] ){

                $newBody = [
                    "Estado" => "Error",
                    "Mensaje" => "El vehiculo ya esta estacionado"
                ];

                $response->getBody()->write(json_encode($newBody));

            } else {
                
                $vehiculo = new vehiculo();
                $vehiculo->patente = $ArrayDeParametros['patente'];
                $vehiculo->Color = $ArrayDeParametros['color'];
                $vehiculo->Marca = $ArrayDeParametros['marca'];            
                $vehiculo->Cochera = $ArrayDeParametros['cochera'];
                $vehiculo->Foto = "Placeholder";

                $info = validationAPI::traerDatosDeToken($request, $response, $args);
                $vehiculo->EmpleadoIngreso = $info->data->email;

                date_default_timezone_set('America/Argentina/Buenos_Aires');

                $vehiculo->HoraDeEntrada = date("Y-m-d H:i:s");
                
                if(vehiculoPDO::entrada($vehiculo) != 1){
                    $newBody = [
                        "Estado" => "Error",
                        "Mensaje" => "No se pudo dar de alta a la entrada del vehiculo"
                    ];

                    $response->getBody()->write(json_encode($newBody));
                }
                else{
                    $newBody = [
                        "Estado" => "Ok",
                        "Mensaje" => "Entrada de vehiculo dada de alta con exito"
                    ];

                    $response->getBody()->write(json_encode($newBody));
                }

            }

        } else if
            (
                !isset($_POST["patente"]) || 
                !isset($_POST["color"]) || 
                !isset($_POST["marca"]) || 
                !isset($_POST["cochera"])
            )
        {
            $newBody = [
                "Estado" => "Error",
                "Mensaje" => "Hay parametros faltantes"
            ];

            $response->getBody()->write(json_encode($newBody));

        } else if
            (
                $_POST["patente"] == "" || 
                $_POST["color"] == "" || 
                $_POST["marca"] == "" || 
                $_POST["cochera"] == ""
            )
        {
            $newBody = [
                "Estado" => "Error",
                "Mensaje" => "Los parametros no pueden estar en blanco"
            ];

            $response->getBody()->write(json_encode($newBody));

        } 

        return $response;
    }

    public function salida($request, $response, $args)
    {
        //6-Cuando sale el vehículo se ingresa la patente y se muestran los datos del vehículo con el importe a pagar.
        //3-Cobro por hora$10 o media estadía $90(12hs) o estadia$170(24hs).

        if
            ( 
                isset($_POST["patente"]) && $_POST["patente"] != ""
            )
        {
            $ArrayDeParametros = $request->getParsedBody();

            if(vehiculoPDO::estacionadoValidation($ArrayDeParametros['patente']) != [] ){
                
                $vehiculoEstacionado = (vehiculoPDO::traerVehiculoPorPatente($_POST["patente"]))[0];
                $vehiculoSalida = new Vehiculo();

                /* Patente */
                $vehiculoSalida->patente = $_POST["patente"];
                /* Patente */

                /* Email empleado salida */
                $info = validationAPI::traerDatosDeToken($request, $response, $args);
                $vehiculoSalida->EmpleadoSalida = $info->data->email;
                /* Email empleado salida */

                /* Horario de salida */
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $vehiculoSalida->HoraDeSalida = date("Y-m-d H:i:s");
                /* Horario de salida */

                /* Tiempo */
                $vehiculoSalida->tiempo_seg = strtotime($vehiculoSalida->HoraDeSalida) - strtotime($vehiculoEstacionado->HoraDeEntrada);
                /* Tiempo */

                /* Importe */
                $importe = 0;
                $tiempoEnHoras = floor( ($vehiculoSalida->tiempo_seg/60)/60 );  //Horas de estadia

                $importe += floor( floor($tiempoEnHoras/24) ) *170;     //Costo por estadias completas
                $importe += floor( ($tiempoEnHoras%24) /12 ) *90;       //Costo por medias estadias
                $importe += floor( ( ($tiempoEnHoras%24) %12) ) *10;    //Costo por hora

                $vehiculoSalida->importe = $importe;
                /* Importe */

                if(vehiculoPDO::salida($vehiculoSalida) != 1){
                    $newBody = [
                        "Estado" => "Error",
                        "Mensaje" => "No se pudo dar de alta a la salida del vehiculo"
                    ];

                    $response->getBody()->write(json_encode($newBody));
                }
                else{

                    $newBody = [
                        "Estado" => "Ok",
                        "Mensaje" => "Salida del vehiculo dada de alta con exito",
                        "Vehiculo" => vehiculoPDO::traerVehiculoPorPatente($_POST["patente"])
                    ];

                    $response->getBody()->write(json_encode($newBody,JSON_UNESCAPED_SLASHES));
                }
                
            } else {

                $newBody = [
                    "Estado" => "Error",
                    "Mensaje" => "El vehiculo no esta estacionado"
                ];

                $response->getBody()->write(json_encode($newBody));

            }

        } else if
            (
                !isset($_POST["patente"])
            )
        {
            $newBody = [
                "Estado" => "Error",
                "Mensaje" => "Hay parametros faltantes"
            ];

            $response->getBody()->write(json_encode($newBody));

        } else if
            (
                $_POST["patente"] == ""
            )
        {
            $newBody = [
                "Estado" => "Error",
                "Mensaje" => "Los parametros no pueden estar en blanco"
            ];

            $response->getBody()->write(json_encode($newBody));

        } 

        return $response;
    }
}




?>