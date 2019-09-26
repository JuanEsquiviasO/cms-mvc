<?php
require_once "conexion.php";

class GestorSlideModel {

	#UPLOAD ROUTE OF IMAGE
	#-.---------------------------------------------------
	public function subirImagenSlideModel($datos, $tabla) {
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (ruta) VALUES (:ruta)");
		$stmt -> bindParam(":ruta", $datos, PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok";
		}
		else {
			"error";
		}
		$stmt->close();
	}

	#SELECT ROUTE OF IMAGE
	#---------------------------------------------------
	public function mostrarImagenSlideModel($datos, $tabla) {
		$stmt = Conexion::conectar()->prepare("SELECT ruta, titulo, descripcion FROM $tabla WHERE ruta = :ruta");
		$stmt -> bindParam(":ruta", $datos, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt -> fetch();

		$stmt -> close();
	}

	#SHOW IMAGE IN THE VIEW
	#------------------------------------------------------
	public function mostrarImagenVistaModel($tabla) {
		$stmt = Conexion::conectar()->prepare("SELECT ruta, titulo, descripcion FROM $tabla ORDER BY orden ASC");

		$stmt->execute();

		return $stmt -> fetchAll();

		$stmt -> close();
	}
}
