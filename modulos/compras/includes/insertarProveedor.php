<?php

include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
		include_once '../../../clases/claseTabla.php';
		include_once '../clases/Proveedor.php';

		$proveedores = new Proveedor();

								 					  		if ( $proveedores->insertar($_POST)  ) {
   			echo "Proveedor " . $_POST['nombre'] . " dado de alta correctamente.";
   		} else {
   			echo "Error al dar de alta al proveedor " . $_POST['nombre'];
   		}

				?>