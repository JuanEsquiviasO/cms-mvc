<?php
class GestorSlide {

	public function mostrarImagenController($datos) {

		list($ancho, $alto) = getimagesize($datos["imagenTemporal"]);

		if ($ancho < 1600 || $alto < 600) {
			echo 0;
		}
		else {
			$aleatorio = mt_rand(100, 999);

			$ruta = "../../views/images/slide/slide".$aleatorio.".jpg";
			$origen = imagecreatefromjpeg($datos["imagenTemporal"]);

			imagejpeg($origen, $ruta);

			GestorSlideModel::subirImagenSlideModel($ruta, "slide");

			$respuesta = GestorSlideModel::mostrarImagenSlideModel($ruta, "slide");

			$enviarDatos = array("ruta"=>$respuesta["ruta"]);

			echo json_encode($enviarDatos);
		}
	}
}
