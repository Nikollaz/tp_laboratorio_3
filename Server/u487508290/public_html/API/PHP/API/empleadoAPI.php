<?php

include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/Entidades/empleado.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/Interfaces/IApiUsable.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/EntidadesPDO/empleadoPDO.php";

include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/Utils/JSONToCSV.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/Utils/FPDF/fpdf.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/Utils/FPDF/pdf.php";

class empleadoAPI extends empleado implements IApiUsable{

    /**
    * @api {get} /empleados TraerTodos
    * @apiVersion 0.1.0
    * @apiName TraerTodos
    * @apiGroup empleadoAPI
    * @apiDescription Trae informacion de todos los empleados
    * @apiParam {String} [CSV] Opcional, se coloca este parametro si se quiere guardar el resultado de la busqueda en un archivo CSV. El valor que se pasa en este parametro sera el nombre del archivo guardado en API/PHP/Busquedas
    * @apiParam {String} [PDF] Opcional, se coloca este parametro si se quiere guardar el resultado de la busqueda en un archivo PDF. El valor que se pasa en este parametro sera el nombre del archivo guardado en API/PHP/Busquedas
    *
    * @apiExample Como usarlo:
    *   ->get('[/]', \empleadoAPI::class . ':TraerTodos')
    * @apiSuccess {Object[]} empleados Trae un array de empleados con todos los datos de los mismos
    */
    public function TraerTodos($request, $response, $args)
    {
        $empleados = empleadoPDO::traerEmpleados();
        $response = $response->withJson($empleados, 200, JSON_UNESCAPED_UNICODE);  

        if( isset($_GET['CSV']) && $_GET['CSV'] != "" ){

            $jsontocsv = new JSONToCSV();
            $jsontocsv->savejson2csv(json_encode($empleados,JSON_UNESCAPED_UNICODE), $_SERVER['DOCUMENT_ROOT']."/API/PHP/Busquedas/".$_GET['CSV'].".csv");
            
        }
        
        if( isset($_GET['PDF']) && $_GET['PDF'] != "" ){

            $pdf = new PDF('L','mm','A3');
            $header = array('Id', 'Email', 'Password', 'Turno','Sexo','Perfil','Suspendido');
            $pdf->SetFont('Arial','',10);
            $pdf->AddPage();
            $pdf->BasicTable($header,$empleados);
            
            $pdf->Output('F', $_SERVER['DOCUMENT_ROOT']."/API/PHP/Busquedas/".$_GET['PDF'].".pdf");
            
        }
        
        return $response;
    }

    /**
    * @api {get} /empleados TraerUno
    * @apiVersion 0.1.0
    * @apiName TraerUno
    * @apiGroup empleadoAPI
    * @apiDescription Trae informacion de un empleado, buscado por id
    *
    * @apiParam {Number} id Id del empleado a buscar
    *
    * @apiExample Como usarlo:
    *   ->get('/{id}', \empleadoAPI::class . ':traerUno')
    * @apiSuccess {Object[]} empleado Informacion del empleado encontrado
    */
    public function TraerUno($request, $response, $args)
    {
        $id = $args['id'];
        $empleado = empleadoPDO::traerEmpleadoPorId($id);
        $response = $response->withJson($empleado, 200);  
        return $response;
    }

