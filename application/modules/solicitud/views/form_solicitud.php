<script type="text/javascript" src="<?php echo base_url("assets/js/validate/solicitud/solicitud.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/validate/solicitud/ajaxPrueba.js"); ?>"></script>

<script>
$(document).ready(function () {

    $('#prueba').change(function () {
        $('#prueba option:selected').each(function () {
            var prueba = $('#prueba').val();
            if (prueba == 998) {
				$("#div_cual_prueba").css("display", "inline");
				$('#cual_prueba').val("");
            } else {
				$("#div_cual_prueba").css("display", "none");
				$('#cual_prueba').val("");
            }
        });
    });
	
    $('#grupo_items').change(function () {
        $('#grupo_items option:selected').each(function () {
            var grupo_items = $('#grupo_items').val();
            if (grupo_items == 69) {
				$("#div_cual").css("display", "inline");
				$('#cual').val("");
            } else {
				$("#div_cual").css("display", "none");
				$('#cual').val("");
            }
        });
    });
	
});
</script>

<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><i class='fa fa-hand-o-up'></i> RESERVAR</h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
				
					<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
					
						<h4><strong>ZONA 2</strong></h4>

						<ul class="list-unstyled user_data">
							<li><i class="fa fa-calendar user-profile-icon"></i> <strong>Fecha:</strong> <?php echo $fecha_apartada; ?>
							</li>

							<li>
								<i class="fa fa-user user-profile-icon"></i> <strong>Usuario:</strong><br> <?php echo $this->session->userdata("name"); ?>
							</li>
							
							<li>
								<i class="fa fa-reorder user-profile-icon"></i> <strong>No. computadores disponibles:</strong><br>
							</li>							
						</ul>
						
<!-- INICIO DISPONIBILIDAD -->
								<?php 								
									$x = 1;
									
									$ci = &get_instance();
									$ci->load->model("general_model");
														
									//BUSCO numero maximo de computadores
									$arrParamGeneral = array(
										"table" => "param_generales",
										"order" => "id_generales",
										"id" => "x"
									);
									$paramGenerales = $this->general_model->get_basic_search($arrParamGeneral);
												
									$numeroMaxComputadores = $paramGenerales[2]['valor'];

echo '<small><textarea class="form-control" rows="25">';
									for ($i = 0; $i < count($horasDisponibilidad); $i++):
										if($x < count($horasDisponibilidad))
										{
											//filtro de solicitudes por fecha
											$arrParam = array(
															"fecha" => $fecha_apartada, 
															"estado" => 1,
															"horaStart" => $horasDisponibilidad[$i]["id_hora"],
															"horaFinish" => $horasDisponibilidad[$x]["id_hora"]
														);
											$listadoSolicitudes = $this->general_model->get_computadores_solicitudes($arrParam);//listado de solicitudes filtrado por fecha

											//recorro las reservas
											if($listadoSolicitudes){
												$numeroDisponibles = $numeroMaxComputadores-$listadoSolicitudes['numero_computadores'];	
											}else{
												$numeroDisponibles = $numeroMaxComputadores;
											}
												
											echo "Hora: ";
											echo $horasDisponibilidad[$i]["hora"]  . "-" . $horasDisponibilidad[$x]["hora"];
											echo "  Computadores disponibles: " . $numeroDisponibles;
											echo "\r";
											$x++;
										}
									endfor;
									
echo '</textarea></small>';
								?>
<!-- FIN DISPONIBILIDAD -->
										
					</div>
				
					<div class="col-md-9 col-sm-9 col-xs-12">
					
<?php 

$rol = $this->session->userdata("rol");//consulto rol
$mensaje = "";
if($rol == 3){
	$mensaje = "<li>Como usuario <strong>GESTOR</strong> solo puede reservar para un horario hábil. (8:00 AM - 6:00 PM de lunes a viernes)</li>";
}

