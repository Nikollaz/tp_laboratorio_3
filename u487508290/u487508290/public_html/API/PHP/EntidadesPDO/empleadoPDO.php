<?php

include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/Entidades/empleado.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/SQL/AccesoDatos.php";

abstract class empleadoPDO{

	public static function traerEmpleados()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta
		(
			 "
				SELECT emp.id , emp.email, emp.password, turnos.nombre as turno, sexos.nombre as sexo, perfiles.nombre as perfil, emp.suspendido
				FROM empleados AS emp
				INNER JOIN turnos ON turnos.id = emp.turno
				INNER JOIN sexos ON sexos.id = emp.sexo
				INNER JOIN perfiles ON perfiles.id = emp.perfil
			 "
		);
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "empleado");		
	}

	public static function traerEmpleadoPorId($id)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta = $objetoAccesoDato->RetornarConsulta
		("
			SELECT * FROM empleados WHERE id=:id
		");
		$consulta->bindValue(':id', $id, PDO::PARAM_INT);	
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "empleado");		
	}

	public static function altaEmpleado($empleado)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$returnValue = 1;

		switch(mb_strtolower($empleado->turno, 'UTF-8')){
			case "mañana":
				$empleado->turno = "1";
				break;
			case "tarde":			
				$empleado->turno = "2";
				break;
			case "noche":				
				$empleado->turno = "3";
				break;
		}

		switch(mb_strtolower($empleado->sexo, 'UTF-8')){
			case "masculino":
				$empleado->sexo = "1";
				break;
			case "femenino":			
				$empleado->sexo = "2";
				break;
		}

		switch(mb_strtolower($empleado->perfil, 'UTF-8')){
			case "user":
				$empleado->perfil = "1";
				break;
			case "admin":			
				$empleado->perfil = "2";
				break;
		}

		$consulta = $objetoAccesoDato->RetornarConsulta
		(
			"
				INSERT INTO empleados(email, password, turno, sexo, perfil)
				VALUES(:email,:password,:turno,:sexo,:perfil)
			"
		);

		$consulta->bindValue(':email',$empleado->email, PDO::PARAM_STR);
		$consulta->bindValue(':password', $empleado->password, PDO::PARAM_STR);
		$consulta->bindValue(':turno', $empleado->turno, PDO::PARAM_STR);
		$consulta->bindValue(':sexo', $empleado->sexo, PDO::PARAM_STR);
		$consulta->bindValue(':perfil', $empleado->perfil, PDO::PARAM_STR);	

		try{

			$returnValue = $consulta->execute();

		} catch (Exception $e){

			$returnValue = 0;

		}

		return $returnValue;
	}

	public static function bajaEmpleado($id)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 

		$consulta = $objetoAccesoDato->RetornarConsulta
		(
			"
				DELETE FROM empleados WHERE id=:id
			"
		);
		$consulta->bindValue(':id', $id, PDO::PARAM_INT);

		try{

			$consulta->execute();
			$returnValue = $consulta->rowCount();

		} catch (Exception $e){

			$returnValue = 0;

		}

		return $returnValue;
	}

	public static function modificarEmpleado($empleado)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$returnValue = 1;

		switch(mb_strtolower($empleado->turno, 'UTF-8')){
			case "mañana":
				$empleado->turno = "1";
				break;
			case "tarde":			
				$empleado->turno = "2";
				break;
			case "noche":				
				$empleado->turno = "3";
				break;
		}

		switch(mb_strtolower($empleado->sexo, 'UTF-8')){
			case "masculino":
				$empleado->sexo = "1";
				break;
			case "femenino":			
				$empleado->sexo = "2";
				break;
		}

		switch(mb_strtolower($empleado->perfil, 'UTF-8')){
			case "user":
				$empleado->perfil = "1";
				break;
			case "admin":			
				$empleado->perfil = "2";
				break;
		}

		$consulta = $objetoAccesoDato->RetornarConsulta
		(
			"
				UPDATE empleados
				SET 
					email=:email, 
					password=:password, 
					turno=:turno, 
					sexo=:sexo, 
					perfil=:perfil
				WHERE id=:id
			"
		);

		$consulta->bindValue(':email',$empleado->email, PDO::PARAM_STR);
		$consulta->bindValue(':password', $empleado->password, PDO::PARAM_STR);
		$consulta->bindValue(':turno', $empleado->turno, PDO::PARAM_STR);
		$consulta->bindValue(':sexo', $empleado->sexo, PDO::PARAM_STR);
		$consulta->bindValue(':perfil', $empleado->perfil, PDO::PARAM_STR);
		$consulta->bindValue(':id', $empleado->id, PDO::PARAM_INT);	

		try{

			$consulta->execute();
			$returnValue = $consulta->rowCount();

		} catch (Exception $e){

			$returnValue = 0;

		}

		return $returnValue;
	}

	public static function traerEmpleadoPorEmailYPassword($email,$password)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta = $objetoAccesoDato->RetornarConsulta
		("
			SELECT id FROM empleados WHERE email=:email AND password=:password
		");
		$consulta->bindValue(':email', $email, PDO::PARAM_STR);
		$consulta->bindValue(':password', $password, PDO::PARAM_STR);	
		$consulta->execute();			
		$queryResponse = $consulta->fetch(PDO::FETCH_ASSOC);
		return $queryResponse["id"];		
	}

	public static function traerOperacionesDeCadaUno($desde, $hasta)
	{
		$counter = 0;
		$operacionesPorEmpleado = [];

		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 

		if($desde==null && $hasta==null){

			$consulta =$objetoAccesoDato->RetornarConsulta
			(
				"
					SELECT emp.email, 
					( CASE WHEN Isnull(ingreso.countentrada) THEN 0 ELSE ingreso.countentrada end ) cantidadIngreso, 
					( CASE WHEN Isnull(salida.countsalida) THEN 0 ELSE salida.countsalida end ) cantidadSalida 
					FROM empleados AS emp 
						LEFT JOIN
					    		(
					        		SELECT idempleadoingreso, 
					              	Count(horadeentrada) AS countEntrada 
					             	FROM `vehiculos`
					              	GROUP BY idempleadoingreso
								) AS ingreso ON emp.id = ingreso.idempleadoingreso 
					    LEFT JOIN
					    		(
					                SELECT idempleadosalida, 
					                Count(horadesalida) AS countSalida 
					                FROM `vehiculos`
					                GROUP BY idempleadosalida
					            ) AS salida ON emp.id = salida.idempleadosalida
				"
			);

			$consulta->execute();			
			while($result = $consulta->fetch(PDO::FETCH_ASSOC))
			{
				$operacionesPorEmpleado[$counter] = $result;
				$counter++;
			}

		} else if($desde!=null && $hasta==null) {

			$consulta =$objetoAccesoDato->RetornarConsulta
			(
				"
					SELECT emp.email, 
					( CASE WHEN Isnull(ingreso.countentrada) THEN 0 ELSE ingreso.countentrada end ) cantidadIngreso, 
					( CASE WHEN Isnull(salida.countsalida) THEN 0 ELSE salida.countsalida end ) cantidadSalida 
					FROM empleados AS emp 
						LEFT JOIN
					    		(
					        		SELECT idempleadoingreso, 
					              	Count(horadeentrada) AS countEntrada 
					             	FROM `vehiculos`
					                WHERE Cast(horadeentrada AS date) =:desde1 
					              	GROUP BY idempleadoingreso                
								) AS ingreso ON emp.id = ingreso.idempleadoingreso 
					    LEFT JOIN
					    		(
					                SELECT idempleadosalida, 
					                Count(horadesalida) AS countSalida 
					                FROM `vehiculos`
					                WHERE  Cast(horadesalida AS date) =:desde2
					                GROUP BY idempleadosalida
					                
					            ) AS salida ON emp.id = salida.idempleadosalida
				"
			);

			try{

				$consulta->bindValue(':desde1', $desde, PDO::PARAM_STR);
				$consulta->bindValue(':desde2', $desde, PDO::PARAM_STR);	
				$consulta->execute();

			} catch (Exception $e){

				print($e->getMessage());

			}

			while($result = $consulta->fetch(PDO::FETCH_ASSOC))
			{
				$operacionesPorEmpleado[$counter] = $result;
				$counter++;
			}

		} else if($desde!=null && $hasta!=null) {

			$consulta =$objetoAccesoDato->RetornarConsulta
			(
				"
					SELECT emp.email, 
					( CASE WHEN Isnull(ingreso.countentrada) THEN 0 ELSE ingreso.countentrada end ) cantidadIngreso, 
					( CASE WHEN Isnull(salida.countsalida) THEN 0 ELSE salida.countsalida end ) cantidadSalida 
					FROM empleados AS emp 
						LEFT JOIN
					    		(
					        		SELECT idempleadoingreso, 
					              	Count(horadeentrada) AS countEntrada 
					             	FROM `vehiculos`
					                WHERE CAST(HoraDeEntrada AS DATE) BETWEEN :desde1 AND :hasta1
					              	GROUP BY idempleadoingreso                
								) AS ingreso ON emp.id = ingreso.idempleadoingreso 
					    LEFT JOIN
					    		(
					                SELECT idempleadosalida, 
					                Count(horadesalida) AS countSalida 
					                FROM `vehiculos`
					                WHERE CAST(horadesalida AS DATE) BETWEEN :desde2 AND :hasta2
					                GROUP BY idempleadosalida
					                
					            ) AS salida ON emp.id = salida.idempleadosalida
				"
			);

			try{

				$consulta->bindValue(':desde1', $desde, PDO::PARAM_STR);
				$consulta->bindValue(':desde2', $desde, PDO::PARAM_STR);
				$consulta->bindValue(':hasta1', $hasta, PDO::PARAM_STR);
				$consulta->bindValue(':hasta2', $hasta, PDO::PARAM_STR);		
				$consulta->execute();

			} catch (Exception $e){

				print($e->getMessage());

			}

			while($result = $consulta->fetch(PDO::FETCH_ASSOC))
			{
				$operacionesPorEmpleado[$counter] = $result;
				$counter++;
			}

		}

		return $operacionesPorEmpleado;
	}

	public static function suspenderEmpleado($id, $valor)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 

		$consulta = $objetoAccesoDato->RetornarConsulta
		(
			"
				UPDATE empleados
				SET 
					suspendido=:valor
				WHERE id=:id
			"
		);
		$consulta->bindValue(':id', $id, PDO::PARAM_INT);
		$consulta->bindValue(':valor', $valor, PDO::PARAM_INT);

		try{

			$consulta->execute();
			$returnValue = $consulta->rowCount();

		} catch (Exception $e){

			$returnValue = 0;

		}

		return $returnValue;
	}

	public static function traerIdEmpleadoPorEmail($email)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta = $objetoAccesoDato->RetornarConsulta
		("
			SELECT id FROM empleados WHERE email=:email
		");
		$consulta->bindValue(':email', $email, PDO::PARAM_STR);
		$consulta->execute();			
		$queryResponse = $consulta->fetch(PDO::FETCH_ASSOC);
		return $queryResponse["id"];		
	}

	/* ============================================================================================================== */

	public static function empleadoValidation($email, $password)
	{
		$returnValue = 0;

		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta =$objetoAccesoDato->RetornarConsulta
		(
			 "
				SELECT id FROM empleados WHERE email=:email AND password=:password
			 "
		);
		$consulta->bindValue(':email', $email, PDO::PARAM_STR);
		$consulta->bindValue(':password', $password, PDO::PARAM_STR);	
		$consulta->execute();

		return $consulta->rowCount();
	}

}

?>