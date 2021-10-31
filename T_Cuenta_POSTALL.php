<?php
	require 'SQLGlobal.php';

	if($_SERVER['REQUEST_METHOD']=='POST'){
		try{
			$datos = json_decode(file_get_contents("php://input"),true);

			$Usuario = $datos["Usuario"]; // obtener parametros POST
            $Contraseña = $datos["Contraseña"];

			//$respuesta = SQLGlobal::query("QUERY");//sin filtro ("No incluir filtros ni '?'")

			$respuesta = SQLGlobal::selectArrayFiltro("SELECT * from cuenta where usuario = ? and contraseña = ?", array($Usuario,$Contraseña));

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