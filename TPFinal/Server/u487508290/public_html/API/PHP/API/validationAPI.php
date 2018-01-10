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

    /**
   * @api {any} /usuarioLogeadoValidationMiddleware/  usuarioLogeadoValidationMiddleware
   * @apiVersion 0.1.0
   * @apiName usuarioLogeadoValidationMiddleware
   * @apiGroup MIDDLEWARE
   * @apiDescription  Por medio de este MiddleWare valido que el contenido de los servicios solamente pueda ser visto por un usuario logeado
   *
   * @apiParam {ServerRequestInterface} request  El objeto REQUEST.
 * @apiParam {ResponseInterface} response El objeto RESPONSE.
 * @apiParam {Callable} next The next middleware callable.
   *
   * @apiExample Como usarlo:
   *   ->add(\validationAPI::class . ':usuarioLogeadoValidationMiddleware')
   */
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

    /**
   * @api {any} /adminValidationMiddleware/  adminValidationMiddleware
   * @apiVersion 0.1.0
   * @apiName adminValidationMiddleware
   * @apiGroup MIDDLEWARE
   * @apiDescription  Por medio de este MiddleWare valido que el contenido de los servicios solamente pueda ser visto por un admin
   *
   * @apiParam {ServerRequestInterface} request  El objeto REQUEST.
 * @apiParam {ResponseInterface} response El objeto RESPONSE.
 * @apiParam {Callable} next The next middleware callable.
   *
   * @apiExample Como usarlo:
   *   ->add(\validationAPI::class . ':adminValidationMiddleware')
   */
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