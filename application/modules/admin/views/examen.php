<script>
$(function(){ 
			
	$(".btn-info").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + 'admin/cargarModalExamen',
                data: {'codigoExamen': oID},
                cache: false,
                success: function (data) {
                    $('#tablaDatos').html(data);
                }
            });
	});

});
</script>

<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><i class='fa fa-sitemap'></i> EXAMENES </h2>
					
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>

					</ul>
					<div class="clearfix"></div>
				</div>

				<div class="x_content">

					<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal" id="x" >
						<i class="fa fa-plus"></i> Adicionar examen
					</button>
				
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

				<?php if(!$info){ ?>				
					<div class="alert alert-success alert-dismissible fade in" role="alert">
						<strong>Info:</strong> No hay información.
					</div>
				<?php }else{ ?>
					<div class="table-responsive">
					
						<table id="datatable" class="table table-striped jambo_table bulk_action">
							<thead>
								<tr class="headings">
								<th class="column-title">Examen</th>
								<th class="column-title">Código examen</th>
								<th class="column-title">Editar</th>
								</tr>
							</thead>

							<tbody>
		<?php 
			foreach ($info as $data):
				echo "<tr>";
				echo "<td>" . $data['examen'] . "</td>";
				echo "<td>" . $data['codigo_examen'] . "</td>";

				echo "<td>";
		?>
				<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $data['codigo_examen']; ?>" >
					Edit <span class="glyphicon glyphicon-edit" aria-hidden="true">
				</button>
		<?php	
				echo "</td>";
				echo "</tr>";
			endforeach 
		?>

							</tbody>
						</table>
					</div>
				<?php } ?>
				
				</div>
			</div>
		</div>
	</div>
</div>

<!--INICIO Modal cambio de hora-->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="tablaDatos">

		</div>
	</div>
</div>                       
<!--FIN Modal-->