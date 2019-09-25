<?php
require_once "conexion.php";

class GestorSlideModel {
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

	public function mostrarImagenSlideModel($datos, $tabla) {
		$stmt = Conexion::conectar()->prepare("SELECT ruta FROM $tabla WHERE ruta = :ruta");
		$stmt -> bindParam(":ruta", $datos, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt -> fetch();

		$stmt -> close();
	}
}
