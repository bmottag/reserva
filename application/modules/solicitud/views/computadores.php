<script type="text/javascript">
function valida(form) {
	var ok = true;

	for (var i=0; i<form.length; i++) {
		if(form[i].type =='text') {
		form.fecha.value = form[i].value;
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
					<h2><i class='fa fa-desktop'></i> LISTADO COMPUTADORES</h2>

					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>

				<div class="x_content">

					<div class="alert alert-success alert-dismissible fade in" role="alert">
						<strong>Info:</strong> Indicar <strong>fecha de solicitud</strong> para reservar el computador.
					</div>

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
									
<?php 
foreach ($computadores as $data):
	echo "<tr>";
	echo "<td>" . $data['computador_nombre'] . "</td>";
	echo "<td>" . $data['computador_descripcion'] . "</td>";
	echo "<td class='a-center '><img src=" . base_url() . "files/salas/" . $data['computador_descripcion'] . "></td>";
	$idComputador = $data['id_computador'];
	echo '<form  name="' . $idComputador . '" id="' . $idComputador . '" method="post" onsubmit="return valida(this)">';
	echo '<td class="a-center ">';
?>			

	<input type="hidden" name="computadorId" value="<?php echo $idComputador; ?>" />
	<input type="hidden" name="nombreComputador" value="<?php echo $data['computador_nombre']; ?>" />
	<input type="hidden" id="fecha" name="fecha">

<script type="text/javascript">
	$(function(){	
			$('#datetimepicker<?php echo $idComputador; ?>').daterangepicker({
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
				<input type="text" class="form-control has-feedback-left" id="datetimepicker<?php echo $idComputador; ?>" aria-describedby="inputSuccess2Status">
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
<?php  
endforeach;
?>
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