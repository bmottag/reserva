<script type="text/javascript" src="<?php echo base_url("assets/js/validate/admin/examenV2.js"); ?>"></script>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Examenes</h4>
</div>

<div class="modal-body">
	<form name="form" id="form" role="form" method="post" >
		<input type="hidden" id="hddId" name="hddId" value="<?php echo $information?$information[0]["codigo_examen"]:""; ?>"/>
				
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="examen">Examen</label>
					<input type="text" id="examen" name="examen" class="form-control" value="<?php echo $information?$information[0]["examen"]:""; ?>" placeholder="Examen" required >
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="codigo_examen">Código examen</label>
					<input type="text" id="codigo_examen" name="codigo_examen" class="form-control" value="<?php echo $information?$information[0]["codigo_examen"]:""; ?>" placeholder="Código examen" required >
				</div>
			</div>
		</div>


<script type="text/javascript">
	$(function(){	
		$('#datetimepicker').daterangepicker({
			locale: {
				format: 'YYYY-MM-DD'
			},
			minDate: moment(),
			singleDatePicker: true,
			singleClasses: "picker_1"
		}, function(start, end, label) {
				console.log(start.toISOString(), end.toISOString(), label);
		});
	})
</script>
				
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="fecha_limite">Fecha límite</label>
					
<fieldset>
	<div class="control-group">
		<div class="controls">
			<div class="col-md-11 xdisplay_inputx form-group has-feedback">
				<input type="text" class="form-control has-feedback-left" id="datetimepicker" name="datetimepicker" value="<?php echo $information?$information[0]["fecha_limite"]:""; ?>" aria-describedby="inputSuccess2Status">
				<span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
				<span id="inputSuccess2Status" class="sr-only">(success)</span>
			</div>
		</div>
	</div>
</fieldset>	
					

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