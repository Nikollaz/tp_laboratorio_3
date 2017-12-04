<?php

include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/Entidades/vehiculo.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/Interfaces/IApiUsable.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/EntidadesPDO/vehiculoPDO.php";

include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/Utils/JSONToCSV.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/Utils/FPDF/fpdf.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/Utils/FPDF/pdf.php";

class vehiculoAPI extends vehiculo implements IApiUsable{

    /**
    * @api {get} /vehiculos TraerTodos
    * @apiVersion 0.1.0
    * @apiName TraerTodos
    * @apiGroup vehiculoAPI
    * @apiDescription Trae informacion de todos los vehiculos
    *
    * @apiParam {Date} [fechaInicio] Opcional, filtro de fecha, si no se especifica "fechaFin", se filtra por esta fecha solamente. Formato 'yyyy/MM/dd'
    * @apiParam {Date} [fechaFin] Opcional, filtro de fecha, si se especifica, se filtra en el rango entre fechaInicio y este. Formato 'yyyy/MM/dd'
    * @apiParam {String} [CSV] Opcional, se coloca este parametro si se quiere guardar el resultado de la busqueda en un archivo CSV. El valor que se pasa en este parametro sera el nombre del archivo guardado en API/PHP/Busquedas
    * @apiParam {String} [PDF] Opcional, se coloca este parametro si se quiere guardar el resultado de la busqueda en un archivo PDF. El valor que se pasa en este parametro sera el nombre del archivo guardado en API/PHP/Busquedas
    *
    * @apiExample Como usarlo:
    *   ->get('[/]', \vehiculoAPI::class . ':TraerTodos')
    * @apiSuccess {Object[]} vehiculos Trae un array de vehiculos con todos los datos de los mismos
    */
    public function TraerTodos($request, $response, $args)
    {
        $flagSinError = false;

        if
            ( 
                (!isset($_GET["fechaInicio"]) || $_GET["fechaInicio"] == "") &&
                (!isset($_GET["fechaFin"]) || $_GET["fechaFin"] == "")
            ){

            $vehiculos = vehiculoPDO::traervehiculos(null, null);
            $vehiculos = $this->empleadoSalidaNullifier($vehiculos);
            $response = $response->withJson($vehiculos, 200, JSON_UNESCAPED_UNICODE);
            $flagSinError = true;

        }  else if
            (
                (isset($_GET["fechaInicio"]) && $_GET["fechaInicio"] != "") &&
                (!isset($_GET["fechaFin"]) || $_GET["fechaFin"] == "")
            ){

            $vehiculos = vehiculoPDO::traervehiculos($_GET["fechaInicio"], null);
            $vehiculos = $this->empleadoSalidaNullifier($vehiculos);
            $response = $response->withJson($vehiculos, 200, JSON_UNESCAPED_UNICODE);
            $flagSinError = true;

        } else if
            (
                (isset($_GET["fechaInicio"]) && $_GET["fechaInicio"] != "") &&
                (isset($_GET["fechaFin"]) && $_GET["fechaFin"] != "")
            ){

            $vehiculos = vehiculoPDO::traervehiculos($_GET["fechaInicio"], $_GET["fechaFin"]);
            $vehiculos = $this->empleadoSalidaNullifier($vehiculos);
            $response = $response->withJson($vehiculos, 200, JSON_UNESCAPED_UNICODE);
            $flagSinError = true;

        } else {

            $newBody = [
                "Estado" => "Error",
                "Mensaje" => "Error en los parametros"
            ];

            $response->getBody()->write(json_encode($newBody));

        }
        
        if( isset($_GET['CSV']) && $_GET['CSV'] != "" && $flagSinError && $vehiculos != []){

            $jsontocsv = new JSONToCSV();
            $jsontocsv->savejson2csv( json_encode($vehiculos, JSON_UNESCAPED_UNICODE) , $_SERVER['DOCUMENT_ROOT']."/API/PHP/Busquedas/".$_GET['CSV'].".csv");

        }
        
        if( isset($_GET['PDF']) && $_GET['PDF'] != "" ){

            $pdf = new PDF('L','mm','A3');
            $header = array('id', 'patente', 'Color', 'Marca','Foto','EmpleadoIngreso','HoraDeEntrada','Cochera','EmpleadoSalida','HoraDeSalida','importe','tiempo_seg');
            $pdf->SetFont('Arial','',10);
            $pdf->AddPage();
            $pdf->BasicTable($header,$vehiculos);
            
            $pdf->Output('F', $_SERVER['DOCUMENT_ROOT']."/API/PHP/Busquedas/".$_GET['PDF'].".pdf");
            
        }
       
        return $response;
    }

