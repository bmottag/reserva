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
							<li><i class="fa fa-calendar user-profile-icon"></i> <strong>Fecha:</strong> <?php echo $this->input->post('hddFecha'); ?>
							</li>

							<li>
								<i class="fa fa-user user-profile-icon"></i> <strong>Usuario:</strong><br> <?php echo $this->session->userdata("name"); ?>
							</li>
						</ul>
										
					 </div>
				
					<div class="col-md-9 col-sm-9 col-xs-12">
					
<?php if($solicitudes){ //SI HAY SOLICITUDES LAS MUESTRO?>
						<div class="alert alert-danger alert-dismissible fade in" role="alert">
							<strong>Info:</strong> El computador esta reservado para el siguiente horario:
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
							</ul>
						</div>
<?php } ?>
				
<!-- FORMULARIO -->
					<form id="form" data-parsley-validate class="form-horizontal form-label-left">
						<input type="hidden" id="hddFecha" name="hddFecha" value="<?php echo $this->input->post('hddFecha'); ?>">
						<div class="ln_solid"></div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="numero_computadores">Número computadores <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select name="numero_computadores" id="numero_computadores" class="form-control" required>
									<option value='' >Select...</option>
									<?php for ($i = 1; $i <= 10; $i++) { ?>
										<option value='<?php echo $i; ?>' <?php if ($information && $i == $information["numero_computadores"]) { echo 'selected="selected"'; } ?> ><?php echo $i; ?></option>
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
										<option value="<?php echo $horas[$i]["id_hora"]; ?>" <?php if(17 == $horas[$i]["id_hora"]) { echo "selected"; }  ?>><?php echo $horas[$i]["hora"]; ?></option>	
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
										<option value="<?php echo $horas[$i]["id_hora"]; ?>" <?php if(17 == $horas[$i]["id_hora"]) { echo "selected"; }  ?>><?php echo $horas[$i]["hora"]; ?></option>	
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
										<option value='<?php echo $i; ?>' <?php if ($information && $i == $information["numero_items"]) { echo 'selected="selected"'; } ?> ><?php echo $i; ?></option>
									<?php } ?>
									<option value=99 <?php if ($information && 99 == $information["numero_items"]) { echo 'selected="selected"'; } ?> >Sin definir</option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="prueba">Prueba <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select name="prueba" id="prueba" class="form-control" >
									<option value=''>Select...</option>
									<?php for ($i = 0; $i < count($examenes); $i++) { ?>
										<option value="<?php echo $examenes[$i]["codigo_examen"]; ?>" ><?php echo $examenes[$i]["examen"]; ?></option>	
									<?php } ?>
								</select>
							</div>
						</div>
						
						<div class="form-group" id="div_cual_prueba" style="display: none">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="cual_prueba">¿Cuál prueba?  <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="cual_prueba" name="cual_prueba" class="form-control" placeholder="¿Cuál prueba?" >
							</div>
						</div><br>
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="grupo_items">Grupo de items <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select name="grupo_items" id="grupo_items" class="form-control" required>					

								</select>
							</div>
						</div>
						
						<div class="form-group" id="div_cual" style="display: none">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="cual">¿Cuál?  <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="cual" name="cual" class="form-control" placeholder="¿Cuál?" >
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
					</div>
				</div>
			</div>
		</div>
	</div>
</div>