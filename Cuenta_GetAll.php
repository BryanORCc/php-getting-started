<?php
	require 'SQLGlobal.php';

	if($_SERVER['REQUEST_METHOD']=='GET'){
		try{
			$usuario = $_GET['usuario']; // obtener parametros GET
			//$Contraseña = $_GET['Contraseña'];
			$respuesta = SQLGlobal::selectArrayFiltro("select * from cuenta where usuario = ? ", array($usuario);

            echo json_encode(array(
				'respuesta' => '200',
                'estado' => 'Se obtuvieron los datos correctamente',
                'data' => $respuesta,
                'error' => ''
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