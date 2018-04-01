<script type="text/javascript" src="<?php echo base_url("assets/js/validate/main/inspeccion.js"); ?>"></script>

<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Listado de reservas</h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
				
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

					<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
					
						<h4><?php echo $userInfo?$userInfo[0]["first_name"] . " " . $userInfo[0]["last_name"]:""; ?></h4>

						<ul class="list-unstyled user_data">
							<li><i class="fa fa-phone user-profile-icon"></i> <?php echo $userInfo?$userInfo[0]["movil"]:""; ?>
							</li>

							<li>
								<i class="fa fa-envelope user-profile-icon"></i> <?php echo $userInfo?$userInfo[0]["email"]:""; ?>
							</li>
							
							<li><br>
								<a href="<?php echo base_url("main/checkin/" . $userInfo[0]["id_user"] ); ?>" class="btn btn-success btn-block"><i class="fa fa-plus"></i> Nuevo Inventario</a>
							</li>
							
						</ul>
					 </div>

					<div class="col-md-9 col-sm-9 col-xs-12">

						<table class="table table-striped projects">
							<thead>
								<tr>
									<th style="width: 1%">#</th>
									<th style="width: 10%">Fecha</th>
									<th style="width: 20%">Inspector</th>
									<th>Observaciones</th>
									<th style="width: 30%">Enlaces</th>
								</tr>
							</thead>
							<tbody>
		<?php 
			if($information){
				foreach ($information as $data):
					echo "<tr>";
					echo "<td>" . $data['id_inspeccion'] . "</td>";
					echo "<td>" . $data['date_inspeccion'] . "</td>";
					echo "<td>" . $data['inspector'] . "</td>";
					echo "<td>" . $data['observaciones'] . "</td>";
					echo "<td class='text-center'>";
					echo "<a href='" . base_url("main/checkin/" . $data['fk_id_user_cliente'] . "/". $data['id_inspeccion']) . "' class='btn btn-info btn-xs'><i class='fa fa-arrow-right'></i> Check In </a>";
					echo "<a href='" . base_url("main/checkout/" . $data['fk_id_user_cliente'] . "/". $data['id_inspeccion']) . "' class='btn btn-danger btn-xs'><i class='fa fa-arrow-left'></i> Check Out </a>";					
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