<!DOCTYPE html>

<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title>Vaksin Influenza</title>
	<link rel="icon" href="<?php echo base_url()?>assets/favicon.ico" type="image/x-icon">

	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/dist/css/adminlte.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.css">
	<!-- SWEETALERT -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/sweetalert2/sweetalert2.min.css">
</head>
<body class="hold-transition layout-top-nav">
	<div class="wrapper">

		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
			<div class="container">
				<a href="javascript:void(0)" class="navbar-brand">
					<img src="<?php echo base_url(); ?>assets/logo.png" alt="AdminLTE Logo" class="brand-image">
				</a>
				<div class="collapse navbar-collapse order-3" id="navbarCollapse">
				</div>
				<!-- Right navbar links -->
				<ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
					<!-- Notifications Dropdown Menu -->
					<li class="nav-item dropdown">
						<a class="nav-link" data-toggle="dropdown" href="#">
							<span><?= $log_user ?></span>
						</a>
						<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
							<a href="<?= base_url() ?>" class="dropdown-item">
								<i class="fas fa-luggage-cart"></i> Exchange
							</a>
							<div class="dropdown-divider"></div>
							<a href="<?= base_url('report') ?>" class="dropdown-item">
								<i class="fas fa-clipboard-list"></i> Report
							</a>
							<div class="dropdown-divider"></div>
							<a href="<?= base_url('welcome/signout'); ?>" class="dropdown-item">
								<i class="fas fa-sign-out-alt"></i> Sign Out
							</a>
						</div>
					</li>
				</ul>
			</div>
		</nav>
		<!-- /.navbar -->

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0 text-dark"> Vaksin Influenza </h1>
						</div><!-- /.col -->
						<!-- /.col -->
					</div>
					<!-- /.row -->
				</div>
				<!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<div class="content">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="card card-primary card-outline">
								<div class="card-body">
									<div class="row">
										<div class="col-md-3 form-group">
											<input type="date" class="form-control" name="fDate" id="fDate">
										</div>
										<div class="col-md-3 form-group">
											<select class="form-control" name="fPlace" id="fPlace">
												<option value="">--</option>
												<option>Kedoya</option>
												<option>ABN Nasdem</option>
											</select>
										</div>
										<div class="col-md-3">
											<button type="button" class="btn btn-primary btn-md btn-submit">Filter</button>
											<button type="button" class="btn btn-danger btn-md btn-reset">Reset</button>
										</div>
									</div>
								</div>
								<div class="card-body">
									<table id="reportTbl" class="table table-striped table-hovered">
										<thead>
											<th width="5"></th>
											<th width="70">NIP</th>
											<th>Name</th>
											<th>Directorate</th>
											<th>Division</th>
											<th>Department</th>
											<th>Position</th>
											<th>Place</th>
											<th width="170">Date & Time</th>
											<th><i class="fas fa-cogs"></i></th>
										</thead>
										<tbody></tbody>
									</table>
								</div>
							</div><!-- /.card -->
						</div>
						<!-- /.col-lg-12 -->
					</div>
					<!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<!-- Main Footer -->
		<footer class="main-footer">
			<!-- Default to the left -->
			<strong>Copyright &copy; 2020 - <?= date('Y') ?> <a href="javascript:void(0)">MIS METRO TV</a>.</strong> All rights reserved.
		</footer>
	</div>
	<!-- ./wrapper -->

	<!-- REQUIRED SCRIPTS -->

	<!-- jQuery -->
	<script src="<?php echo base_url(); ?>assets/adminlte/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="<?php echo base_url(); ?>assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url(); ?>assets/adminlte/dist/js/adminlte.min.js"></script>
	<!-- DataTables -->
	<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
	<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
	<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-buttons/js/dataTables.buttons.js"></script>
	<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.js"></script>
	<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-buttons/js/buttons.print.js"></script>
	<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-buttons/js/buttons.html5.js"></script>
	<script src="<?php echo base_url(); ?>assets/adminlte/plugins/jszip/jszip.js"></script>
	<!-- SWEETALERT -->
	<script src="<?php echo base_url(); ?>assets/adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
	<script type="text/javascript">
		var base_url = "<?php echo base_url(); ?>";
		$(function () {
			reportTable();

			function reportTable(fDate = '', fPlace = '') {
				var t = $('#reportTbl').DataTable({
					"dom"			: 'Bflrtip',
					"processing" 	: true,
					"language"		: {
						"processing"	: '<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
					},
					"serverSide"	: true, 
					"order"			: [ 8, 'DESC'], 
					"ajax"			: {
						"url"			: base_url + "report/view_report",
						"type"			: "POST",
						"data"			: {
							"fDate"		: fDate,
							"fPlace"	: fPlace,
						}
					},
					"lengthMenu"	: [[-1], ["All"]],
					"columnDefs" : [{
						"targets"		: [0],
						"visible"		: false,
					},{
						"targets"		: [9],
						"orderable"		: false,
					}],
					"buttons"		: [{
						'extend' : 'excel',
						'exportOptions' : {
							'columns' : [1,2,3,4,5,6,7,8]
						}
					}],
					"searchDelay" 	: 750

				});

				t.on('click', '.btn-delete', function () {
					var row_id = $(this).data('id');
					Swal.fire({
						title: 'Delete data !',
						type: 'warning',
						html: '<span class="italic">Are you sure to delete ?</span>',
						showCancelButton: true,
						confirmButtonText: "Yes, delete it!",
						confirmButtonColor: "#DD6B55",
						showLoaderOnConfirm: true,
					}).then(function(result){
						if (result.value) {
							$.ajax({
								url: base_url + "report/delete",
								type: 'post',
								data: { 'key' : row_id },
								dataType: 'json',
								success: function(data){
									var sa_title = (data.type == 'done') ? "Success!" : "Failed!";
									var sa_type = (data.type == 'done') ? "success" : "error";
									Swal.fire({ title:sa_title, type:sa_type, html:data.msg }).then(function(){
										if (data.type == 'done') window.location.reload();
									});
								}
							});
						}else{
							Swal.fire('Canceled', 'Canceled remove data', 'warning');
						}
					});
				});
			}

			$('.btn-submit').on('click', function () {
				var fDate = $('#fDate').val();
				var fPlace = $('#fPlace').val();
				
				$('#reportTbl').DataTable().destroy();
				reportTable(fDate, fPlace);
				
			});

			$('.btn-reset').on('click', function () {
				$('#fDate').val('');
				$('#fPlace').val('');
				$('#reportTbl').DataTable().destroy();
				reportTable();
			});

		});
	</script>
</body>
</html>
