<?php

include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/Entidades/cochera.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/Interfaces/IApiUsable.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/EntidadesPDO/cocheraPDO.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/Utils/JSONToCSV.php";

class cocheraAPI extends cochera{

    /**
    * @api {post} /cocheras Busqueda
    * @apiVersion 0.1.0
    * @apiName busqueda
    * @apiGroup cocheraAPI
    * @apiDescription Trae las cocheras mas usadas, menos usadas, y sin usar desde siempre o de una fecha/rango de fechas determinado
    *
    * @apiParam {Date} [fechaInicio] Opcional, filtro de fecha, si no se especifica "fechaFin", se filtra por esta fecha solamente. Formato 'yyyy/MM/dd'
    * @apiParam {Date} [fechaFin] Opcional, filtro de fecha, si se especifica, se filtra en el rango entre fechaInicio y este. Formato 'yyyy/MM/dd'
    *
    * @apiExample Como usarlo:
    *   ->post('[/]', \cocheraAPI::class . ':busqueda')
    * @apiSuccess {Object[]} MasUsados Un array con el nombre y cantidad de las cocheras mas usadas
    * @apiSuccess {Object[]} MenosUsados Un array con el nombre y cantidad de las cocheras menos usadas
    * @apiSuccess {Object[]} SinUsar Un array con el nombre y cantidad de las cocheras sin usar
    * @apiErrorExample Parametros erroneos:
    *     {
    *        "Estado" => "Error",
    *        "Mensaje" => "Error en los parametros"
    *     }
    */
    public function busqueda($request, $response, $args)
    {   

        if
            ( 
                (!isset($_POST["fechaInicio"]) || $_POST["fechaInicio"] == "") &&
                (!isset($_POST["fechaFin"]) || $_POST["fechaFin"] == "")
            ){

            $cocherasMasUsadas = cocheraPDO::traerMasUsados(null,null);
        
            $cocherasMenosUsadas = cocheraPDO::traerMenosUsados(null,null);
           
            $cocherasSinUsar = cocheraPDO::traerSinUsar(null,null);

            $newBody = [
                "Mas usadas" => $cocherasMasUsadas,
                "Menos usadas" => $cocherasMenosUsadas,
                "Sin usar" => $cocherasSinUsar
            ];

            $response->getBody()->write(json_encode($newBody)); 

        } else if
            (
                (isset($_POST["fechaInicio"]) && $_POST["fechaInicio"] != "") &&
                (!isset($_POST["fechaFin"]) || $_POST["fechaFin"] == "")
            ){

            $cocherasMasUsadas = cocheraPDO::traerMasUsados($_POST["fechaInicio"],null);
        
            $cocherasMenosUsadas = cocheraPDO::traerMenosUsados($_POST["fechaInicio"],null);
           
            $cocherasSinUsar = cocheraPDO::traerSinUsar($_POST["fechaInicio"],null);

            $newBody = [
                "Mas usadas" => $cocherasMasUsadas,
                "Menos usadas" => $cocherasMenosUsadas,
                "Sin usar" => $cocherasSinUsar
            ];

            $response->getBody()->write(json_encode($newBody)); 

        } else if
            (
                (isset($_POST["fechaInicio"]) && $_POST["fechaInicio"] != "") &&
                (isset($_POST["fechaFin"]) && $_POST["fechaFin"] != "")
            ){

            $cocherasMasUsadas = cocheraPDO::traerMasUsados($_POST["fechaInicio"],$_POST["fechaFin"]);
        
            $cocherasMenosUsadas = cocheraPDO::traerMenosUsados($_POST["fechaInicio"],$_POST["fechaFin"]);
           
            $cocherasSinUsar = cocheraPDO::traerSinUsar($_POST["fechaInicio"],$_POST["fechaFin"]);

            $newBody = [
                "Mas usadas" => $cocherasMasUsadas,
                "Menos usadas" => $cocherasMenosUsadas,
                "Sin usar" => $cocherasSinUsar
            ];

            $response->getBody()->write(json_encode($newBody)); 

        } else {

            $newBody = [
                "Estado" => "Error",
                "Mensaje" => "Error en los parametros"
            ];

            $response->getBody()->write(json_encode($newBody));

        }
        
        return $response;
        
    }

}




?>