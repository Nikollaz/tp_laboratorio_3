<?php

include_once $_SERVER['DOCUMENT_ROOT']."/TPFinal/Src/API/PHP/Entidades/cochera.php";
include_once $_SERVER['DOCUMENT_ROOT']."/TPFinal/Src/API/PHP/SQL/AccesoDatos.php";

abstract class cocheraPDO{

	public static $cocheras = [];

	private static function cargarCocheras($desde, $hasta)
	{
		$counter = 0;

		if($desde==null && $hasta==null){

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta
			(
				 "
					SELECT c.nombre as Cochera, COUNT(v.Cochera) AS Usos
					FROM cocheras c LEFT JOIN
					vehiculos v ON c.id = v.Cochera
					GROUP BY c.id
					ORDER BY Usos DESC
				 "
			);
			$consulta->execute();			
			while($result = $consulta->fetch(PDO::FETCH_ASSOC))
			{
				self::$cocheras[$counter] = $result;
				$counter++;
			}

		} else if($desde!=null && $hasta==null){

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

			/* === TODAS LAS COCHERAS === */

			$todasLasCocheras = [];
			$counterTodasLasCocheras = 0;

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta
			(
				 "
					SELECT nombre from cocheras
				 "
			);
			$consulta->execute();			
			while($result = $consulta->fetch(PDO::FETCH_ASSOC))
			{
				$todasLasCocheras[$counterTodasLasCocheras] = $result;
				$counterTodasLasCocheras++;
			}
			/* === TODAS LAS COCHERAS === */

			/* === COCHERAS USADAS EN ESE DIA === */

			$cocherasUsadasEseDia = [];
			$counterCocherasUsadasEseDia = 0;

			$consulta = $objetoAccesoDato->RetornarConsulta
			(
				 "
					SELECT c.nombre as Cochera, COUNT(v.Cochera) AS Usos
					FROM cocheras c LEFT JOIN
					vehiculos v ON c.id = v.Cochera
					WHERE CAST(HoraDeEntrada AS DATE) = :desde
					GROUP BY c.id
					ORDER BY Usos DESC
				 "
			);
			$consulta->bindValue(':desde', $desde, PDO::PARAM_STR);	
			$consulta->execute();			
			while($result = $consulta->fetch(PDO::FETCH_ASSOC))
			{
				$cocherasUsadasEseDia[$counterCocherasUsadasEseDia] = $result;
				$counterCocherasUsadasEseDia++;
			}

			/* === COCHERAS USADAS EN ESE DIA === */

			/* === UNION DE AMBAS LISTAS === */

			foreach ($cocherasUsadasEseDia as $key => $value) {
					
				self::$cocheras[$key] = $value;
				
			}

			foreach ($todasLasCocheras as $key => $value) {

				$flag = 0;

				foreach ($cocherasUsadasEseDia as $key2 => $value2) {
					
					if($cocherasUsadasEseDia[$key2]["Cochera"] == $todasLasCocheras[$key]["nombre"]){

						$flag = 1;

					}

				}

				if($flag==0){
					
					array_push(
						self::$cocheras,
						[
						    "Cochera"=>$value["nombre"],
						    "Usos"=>0
						]
					);
					
				}

			}

			/* === UNION DE AMBAS LISTAS === */

		} else if($desde!=null && $hasta!=null){

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

			/* === TODAS LAS COCHERAS === */

			$todasLasCocheras = [];
			$counterTodasLasCocheras = 0;

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta
			(
				 "
					SELECT nombre from cocheras
				 "
			);
			$consulta->execute();			
			while($result = $consulta->fetch(PDO::FETCH_ASSOC))
			{
				$todasLasCocheras[$counterTodasLasCocheras] = $result;
				$counterTodasLasCocheras++;
			}
			/* === TODAS LAS COCHERAS === */

			/* === COCHERAS USADAS EN ESE DIA === */

			$cocherasUsadasEseDia = [];
			$counterCocherasUsadasEseDia = 0;

			$consulta =$objetoAccesoDato->RetornarConsulta
			(
				 "
					SELECT c.nombre as Cochera, COUNT(v.Cochera) AS Usos
					FROM cocheras c LEFT JOIN
					vehiculos v ON c.id = v.Cochera
					WHERE CAST(HoraDeEntrada AS DATE) BETWEEN :desde AND :hasta
					GROUP BY c.id
					ORDER BY Usos DESC
				 "
			);
			$consulta->bindValue(':desde', $desde, PDO::PARAM_STR);	
			$consulta->bindValue(':hasta', $hasta, PDO::PARAM_STR);	
			$consulta->execute();			
			while($result = $consulta->fetch(PDO::FETCH_ASSOC))
			{
				$cocherasUsadasEseDia[$counterCocherasUsadasEseDia] = $result;
				$counterCocherasUsadasEseDia++;
			}

			/* === COCHERAS USADAS EN ESE DIA === */

			/* === UNION DE AMBAS LISTAS === */

			foreach ($cocherasUsadasEseDia as $key => $value) {
					
				self::$cocheras[$key] = $value;
				
			}

			foreach ($todasLasCocheras as $key => $value) {

				$flag = 0;

				foreach ($cocherasUsadasEseDia as $key2 => $value2) {
					
					if($cocherasUsadasEseDia[$key2]["Cochera"] == $todasLasCocheras[$key]["nombre"]){

						$flag = 1;

					}

				}

				if($flag==0){
					
					array_push(
						self::$cocheras,
						[
						    "Cochera"=>$value["nombre"],
						    "Usos"=>0
						]
					);
					
				}

			}

			/* === UNION DE AMBAS LISTAS === */

		}
		
	}
	
