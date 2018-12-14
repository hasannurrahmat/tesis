<html>
	<head>
		<title></title>
		<meta name="viewport" content="width=device-widtth, initial-scale=1.0">
		<link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/background.css">
		<script src="<?php echo base_url();?>js/jquery-1.10.2.min.js"></script>
		<link class="include" rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/jquery.jqplot.min.css" />
		<style type="text/css">
			.table-borderless > tbody > tr > td,
			.table-borderless > tbody > tr > th,
			.table-borderless > tfoot > tr > td,
			.table-borderless > tfoot > tr > th,
			.table-borderless > thead > tr > td,
			.table-borderless > thead > tr > th {
			    border: none;
			}
		</style>
	</head>
	<body>

		<?php $this->load->view('template/menunavigasi'); ?>
		
		<?php $this->load->view('template/alert'); ?>

		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<?php if($this->session->userdata('id_group_user')==1){ ?>
                   	 <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">Menu Utama</div>
                        <div class="panel-body">
                            <a href="<?php echo base_url();?>master/berita" class="btn btn-primary btn-block">Berita Online</a>
                            <a href="<?php echo base_url();?>efas" class="btn btn-primary btn-block">EFAS</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
					<?php } ?>
                     <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">Profile User</div>
                        <div class="panel-body">
                        	<center><img src="<?php echo base_url();?>uploads/profile_picture/<?php if($user->file_photo){echo $user->file_photo;}else{echo 'profile.png';} ?>" width="150px" height="150px"></center>
                        	<p class="text-center"><?php echo $this->session->userdata('username'); ?></p>
                        	<a href="#import" data-toggle="modal" class="btn btn-default btn-block">Change Picture</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>

				<div class="col-lg-8">
					
                     <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">Data Berita Online</div>
                        <div class="panel-body">
                        	<table class="table table-borderless table-condensed table-responsive">
                        		<tr>
                        			<td class="text-center"><h4>Persentase Jumlah Berita per Situs</h4></td>
                        			<td class="text-center"><h4>Persentase Jumlah Berita per Topik</h4></td>
                        		</tr>
                        		<tr>
                        			<td width="50%"><div id="chart1" style="height:300px;"></div></td>
                        			<td width="50%"><div id="chart2" style="height:300px;"></div></td>
                        		</tr>
                        	</table>
                        	<script>
                        		$(document).ready(function(){
							    	data1 = [[
 									<?php foreach($situs as $s): ?>
							    		['<?php echo $s->situs; ?>', <?php echo $s->jumlah; ?>],
							    	<?php endforeach; ?>
							    	]];
								    
								    var plot1 = jQuery.jqplot('chart1', 
								        data1,
								        {
								            title: ' ', 
								            seriesDefaults: {
								                shadow: false, 
								                renderer: jQuery.jqplot.PieRenderer, 
								                rendererOptions: { padding: 2, sliceMargin: 2, showDataLabels: true }
								            },
								            legend: {
								                show: true,
								                location: 'e',
								                renderer: $.jqplot.EnhancedPieLegendRenderer,
								                rendererOptions: {
								                    numberColumns: 1
								                }
								            },
								        }
								    );

								   	data2 = [[
 									<?php foreach($topik as $t): ?>
							    		['<?php echo $t->topik; ?>', <?php echo $t->jumlah; ?>],
							    	<?php endforeach; ?>
							    	]];
								   								 
								    var plot2 = jQuery.jqplot('chart2', 
								        data2,
								        {
								            title: ' ', 
								            seriesDefaults: {
								                shadow: false, 
								                renderer: jQuery.jqplot.PieRenderer, 
								                rendererOptions: { padding: 2, sliceMargin: 2, showDataLabels: true }
								            },
								            legend: {
								                show: true,
								                location: 'e',
								                renderer: $.jqplot.EnhancedPieLegendRenderer,
								                rendererOptions: {
								                    numberColumns: 1
								                }
								            },
								        }
								    );
								});
	                        	
							</script>
                        </div>
                        <!-- /.panel-body -->
                    </div>						
				</div>
				
			</div>
		</div>

		<div class="modal fade" id="import" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4>Change Profile Picture</h4>
					</div>
					<form class="form-horizontal" role="form" action="<?php echo base_url('auth/ganti'); ?>" method="post" enctype="multipart/form-data">
					<div class="modal-body">
						<div class="form-group">
							<label for="file" class="col-sm-2 control-label">Pilih File</label>
							<div class="col-sm-10">
								<input type="file" name="userfile" size="20" />
							</div>
						</div>
					</div>

					<div class="modal-footer">
						<a class="btn btn-default" data-dismiss="modal">Cancel</a>
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
					</form>
				</div>
			</div>
		</div>

		<?php $this->load->view('template/footer'); ?>

		<script src="<?php echo base_url();?>js/bootstrap.js"></script>
		<script class="include" type="text/javascript" src="<?php echo base_url();?>js/jquery.jqplot.min.js"></script>

		<!-- Additional plugins go here -->
		<script type="text/javascript" src="<?php echo base_url();?>js/plugins/jqplot.pieRenderer.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/plugins/jqplot.enhancedPieLegendRenderer.js"></script>
		<!-- End additional plugins -->
	</body>
</html>