    /**
    * @api {get} /vehiculos TraerUno
    * @apiVersion 0.1.0
    * @apiName TraerUno
    * @apiGroup vehiculoAPI
    * @apiDescription Trae informacion de un vehiculo, buscado por id
    *
    * @apiParam {Number} id Id del empleado a buscar
    *
    * @apiExample Como usarlo:
    *   ->get('/{id}', \vehiculoAPI::class . ':traerUno')
    * @apiSuccess {Object[]} vehiculo Informacion del vehiculo encontrado
    */
    public function TraerUno($request, $response, $args)
    { 
        $id = $args['id'];
        $vehiculo = vehiculoPDO::traerVehiculoPorId($id);
        $vehiculo = $this->empleadoSalidaNullifier($vehiculo);
        $response = $response->withJson($vehiculo, 200);  
        return $response;
    }

        /**
    * @api {post} /vehiculos CargarUno
    * @apiVersion 0.1.0
    * @apiName CargarUno
    * @apiGroup vehiculoAPI
    * @apiDescription (Admin) Da de alta un nuevo vehiculo
    *
    * @apiParam {String} patente  Patente del vehiculo
    * @apiParam {String} color Color del vehiculo
    * @apiParam {String} marca Marca del vehiculo
    * @apiParam {File} foto Foto del vehiculo
    * @apiParam {String} emailEmpleadoIngreso Email del empleado que ingreso el vehiculo
    * @apiParam {Datetime} horaDeEntrada Fecha y hora que ingreso el vehiculo en formato "yyyy-MM-dd hh:mm:ss"
    * @apiParam {String} cochera Cochera en la que entrara el vehiculo
    * @apiParam {String} emailEmpleadoSalida Email del empleado que saco el vehiculo
    * @apiParam {Datetime} horaDeSalida Fecha y hora que salio el vehiculo en formato "yyyy-MM-dd hh:mm:ss"
    * @apiParam {Number} importe Importe que se le cobro al vehiculo
    * @apiParam {Number} tiempo_seg Tiempo en segundos que estuvo el vehiculo en el estacionamiento
    *
    * @apiExample Como usarlo:
    *   ->post('[/]', \empleadoAPI::class . ':CargarUno')
    * @apiSuccessExample {json} Alta exitosa:
    *     HTTP/1.1 200 OK
    *     {
    *       "Estado" => "Ok",
    *       "Mensaje" => "Vehiculo dado de alta con exito"
    *     }
    * @apiErrorExample Datos incorrectos o faltantes:
    *     {
    *       "Estado" => "Error",
    *       "Mensaje" => "Hay parametros faltantes"
    *     }
    */
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

    /**
    * @api {delete} /vehiculos BorrarUno
    * @apiVersion 0.1.0
    * @apiName BorrarUno
    * @apiGroup vehiculoAPI
    * @apiDescription (Admin) Da de baja un registro de vehiculos
    *
    * @apiParam {Number} id  Id del vehiculo a dar de baja
    *
    * @apiExample Como usarlo:
    *   ->delete('[/]', \vehiculoAPI::class . ':BorrarUno')
    * @apiSuccessExample {json} Baja exitosa:
    *     HTTP/1.1 200 OK
    *     {
    *       "Estado" => "Ok",
    *       "Mensaje" => "Vehiculo dado de baja con exito"
    *     }
    * @apiErrorExample Datos incorrectos o faltantes:
    *     {
    *       "Estado" => "Error",
    *       "Mensaje" => "Hay parametros faltantes"
    *     }
    * @apiErrorExample No se encontro el id:
    *     {
    *       "Estado" => "Error",
    *       "Mensaje" => "No se pudo dar de baja el vehiculo"
    *     }
    */
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

    /**
    * @api {put} /vehiculos/modificar ModificarUno
    * @apiVersion 0.1.0
    * @apiName ModificarUno
    * @apiGroup vehiculoAPI
    * @apiDescription (Admin) Modifica un vehiculo
    *
    * @apiParam {Number} id Id del vehiculo a modificar
    * @apiParam {String} patente Patente del vehiculo
    * @apiParam {String} color Color del vehiculo
    * @apiParam {String} marca Marca del vehiculo
    * @apiParam {File} foto Foto del vehiculo
    * @apiParam {String} emailEmpleadoIngreso Email del empleado que ingreso el vehiculo
    * @apiParam {Datetime} horaDeEntrada Fecha y hora que ingreso el vehiculo en formato "yyyy-MM-dd hh:mm:ss"
    * @apiParam {String} cochera Cochera en la que entrara el vehiculo
    * @apiParam {String} emailEmpleadoSalida Email del empleado que saco el vehiculo
    * @apiParam {Datetime} horaDeSalida Fecha y hora que salio el vehiculo en formato "yyyy-MM-dd hh:mm:ss"
    * @apiParam {Number} importe Importe que se le cobro al vehiculo
    * @apiParam {Number} tiempo_seg Tiempo en segundos que estuvo el vehiculo en el estacionamiento
    *
    * @apiExample Como usarlo:
    *   ->post('/modificar[/]', \vehiculoAPI::class . ':ModificarUno')
    * @apiSuccessExample {json} Modificacion exitosa:
    *     HTTP/1.1 200 OK
    *     {
    *       "Estado" => "Ok",
    *       "Mensaje" => "Vehiculo modificado con exito"
    *     }
    * @apiErrorExample Datos incorrectos o faltantes:
    *     {
    *       "Estado" => "Error",
    *       "Mensaje" => "Hay parametros faltantes"
    *     }
    * @apiErrorExample No se encontro el id:
    *     {
    *       "Estado" => "Error",
    *       "Mensaje" => "No se pudo modificar el vehiculo"
    *     }
    */
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

