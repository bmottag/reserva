<div class="col-md-3 left_col">
	<div class="left_col scroll-view">
		<div class="navbar nav_title" style="border: 0;">
			<a href="<?php echo base_url("solicitud/solicitudes_usuario/" . $this->session->userdata("id")); ?>" class="site_title"><i class="fa fa-google-wallet"></i> <span>ZONA 2</span></a>
		</div>

		<div class="clearfix"></div>

		<!-- menu profile quick info -->
		<div class="profile clearfix">
			<div class="profile_pic">
				<img src="<?php echo base_url("images/oxalis.png"); ?>" alt="..." class="img-circle profile_img">
			</div>
			<div class="profile_info">
				<span>Bienvenido,</span>
				<h2><?php echo $userRol = $this->session->name; ?></h2>
			</div>
		</div>
		<!-- /menu profile quick info -->
		<br />
		<!-- sidebar menu -->
		<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
			<div class="menu_section">
				<h3>General</h3>
				<ul class="nav side-menu">
					<li><a href="<?php echo base_url("solicitud"); ?>"><i class="fa fa-hand-o-up"></i> Nueva reserva</a></li>
					<li><a href="<?php echo base_url("solicitud/solicitudes_usuario/" . $this->session->userdata("id")); ?>"><i class="fa fa-list"></i> Listado reservas</a></li>
					<li><a href="<?php echo base_url("solicitud/calendario"); ?>"><i class="fa fa-calendar"></i> Calendario</a></li>
				</ul>
			</div>
		</div>
		<!-- /sidebar menu -->

		<!-- /menu footer buttons -->
		<div class="sidebar-footer hidden-small">
			<a data-toggle="tooltip" data-placement="top" title="Settings">
				<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
			</a>
			<a data-toggle="tooltip" data-placement="top" title="FullScreen">
				<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
			</a>
			<a data-toggle="tooltip" data-placement="top" title="Calendario" href="<?php echo base_url("solicitud/calendario"); ?>">
				<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
			</a>
			<a data-toggle="tooltip" data-placement="top" title="Salir" href="<?php echo base_url("menu/salir"); ?>">
				<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
			</a>
		</div>
		<!-- /menu footer buttons -->
	</div>
</div>