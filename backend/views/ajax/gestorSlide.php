<?php
require_once "../../models/gestorSlide.php";
require_once "../../controllers/gestorSlide.php";

class Ajax {

	public $nombreImagen;
	public $imagenTemporal;

	public function gestorSlideAjax() {
		$datos  = array("nombreImagen"=>$this->nombreImagen,
										"imagenTemporal"=>$this->imagenTemporal);

		$respuesta = GestorSlide::mostrarImagenController($datos);

		echo $respuesta;
	}

}

$a = new Ajax();
$a -> nombreImagen = $_FILES["imagen"]["name"];
$a -> imagenTemporal = $_FILES["imagen"]["tmp_name"];
$a -> gestorSlideAjax();