if($solicitudes){ //SI HAY SOLICITUDES LAS MUESTRO?>
						<div class="alert alert-danger alert-dismissible fade in" role="alert">
							<strong>Info:</strong> 
							<ul>
								<?php echo $mensaje; ?>
								<li>La sala esta reservada en los siguientes horarios:</li>
							</ul>
						</div>

						<div class="table-responsive">
							<table class="table table-striped jambo_table bulk_action">
								<thead>
									<tr class="headings">
										<th class="column-title" style="width: 2%"># </th>
										<th class="column-title" style="width: 20%">Fecha reserva</th>
										<th class="column-title" style="width: 20%">No. computadores</th>
										<th class="column-title" style="width: 17%">Hora inicio</th>
										<th class="column-title" style="width: 17%">Hora fin</th>
										<th class="column-title" style="width: 25%">Usuario </th>
									</tr>
								</thead>

								<tbody>
		<?php
			if($solicitudes){
				foreach ($solicitudes as $data):
					echo "<tr>";
					echo "<td>" . $data['id_solicitud'] . "</td>";
					echo "<td>" . $data['fecha_apartado'] . "</td>";
					echo "<td>" . $data['numero_computadores'] . "</td>";
					echo "<td>" . $data['hora_inicial'] . "</td>";
					echo "<td>" . $data['hora_final'] . "</td>";
					echo "<td>" . $data['first_name'] . " " . $data['last_name'] . "</td>";
					echo "</tr>";
				endforeach;
			}
		?>								
								</tbody>
							</table>
						</div>
<?php }else{ ?>
						<div class="alert alert-success alert-dismissible fade in" role="alert">
							<strong>Info:</strong> 
							<ul>
								<li>Para la fecha seleccionada no existe ninguna reserva. </li>
								<li>Diligencie el siguiente formulario para realizar una nueva reserva.</li>
								<li>La fecha de reserva debe ser previa a la fecha límite del examen, 
								de lo contrario no se visualizará en el listado de prueba.</li>
								<?php echo $mensaje; ?>
							</ul>
						</div>
<?php } ?>

