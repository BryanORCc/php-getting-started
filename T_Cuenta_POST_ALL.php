<?php
	require 'SQLGlobal.php';

	if($_SERVER['REQUEST_METHOD']=='POST'){
		try{
			$datos = json_decode(file_get_contents("php://input"),true);

			$Usuario = $datos["Usuario"]; // obtener parametros POST
            $Contraseña = $datos["Contraseña"];

			//$respuesta = SQLGlobal::query("QUERY");//sin filtro ("No incluir filtros ni '?'")

			$respuesta = SQLGlobal::selectArrayFiltro("SELECT * from cuenta where usuario = ? and contraseña = ?", array($Usuario,$Contraseña));

			if($respuesta>0){
                echo json_encode(array(
                    'respuesta'=>'200',
                    'estado' => 'Registro exitoso',
                    'data'=> true;
                    'error'=>''
                ));
            }else{
                echo json_encode(array(
                    'respuesta'=>'100',
                    'estado' => 'Fallo el registro',
                    'data'=> false;
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