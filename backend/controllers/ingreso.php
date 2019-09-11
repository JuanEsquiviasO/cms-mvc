<?php

class Ingreso {
	public function ingresoController() {

		if(isset($_POST["usuarioIngreso"])) {

			if ( preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuarioIngreso"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["passwordIngreso"]) ) {

				#$encriptar = crypt($_POST["passwordIngreso"], '$2a$09$anexamplestringforsaleLouKejcjRlExmf1671qw3Khl49R3dfu');

				$datosController = array("usuario"=>$_POST["usuarioIngreso"], "password"=>$_POST["passwordIngreso"]);
				$respuesta = IngresoModels::ingresoModel($datosController, "usuarios");

				$intentos = $respuesta["intentos"];
				$usuarioActual = $_POST["usuarioIngreso"];
				$maximoIntentos = 2;

				if ($intentos < $maximoIntentos) {

					if($respuesta["usuario"] == $_POST["usuarioIngreso"] && $respuesta["password"] == $_POST["passwordIngreso"]) {

						$intentos = 0;
						$datosController = array("usuarioActual"=>$usuarioActual, "actualizarIntentos"=>$intentos);
						$respuestaActualizarIntentos = IngresoModels::intentosModel($datosController, "usuarios");

						session_start();

						$_SESSION["validar"] = true;
						$_SESSION["usuario"] = $respuesta["usuario"];

						header("location:inicio");
					}
					else {
						++$intentos;
						$datosController = array("usuarioActual"=>$usuarioActual, "actualizarIntentos"=>$intentos);
						$respuestaActualizarIntentos = IngresoModels::intentosModel($datosController, "usuarios");
						echo '<div class="alert alert-danger">Error al ingresar</div>';
					}
				}

				else {
					$intentos = 0;
					$datosController = array("usuarioActual"=>$usuarioActual, "actualizarIntentos"=>$intentos);
					$respuestaActualizarIntentos = IngresoModels::intentosModel($datosController, "usuarios");

					echo '<div class="alert alert-danger">Ha fallado 03 veces al intentar ingresar, demuestre que no es un robot.</div>';
				}
			}
		}

	}
}
