<?php

include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/Entidades/empleado.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/SQL/AccesoDatos.php";

abstract class loginPDO{

	public static function traerLogins($desde,$hasta)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 

		if($desde==null && $hasta==null){

			$consulta = $objetoAccesoDato->RetornarConsulta
			(
				 "
					SELECT log.id , empleados.email as empleado, log.fecha
					FROM logueos AS log
					INNER JOIN empleados ON empleados.id = log.empleado
				 "
			);
			

		} else if($desde!=null && $hasta==null){

			$consulta = $objetoAccesoDato->RetornarConsulta
			(
				 "
					SELECT log.id , empleados.email as empleado, log.fecha
					FROM logueos AS log
					INNER JOIN empleados ON empleados.id = log.empleado
					WHERE CAST(log.fecha AS DATE) = :desde
				 "
			);
			$consulta->bindValue(':desde', $desde, PDO::PARAM_STR);	

		} else if($desde!=null && $hasta!=null){

			$consulta = $objetoAccesoDato->RetornarConsulta
			(
				 "
					SELECT log.id , empleados.email as empleado, log.fecha
					FROM logueos AS log
					INNER JOIN empleados ON empleados.id = log.empleado
					WHERE CAST(log.fecha AS DATE) BETWEEN :desde AND :hasta
				 "
			);
			$consulta->bindValue(':desde', $desde, PDO::PARAM_STR);
			$consulta->bindValue(':hasta', $hasta, PDO::PARAM_STR);

		}

		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "login");	
		
	}

	public static function traerLoginsDeEmpleado($id)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta = $objetoAccesoDato->RetornarConsulta
		(
			"
				SELECT * FROM logueos WHERE empleado=:id
			"
		);
		$consulta->bindValue(':id', $id, PDO::PARAM_INT);	
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "login");
	}

	public static function nuevoLogin($email ,$password)
	{
		$idEmpleado = empleadoPDO::traerEmpleadoPorEmailYPassword($email, $password);
		$returnValue = 1;
		date_default_timezone_set('America/Argentina/Buenos_Aires');

		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $objetoAccesoDato->RetornarConsulta
		(
			"
				INSERT INTO logueos(empleado, fecha) VALUES (:idEmpleado,:time)
			"
		);
		$consulta->bindValue(':idEmpleado', $idEmpleado, PDO::PARAM_INT);
		$consulta->bindValue(':time', date("Y-m-d H:i:s"), PDO::PARAM_INT);
		try{

			$returnValue = $consulta->execute();

		} catch (Exception $e){

			$returnValue = 0;

		}

		return $returnValue;
	}

}

?>