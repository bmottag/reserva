<script type="text/javascript" src="<?php echo base_url("assets/js/validate/solicitud/solicitud.js"); ?>"></script>

<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><i class='fa fa-users'></i> RESERVAR</h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
				
				
					<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
					
						<h4><strong>Computador:</strong> <?php echo $this->input->post('hddNombreComputador'); ?></h4>

						<ul class="list-unstyled user_data">
							<li><i class="fa fa-phone user-profile-icon"></i> <strong>Fecha:</strong> <?php echo $this->input->post('hddFecha'); ?>
							</li>

							<li>
								<i class="fa fa-envelope user-profile-icon"></i> <strong>Usuario:</strong> <?php echo $this->session->userdata("name"); ?>
							</li>

												
							<li><br>
<?php if($solicitudes){ //SI HAY SOLICITUDES LAS MUESTRO?>
								<a href="#" class="btn btn-info btn-block"><i class="fa fa-edit"></i> El computador esta reservado para el siguiente horario.</a>
<?php }else{ ?>
<a href="#" class="btn btn-info btn-block"><i class="fa fa-edit"></i> El computador no esta reservado</a>
<?php } ?>
							</li>
						</ul>
						

				
					 </div>
				
					<div class="col-md-9 col-sm-9 col-xs-12">

<?php if($solicitudes){//SI HAY SOLICITUDES LAS MUESTRO ?>	
						<div class="table-responsive">
							<table class="table table-striped jambo_table bulk_action">
								<thead>
									<tr class="headings">
										<th class="column-title">Computador </th>
										<th class="column-title">Descripción</th>
										<th class="column-title">Imagen</th>
										<th class="column-title">Fecha de solicitud </th>
										<th class="column-title">Reservar </th>
									</tr>
								</thead>

								<tbody>
								
								</tbody>
							</table>
						</div>
<?php } ?>	
				
				
<?php
$retornoExito = $this->session->flashdata('retornoExito');
if ($retornoExito) {
    ?>
	<div class="alert alert-success alert-dismissible fade in" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
		</button>
		<strong>Ok!</strong> <?php echo $retornoExito ?>	
	</div>
    <?php
}

$retornoError = $this->session->flashdata('retornoError');
if ($retornoError) {
    ?>
	<div class="alert alert-danger alert-dismissible fade in" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
		</button>
		<strong>Error!</strong> <?php echo $retornoError ?>
	</div>	
    <?php
}
?> 

<!-- FORMULARIO -->

					<form id="form" data-parsley-validate class="form-horizontal form-label-left">
						<input type="hidden" name="hddIdComputador" value="<?php echo $idComputador; ?>" />
						<input type="hidden" id="hddNombreComputador" name="hddNombreComputador" value="<?php echo $this->input->post('hddNombreComputador'); ?>" >
						<input type="hidden" id="hddFecha" name="hddFecha" value="<?php echo $this->input->post('hddFecha'); ?>">
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hora_inicio">Hora inicio <span class="required">*</span><br>
							<small>(HH:mm) 08:00 - 18:00</small>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class='input-group date' id='hora_inical_picker'>	
									<input type='text' id="hora_inicio" name="hora_inicio" class="form-control" required="required" value="<?php echo $information?$information[0]["hora_inicio"]:""; ?>" maxlength=5 placeholder="HH:mm"/>
									<span class="input-group-addon">
									   <span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="hora_final">Hora final <span class="required">*</span><br>
							<small>(HH:mm) 08:00 - 18:00</small>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class='input-group date' id='hora_final_picker'>	
									<input type='text' id="hora_final" name="hora_final" class="form-control" required="required" value="<?php echo $information?$information[0]["hora_final"]:""; ?>" maxlength=5 placeholder="HH:mm"/>
									<span class="input-group-addon">
									   <span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
						</div>						

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="numero_items">Número de items <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select name="numero_items" id="numero_items" class="form-control" required>
									<option value='' >Select...</option>
									<?php for ($i = 1; $i <= 50; $i++) { ?>
										<option value='<?php echo $i; ?>' <?php if ($information && $i == $information["numero_items"]) { echo 'selected="selected"'; } ?> ><?php echo $i; ?></option>
									<?php } ?>									
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="grupo_items">Grupo de items <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="grupo_items" name="grupo_items" required="required" class="form-control col-md-7 col-xs-12" maxlength=50 placeholder="Grupo de items">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="tipificacion">Tipificación<span class="required">*</span></label>
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
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								
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

<!-- bootstrap-datetimepicker -->    	
<script src="<?php echo base_url("assets/bootstrap/vendors/moment/min/moment.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/bootstrap/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"); ?>"></script>

<script type="text/javascript">
    $('#hora_inical_picker').datetimepicker({
        format: 'HH:mm'
    });
	
    $('#hora_final_picker').datetimepicker({
        format: 'HH:mm'
    });
</script>