	public static function traerMasUsados($desde, $hasta)
	{
		$cocherasMasUsadas = [];

		if( count(self::$cocheras) == 0 ){

			self::cargarCocheras($desde, $hasta);

		} 

		$max = self::$cocheras[0]["Usos"];

		foreach (self::$cocheras as $cochera) {
			
			if($cochera["Usos"] > $max){
				$max = $cochera["Usos"];
			}

		}

		foreach (self::$cocheras as $cochera) {
			
			if($cochera["Usos"] == $max){
				
				array_push($cocherasMasUsadas, $cochera);

			}

		}

		return $cocherasMasUsadas;
	}

	public static function traerMenosUsados($desde, $hasta)
	{
		$cocherasMenosUsadas = [];

		if( count(self::$cocheras) == 0 ){

			self::cargarCocheras($desde, $hasta);

		} 

		$min = self::$cocheras[0]["Usos"];

		foreach (self::$cocheras as $cochera) {
			
			if($cochera["Usos"] < $min && $cochera["Usos"] != 0){
				$min = $cochera["Usos"];
			}

		}

		foreach (self::$cocheras as $cochera) {
			
			if($cochera["Usos"] == $min){
				
				array_push($cocherasMenosUsadas, $cochera);

			}

		}

		return $cocherasMenosUsadas;
	}

	public static function traerSinUsar($desde, $hasta)
	{
		$cocherasSinUsar = [];

		if( count(self::$cocheras) == 0 ){

			self::cargarCocheras($desde, $hasta);

		}

		foreach (self::$cocheras as $cochera) {
			
			if($cochera["Usos"] == 0){
				
				array_push($cocherasSinUsar, $cochera);

			}

		}

		return $cocherasSinUsar;
	}

	public static function traerIdCocheraPorNombre($nombre)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta = $objetoAccesoDato->RetornarConsulta
		("
			SELECT id FROM cocheras WHERE nombre=:nombre
		");
		$consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
		$consulta->execute();			
		$queryResponse = $consulta->fetch(PDO::FETCH_ASSOC);
		return $queryResponse["id"];		
	}
}

?>