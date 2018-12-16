
	
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
							<div>

							  <!-- Nav tabs -->
							  <ul class="nav nav-tabs" role="tablist">
							    <li role="presentation" class="active"><a href="#model" aria-controls="model" role="tab" data-toggle="tab">Build Model</a></li>
							    <li role="presentation"><a href="#kategori" aria-controls="kategori" role="tab" data-toggle="tab">Text Categorization</a></li>
							    <li role="presentation"><a href="#prioritas" aria-controls="prioritas" role="tab" data-toggle="tab">Priority Strenght and Threat</a></li>
							    <li role="presentation"><a href="#hasil" aria-controls="hasil" role="tab" data-toggle="tab">EFAS</a></li>
							  </ul>

							  <!-- Tab panes -->
							  <div class="tab-content">
							  	<!-- Build Model -->
							    <div role="tabpanel" class="tab-pane active" id="model">
						    		<br>
				    				<div class="panel panel-primary">
							    		<div class="panel-heading">Build Model Learning</div>
										<div class="panel-body" style="min-height: 50%; max-height: 50%;">
									    	<form class="form-inline">
												<div class="form-group">
													<label>Load Data Training</label>
													<input type="file" class="form-control" style="width: auto;">
												</div>
												<div class="form-group">
													<label>Topic</label>
													<select class="form-control" name="id_topik" style="width: auto;">
														<option value=0>-- Pilih Topik --</option>
														<?php foreach($topik as $j): ?>
														<?php if($j->id_topik == $id_topik){ ?>
															<option selected value="<?php echo $j->id_topik; ?>"><?php echo $j->topik; ?></option>
														<?php }else{ ?>
															<option value="<?php echo $j->id_topik; ?>"><?php echo $j->topik; ?></option>
														<?php } endforeach; ?>
													</select>
												</div>
												<div class="form-group">
													<label>Algorithm</label>
													<select class="form-control" name="algoritma" style="width: auto;">
														<option value=1>Naive Bayes</option>
														<option value=2>SVM</option>
														<option value=3>J48</option>
													</select>
												</div>
												<button type="submit" class="btn btn-default">Upload</button>
											</form>
											<hr>
											<div class="well" style="min-height: 32%; max-height: 32%;">
												<p></p>
											</div>
										</div>
									</div>
							    </div>
							    
							    <!-- Text Categorization -->
							    <div role="tabpanel" class="tab-pane" id="kategori">
							    	<br>
				    				<div class="panel panel-primary">
							    		<div class="panel-heading">Text Categorization</div>
										<div class="panel-body" style="min-height: 50%; max-height: 50%;">
									    	<form class="form-inline">
												<div class="form-group">
													<label>Load Data Testing</label>
													<input type="file" class="form-control" style="width: auto;">
												</div>
												<div class="form-group">
													<label>Topic</label>
													<select class="form-control" name="id_topik" style="width: auto;">
														<option value=0>-- Pilih Topik --</option>
														<?php foreach($topik as $j): ?>
														<?php if($j->id_topik == $id_topik){ ?>
															<option selected value="<?php echo $j->id_topik; ?>"><?php echo $j->topik; ?></option>
														<?php }else{ ?>
															<option value="<?php echo $j->id_topik; ?>"><?php echo $j->topik; ?></option>
														<?php } endforeach; ?>
													</select>
												</div>
												<div class="form-group">
													<label>Algorithm</label>
													<select class="form-control" name="algoritma" style="width: auto;">
														<option value=1>Naive Bayes</option>
														<option value=2>SVM</option>
														<option value=3>J48</option>
													</select>
												</div>
												<button type="submit" class="btn btn-default">Upload</button>
											</form>
											<hr>
											<div class="well" style="min-height: 32%; max-height: 32%;">
												<p></p>
											</div>
										</div>
									</div>
							    </div>

							    <!-- Priority -->
							    <div role="tabpanel" class="tab-pane" id="prioritas">
							    	<br>
				    				<div class="panel panel-primary">
							    		<div class="panel-heading">Priority Opportunity and Threat</div>
										<div class="panel-body" style="min-height: 50%; max-height: 50%;">
									    	<form class="form-inline">
												<div class="form-group">
													<label>Load Data Categorization</label>
													<input type="file" class="form-control" style="width: auto;">
												</div>
												<div class="form-group">
													<label>Topic</label>
													<select class="form-control" name="id_topik" style="width: auto;">
														<option value=0>-- Pilih Topik --</option>
														<?php foreach($topik as $j): ?>
														<?php if($j->id_topik == $id_topik){ ?>
															<option selected value="<?php echo $j->id_topik; ?>"><?php echo $j->topik; ?></option>
														<?php }else{ ?>
															<option value="<?php echo $j->id_topik; ?>"><?php echo $j->topik; ?></option>
														<?php } endforeach; ?>
													</select>
												</div>
												<div class="form-group">
													<label>Algorithm</label>
													<select class="form-control" name="algoritma" style="width: auto;">
														<option value=1>AHP</option>
														<option value=2>ANP</option>
													</select>
												</div>
												<button type="submit" class="btn btn-default">Upload</button>
											</form>
											<hr>
											<div class="well" style="min-height: 32%; max-height: 32%;">
												<p></p>
											</div>
										</div>
									</div>
							    </div>
							    
							    <!-- EFAS -->
							    <div role="tabpanel" class="tab-pane" id="hasil">
							    	<br>
				    				<div class="panel panel-primary">
							    		<div class="panel-heading">EFAS</div>
										<div class="panel-body" style="min-height: 50%; max-height: 50%; overflow-y: auto;">
									    	<form class="form-horizontal" role="form" action ="<?php echo base_url(); ?>master/berita/submit" method="POST" enctype="multipart/form-data">
									    	<table class="table table-condensed table-responsive table-bordered">
												<tr class="active">
													<th class="text-center" colspan=2>External Factors</th>
													<th class="text-center">Weight</th>
													<th class="text-center">Rating</th>
													<th class="text-center">Score</th>
												</tr>
												<?php if($topik){ ?>
												<tr>
													<td colspan=5 class="success">Opportunity</td>
												</tr>
												<?php $no=1; foreach($topik as $s): ?>
												<tr>
													<td width="10%" class="text-center"><?php echo $no; ?></td>
													<td width="25%"><?php echo $s->topik; ?></td>
													<td></td>
													<td><input type="text" name="" class="form-control"></td>
													<td></td>
												</tr>
												<?php $no++; endforeach; ?>
												<tr>
													<td colspan=5 class="danger">Weakness</td>
												</tr>
												<?php $no=1; foreach($topik as $s): ?>
												<tr>
													<td width="10%" class="text-center"><?php echo $no; ?></td>
													<td width="25%"><?php echo $s->topik; ?></td>
													<td></td>
													<td><input type="text" name="" class="form-control"></td>
													<td></td>
												</tr>
												<?php $no++; endforeach; ?>
												<?php }else{ ?>
													<tr><td colspan=8>Tidak ada data, silahkan tambah data</td></tr>
												<?php } ?>
											</table>
											<button type="submit" class="btn btn-primary">Submit</button>
											</form>
										</div>
									</div>
							    </div>
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