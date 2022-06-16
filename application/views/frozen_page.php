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

	<title>Bingkisan Idul Fitri (Frozen Food)</title>
	<link rel="icon" href="<?php echo base_url()?>assets/favicon.ico" type="image/x-icon">

	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/dist/css/adminlte.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
	<!-- SWEETALERT -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/sweetalert2/sweetalert2.min.css">
	<!-- SELECT 2 -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/select2/css/select2.min.css">
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
							<h1 class="m-0 text-dark">Bingkisan Idul Fitri (frozen Food)</h1>
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
						<div class="col-lg-6">
							<div class="card card-primary card-outline">
								<div class="card-body form-group">
									<input type="text" class="form-control" name="nip_field" id="nip_field" placeholder="NIP" autofocus="">
								</div>
								<div class="card-body form-group">
									<select class="form-control" name="name_field" id="name_field" >
										<option value="0">--Choose Name--</option>
										<?php
										if (isset($emp) and $emp != 0) {
											foreach ($emp as $row) {
												?>
												<option value="<?= $row->emp_id ?>"><?= $row->emp_nip . ' - ' . $row->emp_name ?></option>
												<?php 
											}
										} 
										?>
									</select><br><br>
									<button type="button" class="btn btn-sm btn-success btn-submit">Choose</button>
								</div>
								<input type="hidden" name="user_id" id="user_id" value="<?= $this->session->userdata(SESS)->log_id ?>">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="card card-primary card-outline">
								<div class="card-body">
									<p class="card-text">NIP : <span id="emp_nip"></span></p>
									<p class="card-text">Nama : <span id="emp_name"></span></p>
									<p class="card-text">Directorate : <span id="emp_dir"></span></p>
									<p class="card-text">Division : <span id="emp_div"></span></p>
									<p class="card-text">Department : <span id="emp_dept"></span></p>
									<p class="card-text">Position : <span id="emp_post"></span></p>
									<p class="card-text">Date & Time : <span id="created_date"></span></p>
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="card card-primary card-outline">
								<div class="card-body">
									<table id="historyTbl" class="table table-striped table-hovered" style="font-size: 11pt;">
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
	<!-- SWEETALERT -->
	<script src="<?php echo base_url(); ?>assets/adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
	<!-- SELECT 2 -->
	<script src="<?php echo base_url(); ?>assets/adminlte/plugins/select2/js/select2.min.js"></script>
	<!-- MOMENT -->
	<script src="<?php echo base_url(); ?>assets/adminlte/plugins/moment/moment.min.js"></script>
	<script type="text/javascript">
		var base_url = "<?php echo base_url(); ?>";
		$(document).ready(function() {

			$('#name_field').select2();
			$('#nip_field').focus();

			histTable();

			$('#nip_field').keyup(function(e){
				var data = {'emp_nip' : $(this).val().toUpperCase(), 'user_id' : $('#user_id').val()};
				if(e.keyCode == 13)
				{
					$.ajax({
						url : base_url + 'frozen/find_data',
						type : 'POST',
						dataType : 'JSON',
						data : data,
						success : function (data) {
							if (data.type == 'done') {
								Swal.fire({
									type	: 'success',
									title 	: 'Success',
									html 	: data.msg,
									showConfirmButton : false,
									timer	: 1500
								}).then(function () {
									$('#nip_field').val('');
									$('#emp_nip').text(data.data[0].emp_nip);
									$('#emp_name').text(data.data[0].emp_name);
									$('#emp_post').text(data.data[0].emp_post);
									$('#emp_dept').text(data.data[0].emp_dept);
									$('#emp_div').text(data.data[0].emp_div);
									$('#emp_dir').text(data.data[0].emp_dir);
									$('#created_date').text(moment(data.data[0].created_date).format('DD MMMM YYYY HH:mm:ss'));
									$('#nip_field').focus();
									histTable();
								});
							}else{
								Swal.fire({
									type	: 'error',
									title : 'Failed !',
									text	: data.msg,
									showConfirmButton : false,
									timer	: 1500
								}).then(function () {
									$('#nip_field').val('');
									$('#nip_field').focus();
									histTable();
								});
							}
						}
					});
				}
			});

			$('.btn-submit').on('click', function () {
				var data = {'emp_id' : $('#name_field').val(), 'user_id' : $('#user_id').val()};

				if (data.emp_id == '') {
					Swal.fire({
						type	: 'error',
						title : 'Failed !',
						text	: data.msg,
						showConfirmButton : false,
						timer	: 1500
					}).then(function () {
						$('#nip_field').focus();
						histTable();
					});
				}else{
					$.ajax({
						url : base_url + 'frozen/find_data2',
						type : 'POST',
						dataType : 'JSON',
						data : data,
						success : function (data) {
							if (data.type == 'done') {
								Swal.fire({
									type	: 'success',
									title 	: 'Success',
									html 	: data.msg,
									showConfirmButton : false,
									timer	: 1500
								}).then(function () {
									window.location.reload();
								});
							}else{
								Swal.fire({
									type	: 'error',
									title : 'Failed !',
									text	: data.msg,
									showConfirmButton : false,
									timer	: 1500
								}).then(function () {
									window.location.reload();
								});
							}
						}
					});
				}
			});

			function histTable() {
				var t = $('#historyTbl').DataTable({
					"dom"			: "ftip",
					"destroy"		: true,
					"processing"	: true,
					"language"		: {
						"processing"	: '<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
					},
					"serverSide"	: true, 
					"order"			: [ 0 , 'DESC'], 
					"ajax"			: {
						"url"			: base_url + "frozen/view_history",
						"type"			: "POST",
					},
					"pageLength"	: 5,
					"columnDefs"	:[{
						"targets"	: [0],
						"visible"	: false
					}]
				});
			}

		});
	</script>
</body>
</html>
