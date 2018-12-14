
	
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
							<h3>List Jumlah Berita<a href="<?php echo base_url();?>master/berita/tambah/"><button class="btn btn-success pull-right">Tambah Berita</button></a></h3>
							</div>
							
							<table class="table table-condensed table-responsive table-bordered">
								<tr class="active">
									<th class="text-center">No</th>
									<th class="text-center">Situs</th>
									<?php foreach($topik as $t): ?>
										<th class="text-center"><?php echo $t->topik ?></th>
									<?php endforeach; ?>
								</tr>
								<?php $no=1; if($situs){ foreach($situs as $s): ?>
								<tr>
									<td width="10%" class="text-center"><?php echo $no; ?></td>
									<td width="25%"><?php echo $s->situs; ?></td>
									<?php foreach($topik as $t): $status=0; ?>
										<?php foreach($listberita as $l): ?>
											<?php if($s->id_situs == $l->id_situs && $t->id_topik == $l->id_topik){ ?>
												<td width="10%"><a href="<?php echo base_url();?>master/berita/home/<?php echo $l->id_topik_situs; ?>"><?php echo $l->jumlah; ?></a></td>
											<?php $status=1; } ?>
										<?php endforeach; ?>
											<?php if($status==0){ ?>
												<td width="10%"><?php echo '-'; ?></td>
											<?php } ?>
									<?php endforeach; ?>
								</tr>
								<?php $no++; endforeach; }else{ ?>
									<tr><td colspan=8>Tidak ada data, silahkan tambah data</td></tr>
								<?php } ?>
							</table>

							<?php if($detailberita){ ?>
								<div class="panel panel-default">
								<!-- Default panel contents -->
								<div class="panel-heading">Detail Berita dari Situs <?php echo $nama_situs.' Topik: '.$nama_topik; ?></div>
									<!-- Table -->
									<table class="table table-condensed table-responsive table-hover">
										<?php $no=$page+1; foreach($detailberita as $d): ?>
											<tr>
												<td><?php echo $no; ?></td>
												<td><?php echo $d->berita; ?></td>
											</tr>
										<?php $no++; endforeach; ?>
									</table>
									<p><?php echo $links; ?></p>
								</div>
							<?php } ?>
							<a href="<?php echo base_url();?>master/berita/tambah/"><button class="btn btn-primary">Export Dataset</button></a>
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