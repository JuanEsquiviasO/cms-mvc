<?php

require_once "conexion.php";

class IngresoModels{
	public function ingresoModel($datosModel) {

		$stmt = Conexion::conectar()->prepare("SELECT usuario, password FROM usuarios WHERE usuario = :usuario AND password = :password");

		$stmt -> bindParam(":usuario", $datosModel["usuario"]);
		$stmt -> bindParam(":password", $datosModel["password"]);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

	}
}
