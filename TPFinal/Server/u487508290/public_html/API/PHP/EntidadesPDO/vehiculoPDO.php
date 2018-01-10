<?php

include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/Entidades/vehiculo.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/SQL/AccesoDatos.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/EntidadesPDO/empleadoPDO.php";
include_once $_SERVER['DOCUMENT_ROOT']."/API/PHP/EntidadesPDO/cocheraPDO.php";

abstract class vehiculoPDO{

	public static function traervehiculos($desde, $hasta)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

		if($desde==null && $hasta==null){

			$consulta =$objetoAccesoDato->RetornarConsulta
			(
				 "
					SELECT 
						veh.id , 
						veh.patente, 
						veh.Color, 
						veh.Marca, 
						veh.Foto, 
						e1.email AS EmpleadoIngreso,
						veh.HoraDeEntrada,
						coch2.nombre AS Cochera,
						e2.email AS EmpleadoSalida,
						veh.HoraDeSalida,
						veh.importe,
						veh.tiempo_seg
					FROM vehiculos AS veh
					LEFT JOIN empleados AS e1 ON veh.IDEmpleadoIngreso = e1.id
					LEFT JOIN empleados AS e2 ON veh.IDEmpleadoSalida = e2.id
					LEFT JOIN cocheras AS coch2 ON coch2.id = veh.Cochera
				 "
			);

		} else if($desde!=null && $hasta==null){

			$consulta =$objetoAccesoDato->RetornarConsulta
			(
				 "
					SELECT 
						veh.id , 
						veh.patente, 
						veh.Color, 
						veh.Marca, 
						veh.Foto, 
						e1.email AS EmpleadoIngreso,
						veh.HoraDeEntrada,
						coch2.nombre AS Cochera,
						e2.email AS EmpleadoSalida,
						veh.HoraDeSalida,
						veh.importe,
						veh.tiempo_seg
					FROM vehiculos AS veh
					LEFT JOIN empleados AS e1 ON veh.IDEmpleadoIngreso = e1.id
					LEFT JOIN empleados AS e2 ON veh.IDEmpleadoSalida = e2.id
					LEFT JOIN cocheras AS coch2 ON coch2.id = veh.Cochera
                    WHERE Cast(HoraDeEntrada AS date) =:desde1 OR Cast(HoraDeSalida AS date) =:desde2
				 "
			);
			$consulta->bindValue(':desde1', $desde, PDO::PARAM_STR);
			$consulta->bindValue(':desde2', $desde, PDO::PARAM_STR);

		} else if($desde!=null && $hasta!=null){

			$consulta =$objetoAccesoDato->RetornarConsulta
			(
				 "
					SELECT 
						veh.id , 
						veh.patente, 
						veh.Color, 
						veh.Marca, 
						veh.Foto, 
						e1.email AS EmpleadoIngreso,
						veh.HoraDeEntrada,
						coch2.nombre AS Cochera,
						e2.email AS EmpleadoSalida,
						veh.HoraDeSalida,
						veh.importe,
						veh.tiempo_seg
					FROM vehiculos AS veh
					LEFT JOIN empleados AS e1 ON veh.IDEmpleadoIngreso = e1.id
					LEFT JOIN empleados AS e2 ON veh.IDEmpleadoSalida = e2.id
					LEFT JOIN cocheras AS coch2 ON coch2.id = veh.Cochera
                    WHERE CAST(HoraDeEntrada AS DATE) BETWEEN :desde1 AND :hasta1 OR
                    	CAST(HoraDeSalida AS DATE) BETWEEN :desde2 AND :hasta2
				 "
			);

			$consulta->bindValue(':desde1', $desde, PDO::PARAM_STR);
			$consulta->bindValue(':desde2', $desde, PDO::PARAM_STR);
			$consulta->bindValue(':hasta1', $hasta, PDO::PARAM_STR);
			$consulta->bindValue(':hasta2', $hasta, PDO::PARAM_STR);

		}

		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "vehiculo");		
	}

	public static function traerVehiculoPorId($id)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta = $objetoAccesoDato->RetornarConsulta
		("
			SELECT 
					veh.id , 
					veh.patente, 
					veh.Color, 
					veh.Marca, 
					veh.Foto, 
					e1.email AS EmpleadoIngreso,
					veh.HoraDeEntrada,
					coch2.nombre AS Cochera,
					e1.email AS EmpleadoSalida,
					veh.HoraDeSalida,
					veh.importe,
					veh.tiempo_seg
			FROM vehiculos AS veh
			LEFT JOIN empleados AS e1 ON veh.IDEmpleadoIngreso = e1.id
			LEFT JOIN empleados AS e2 ON veh.IDEmpleadoSalida = e2.id
			LEFT JOIN cocheras AS coch2 ON coch2.id = veh.Cochera
			WHERE veh.id=:id
		");
		$consulta->bindValue(':id', $id, PDO::PARAM_INT);	
		$consulta->execute();			
		return ($consulta->fetchAll(PDO::FETCH_CLASS, "vehiculo"))[0];	
	}

	public static function traerVehiculoPorPatente($patente)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta = $objetoAccesoDato->RetornarConsulta
		("
			SELECT 
					veh.id , 
					veh.patente, 
					veh.Color, 
					veh.Marca, 
					veh.Foto, 
					e1.email AS EmpleadoIngreso,
					veh.HoraDeEntrada,
					coch2.nombre AS Cochera,
					e1.email AS EmpleadoSalida,
					veh.HoraDeSalida,
					veh.importe,
					veh.tiempo_seg
			FROM vehiculos AS veh
			LEFT JOIN empleados AS e1 ON veh.IDEmpleadoIngreso = e1.id
			LEFT JOIN empleados AS e2 ON veh.IDEmpleadoSalida = e2.id
			LEFT JOIN cocheras AS coch2 ON coch2.id = veh.Cochera
			WHERE veh.patente=:patente
		");
		$consulta->bindValue(':patente', $patente, PDO::PARAM_STR);	
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "vehiculo");	
	}

	public static function altaVehiculo($vehiculo)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$returnValue = 1;

		$empleadoIngresoId = empleadoPDO::traerIdEmpleadoPorEmail($vehiculo->EmpleadoIngreso);
		$vehiculo->EmpleadoIngreso = $empleadoIngresoId;

		$empleadoSalidaId = empleadoPDO::traerIdEmpleadoPorEmail($vehiculo->EmpleadoSalida);
		$vehiculo->EmpleadoSalida = $empleadoSalidaId;

		$cocheraId = cocheraPDO::traerIdCocheraPorNombre($vehiculo->Cochera);
		$vehiculo->Cochera = $cocheraId;
		
		if($empleadoIngresoId == null || $empleadoSalidaId == null || $cocheraId == null){

			return 0;

		} else {

			$consulta = $objetoAccesoDato->RetornarConsulta
			(
				"
					INSERT INTO vehiculos(patente, Color, Marca, Foto, IDEmpleadoIngreso, HoraDeEntrada, Cochera, IDEmpleadoSalida, HoraDeSalida, importe, tiempo_seg)
					VALUES(:patente,:Color,:Marca,:Foto,:IDEmpleadoIngreso,:HoraDeEntrada,:Cochera,:IDEmpleadoSalida,:HoraDeSalida,:importe,:tiempo_seg)
				"
			);

			$consulta->bindValue(':patente',$vehiculo->patente, PDO::PARAM_STR);
			$consulta->bindValue(':Color',$vehiculo->Color, PDO::PARAM_STR);
			$consulta->bindValue(':Marca',$vehiculo->Marca, PDO::PARAM_STR);
			$consulta->bindValue(':Foto',$vehiculo->Foto, PDO::PARAM_STR);
			$consulta->bindValue(':IDEmpleadoIngreso',$vehiculo->EmpleadoIngreso, PDO::PARAM_INT);
			$consulta->bindValue(':HoraDeEntrada',$vehiculo->HoraDeEntrada, PDO::PARAM_STR);
			$consulta->bindValue(':Cochera',$vehiculo->Cochera, PDO::PARAM_INT);
			$consulta->bindValue(':IDEmpleadoSalida',$vehiculo->EmpleadoSalida, PDO::PARAM_INT);
			$consulta->bindValue(':HoraDeSalida',$vehiculo->HoraDeSalida, PDO::PARAM_STR);
			$consulta->bindValue(':importe',$vehiculo->importe, PDO::PARAM_STR);
			$consulta->bindValue(':tiempo_seg',$vehiculo->tiempo_seg, PDO::PARAM_STR);

			try{

				$returnValue = $consulta->execute();

			} catch (Exception $e){

				$returnValue = 0;

			}

		}

		return $returnValue;
	}

	public static function bajaVehiculo($id)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$vehiculo = vehiculoPDO::traerVehiculoPorId($id);
		if($vehiculo==null)
		    return 0;

		$consulta = $objetoAccesoDato->RetornarConsulta
		(
			"
				DELETE FROM vehiculos WHERE id=:id
			"
		);
		$consulta->bindValue(':id', $id, PDO::PARAM_INT);

		try{

			$consulta->execute();
			$returnValue = $consulta->rowCount();
			if($returnValue==1){
			    cocheraPDO::toggleOcupadoCochera($vehiculo->Cochera, 0);
			}

		} catch (Exception $e){

			$returnValue = 0;

		}

		return $returnValue;
	}

	public static function modificarVehiculo($vehiculo)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$returnValue = 1;

		$empleadoIngresoId = empleadoPDO::traerIdEmpleadoPorEmail($vehiculo->EmpleadoIngreso);
		$vehiculo->EmpleadoIngreso = $empleadoIngresoId;

		$empleadoSalidaId = empleadoPDO::traerIdEmpleadoPorEmail($vehiculo->EmpleadoSalida);
		$vehiculo->EmpleadoSalida = $empleadoSalidaId;

		$cocheraId = cocheraPDO::traerIdCocheraPorNombre($vehiculo->Cochera);
		$vehiculo->Cochera = $cocheraId;

		if($empleadoIngresoId == null || $empleadoSalidaId == null || $cocheraId == null){

			$returnValue = 0;

		} else {

			$consulta = $objetoAccesoDato->RetornarConsulta
			(
				"
					UPDATE vehiculos
					SET
						patente=:patente, 
						Color=:Color, 
						Marca=:Marca, 
						Foto=:Foto, 
						IDEmpleadoIngreso=:IDEmpleadoIngreso, 
						HoraDeEntrada=:HoraDeEntrada, 
						Cochera=:Cochera, 
						IDEmpleadoSalida=:IDEmpleadoSalida, 
						HoraDeSalida=:HoraDeSalida, 
						importe=:importe, 
						tiempo_seg=:tiempo_seg
					WHERE id=:id
				"
			);

			$consulta->bindValue(':id',$vehiculo->id, PDO::PARAM_INT);
			$consulta->bindValue(':patente',$vehiculo->patente, PDO::PARAM_STR);
			$consulta->bindValue(':Color',$vehiculo->Color, PDO::PARAM_STR);
			$consulta->bindValue(':Marca',$vehiculo->Marca, PDO::PARAM_STR);
			$consulta->bindValue(':Foto',$vehiculo->Foto, PDO::PARAM_STR);
			$consulta->bindValue(':IDEmpleadoIngreso',$vehiculo->EmpleadoIngreso, PDO::PARAM_INT);
			$consulta->bindValue(':HoraDeEntrada',$vehiculo->HoraDeEntrada, PDO::PARAM_STR);
			$consulta->bindValue(':Cochera',$vehiculo->Cochera, PDO::PARAM_INT);
			$consulta->bindValue(':IDEmpleadoSalida',$vehiculo->EmpleadoSalida, PDO::PARAM_INT);
			$consulta->bindValue(':HoraDeSalida',$vehiculo->HoraDeSalida, PDO::PARAM_STR);
			$consulta->bindValue(':importe',$vehiculo->importe, PDO::PARAM_STR);
			$consulta->bindValue(':tiempo_seg',$vehiculo->tiempo_seg, PDO::PARAM_STR);

			try{

				$returnValue = $consulta->execute();
				
			} catch (Exception $e){

				$returnValue = 0;

			}

		}

		return $returnValue;
	}

	public static function estacionadoValidation($patente)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta = $objetoAccesoDato->RetornarConsulta
		("
			SELECT 
					veh.id , 
					veh.patente, 
					veh.Color, 
					veh.Marca, 
					veh.Foto, 
					e1.email AS EmpleadoIngreso,
					veh.HoraDeEntrada,
					coch2.nombre AS Cochera,
					e1.email AS EmpleadoSalida,
					veh.HoraDeSalida,
					veh.importe,
					veh.tiempo_seg
			FROM vehiculos AS veh
			LEFT JOIN empleados AS e1 ON veh.IDEmpleadoIngreso = e1.id
			LEFT JOIN empleados AS e2 ON veh.IDEmpleadoSalida = e2.id
			LEFT JOIN cocheras AS coch2 ON coch2.id = veh.Cochera
			WHERE veh.patente=:patente AND veh.HoraDeSalida IS NULL
		");
		$consulta->bindValue(':patente', $patente, PDO::PARAM_STR);	
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "vehiculo");
	}

	public static function entrada($vehiculo)
	{
		//5- Cuando ingresa el vehículo se le toma la patente, color y marca.

		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$returnValue = 1;

		$empleadoIngresoId = empleadoPDO::traerIdEmpleadoPorEmail($vehiculo->EmpleadoIngreso);
		$vehiculo->EmpleadoIngreso = $empleadoIngresoId;

		$cocheraId = cocheraPDO::traerIdCocheraPorNombre($vehiculo->Cochera);
		$vehiculo->Cochera = $cocheraId;
		
		if( cocheraPDO::traerEstadoOcupadoCochera($vehiculo->Cochera) == 1 ){
		    
		    return 2;
		    
		}

		if($empleadoIngresoId == null || $cocheraId == null){

			return 0;

		} else {

			$consulta = $objetoAccesoDato->RetornarConsulta
			(
				"
					INSERT INTO vehiculos(patente, Color, Marca, Foto, IDEmpleadoIngreso, HoraDeEntrada, Cochera)
					VALUES(:patente,:Color,:Marca,:Foto,:IDEmpleadoIngreso,:HoraDeEntrada,:Cochera)
				"
			);

			$consulta->bindValue(':patente',$vehiculo->patente, PDO::PARAM_STR);
			$consulta->bindValue(':Color',$vehiculo->Color, PDO::PARAM_STR);
			$consulta->bindValue(':Marca',$vehiculo->Marca, PDO::PARAM_STR);
			$consulta->bindValue(':Foto',$vehiculo->Foto, PDO::PARAM_STR);
			$consulta->bindValue(':IDEmpleadoIngreso',$vehiculo->EmpleadoIngreso, PDO::PARAM_INT);
			$consulta->bindValue(':HoraDeEntrada',$vehiculo->HoraDeEntrada, PDO::PARAM_STR);
			$consulta->bindValue(':Cochera',$vehiculo->Cochera, PDO::PARAM_INT);

			try{

				$returnValue = $consulta->execute();

				cocheraPDO::toggleOcupadoCochera($vehiculo->Cochera, 1);
            
			} catch (Exception $e){

				$returnValue = 0;

			}

		}

		return $returnValue;
	}

	public static function salida($vehiculo)
	{
		//6-Cuando sale el vehículo se ingresa la patente y se muestran los datos del vehículo con el importe a pagar.
		
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$returnValue = 1;

		$empleadoSalidaId = empleadoPDO::traerIdEmpleadoPorEmail($vehiculo->EmpleadoSalida);
		$vehiculo->EmpleadoSalida = $empleadoSalidaId;
		
		if($empleadoSalidaId == null){

			$returnValue = 0;

		} else {

			$consulta = $objetoAccesoDato->RetornarConsulta
			(
				"
					UPDATE vehiculos
					SET
						IDEmpleadoSalida=:IDEmpleadoSalida, 
						HoraDeSalida=:HoraDeSalida, 
						importe=:importe, 
						tiempo_seg=:tiempo_seg
					WHERE patente=:patente
				"
			);

			$consulta->bindValue(':patente',$vehiculo->patente, PDO::PARAM_STR);

			$consulta->bindValue(':IDEmpleadoSalida',$vehiculo->EmpleadoSalida, PDO::PARAM_INT);
			$consulta->bindValue(':HoraDeSalida',$vehiculo->HoraDeSalida, PDO::PARAM_STR);
			$consulta->bindValue(':importe',$vehiculo->importe, PDO::PARAM_STR);
			$consulta->bindValue(':tiempo_seg',$vehiculo->tiempo_seg, PDO::PARAM_INT);

			try{

				$returnValue = $consulta->execute();
				
				cocheraPDO::toggleOcupadoCochera($vehiculo->Cochera, 0);
				
			} catch (Exception $e){

				$returnValue = 0;

			}

		}

		return $returnValue;

	}
}

?>