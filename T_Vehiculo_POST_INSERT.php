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

            if($respuesta>0){
                echo json_encode(array(
                    'respuesta'=>'200',
                    'estado' => 'Registro exitoso',
                    'data'=> 'El numero de registros afectados es: '.$respuesta,
                    'error'=>''
                ));
            }else{
                echo json_encode(array(
                    'respuesta'=>'100',
                    'estado' => 'Fallo el registro',
                    'data'=> 'El numero de registros afectados es: '.$respuesta,
                    'error'=>''
                ));
            }

			
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