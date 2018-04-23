<script type="text/javascript" src="<?php echo base_url("assets/js/validate/admin/tipificacion.js"); ?>"></script>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Tipificación</h4>
</div>

<div class="modal-body">
	<form name="form" id="form" role="form" method="post" >
		<input type="hidden" id="hddId" name="hddId" value="<?php echo $information?$information[0]["id_tipificacion"]:""; ?>"/>
		
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="tipificacion">Tipificación</label>
					<input type="text" id="tipificacion" name="tipificacion" class="form-control" value="<?php echo $information?$information[0]["tipificacion"]:""; ?>" placeholder="Tipificación" required >
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="usuario">Usuario</label>
					<select name="usuario" id="usuario" class="form-control" required>
						<option value=''>Select...</option>
						<option value="ADMON" <?php if($information[0]["usuario"] == "ADMON") { echo "selected"; }  ?>>ADMON</option>
						<option value="GESTOR" <?php if($information[0]["usuario"] == "GESTOR") { echo "selected"; }  ?>>GESTOR</option>
					</select>
				</div>
			</div>
		</div>
		
		<div class="ln_solid"></div>
		<div class="form-group">
			<button type="button" id="btnSubmit" name="btnSubmit" class="btn btn-primary" >
				Guardar <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
			</button> 
		</div>
		
		<div class="form-group">
			<div id="div_load" style="display:none">		
				<div class="progress progress-striped active">
					<div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
						<span class="sr-only">45% completado</span>
					</div>
				</div>
			</div>
			<div id="div_error" style="display:none">			
				<div class="alert alert-danger"><span class="glyphicon glyphicon-remove" id="span_msj">&nbsp;</span></div>
			</div>	
		</div>
			
	</form>
</div>