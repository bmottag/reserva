<script type="text/javascript" src="<?php echo base_url("assets/js/validate/admin/cargue_archivo.js"); ?>"></script>

<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><i class='fa fa-users'></i> CARGAR USUARIOS</h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">

					<div class="alert alert-success alert-dismissible fade in" role="alert">
						<strong>Info:</strong> Seleccionar archivo para cargue de usuarios.
					</div>
					
<div class="row">
	<?php if (!empty($error)) {
		echo '<div class="alert alert-danger alert-dismissible fade in"><strong>ERROR:</strong> ' . $error . '</div>';
	} 
	if (!empty($success)) {
		echo '<div class="alert alert-success alert-dismissible fade in"><strong>' . $success . '</strong></div>';
	} ?>
</div>
				
					<form class="form-horizontal form-label-left" name="formCargue" id="formCargue" role="form" method="post" enctype="multipart/form-data" action="<?php echo site_url("/admin/do_upload"); ?>">

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="archivo">Ajuntar Archivo <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="file" name="userfile" />
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<div class="row" align="center">
									<div style="width:50%;" align="center">
										<button type="button" id="btnSubir" name="btnSubir" class='btn btn-success'>
												Subir Archivo <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
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
					
					<div class="alert alert-danger alert-dismissible fade in" role="alert">
						<strong>Tener en cuenta:</strong> <br>
						Formato permitido : csv<br>
						Tamaño máximo : 4096 KB<br>
						Campo usuario deber ser mínimo de 6 caracteres
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>