    /**
    * @api {post} /vehiculos/entrada entrada
    * @apiVersion 0.1.0
    * @apiName entrada
    * @apiGroup vehiculoAPI
    * @apiDescription (User/Admin) Da de alta la entrada de un nuevo vehiculo
    *
    * @apiParam {String} patente  Patente del vehiculo
    * @apiParam {String} color Color del vehiculo
    * @apiParam {String} marca Marca del vehiculo
    * @apiParam {String} cochera Cochera en la que entrara el vehiculo
    * @apiParam {String="true","false"} discapacitado Valor que sirve para indicar si el auto ingresante contiene personas discapacitadas
    *
    * @apiExample Como usarlo:
    *   ->post('/entrada[/]', \vehiculoAPI::class . ':entrada')
    * @apiSuccessExample {json} Entrada de vehiculo exitosa:
    *     HTTP/1.1 200 OK
    *     {
    *       "Estado" => "Ok",
    *       "Mensaje" => "Entrada de vehiculo dada de alta con exito"
    *     }
    * @apiErrorExample Vehiculo ya estacionado:
    *     {
    *       "Estado" => "Error",
    *       "Mensaje" => "El vehiculo ya esta estacionado"
    *     }
    * @apiErrorExample Datos incorrectos o faltantes:
    *     {
    *       "Estado" => "Error",
    *       "Mensaje" => "Hay parametros faltantes"
    *     }
    * @apiErrorExample Datos en blanco:
    *     {
    *       "Estado" => "Error",
    *       "Mensaje" => "Los parametros no pueden estar en blanco"
    *     }
    */
    public function entrada($request, $response, $args)
    {
        //5- Cuando ingresa el vehículo se le toma la patente, color y marca.

        if
            ( 
                isset($_POST["patente"]) && $_POST["patente"] != "" &&
                isset($_POST["color"]) && $_POST["color"] != "" &&
                isset($_POST["marca"]) && $_POST["marca"] != "" &&
                isset($_POST["cochera"]) && $_POST["cochera"] != "" &&
                isset($_POST["discapacitado"]) && $_POST["discapacitado"] != "" &&
                ($_POST["discapacitado"] == "true" || $_POST["discapacitado"] == "false")
            )
        {

            $ArrayDeParametros = $request->getParsedBody();

            if
            (
                vehiculoPDO::estacionadoValidation($ArrayDeParametros['patente']) != [] 
            ){
                $newBody = [
                    "Estado" => "Error",
                    "Mensaje" => "El vehiculo ya esta estacionado"
                ];

                $response->getBody()->write(json_encode($newBody));
            } else if
                (
                    $_POST["discapacitado"] == "true" &&
                    cocheraPDO::cocheraDiscapacitadoValidation($_POST["cochera"]) != 1
                )
            {
                $newBody = [
                    "Estado" => "Error",
                    "Mensaje" => "La cochera no es apta para discapacitados"
                ];
    
                $response->getBody()->write(json_encode($newBody));
                
            } else if
                (
                    $_POST["discapacitado"] == "false" &&
                    cocheraPDO::cocheraDiscapacitadoValidation($_POST["cochera"]) == 1
                )
            {
                $newBody = [
                    "Estado" => "Error",
                    "Mensaje" => "Esta cochera esta reservada para discapacitados"
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
                !isset($_POST["cochera"]) || 
                !isset($_POST["discapacitado"]) ||
                ($_POST["discapacitado"] != "true" && $_POST["discapacitado"] != "false")
                
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
                $_POST["cochera"] == "" || 
                $_POST["discapacitado"] == ""
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

    /**
    * @api {post} /vehiculos/salida salida
    * @apiVersion 0.1.0
    * @apiName salida
    * @apiGroup vehiculoAPI
    * @apiDescription (User/Admin) Da de alta la salida de un vehiculo y devuelve los datos del mismo
    *
    * @apiParam {String} patente Patente del vehiculo
    *
    * @apiExample Como usarlo:
    *   ->post('/salida[/]', \vehiculoAPI::class . ':salida')
    * @apiSuccess {Object[]} datos Trae un json con el estado de la operacion, un mensaje que informa la misma, y un objeto Vehiculo con los datos del mismo
    * @apiErrorExample Vehiculo que no esta estacionado:
    *     {
    *       "Estado" => "Error",
    *       "Mensaje" => "El vehiculo no esta estacionado"
    *     }
    * @apiErrorExample Datos incorrectos o faltantes:
    *     {
    *       "Estado" => "Error",
    *       "Mensaje" => "Hay parametros faltantes"
    *     }
    * @apiErrorExample Datos en blanco:
    *     {
    *       "Estado" => "Error",
    *       "Mensaje" => "Los parametros no pueden estar en blanco"
    *     }
    */
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