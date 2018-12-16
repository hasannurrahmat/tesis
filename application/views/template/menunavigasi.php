<div class="navbar navbar-inverse navbar-static-top">
	<div class="container">
		<button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<div class="collapse navbar-collapse navHeaderCollapse">
			<ul class="nav navbar-nav navbar-left">
			 	<li class="dropdown">
					<a href="<?php echo base_url();?>"><span class="glyphicon glyphicon-home"></span>&nbsp; EFAS Online</a>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Data Master <span class="caret"></span></a>
					<ul class="dropdown-menu">
					<li><a href="<?php echo base_url();?>master/berita/">Berita Online</a></li>
					<li><a href="<?php echo base_url();?>master/efas/">EFAS</a></li>
					</ul>
				</li>
			
				<?php if($this->session->userdata('id_usergroup')==1){ ?>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin <span class="caret"></span></a>
					<ul class="dropdown-menu">
					<li><a href="<?php echo base_url();?>admin/ganti/">Ganti Nama Toko</a></li>
					<li><a href="<?php echo base_url();?>admin/user/">User</a></li>
					</ul>
				</li>
				<?php } ?>
			</ul>
			
			<ul class="nav navbar-nav navbar-right">
				
			
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php echo $this->session->userdata('username'); ?> <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li ><a href="<?php echo base_url(); ?>auth/logout"><span class="glyphicon glyphicon-off"></span>&nbsp; Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>


<script>
	document.title = 'EFAS Online';
</script>