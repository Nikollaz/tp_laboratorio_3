<?php

include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/Entidades/empleado.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/Interfaces/IApiUsable.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/EntidadesPDO/empleadoPDO.php";

class empleadoAPI extends empleado implements IApiUsable{

    public function TraerTodos($request, $response, $args)
    {
        $empleados = empleadoPDO::traerEmpleados();
        $response = $response->withJson($empleados, 200, JSON_UNESCAPED_UNICODE);  
        return $response;
    }

    public function TraerUno($request, $response, $args)
    {
        $id = $args['id'];
        $empleado = empleadoPDO::traerEmpleadoPorId($id);
        $response = $response->withJson($empleado, 200);  
        return $response;
    }

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