<script type="text/javascript">
function valida(form) {
	var ok = true;

	for (var i=0; i<form.length; i++) {
		if(form[i].type =='text') {
		form.hddFecha.value = form[i].value;
			if (form[i].value == null || form[i].value.length == 0 || /^\s*$/.test(form[i].value)){
				ok = false;
			}
		}
	}
  
	if(ok == false)
		alert('Debe indicar la fecha de la solicitud');
	return ok;
}
</script>

<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><i class='fa fa-hand-o-up'></i> ZONA 2</h2>

					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>

				<div class="x_content">

					<div class="alert alert-success alert-dismissible fade in" role="alert">
						<strong>Info:</strong> 
						
							<ul>
								<li>Indicar <strong>FEHA DE SOLICITUD </strong>deseada para realizar la reserva.</li>
<?php 
$rol = $this->session->userdata("rol");//consulto rol
if($rol == 3){
	echo "<li>Como usuario <strong>GESTOR</strong> solo puede reservar para un horario hábil. (8:00 AM - 6:00 PM de lunes a viernes)</li>";
}
?>
							</ul>
					</div>
	<!-- Mensajes de alerta form validator-->
	<?php if(validation_errors()){?>
					<div class="alert alert-danger alert-dismissible fade in" role="alert">
						<?php echo validation_errors(); ?>
					</div>
	<?php } ?>
					<div class="table-responsive">
						<table class="table table-striped jambo_table bulk_action">
							<thead>
								<tr class="headings">
									<th class="column-title">Zona 2 </th>
									<th class="column-title">Fecha de solicitud </th>
									<th class="column-title">Reservar </th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td>Seleccionar la fecha en la que desea realizar la reseva </td>
									<form  name="zona_2" id="zona_2" method="post" onsubmit="return valida(this)">
									
									<td class="a-center ">
										<input type="hidden" id="hddFecha" name="hddFecha">

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
				
<fieldset>
	<div class="control-group">
		<div class="controls">
			<div class="col-md-11 xdisplay_inputx form-group has-feedback">
				<input type="text" class="form-control has-feedback-left" id="datetimepicker" aria-describedby="inputSuccess2Status">
				<span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
				<span id="inputSuccess2Status" class="sr-only">(success)</span>
			</div>
		</div>
	</div>
</fieldset>				
								</td>
								<td class="a-center">
								
									<button type="submit" id="btnSubmit" name="btnSubmit" class='btn btn-success'>
											Reservar <span class="fa fa-arrow-right" aria-hidden="true">
									</button>
								</td>
								</form>
								</tr>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- bootstrap-datetimepicker -->    	
<script src="<?php echo base_url("assets/bootstrap/vendors/moment/min/moment.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/bootstrap/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"); ?>"></script>