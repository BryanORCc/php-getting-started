<?php
	require 'SQLGlobal.php';

	if($_SERVER['REQUEST_METHOD']=='POST'){
		try{
			$datos = json_decode(file_get_contents("php://input"),true);
            $VehiculoId = $datos["VehiculoId"];
            $TipoVehiculo = $datos["TipoVehiculo"];
            $FotoVehiculo = $datos["FotoVehiculo"];
            $MarcaVehiculo = $datos["MarcaVehiculo"];
            $ModeloVehiculo = $datos["ModeloVehiculo"];
			$respuesta = SQLGlobal::cudFiltro("INSERT into T_Vehiculo values (?,?,?,?,?)",array($VehiculoId, $TipoVehiculo, $FotoVehiculo, $MarcaVehiculo, $ModeloVehiculo));

			echo json_encode(array(
				'respuesta'=>'200',
				'estado' => 'Se obtuvieron los datos correctamente',
				'data'=>$respuesta,
				'error'=>''
			));
		}catch(PDOException $e){
			echo json_encode(
				array(
					'respuesta'=>'-1',
					'estado' => 'Ocurrio un error, intentelo mas tarde',
					'data'=>'',
					'error'=>$e->getMessage())
			);
		}
	}

?>