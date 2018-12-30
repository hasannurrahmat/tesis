<html>
	<head>
		<title></title>
		<meta name="viewport" content="width=device-widtth, initial-scale=1.0">
		<link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/background.css">
	</head>
	<body>

		<?php $this->load->view('template/menunavigasi'); ?>
		<?php $this->load->view('template/alert'); ?>

		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="page-header">
								<h3>Tambah Data Training</h3>
							
							</div>
							<form class="form-horizontal" role="form" action ="<?php echo base_url(); ?>master/berita/submit" method="POST" enctype="multipart/form-data">
								<div class="form-group">
									<label class="col-sm-2 control-label required">Situs</label>
									<div class="col-sm-10">
										<select class="form-control" name="id_situs">
											<option value=0>-- Pilih Situs --</option>
											<?php foreach($situs as $j): ?>
											<?php if($j->id_situs == $id_situs){ ?>
												<option selected value="<?php echo $j->id_situs; ?>"><?php echo $j->situs; ?></option>
											<?php }else{ ?>
												<option value="<?php echo $j->id_situs; ?>"><?php echo $j->situs; ?></option>
											<?php } endforeach; ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label required">Topik</label>
									<div class="col-sm-10">
										<select class="form-control" name="id_topik">
											<option value=0>-- Pilih Topik --</option>
											<?php foreach($topik as $j): ?>
											<?php if($j->id_topik == $id_topik){ ?>
												<option selected value="<?php echo $j->id_topik; ?>"><?php echo $j->topik; ?></option>
											<?php }else{ ?>
												<option value="<?php echo $j->id_topik; ?>"><?php echo $j->topik; ?></option>
											<?php } endforeach; ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Tanggal Awal<font color="red">*</font></label>
									<div class="col-sm-4">
										<input type="date" class="form-control" name="tanggal_awal">
									</div>
									<label class="col-sm-2 control-label">Tanggal Akhir</label>
									<div class="col-sm-4">
										<input type="date" class="form-control" name="tanggal_akhir">
									</div>
									<div class="col-sm-10">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Page<font color="red">**</font></label>
									<div class="col-sm-10">
										<input type="hidden" class="form-control" name="jenis" value=1>
										<input type="number" class="form-control" name="page" value=1>
									</div>
								</div>
								<div class="form-group">
									
									<label class="col-sm-2 control-label">&nbsp;</label>
									<div class="col-sm-10">
										<font color="red">*</font>&nbsp;<small class="form-text text-muted">Tidak digunakan untuk situs RMOL dan Metrotvnews untuk topik Politics, Social, Legal, dan Environment.</small>
									</div>
									<div class="col-sm-10">
										<font color="red">**</font>&nbsp;<small class="form-text text-muted">Khusus untuk situs RMOL dan Metrotvnews untuk topik Politics, Social, Legal, dan Environment.</small>
									</div>
								</div>
								<hr>
								<div class="pull-right">
								<button type="reset" class="btn btn-warning">Reset</button>
								<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php $this->load->view('template/footer'); ?>
		<script src="<?php echo base_url();?>js/jquery-1.10.2.min.js"></script>
		<script src="<?php echo base_url();?>js/bootstrap.js"></script>
	</body>
</html>
