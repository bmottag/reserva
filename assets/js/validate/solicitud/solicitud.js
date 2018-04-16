$( document ).ready( function () {
				
//regla para validar que la hora final es mayor a la hora inicial
jQuery.validator.addMethod("mayorQ", function(value, element, param) {
	var hora_inicio = $('#hora_inicio').val();
	
	if (parseInt(hora_inicio) >= parseInt(value)) {
		return false;
	}else{
		return true;
	}
}, "La hora final debe ser mayor a la hora inicial.");

				
	$("#grupo_items").convertirMayuscula().maxlength(50);
			
	$( "#form" ).validate( {
		rules: {
			numero_computadores:	{ required: true },
			hora_inicio:			{ required: true },
			hora_final: 			{ required: true, mayorQ: "#hora_inicio" },
			numero_items: 			{ required: true },
			grupo_items: 			{ required: true, minlength: 3, maxlength:50 },
			tipificacion:	 		{ required: true }
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `help-block` class to the error element
			error.addClass( "help-block" );
			error.insertAfter( element );

		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).parents( ".col-sm-6" ).addClass( "has-error" ).removeClass( "has-success" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).parents( ".col-sm-6" ).addClass( "has-success" ).removeClass( "has-error" );
		},
		submitHandler: function (form) {
			return true;
		}
	});
	
	$(".btn-danger").click(function () {	
			var oID = $(this).attr("id");
			
			//Activa icono guardando
			if(window.confirm('Esta seguro de eliminar la reseva?'))
			{
					$(".btn-danger").attr('disabled','-1');
					$.ajax ({
						type: 'POST',
						url: base_url + 'solicitud/eliminar_reserva',
						data: {'identificador': oID},
						cache: false,
						success: function(data){
												
							if( data.result == "error" )
							{
								alert(data.mensaje);
								$(".btn-danger").removeAttr('disabled');							
								return false;
							} 
											
							if( data.result )//true
							{	                                                        
								$(".btn-danger").removeAttr('disabled');

								var url = base_url + "solicitud/solicitudes_usuario/" + data.idRecord;
								$(location).attr("href", url);
							}
							else
							{
								alert('Error. Reload the web page.');
								$(".btn-danger").removeAttr('disabled');
							}	
						},
						error: function(result) {
							alert('Error. Reload the web page.');
							$(".btn-danger").removeAttr('disabled');
						}

					});
			}
	});
	
	$("#btnSubmit").click(function(){		
	
		if ($("#form").valid() == true){
		
				//Activa icono guardando
				$('#btnSubmit').attr('disabled','-1');
				$("#div_error").css("display", "none");
				$("#div_load").css("display", "inline");
			
				$.ajax({
					type: "POST",	
					url: base_url + "solicitud/save_solicitud",	
					data: $("#form").serialize(),
					dataType: "json",
					contentType: "application/x-www-form-urlencoded;charset=UTF-8",
					cache: false,
					
					success: function(data){
                                            
						if( data.result == "error" )
						{
							$("#div_load").css("display", "none");
							$("#div_error").css("display", "inline");
							$("#span_msj").html(data.mensaje);
							$('#btnSubmit').removeAttr('disabled');
							alert(data.mensaje);
							return false;
						} 

						if( data.result )//true
						{	                                                        
							$("#div_load").css("display", "none");
							$('#btnSubmit').removeAttr('disabled');
							var url = base_url + "solicitud/solicitudes_usuario/" + data.idRecord;
							$(location).attr("href", url);
						}
						else
						{
							alert('Error. Reload the web page.');
							$("#div_load").css("display", "none");
							$("#div_error").css("display", "inline");
							$('#btnSubmit').removeAttr('disabled');
						}	
					},
					error: function(result) {
						alert('Error. Reload the web page.');
						$("#div_load").css("display", "none");
						$("#div_error").css("display", "inline");
						$('#btnSubmit').removeAttr('disabled');
					}
					
		
				});	
		
		}//if			
	});

});