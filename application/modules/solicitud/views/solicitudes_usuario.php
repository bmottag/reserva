<script type="text/javascript" src="<?php echo base_url("assets/js/validate/solicitud/solicitud.js"); ?>"></script>

<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><i class='fa fa-list'></i> LISTADO DE RESERVAS </h2> 
					
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>

					</ul>
					<div class="clearfix"></div>
				</div>

				<div class="x_content">
				
					<a href="<?php echo base_url("solicitud"); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Nueva reserva</a>
					
					<div class="alert alert-warning alert-dismissible fade in" role="alert">
						<strong>Info:</strong> Listado de solicitudes, organizadas de la más reciente a las más antigua.
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
					<div class="table-responsive">
						<table id="datatable" class="table table-striped jambo_table bulk_action">

							<thead>
								<tr class="headings">
									<th class="column-title" style="width: 1%">#</th>
									<th class="column-title" style="width: 14%">Fecha reserva</th>
									<th class="column-title" style="width: 7%">No. CPU</th>
									<th class="column-title" style="width: 8%">Hora inicio</th>
									<th class="column-title" style="width: 8%">Hora fin</th>
									<th class="column-title" style="width: 10%">No. items</th>
									<th class="column-title" style="width: 15%">Grupo items</th>
									<th class="column-title" style="width: 15%">Tipificación</th>
									<th class="column-title" style="width: 15%">Usuario</th>
									<th class="column-title" style="width: 8%">Enlaces</th>
								</tr>
							</thead>

							<tbody>
										
		<?php
			if($information){
				foreach ($information as $data):
					echo "<tr>";
					echo "<td>" . $data['id_solicitud'] . "</td>";
					echo "<td>" . $data['fecha_apartado'] . "</td>";
					echo "<td>" . $data['numero_computadores'] . "</td>";
					echo "<td>" . $data['hora_inicial'] . "</td>";
					echo "<td>" . $data['hora_final'] . "</td>";
					echo "<td>" . $data['numero_items'] . "</td>";
					echo "<td>";
					echo "<strong>" . $data['examen'] . "</strong> - ";
					if($data['fk_id_prueba'] == 69){
						echo $data['cual'];
					}else{
						echo $data['prueba'];
					}
					echo "</td>";
					echo "<td>" . $data['tipificacion'] . "</td>";
					echo "<td>" . $data['first_name'] . " " . $data['last_name'] . "</td>";
					echo "<td class='text-center'>";
		?>
<button type="button" id="<?php echo $data['id_solicitud']; ?>" class='btn btn-danger btn-xs'>
		Eliminar <span class="fa fa-times fa-fw" aria-hidden="true">
</button>
		<?php

					echo "</td>";
					echo "</tr>";
				endforeach;
			}
		?>

							</tbody>
						</table>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>