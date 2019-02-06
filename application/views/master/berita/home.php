
	
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
								<h3>List Jumlah Berita Online</h3>
							</div>
							
							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist">
							    <li role="presentation" class="active"><a href="#training" aria-controls="training" role="tab" data-toggle="tab">Data Training</a></li>
							    <li role="presentation"><a href="#testing" aria-controls="testing" role="tab" data-toggle="tab">Data Testing</a></li>
								<div class="text-right">
									<a href="<?php echo base_url();?>master/berita/tambah_training/"><button class="btn btn-success">Tambah Data Training</button></a>
							    	<a href="<?php echo base_url();?>master/berita/tambah_testing/"><button class="btn btn-success">Tambah Data Testing</button></a>
								</div>
							</ul>

							<!-- Tab panes -->
							<div class="tab-content">
								<!-- Data Training -->
							    <div role="tabpanel" class="tab-pane active" id="training">
							    	<br>
							    	<table class="table table-condensed table-responsive table-bordered">
										<tr class="active">
											<th class="text-center">No</th>
											<th class="text-center">Situs</th>
											<?php foreach($topik as $t): ?>
												<th class="text-center"><?php echo $t->topik ?></th>
											<?php endforeach; ?>
										</tr>
										<?php $sum = array(0, 0, 0, 0);  ?>

										<?php $no=1; if($situs){ foreach($situs as $s): ?>
											<tr>
												<td width="10%" class="text-center"><?php echo $no; ?></td>
												<td width="25%"><?php echo $s->situs; ?></td>
												<?php $i=0; foreach($topik as $t): $status=0; ?>
													<?php foreach($list_training as $l): ?>
														<?php if($s->id_situs == $l->id_situs && $t->id_topik == $l->id_topik){ ?>
															<td width="10%" class="text-center"><a href="<?php echo base_url();?>master/berita/home/<?php echo $l->id_topik_situs; ?>"><?php echo $l->jumlah;  $sum[$i] += $l->jumlah; ?></a></td>
														<?php $status=1; } ?>
													<?php endforeach; ?>
														<?php if($status==0){ ?>
															<td width="10%" class="text-center"><?php echo '-'; ?></td>
														<?php } ?>
												<?php $i++; endforeach; ?>
											</tr>
										<?php $no++; endforeach; ?>
										<tr>
											<td colspan="2">Jumlah Berita</td>
											<?php $total = 0; foreach($sum as $t): ?>
												<td width="10%" class="text-center"><b><?php echo $t; $total+=$t; ?></b></td>
											<?php endforeach; ?>
										</tr>
										<tr>
											<td colspan="2">Jumlah Keseluruhan Berita</td>
											<td colspan="4" width="10%" class="text-center"><b><?php echo $total; ?></b></td>

										</tr>
										<?php }else{ ?>
											<tr><td colspan=8>Tidak ada data, silahkan tambah data</td></tr>
										<?php } ?>
									</table>

									<!-- Detail Berita  -->
									<?php if($detailtraining){ ?>
										<div class="panel panel-default">
										<!-- Default panel contents -->
										<div class="panel-heading">Detail Berita dari Situs <?php echo $nama_situs.' Topik: '.$nama_topik; ?></div>
											<!-- Table -->
											<table class="table table-condensed table-responsive table-hover">
												<?php $no=$page_training+1; foreach($detailtraining as $d): ?>
													<tr>
														<td><?php echo $no; ?></td>
														<td><?php echo $d->berita; ?></td>
													</tr>
												<?php $no++; endforeach; ?>
											</table>
											<p><?php echo $links_training; ?></p>
										</div>
									<?php } ?>
									<a href="<?php echo base_url();?>master/berita/export_training/"><button class="btn btn-primary">Export Data Training</button></a>
							    </div>

								<!-- Data Testing -->
							    <div role="tabpanel" class="tab-pane" id="testing">
							    	<br>
							    	<table class="table table-condensed table-responsive table-bordered">
										<tr class="active">
											<th class="text-center">No</th>
											<th class="text-center">Situs</th>
											<?php foreach($topik as $t): ?>
												<th class="text-center"><?php echo $t->topik ?></th>
											<?php endforeach; ?>
										</tr>
										<?php $sum = array(0, 0, 0, 0);  ?>

										<?php $no=1; if($situs){ foreach($situs as $s): ?>
											<tr>
												<td width="10%" class="text-center"><?php echo $no; ?></td>
												<td width="25%"><?php echo $s->situs; ?></td>
												<?php $i=0; foreach($topik as $t): $status=0; ?>
													<?php foreach($list_testing as $l): ?>
														<?php if($s->id_situs == $l->id_situs && $t->id_topik == $l->id_topik){ ?>
															<td width="10%" class="text-center"><a href="<?php echo base_url();?>master/berita/home/<?php echo $l->id_topik_situs; ?>"><?php echo $l->jumlah;  $sum[$i] += $l->jumlah; ?></a></td>
														<?php $status=1; } ?>
													<?php endforeach; ?>
														<?php if($status==0){ ?>
															<td width="10%" class="text-center"><?php echo '-'; ?></td>
														<?php } ?>
												<?php $i++; endforeach; ?>
											</tr>
										<?php $no++; endforeach; ?>
										<tr>
											<td colspan="2">Jumlah Berita</td>
											<?php $total = 0; foreach($sum as $t): ?>
												<td width="10%" class="text-center"><b><?php echo $t; $total+=$t; ?></b></td>
											<?php endforeach; ?>
										</tr>
										<tr>
											<td colspan="2">Jumlah Keseluruhan Berita</td>
											<td colspan="4" width="10%" class="text-center"><b><?php echo $total; ?></b></td>

										</tr>
										<?php }else{ ?>
											<tr><td colspan=8>Tidak ada data, silahkan tambah data</td></tr>
										<?php } ?>
									</table>

									<!-- Detail Berita  -->
									<?php if($detailtesting){ ?>
										<div class="panel panel-default">
										<!-- Default panel contents -->
										<div class="panel-heading">Detail Berita dari Situs <?php echo $nama_situs.' Topik: '.$nama_topik; ?></div>
											<!-- Table -->
											<table class="table table-condensed table-responsive table-hover">
												<?php $no=$page_testing+1; foreach($detailtesting as $d): ?>
													<tr>
														<td><?php echo $no; ?></td>
														<td><?php echo $d->berita; ?></td>
													</tr>
												<?php $no++; endforeach; ?>
											</table>
											<p><?php echo $links_testing; ?></p>
										</div>
									<?php } ?>
									<a href="<?php echo base_url();?>master/berita/export_testing/"><button class="btn btn-primary">Export Data Testing</button></a>
							    </div>
							</div>

							
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