// console.log($("#columnasSlide").html());

/*--=====================================
SLIDE ADMINISTRABLE
========================================*/
if ($("#columnasSlide").html() == 0) {
	$("#columnasSlide").css({"height":"100px"})
}
else {
	$("#columnasSlide").css({"height":"auto"})
}

/*--=====================================
	UPLOAD IMAGE DRAG
========================================*/
$("#columnasSlide").on("dragover", function (e) {
	e.preventDefault();
	e.stopPropagation();

	$("#columnasSlide").css({"background":"url(views/images/pattern.jpg)"});
});

/*--=====================================
	 DROP IMAGE
========================================*/
$("#columnasSlide").on("drop", function (e) {
	e.preventDefault();
	e.stopPropagation();

	$("#columnasSlide").css({ "background": "white" });

	var archivo = e.originalEvent.dataTransfer.files;
	var imagen = archivo[0];

	// Validar tamaño de la imagen
	var imagenSize = imagen.size;

	if (Number(imagenSize) > 2000000) {
		$("#columnasSlide").before('<div class="alert alert-warning alerta text-center">El archivo excede la capacidad permitida, 200Kb</>')
	}
	else {
		$(".alerta").remove();
	}

	// Validar tipo de la imagen
	var imagenType= imagen.type;

	if (imagenType == "image/jpeg" || imagenType == "image/png") {
		$(".alerta").remove();
	}
	else {
		$("#columnasSlide").before('<div class="alert alert-warning alerta text-center">El archivo no es del tipo permitido, jpeg ó png</>')
	}

	// Subir imagen al Servidor
	if ( Number(imagenSize) < 2000000 && imagenType == "image/jpeg" || imagenType == "image/png" ) {
		var datos = new FormData();
		datos.append("imagen", imagen);

		$.ajax({
			url: "views/ajax/gestorSlide.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			beforeSend: function() {

				$("#columnasSlide").before('<img src="views/images/status.gif" id="status">');

			},
			success: function (respuesta) {

				$("#status").remove();

				if (respuesta == 0) {
					$("#columnasSlide").before('<div class="alert alert-warning alerta text-center">La imagen es inferior a 1600px x 600px</div>');
				}
				else {
					$("#columnasSlide").css({ "height": "auto" });

					$("#columnasSlide").append('<li class="bloqueSlide"><span class="fa fa-times"></span><img src="'+respuesta["ruta"].slice(6)+'" class="handleImg"></li>');

					$("#ordenarTextSlide").append('<li><span class= "fa fa-pencil" style = "background:blue" ></span ><img src="' + respuesta["ruta"].slice(6) +'" style="float:left; margin-bottom:10px" width="80%"><h1>'+respuesta["titulo"]+'</h1><p>'+respuesta["descripcion"]+'</p></li>');
				}
			}
		});
	}
});
