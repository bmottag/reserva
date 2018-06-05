<script type="text/javascript" src="<?php echo base_url("assets/js/validate/solicitud/solicitud.js"); ?>"></script>

<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><i class='fa fa-list'></i> LISTADO DE RESERVAS,<small> organizadas de la más reciente a las más antigua.</small>
					</h2> 
					
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>

					</ul>
					<div class="clearfix"></div>
				</div>

				<div class="x_content">
				
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
						<table id="dataTables" class="table table-striped jambo_table bulk_action dt-responsive nowrap" cellspacing="0" width="100%">

							<thead>
								<tr class="headings">
									<th class="column-title" style="width: 12%"><small>Fecha reserva</small></th>
									<th class="column-title" style="width: 8%"><small>No. CPU</small></th>
									<th class="column-title" style="width: 8%"><small>Hora inicio</small></th>
									<th class="column-title" style="width: 8%"><small>Hora fin</small></th>
									<th class="column-title" style="width: 8%"><small>Enlaces</small></th>
									<th class="column-title" style="width: 10%"><small>No. items</small></th>
									<th class="column-title" style="width: 15%"><small>Grupo items</small></th>
									<th class="column-title" style="width: 14%"><small>Tipificación</small></th>
									<th class="column-title" style="width: 14%"><small>Usuario</small></th>
									<th class="column-title" style="width: 1%"><small>ID</small></th>
								</tr>
							</thead>

							<tbody>
										
		<?php
			if($information){
				foreach ($information as $data):
					echo "<tr>";
					echo "<td><small>" . $data['fecha_apartado'] . "</small></td>";
					echo "<td class='text-center'><small>" . $data['numero_computadores'] . "</small></td>";
					echo "<td class='text-center'><small>" . $data['hora_inicial'] . "</small></td>";
					echo "<td class='text-center'><small>" . $data['hora_final'] . "</small></td>";
					echo "<td class='text-center'>";
					
//consultar si la fecha y hora de la reserva es mayor a la fecha y hora actual
$fechaAparatada = $data['fecha_apartado'] . " " . $data['hora_final_24'];

$datetime1 = date_create($fechaAparatada);
$datetime2 = date_create(date('Y-m-d G:i'));


if($data['estado_solicitud'] == 2)
{
		echo '<p class="text-danger"><strong>Eliminada</strong></p>';
}else{
		if($datetime1 < $datetime2) {
				echo '<p class="text-danger"><strong>No se puede modificar</strong></p>';
		}else{
				?>
		<a href='<?php echo base_url("solicitud/update_solicitud/" . $data['id_solicitud']); ?>' class='btn btn-info btn-xs'><i class='fa fa-pencil'></i> Editar </a>
				
		<button type="button" id="<?php echo $data['id_solicitud']; ?>" class='btn btn-danger btn-xs'>
				<i class="fa fa-trash-o"></i> Eliminar 
		</button>
				<?php
		}
}

//consulto rol mostrar el boton ver solo para los ADMINISTRADORES
$rol = $this->session->userdata("rol");
if($rol != 3){
?>
<a href='<?php echo base_url("solicitud/solicitudes_usuario/$data[fk_id_user]/$data[id_solicitud]"); ?>' class='btn btn-success btn-xs'><i class='fa fa-eye'></i> Ver </a>
<?php
}
					echo "</td>";

					echo "<td class='text-center'><small>";
					if (99 == $data["numero_items"])
					{ 
						echo 'Sin definir'; 
					}else{
						echo $data['numero_items'];
					}
					echo "</td>";
					echo "<td><small>";
					echo "<strong>" . $data['examen'] . "</strong> - ";
					if($data['fk_id_prueba'] == 69){
						echo $data['cual_prueba'] . " - ";
						echo $data['cual'];
					}else{
						echo $data['prueba'];
					}
					echo "</small></td>";
					echo "<td><small>" . $data['tipificacion'] . "</small></td>";
					echo "<td><small>" . $data['first_name'] . " " . $data['last_name'] . "</small></td>";
					echo "<td>" . $data['id_solicitud'] . "</td>";
					echo "</tr>";
				endforeach;
			}
		?>

							</tbody>
						</table>
					</div>
					
					
<!-- INICIO HISTORICO -->
		<?php
			if($informationHistorico){
		?>
					<div class="table-responsive">					
						<table id="dataTablesHistorico" class="table table-striped jambo_table bulk_action" cellspacing="0" width="100%">

							<thead>
								<tr class="headings">
									<th class="column-title" colspan="9">-- Historial --</th>
								</tr>
								
								<tr class="headings">
									<th class="column-title" style="width: 11%"><small>Fecha registro</small></th>
									<th class="column-title" style="width: 8%"><small>No. CPU</small></th>
									<th class="column-title" style="width: 9%"><small>Hora inicio</small></th>
									<th class="column-title" style="width: 8%"><small>Hora fin</small></th>
									<th class="column-title" style="width: 10%"><small>No. items</small></th>
									<th class="column-title" style="width: 17%"><small>Grupo items</small></th>
									<th class="column-title" style="width: 14%"><small>Tipificación</small></th>
									<th class="column-title" style="width: 14%"><small>Usuario</small></th>
									<th class="column-title" style="width: 8%"><small>Estado</small></th>
								</tr>
							</thead>

							<tbody>
										
		<?php
				foreach ($informationHistorico as $data):
					echo "<tr>";
					echo "<td class='text-center'><small>$data[fecha_solicitud]</small></td>";
					echo "<td class='text-center'><small>" . $data['numero_computadores'] . "</small></td>";
					echo "<td class='text-center'><small>" . $data['hora_inicial'] . "</small></td>";
					echo "<td class='text-center'><small>" . $data['hora_final'] . "</small></td>";
					echo "<td class='text-center'><small>";
					if (99 == $data["numero_items"])
					{ 
						echo 'Sin definir'; 
					}else{
						echo $data['numero_items'];
					}
					echo "</small></td>";
					echo "<td><small>";
					echo "<strong>" . $data['examen'] . "</strong> - ";
					if($data['fk_id_prueba'] == 69){
						echo $data['cual_prueba'] . " - ";
						echo $data['cual'];
					}else{
						echo $data['prueba'];
					}
					echo "</small></td>";
					echo "<td><small>" . $data['tipificacion'] . "</small></td>";
					echo "<td><small>" . $data['first_name'] . " " . $data['last_name'] . "</small></td>";

					echo "<td class='text-center'><small>";
						switch ($data['estado_solicitud']) {
							case 1:
								$valor = 'Nueva';
								$clase = "text-success";
								break;
							case 2:
								$valor = 'Eliminada';
								$clase = "text-danger";
								break;
							case 3:
								$valor = 'Modificada';
								$clase = "text-info";
								break;
						}
						echo '<p class="' . $clase . '"><strong>' . $valor . '</strong></p>';
					echo "</small></td>";

					echo "</tr>";
				endforeach;
		?>

							</tbody>
						</table>
					</div>
		<?php
			}
		?>
<!-- FIN HISTORICO -->
					
					

				</div>
			</div>
		</div>
	</div>
</div>

<!-- Tables -->
<script>
$(document).ready(function() {
    $('#dataTables').DataTable( {
        "pageLength": 50,
        "ordering": false,
        "info":     true
    } );
	
    $('#dataTablesHistorico').DataTable( {
        "paging":   false,
        "ordering": false,
        "info":     false,
		"searching": false
    } );
	
	
} );
</script>