<?php if($dataMensajeAlerta){ ?>
						<div class="alert alert-danger alert-dismissible fade in" role="alert">
							<strong>Error!</strong> <?php echo $dataMensajeAlerta ?>
						</div>
<?php }else{ ?>
				
<!-- FORMULARIO -->
					<form id="form" data-parsley-validate class="form-horizontal form-label-left">
						<input type="hidden" id="hddIdInspeccion" name="hddIdInspeccion" value="<?php echo $information?$information[0]["id_solicitud"]:""; ?>" >
						<input type="hidden" id="hddFecha" name="hddFecha" value="<?php echo $fecha_apartada; ?>">
						
						<div class="ln_solid"></div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="numero_computadores">Número computadores <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select name="numero_computadores" id="numero_computadores" class="form-control" required>
									<option value='' >Select...</option>
									<?php for ($i = 1; $i <= $filtro[2]['valor']; $i++) { ?>
										<option value='<?php echo $i; ?>' <?php if ($information && $i == $information[0]["numero_computadores"]) { echo 'selected="selected"'; } ?> ><?php echo $i; ?></option>
									<?php } ?>									
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hora_inicio">Hora inicio <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select name="hora_inicio" id="hora_inicio" class="form-control" >
									<option value=''>Select...</option>
									<?php for ($i = 0; $i < count($horas); $i++) { ?>
										<option value="<?php echo $horas[$i]["id_hora"]; ?>" 
										<?php 
										if ($information && $horas[$i]["id_hora"] == $information[0]["fk_id_hora_inicial"]) 
										{ 
											echo 'selected="selected"'; 
										}elseif($filtro[0]['valor'] == $horas[$i]["id_hora"]) { 
											echo "selected"; 
										}  
										?> ><?php echo $horas[$i]["hora"]; ?>
										</option>	
									<?php } ?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hora_final">Hora final <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select name="hora_final" id="hora_final" class="form-control" >
									<option value=''>Select...</option>
									<?php for ($i = 0; $i < count($horas); $i++) { ?>
										<option value="<?php echo $horas[$i]["id_hora"]; ?>" 
										<?php 
										if ($information && $horas[$i]["id_hora"] == $information[0]["fk_id_hora_final"]) 
										{ 
											echo 'selected="selected"'; 
										}elseif($filtro[0]['valor'] == $horas[$i]["id_hora"]) { 
											echo "selected"; 
										}  
										?> ><?php echo $horas[$i]["hora"]; ?>
										</option>
									<?php } ?>
								</select>
							</div>
						</div>						

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="numero_items">Número de items <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select name="numero_items" id="numero_items" class="form-control">
									<option value='' >Select...</option>
									<?php for ($i = 1; $i <= 50; $i++) { ?>
										<option value='<?php echo $i; ?>' <?php if ($information && $i == $information[0]["numero_items"]) { echo 'selected="selected"'; } ?> ><?php echo $i; ?></option>
									<?php } ?>
									<option value=99 <?php if ($information && 99 == $information[0]["numero_items"]) { echo 'selected="selected"'; } ?> >Sin definir</option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="prueba">Prueba <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select name="prueba" id="prueba" class="form-control" >
									<option value=''>Select...</option>
									<?php for ($i = 0; $i < count($examenes); $i++) { ?>
										<option value="<?php echo $examenes[$i]["codigo_examen"]; ?>" <?php if ($information && $examenes[$i]["codigo_examen"] == $information[0]["fk_codigo_examen"]) { echo 'selected="selected"'; } ?> ><?php echo $examenes[$i]["examen"]; ?></option>	
									<?php } ?>
								</select>
							</div>
						</div>
						
<?php 
	$mostrar = "none";
	if($information && $information[0]["fk_id_prueba"]==69){
		$mostrar = "inline";
	}
?>
						
						<div class="form-group" id="div_cual_prueba" style="display: <?php echo $mostrar; ?>">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="cual_prueba">¿Cuál prueba?  <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="cual_prueba" name="cual_prueba" class="form-control" placeholder="¿Cuál prueba?" value="<?php echo $information?$information[0]["cual_prueba"]:""; ?>" >
							</div>
						</div><br>
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="grupo_items">Grupo de items <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select name="grupo_items" id="grupo_items" class="form-control" required>
									<?php if($information){ ?>
									<option value=''>Select...</option>
										<option value="<?php echo $information[0]["fk_id_prueba"]; ?>" selected><?php echo $information[0]["prueba"]; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						
						<div class="form-group" id="div_cual" style="display: <?php echo $mostrar; ?>">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="cual">¿Cuál?  <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="cual" name="cual" class="form-control" placeholder="¿Cuál?" value="<?php echo $information?$information[0]["cual"]:""; ?>">
							</div>
						</div><br>
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tipificacion">Tipificación <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select name="tipificacion" id="tipificacion" class="form-control" >
									<option value=''>Select...</option>
									<?php for ($i = 0; $i < count($tipificacion); $i++) { ?>
										<option value="<?php echo $tipificacion[$i]["id_tipificacion"]; ?>" <?php if($information[0]["fk_id_tipificacion"] == $tipificacion[$i]["id_tipificacion"]) { echo "selected"; }  ?>><?php echo $tipificacion[$i]["tipificacion"]; ?></option>	
									<?php } ?>
								</select>
							</div>
						</div>
						
						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<div class="row" align="center">
									<div style="width:50%;" align="center">
										<button type="button" id="btnSubmit" name="btnSubmit" class='btn btn-success'>
												Guardar <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
										</button>								
									</div>
								</div>
							</div>
						</div>
												
						<div class="form-group">
							<div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-1">
								
								<div id="div_load" style="display:none">		
									<div class="progress progress-striped active">
										<div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
											<span class="sr-only">45% completado</span>
										</div>
									</div>
								</div>
								<div id="div_error" style="display:none">			
									<div class="alert alert-danger"><span class="glyphicon glyphicon-remove" id="span_msj"> &nbsp;</span></div>
								</div>	
								
							</div>
						</div>

					</form>
<?php } ?>
					
					</div>
				</div>
			</div>
		</div>
	</div>
</div>