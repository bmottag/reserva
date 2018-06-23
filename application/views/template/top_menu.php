<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
	<nav>
	  <div class="nav toggle">
		<a id="menu_toggle"><i class="fa fa-bars"></i></a>
	  </div>

	  <ul class="nav navbar-nav navbar-right">	  
		
		<li class="">
		  <a href="<?php echo base_url("menu/salir"); ?>" class="user-profile" aria-expanded="false">
			<i class="fa fa-sign-out"></i> Salir
		  </a>
		</li>
		
<?php
	$rol = $this->session->userdata("rol");//consulto rol para mostrar enlaces
	//configuracion solo para usuarios ADMINISTRADOR
	if($rol == 1){
?>
		<li class="">
		  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			<i class="fa fa-cogs"></i> Configuración
			<span class=" fa fa-angle-down"></span>
		  </a>
		  <ul class="dropdown-menu dropdown-usermenu pull-right">
			<li><a href="<?php echo base_url("admin/examen"); ?>"><i class="fa fa-sitemap pull-right"></i> Examen</a></li>
			
			<li><a href="<?php echo base_url("admin/update_parametricas"); ?>" ><i class="fa fa-crosshairs pull-right"></i> Paramétricas</a></li>
			<li><a href="<?php echo base_url("admin/prueba"); ?>"><i class="fa fa-database pull-right"></i> Pruebas</a></li>
			
			<li><a href="<?php echo base_url("admin/tipificacion"); ?>"><i class="fa fa-tags pull-right"></i> Tipificación</a></li>
			
			<li><a href="<?php echo base_url("admin/usuarios"); ?>"><i class="fa fa-users pull-right"></i> Usuarios</a></li>
			
		  </ul>
		</li>	
<?php
	}
?>
		
<?php
	//usuario GESTOR no tiene acceso
	if($rol != 3){
?>	
		<li class="">
		  <a href="<?php echo base_url("public/reportico/run.php?execute_mode=MENU&project=Zona 2"); ?>" target="_blanck" class="user-profile" aria-expanded="false">
			<i class="fa fa-area-chart"></i> Reporte
		  </a>
		</li>
		
<?php
	}
?>

	  </ul>
	</nav>
  </div>
</div>
<!-- /top navigation -->