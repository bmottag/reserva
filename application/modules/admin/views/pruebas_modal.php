<script type="text/javascript" src="<?php echo base_url("assets/js/validate/admin/pruebas.js"); ?>"></script>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Pruebas</h4>
</div>

<div class="modal-body">
	<form name="form" id="form" role="form" method="post" >
		<input type="hidden" id="hddId" name="hddId" value="<?php echo $information?$information[0]["id_prueba"]:""; ?>"/>
		
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="examen">Examen</label>
					<select name="examen" id="examen" class="form-control" >
						<option value=''>Select...</option>
						<?php for ($i = 0; $i < count($examenes); $i++) { ?>
							<option value="<?php echo $examenes[$i]["codigo_examen"]; ?>" <?php if($information[0]["codigo_examen"] == $examenes[$i]["codigo_examen"]) { echo "selected"; }  ?>><?php echo $examenes[$i]["examen"]; ?></option>	
						<?php } ?>
					</select>
				</div>
			</div>
			
		</div>
		
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="prueba">Prueba</label>
					<input type="text" id="prueba" name="prueba" class="form-control" value="<?php echo $information?$information[0]["prueba"]:""; ?>" placeholder="Prueba" required >
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="codigo_prueba">Código prueba</label>
					<input type="text" id="codigo_prueba" name="codigo_prueba" class="form-control" value="<?php echo $information?$information[0]["codigo_prueba"]:""; ?>" placeholder="Código prueba" required >
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