<?php
require_once "../../models/gestorSlide.php";
require_once "../../controllers/gestorSlide.php";


#CLASS & METHODS
#------------------------------------------------------
class Ajax {

	#UPLOAD IMAGE OF SLIDE
	#-----------------------------------------------------
	public $nombreImagen;
	public $imagenTemporal;

	public function gestorSlideAjax() {
		$datos  = array("nombreImagen"=>$this->nombreImagen,
										"imagenTemporal"=>$this->imagenTemporal);

		$respuesta = GestorSlide::mostrarImagenController($datos);

		echo $respuesta;
	}

	#DELET ITEM SLIDE
	#-----------------------------------------------------
	public $idSlide;
	public $rutaSlide;

	public function eliminarSlideAjax() {
		$datos = array("idSlide" => $this->idSlide,
										"rutaSlide" => $this->rutaSlide);

		$respuesta = GestorSlide::eliminarSlideController($datos);

		echo $respuesta;
	}
}

#OBJECTS
#------------------------------------------------------
if (isset($_FILES["imagen"]["name"])) {
	$a = new Ajax();
	$a -> nombreImagen = $_FILES["imagen"]["name"];
	$a -> imagenTemporal = $_FILES["imagen"]["tmp_name"];
	$a -> gestorSlideAjax();
}

if (isset($_POST["idSlide"])) {
	$b = new Ajax();
	$b -> idSlide = $_POST["idSlide"];
	$b -> rutaSlide = $_POST["rutaSlide"];
	$b -> eliminarSlideAjax();
}

