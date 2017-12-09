<?php

	include("conexion.php");
	
	$fecha = date("Y-m-d H:i:s");
	
	$agregar = "INSERT INTO formulario_contacto
				VALUES(
					NULL,
					'$nombre',
					'$apellido',
					'$email',
					'$mensaje',
					'$fecha'
				)";

	$ej_agregar = mysqli_query($conexion, $agregar);
	
	if($ej_agregar == false){
            echo'<div class="alert alert-danger alert-dismissible formulario-ms" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>ERROR EN BASE DE DATOS</strong><br></strong>
            </div>'; 
	}
?>




