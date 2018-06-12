<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="baseurl" content="<?php echo base_url()?>" />
	<link rel="icon" href="<?php echo base_url("images/favicon2.ico"); ?>" type="image/ico" />

    <title>ZONA 2 </title>

    <!-- Bootstrap -->
	<link href="<?php echo base_url("assets/bootstrap/vendors/bootstrap/dist/css/bootstrap.min.css"); ?>" rel="stylesheet">
    <!-- Font Awesome -->
	<link href="<?php echo base_url("assets/bootstrap/vendors/font-awesome/css/font-awesome.min.css"); ?>" rel="stylesheet">
    <!-- NProgress -->
	<link href="<?php echo base_url("assets/bootstrap/vendors/nprogress/nprogress.css"); ?>" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
	<link href="<?php echo base_url("assets/bootstrap/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css"); ?>" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
	<link href="<?php echo base_url("assets/bootstrap/vendors/bootstrap-daterangepicker/daterangepicker.css"); ?>" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="<?php echo base_url("assets/bootstrap/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css"); ?>" rel="stylesheet">

    <!-- Datatables -->
    <link href="<?php echo base_url("assets/bootstrap/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/bootstrap/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/bootstrap/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/bootstrap/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/bootstrap/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css"); ?>" rel="stylesheet">
	
    <!-- Custom Theme Style -->
	<link href="<?php echo base_url("assets/bootstrap/build/css/custom.min.css"); ?>" rel="stylesheet">
	
    <!-- jQuery -->
	<script src="<?php echo base_url("assets/bootstrap/vendors/jquery/dist/jquery.min.js"); ?>"></script>
	<!-- jQuery validate-->
	<script type="text/javascript" src="<?php echo base_url("assets/js/general/general.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/general/jquery.validate.js"); ?>"></script>
	
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
			
			<!-- left navigation -->
			<?php $this->load->view("template/left_menu"); ?>
			<!-- top navigation -->
			<?php $this->load->view("template/top_menu"); ?>
			<!-- Start of content -->
			<?php
			if (isset($view) && ($view != '')) {
				$this->load->view($view);
			}
			?>
			<!-- End of content -->





        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Reservas - BMG
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- Bootstrap -->
	<script src="<?php echo base_url("assets/bootstrap/vendors/bootstrap/dist/js/bootstrap.min.js"); ?>"></script>
    <!-- FastClick -->
	<script src="<?php echo base_url("assets/bootstrap/vendors/fastclick/lib/fastclick.js"); ?>"></script>
    <!-- NProgress -->
	<script src="<?php echo base_url("assets/bootstrap/vendors/nprogress/nprogress.js"); ?>"></script>
    <!-- bootstrap-progressbar -->
	<script src="<?php echo base_url("assets/bootstrap/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"); ?>"></script>
    <!-- Skycons -->
	<script src="<?php echo base_url("assets/bootstrap/vendors/skycons/skycons.js"); ?>"></script>
    <!-- DateJS -->
	<script src="<?php echo base_url("assets/bootstrap/vendors/DateJS/build/date.js"); ?>"></script>
    <!-- bootstrap-daterangepicker -->
	<script src="<?php echo base_url("assets/bootstrap/vendors/moment/min/moment.min.js"); ?>"></script>
	<script src="<?php echo base_url("assets/bootstrap/vendors/bootstrap-daterangepicker/daterangepicker.js"); ?>"></script>
	
    <!-- Datatables -->
    <script src="<?php echo base_url("assets/bootstrap/vendors/datatables.net/js/jquery.dataTables.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/bootstrap/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/bootstrap/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/bootstrap/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/bootstrap/vendors/datatables.net-buttons/js/buttons.flash.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/bootstrap/vendors/datatables.net-buttons/js/buttons.html5.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/bootstrap/vendors/datatables.net-buttons/js/buttons.print.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/bootstrap/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/bootstrap/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/bootstrap/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/bootstrap/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"); ?>"></script>
    <script src="<?php echo base_url("assets/bootstrap/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/bootstrap/vendors/jszip/dist/jszip.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/bootstrap/vendors/pdfmake/build/pdfmake.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/bootstrap/vendors/pdfmake/build/vfs_fonts.js"); ?>"></script>

    <!-- Custom Theme Scripts -->
	<script src="<?php echo base_url("assets/bootstrap/build/js/custom.min.js"); ?>"></script>
	
  </body>
</html>