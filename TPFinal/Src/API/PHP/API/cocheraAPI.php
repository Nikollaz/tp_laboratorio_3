<?php

include_once $_SERVER['DOCUMENT_ROOT']."/TPFinal/Src/API/PHP/Entidades/cochera.php";
include_once $_SERVER['DOCUMENT_ROOT']."/TPFinal/Src/API/PHP/Interfaces/IApiUsable.php";
include_once $_SERVER['DOCUMENT_ROOT']."/TPFinal/Src/API/PHP/EntidadesPDO/cocheraPDO.php";

class cocheraAPI extends cochera{

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