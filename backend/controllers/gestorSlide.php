<?php
class GestorSlide {

	#SHOW IMAGE SLIDE AJAX
	#----------------------------------------------------
	public function mostrarImagenController($datos) {

		#getimagesize - Get the size og a image

		#LIST() Not really a function, is a Constructor of language, usually use for asign a list of variaables in one operation
		list($ancho, $alto) = getimagesize($datos["imagenTemporal"]);

		if ($ancho < 1600 || $alto < 600) {
			echo 0;
		}
		else {
			$aleatorio = mt_rand(100, 999);

			$ruta = "../../views/images/slide/slide".$aleatorio.".jpg";

			#imagecreatefromjpeg - Create a new image from a file or the URL
			$origen = imagecreatefromjpeg($datos["imagenTemporal"]);
			#imagecrop() - Cut image using the coordinates, X and Y, width and large of images of al data.
			$destino = imagecrop($origen, ["x"=>0, "y"=>0, "width"=>1600, "height"=>600]);
			#imagejpeg() - Export image to web browser or a file
			imagejpeg($destino, $ruta);

			GestorSlideModel::subirImagenSlideModel($ruta, "slide");

			$respuesta = GestorSlideModel::mostrarImagenSlideModel($ruta, "slide");

			$enviarDatos = array("ruta"=>$respuesta["ruta"],
													 "titulo"=>$respuesta["titulo"],
													 "descripcion"=>$respuesta["descripcion"]);

			echo json_encode($enviarDatos);
		}
	}

	#SHOW IMAGE SLIDE AJAX
	#----------------------------------------------------
	public function mostrarImagenVistaController() {
		$respuesta = GestorSlideModel::mostrarImagenVistaModel("slide");

		foreach($respuesta as $row => $item) {
			echo '<li id="'.$item["id"].'" class="bloqueSlide"><span class="fa fa-times eliminarSlide" ruta="'.$item["ruta"].'"></span><img src="'.substr($item["ruta"], 6).'" class="handleImg"></li>';
		}
	}

	#SHOW IMAGE IN THE EDITOR
	#----------------------------------------------------
	public function editorSlideController() {
		$respuesta = GestorSlideModel::mostrarImagenVistaModel("slide");

		foreach($respuesta as $row => $item) {
			echo '<li id="item'.$item["id"].'">
							<span class="fa fa-pencil editarSlide" style="background:blue"></span>
							<img src="'.substr($item["ruta"], 6).'" style="float:left; margin-bottom:10px" width="80%">
							<h1>'.$item["titulo"].'</h1>
							<p>'.$item["descripcion"].'</p>
						</li>';
		}
	}

	#DELETE IMAGE IN THE EDITOR
	#----------------------------------------------------
	public function eliminarSlideController($datos) {
		$respuesta = GestorSlideModel::eliminarSlideModel($datos, "slide");

		unlink($datos["rutaSlide"]);

		echo $respuesta;
	}
}
