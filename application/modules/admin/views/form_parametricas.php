<script type="text/javascript" src="<?php echo base_url("assets/js/validate/admin/parametricas.js"); ?>"></script>

<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><i class='fa fa-crosshairs'></i> PARAMETRICAS</h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">

					<div class="alert alert-success alert-dismissible fade in" role="alert">
						<strong>Info:</strong> Formulario para editar los datos parametricos.
					</div>
				
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
					<form id="form" data-parsley-validate class="form-horizontal form-label-left">

						<div class="form-group">
							<label class="control-label col-md-5 col-sm-5 col-xs-12" for="hora_inicio">Hora inicio <span class="required">*</span>
							<br><small><?php echo $information[0]["descripcion"] ?></small>
							</label>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<select name="hora_inicio" id="hora_inicio" class="form-control" >
									<option value=''>Select...</option>
									<?php for ($i = 0; $i < count($horas); $i++) { ?>
										<option value="<?php echo $horas[$i]["id_hora"]; ?>" 
										<?php 
										if ($information && $horas[$i]["id_hora"] == $information[0]["valor"]) 
										{ 
											echo 'selected="selected"'; 
										} 
										?> ><?php echo $horas[$i]["hora"]; ?>
										</option>	
									<?php } ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-5 col-sm-5 col-xs-12" for="hora_final">Hora final <span class="required">*</span>
							<br><small><?php echo $information[1]["descripcion"] ?></small>
							</label>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<select name="hora_final" id="hora_final" class="form-control" >
									<option value=''>Select...</option>
									<?php for ($i = 0; $i < count($horas); $i++) { ?>
										<option value="<?php echo $horas[$i]["id_hora"]; ?>" 
										<?php 
										if ($information && $horas[$i]["id_hora"] == $information[1]["valor"]) 
										{ 
											echo 'selected="selected"'; 
										} 
										?> ><?php echo $horas[$i]["hora"]; ?>
										</option>	
									<?php } ?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-5 col-sm-5 col-xs-12" for="numero_computadores">Número computadores <span class="required">*</span>
							<br><small><?php echo $information[2]["descripcion"] ?></small>
							</label>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<select name="numero_computadores" id="numero_computadores" class="form-control" required>
									<option value='' >Select...</option>
									<?php for ($i = 1; $i <= 50; $i++) { ?>
										<option value='<?php echo $i; ?>' <?php if ($information && $i == $information[2]["valor"]) { echo 'selected="selected"'; } ?> ><?php echo $i; ?></option>
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