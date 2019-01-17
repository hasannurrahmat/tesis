<html>
	<head>
		<title></title>
		<meta name="viewport" content="width=device-widtth, initial-scale=1.0">
		<link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/background.css">
		
	</head>
	<body>

		<?php $this->load->view('template/menunavigasi'); ?>
		

		<div class="container">
			
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-body" style="min-height: 85%; max-height: 85%;">
						<?php $this->load->view('template/alert'); ?>
							<ul class="nav nav-tabs">
								<li role="presentation" <?php if($tahap<=1){ ?>class="active"<?php } ?>><a href="<?php echo base_url();?>master/efas/preprocessing/">Preprocessing</a></li>
								<li role="presentation" <?php if($tahap==2){ ?>class="active"<?php } ?>><a href="<?php echo base_url();?>master/efas/build_model/">Build Model</a></li>
								<li role="presentation" <?php if($tahap==3){ ?>class="active"<?php } ?>><a href="<?php echo base_url();?>master/efas/classification/">Classification</a></li>
								<li role="presentation" <?php if($tahap==4){ ?>class="active"<?php } ?>><a href="<?php echo base_url();?>master/efas/prioritas/">Priority</a></li>
								<li role="presentation" <?php if($tahap==5){ ?>class="active"<?php } ?>><a href="<?php echo base_url();?>master/efas/efas_view/">EFAS</a></li>
								<li role="presentation" <?php if($tahap==6){ ?>class="active"<?php } ?>><a href="<?php echo base_url();?>master/efas/summary/">Summary</a></li>
							</ul>
						  	<br>
							<?php if($tahap<=1){ ?>
								<?php $this->load->view('master/efas/preprocessing'); ?>
							<?php }elseif($tahap==2){ ?>
								<?php $this->load->view('master/efas/build_model'); ?>
							<?php }elseif($tahap==3){ ?>
								<?php $this->load->view('master/efas/classification'); ?>
							<?php }elseif($tahap==4){ ?>
								<?php $this->load->view('master/efas/prioritas'); ?>
							<?php }elseif($tahap==5){ ?>
								<?php $this->load->view('master/efas/efas_view'); ?>
							<?php }elseif($tahap==6){ ?>
								<?php $this->load->view('master/efas/summary'); ?>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php $this->load->view('template/footer'); ?>
		<script src="<?php echo base_url();?>js/jquery-1.10.2.min.js"></script>
		<script src="<?php echo base_url();?>js/bootstrap.js"></script>
	</body>
=======
<html>
	<head>
		<title></title>
		<meta name="viewport" content="width=device-widtth, initial-scale=1.0">
		<link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/background.css">
		
	</head>
	<body>

		<?php $this->load->view('template/menunavigasi'); ?>
		

		<div class="container">
			
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-body" style="min-height: 85%; max-height: 85%;">
						<?php $this->load->view('template/alert'); ?>
							<ul class="nav nav-tabs">
								<li role="presentation" <?php if($tahap<=1){ ?>class="active"<?php } ?>><a href="<?php echo base_url();?>master/efas/preprocessing/">Preprocessing</a></li>
								<li role="presentation" <?php if($tahap==2){ ?>class="active"<?php } ?>><a href="<?php echo base_url();?>master/efas/build_model/">Build Model</a></li>
								<li role="presentation" <?php if($tahap==3){ ?>class="active"<?php } ?>><a href="<?php echo base_url();?>master/efas/classification/">Classification</a></li>
								<li role="presentation" <?php if($tahap==4){ ?>class="active"<?php } ?>><a href="<?php echo base_url();?>master/efas/prioritas/">Priority</a></li>
								<li role="presentation" <?php if($tahap==5){ ?>class="active"<?php } ?>><a href="<?php echo base_url();?>master/efas/efas_view/">EFAS</a></li>
								<li role="presentation" <?php if($tahap==6){ ?>class="active"<?php } ?>><a href="<?php echo base_url();?>master/efas/summary/">Summary</a></li>
							</ul>
						  	<br>
							<?php if($tahap<=1){ ?>
								<?php $this->load->view('master/efas/preprocessing'); ?>
							<?php }elseif($tahap==2){ ?>
								<?php $this->load->view('master/efas/build_model'); ?>
							<?php }elseif($tahap==3){ ?>
								<?php $this->load->view('master/efas/classification'); ?>
							<?php }elseif($tahap==4){ ?>
								<?php $this->load->view('master/efas/prioritas'); ?>
							<?php }elseif($tahap==5){ ?>
								<?php $this->load->view('master/efas/efas_view'); ?>
							<?php }elseif($tahap==6){ ?>
								<?php $this->load->view('master/efas/summary'); ?>
							<?php } ?>
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