<?php

include_once $_SERVER['DOCUMENT_ROOT']."/API/composer/vendor/autoload.php";
use Firebase\JWT\JWT;

class validationAPI{

    private static $key = 'd10928dh1290d7fg10fg3bd1862df218';
    private static $tipoEncriptacion = ['HS256'];
    private static $aud = null;

    public static function CrearToken($datos)
    {
        $ahora = time();
        $payload = array(
            'exp' => $ahora + (86400), //Dura 24hs
            'data' => $datos
        );
     
        return JWT::encode($payload, self::$key);
    }

    public function usuarioLogeadoValidationMiddleware($request, $response, $next) {

       if ($request->hasHeader('SessionToken')){

            $token = $request->getHeader('SessionToken');

            try{

                $info = JWT::decode( $token[0], self::$key, self::$tipoEncriptacion );

                if($info->data->perfil == "admin" || $info->data->perfil == "user"){

                    $response = $next($request, $response);

                } else {

                    $newBody = [
                        "Estado" => "Error",
                        "Mensaje" => "Permisos insuficientes"
                    ];

                    $response->getBody()->write(json_encode($newBody));

                }

            } catch (Exception $e) {
                var_dump();
                $newBody = [
                    "Estado" => "Error",
                    "Mensaje" => "Debe estar logeado para ver este contenido"
                ];

                $response->getBody()->write(json_encode($newBody));

            }

        } else {

            $newBody = [
                "Estado" => "Error",
                "Mensaje" => "Debe estar logeado para ver este contenido"
            ];

            $response->getBody()->write(json_encode($newBody));

        }

        return $response;

    }

    public function adminValidationMiddleware($request, $response, $next) {

        if ($request->hasHeader('SessionToken')){

            $token = $request->getHeader('SessionToken');

            try{

                $info = JWT::decode( $token[0], self::$key, self::$tipoEncriptacion );

                if($info->data->perfil == "admin"){

                    $response = $next($request, $response);

                } else {

                    $newBody = [
                        "Estado" => "Error",
                        "Mensaje" => "Permisos insuficientes"
                    ];

                    $response->getBody()->write(json_encode($newBody));

                }

            } catch (Exception $e) {
                
                $newBody = [
                    "Estado" => "Error",
                    "Mensaje" => "Debe estar logeado para ver este contenido"
                ];

                $response->getBody()->write(json_encode($newBody));

            }

        } else {

            $newBody = [
                "Estado" => "Error",
                "Mensaje" => "Debe estar logeado para ver este contenido"
            ];

            $response->getBody()->write(json_encode($newBody));

        }

        return $response;

    }

    public static function traerDatosDeToken($request, $response, $args){

        $token = $request->getHeader('SessionToken');

        $info = JWT::decode( $token[0], self::$key, self::$tipoEncriptacion );

        return $info;
    }

}

?>