    /**
    * @api {post} /empleados CargarUno
    * @apiVersion 0.1.0
    * @apiName CargarUno
    * @apiGroup empleadoAPI
    * @apiDescription (Admin) Da de alta un nuevo empleado
    *
    * @apiParam {String} email  Email del empleado
    * @apiParam {String} password Password del empleado
    * @apiParam {String="dia","tarde","noche"} turno Turno del empleado
    * @apiParam {String="femenino","masculino"} sexo Sexo del empleado
    * @apiParam {String="user","admin"} perfil Perfil del empleado
    *
    * @apiExample Como usarlo:
    *   ->post('[/]', \vehiculoAPI::class . ':CargarUno')
    * @apiSuccessExample {json} Alta exitosa:
    *     HTTP/1.1 200 OK
    *     {
    *       "Estado" => "Ok",
    *       "Mensaje" => "Empleado dado de alta con exito"
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
                isset($_POST["email"]) && $_POST["email"] != "" &&
                isset($_POST["password"]) && $_POST["password"] != "" &&
                isset($_POST["turno"]) && $_POST["turno"] != "" &&
                isset($_POST["sexo"]) && $_POST["sexo"] != "" &&
                isset($_POST["perfil"]) && $_POST["perfil"] != "" 
            )
        {

            $ArrayDeParametros = $request->getParsedBody();
            $empleado = new empleado();
            $empleado->email = $ArrayDeParametros['email'];
            $empleado->password = $ArrayDeParametros['password'];
            $empleado->turno = $ArrayDeParametros['turno'];
            $empleado->sexo = $ArrayDeParametros['sexo'];
            $empleado->perfil = $ArrayDeParametros['perfil'];
            if(empleadoPDO::altaEmpleado($empleado) != 1){
                $newBody = [
                    "Estado" => "Error",
                    "Mensaje" => "No se pudo dar de alta el empleado"
                ];

                $response->getBody()->write(json_encode($newBody));
            }
            else{
                $newBody = [
                    "Estado" => "Ok",
                    "Mensaje" => "Empleado dado de alta con exito"
                ];

                $response->getBody()->write(json_encode($newBody));
            }

        } else if
            (
                !isset($_POST["email"]) || 
                !isset($_POST["password"]) || 
                !isset($_POST["turno"]) ||
                !isset($_POST["sexo"]) ||
                !isset($_POST["perfil"])
            )
        {
            $newBody = [
                "Estado" => "Error",
                "Mensaje" => "Hay parametros faltantes"
            ];

            $response->getBody()->write(json_encode($newBody));

        } else if
            (
                $_POST["email"] == "" || 
                $_POST["password"] == "" || 
                $_POST["turno"] == "" ||
                $_POST["sexo"] == "" ||
                $_POST["perfil"] == ""
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
    * @api {delete} /empleados BorrarUno
    * @apiVersion 0.1.0
    * @apiName BorrarUno
    * @apiGroup empleadoAPI
    * @apiDescription (Admin) Da de baja un empleado
    *
    * @apiParam {Number} id  Id del empleado a dar de baja
    *
    * @apiExample Como usarlo:
    *   ->delete('[/]', \empleadoAPI::class . ':BorrarUno')
    * @apiSuccessExample {json} Baja exitosa:
    *     HTTP/1.1 200 OK
    *     {
    *       "Estado" => "Ok",
    *       "Mensaje" => "Empleado dado de baja con exito"
    *     }
    * @apiErrorExample Datos incorrectos o faltantes:
    *     {
    *       "Estado" => "Error",
    *       "Mensaje" => "Hay parametros faltantes"
    *     }
    * @apiErrorExample No se encontro el id:
    *     {
    *       "Estado" => "Error",
    *       "Mensaje" => "No se pudo dar de baja el empleado"
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
            if(empleadoPDO::bajaEmpleado($id) != 1){
                $newBody = [
                    "Estado" => "Error",
                    "Mensaje" => "No se pudo dar de baja el empleado"
                ];

                $response->getBody()->write(json_encode($newBody));
            }
            else{
                $newBody = [
                    "Estado" => "Ok",
                    "Mensaje" => "Empleado dado de baja con exito"
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
    * @api {put} /empleados ModificarUno
    * @apiVersion 0.1.0
    * @apiName ModificarUno
    * @apiGroup empleadoAPI
    * @apiDescription (Admin) Modifica un empleado
    *
    * @apiParam {Number} id Id del empleado a modificar
    * @apiParam {String} email  Email del empleado
    * @apiParam {String} password Password del empleado
    * @apiParam {String="dia","tarde","noche"} turno Turno del empleado
    * @apiParam {String="femenino","masculino"} sexo Sexo del empleado
    * @apiParam {String="user","admin"} perfil Perfil del empleado
    *
    * @apiExample Como usarlo:
    *   ->put('[/]', \empleadoAPI::class . ':ModificarUno')
    * @apiSuccessExample {json} Modificacion exitosa:
    *     HTTP/1.1 200 OK
    *     {
    *       "Estado" => "Ok",
    *       "Mensaje" => "Empleado modificado con exito"
    *     }
    * @apiErrorExample Datos incorrectos o faltantes:
    *     {
    *       "Estado" => "Error",
    *       "Mensaje" => "Hay parametros faltantes"
    *     }
    * @apiErrorExample No se encontro el id:
    *     {
    *       "Estado" => "Error",
    *       "Mensaje" => "No se pudo modificar el empleado"
    *     }
    */
    public function ModificarUno($request, $response, $args)
    { 
        parse_str(file_get_contents('php://input'), $parametros);

        if
            ( 
                array_key_exists("email", $parametros) && $parametros["email"] != "" &&
                array_key_exists("password", $parametros) && $parametros["password"] != "" &&
                array_key_exists("turno", $parametros) && $parametros["turno"] != "" &&
                array_key_exists("sexo", $parametros) && $parametros["sexo"] != "" &&
                array_key_exists("perfil", $parametros) && $parametros["perfil"] != "" &&
                array_key_exists("id", $parametros) && $parametros["id"] != ""
            )
        {

            $empleado = new empleado();
            $empleado->email = $parametros['email'];
            $empleado->password = $parametros['password'];
            $empleado->turno = $parametros['turno'];
            $empleado->sexo = $parametros['sexo'];
            $empleado->perfil = $parametros['perfil'];
            $empleado->id = $parametros['id'];

            if(empleadoPDO::modificarEmpleado($empleado) != 1){
                $newBody = [
                    "Estado" => "Error",
                    "Mensaje" => "No se pudo modificar el empleado"
                ];

                $response->getBody()->write(json_encode($newBody));
            }
            else{
                $newBody = [
                    "Estado" => "Ok",
                    "Mensaje" => "Empleado modificado con exito"
                ];

                $response->getBody()->write(json_encode($newBody));
            }

        } else if
            (
                !array_key_exists("email", $parametros) || 
                !array_key_exists("password", $parametros) || 
                !array_key_exists("turno", $parametros) ||
                !array_key_exists("sexo", $parametros) ||
                !array_key_exists("perfil", $parametros) ||
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
                $parametros["email"] == "" || 
                $parametros["password"] == "" || 
                $parametros["turno"] == "" ||
                $parametros["sexo"] == "" ||
                $parametros["perfil"] == "" ||
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
    * @api {post} /empleados/busqueda Busqueda
    * @apiVersion 0.1.0
    * @apiName busqueda
    * @apiGroup empleadoAPI
    * @apiDescription Trae los logins o la cantidad de operaciones de los empleados, desde siempre, en una fecha o rango de fechas determinados
    *
    * @apiParam {String="logins","operaciones"} filtro Datos que se necesitan saber
    * @apiParam {Date} [fechaInicio] Opcional, filtro de fecha, si no se especifica "fechaFin", se filtra por esta fecha solamente. Formato 'yyyy/MM/dd'
    * @apiParam {Date} [fechaFin] Opcional, filtro de fecha, si se especifica, se filtra en el rango entre fechaInicio y este. Formato 'yyyy/MM/dd'
    *
    * @apiExample Como usarlo:
    *   ->post('/busqueda[/]', \empleadoAPI::class . ':busqueda')
    * @apiSuccess {Object[]} logins Un array con los mails de los usuarios, y la fecha en que se logearon
    * @apiSuccess {Object[]} operaciones Un array con los mails de los usuarios y la cantidad de operaciones que hicieron
    * @apiErrorExample Parametros erroneos:
    *     {
    *        "Estado" => "Error",
    *        "Mensaje" => "Error en los parametros"
    *     }
    * @apiErrorExample Parametros faltantes:
    *     {
    *        "Estado" => "Error",
    *        "Mensaje" => "Hay parametros faltantes"
    *     }
    */
    public function busqueda($request, $response, $args)
    {
        if
            ( 
                (!isset($_POST["fechaInicio"]) || $_POST["fechaInicio"] == "") &&
                (!isset($_POST["fechaFin"]) || $_POST["fechaFin"] == "")
            ){

            $ArrayDeParametros = $request->getParsedBody();

            if(isset($ArrayDeParametros['filtro'])){

                switch( mb_strtolower($ArrayDeParametros['filtro'], 'UTF-8') ){

                case "logins":
                    $logins = loginPDO::traerLogins(null,null);
                    $response = $response->withJson($logins, 200, JSON_UNESCAPED_UNICODE); 
                    break;
                case "operaciones":
                    $array;
                    $operaciones = empleadoPDO::traerOperacionesDeCadaUno(null,null);
                    foreach ($operaciones as $key => $value) {
                        $array[$value["email"]] = $value["cantidadIngreso"] + $value["cantidadSalida"];
                    }
                    $response = $response->withJson($array, 200, JSON_UNESCAPED_UNICODE); 
                    break;
                default:
                    $newBody = [
                        "Estado" => "Error",
                        "Mensaje" => "Ingrese una opcion valida"
                    ];
                    $response->getBody()->write(json_encode($newBody));
                }

            } else {

                $newBody = [
                    "Estado" => "Error",
                    "Mensaje" => "Hay parametros faltantes"
                ];

                $response->getBody()->write(json_encode($newBody));

            }

        } else if
            (
                (isset($_POST["fechaInicio"]) && $_POST["fechaInicio"] != "") &&
                (!isset($_POST["fechaFin"]) || $_POST["fechaFin"] == "")
            ){

            $ArrayDeParametros = $request->getParsedBody();

            if(isset($ArrayDeParametros['filtro'])){

                switch( mb_strtolower($ArrayDeParametros['filtro'], 'UTF-8') ){

                case "logins":
                    $logins = loginPDO::traerLogins($_POST["fechaInicio"],null);
                    $response = $response->withJson($logins, 200, JSON_UNESCAPED_UNICODE); 
                    break;
                case "operaciones":
                    $operaciones = empleadoPDO::traerOperacionesDeCadaUno($_POST["fechaInicio"],null);
                    foreach ($operaciones as $key => $value) {
                        $array[$value["email"]] = $value["cantidadIngreso"] + $value["cantidadSalida"];
                    }
                    $response = $response->withJson($array, 200, JSON_UNESCAPED_UNICODE); 
                    break;
                default:
                    $newBody = [
                        "Estado" => "Error",
                        "Mensaje" => "Ingrese una opcion valida"
                    ];
                    $response->getBody()->write(json_encode($newBody));
                }

            } else {

                $newBody = [
                    "Estado" => "Error",
                    "Mensaje" => "Hay parametros faltantes"
                ];

                $response->getBody()->write(json_encode($newBody));

            }

        } else if
            (
                (isset($_POST["fechaInicio"]) && $_POST["fechaInicio"] != "") &&
                (isset($_POST["fechaFin"]) && $_POST["fechaFin"] != "")
            ){

            $ArrayDeParametros = $request->getParsedBody();

            if(isset($ArrayDeParametros['filtro'])){

                switch( mb_strtolower($ArrayDeParametros['filtro'], 'UTF-8') ){

                case "logins":
                    $logins = loginPDO::traerLogins($_POST["fechaInicio"],$_POST["fechaFin"]);
                    $response = $response->withJson($logins, 200, JSON_UNESCAPED_UNICODE); 
                    break;
                case "operaciones":
                    $array;
                    $operaciones = empleadoPDO::traerOperacionesDeCadaUno($_POST["fechaInicio"],$_POST["fechaFin"]);
                    foreach ($operaciones as $key => $value) {
                        $array[$value["email"]] = $value["cantidadIngreso"] + $value["cantidadSalida"];
                    }
                    $response = $response->withJson($array, 200, JSON_UNESCAPED_UNICODE); 
                    break;
                default:
                    $newBody = [
                        "Estado" => "Error",
                        "Mensaje" => "Ingrese una opcion valida"
                    ];
                    $response->getBody()->write(json_encode($newBody));
                }

            } else {

                $newBody = [
                    "Estado" => "Error",
                    "Mensaje" => "Hay parametros faltantes"
                ];

                $response->getBody()->write(json_encode($newBody));

            }

        } else {

            $newBody = [
                "Estado" => "Error",
                "Mensaje" => "Error en los parametros"
            ];

            $response->getBody()->write(json_encode($newBody));

        }       

        return $response;
    }

    /**
    * @api {post} /empleados/suspension Suspension
    * @apiVersion 0.1.0
    * @apiName suspension
    * @apiGroup empleadoAPI
    * @apiDescription (Admin) Suspende a un empleado
    *
    * @apiParam {Number} id Id del empleado a suspender
    * @apiParam {String="alta","cancelar"} motivo Motivo de suspension, 'alta' dara de alta la suspension, 'cancelar', cancela la suspension
    *
    * @apiExample Como usarlo:
    *   ->post('/suspension[/]', \empleadoAPI::class . ':suspension')
    * @apiSuccessExample {json} Alta suspension exitosa:
    *     HTTP/1.1 200 OK
    *     {
    *       "Estado" => "Ok",
    *       "Mensaje" => "Empleado suspendido con exito"
    *     }
    * @apiSuccessExample {json} Cancelacion de suspension exitosa:
    *     HTTP/1.1 200 OK
    *     {
    *       "Estado" => "Ok",
    *       "Mensaje" => "Suspension de empleado cancelada con exito"
    *     }
    * @apiErrorExample Parametros erroneos:
    *     {
    *        "Estado" => "Error",
    *        "Mensaje" => "Error en los parametros"
    *     }
    * @apiErrorExample Parametros faltantes:
    *     {
    *        "Estado" => "Error",
    *        "Mensaje" => "Hay parametros faltantes"
    *     }
    */
    public function suspension($request, $response, $args)
    {
        if
            ( 
                isset($_POST["id"]) && $_POST["id"] != "" &&
                isset($_POST["motivo"]) && $_POST["motivo"] != ""
            )
        {

            $ArrayDeParametros = $request->getParsedBody();
            $id = $_POST["id"];
            $valor;

            if($_POST["motivo"] == "alta")
                $valor = 1;
            else if ($_POST["motivo"] == "cancelar")
                $valor = 0;
            else {

                $newBody = [
                    "Estado" => "Error",
                    "Mensaje" => "Error en los parametros"
                ];

                $response->getBody()->write(json_encode($newBody));

                return $response;

            }

            if(empleadoPDO::suspenderEmpleado($id, $valor) != 1){

                $newBody = [
                    "Estado" => "Error",
                    "Mensaje" => "No se pudo suspender el empleado"
                ];

                $response->getBody()->write(json_encode($newBody));

            }
            else {

                if($valor == 1){

                    $newBody = [
                        "Estado" => "Ok",
                        "Mensaje" => "Empleado suspendido con exito"
                    ];

                    $response->getBody()->write(json_encode($newBody));

                }                    
                else if($valor == 0){

                     $newBody = [
                        "Estado" => "Ok",
                        "Mensaje" => "Suspension de empleado cancelada con exito"
                    ];

                    $response->getBody()->write(json_encode($newBody));

                }
            }

        } else if
            (
                !isset($_POST["id"]) ||
                !isset($_POST["motivo"])
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
                $_POST["motivo"] == ""
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