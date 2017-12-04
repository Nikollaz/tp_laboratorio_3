<?php

include_once $_SERVER['DOCUMENT_ROOT']."/TPFinal/Src/API/PHP/Entidades/login.php";
include_once $_SERVER['DOCUMENT_ROOT']."/TPFinal/Src/API/PHP/Interfaces/IApiUsable.php";
include_once $_SERVER['DOCUMENT_ROOT']."/TPFinal/Src/API/PHP/EntidadesPDO/loginPDO.php";

class loginAPI extends login implements IApiUsable{

    public function TraerTodos($request, $response, $args)
    {
        $logins = loginPDO::traerLogins();
        $newResponse = $response->withJson($logins, 200, JSON_UNESCAPED_UNICODE);  
        return $newResponse;
    }

    public function TraerUno($request, $response, $args)
    {
        $idEmpleado = $args['idEmpleado'];
        $logins = loginPDO::traerLoginsDeEmpleado($idEmpleado);
        $newResponse = $response->withJson($logins, 200);  
        return $newResponse;
    }

    public function CargarUno($request, $response, $args)
    { 
        if( !isset($_POST["email"]) || !isset($_POST["password"]) ){

            $newBody = [
                "Estado" => "Error",
                "Mensaje" => "Los parametros de email y password son obligatorios"
            ];

            $response->getBody()->write(json_encode($newBody));

        } else {

            if
                ( 
                    $_POST["email"] == "" || 
                    $_POST["email"] == null ||
                    $_POST["password"] == "" || 
                    $_POST["password"] == null 
                )
            {
                $newBody = [
                    "Estado" => "Error",
                    "Mensaje" => "Los parametros de email y password no pueden estar vacios"
                ];

                $response->getBody()->write(json_encode($newBody));

            }

            else

            {
                $ArrayDeParametros = $request->getParsedBody();

                $email= $ArrayDeParametros['email'];
                $password= $ArrayDeParametros['password'];
                $PDOresponse = empleadoPDO::empleadoValidation($email,$password);

                if ($PDOresponse != 0) {

                    if(loginPDO::nuevoLogin($ArrayDeParametros["email"],$ArrayDeParametros["password"]) != 0)
                    {

                        $idUser = empleadoPDO::traerEmpleadoPorEmailYPassword($email,$password);

                        $user = empleadoPDO::traerEmpleadoPorId($idUser);
                        $profile;

                        if($user[0]->perfil == 2){
                            $profile = "admin";
                        } else {
                            $profile = "user";
                        }

                        $newUser = [
                            "email" => $user[0]->email,
                            "perfil" => $profile
                        ];

                        $newBody = [
                            "SessionToken" => validationAPI::CrearToken($newUser)
                        ];

                        $response->getBody()->write(json_encode($newBody));

                    } else {

                        $newBody = [
                            "Estado" => "Error",
                            "Mensaje" => "Ocurrio un error al intentar logearse"
                        ];

                        $response->getBody()->write(json_encode($newBody));

                    }

                } else {

                    $newBody = [
                        "Estado" => "Error",
                        "Mensaje" => "Datos incorrectos"
                    ];

                    $response->getBody()->write(json_encode($newBody));
                    
                }

            }

        }
        
        return $response;
       
    }

    public function BorrarUno($request, $response, $args){ }

    public function ModificarUno($request, $response, $args){ }

}




?>