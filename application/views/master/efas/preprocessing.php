<div class="panel panel-primary">
	<div class="panel-heading">Preprocessing</div>
	<div class="panel-body">
    	<form class="form-inline" action ="<?php echo base_url(); ?>master/efas/preprocessing_submit" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label>Load Data Training</label>
				<input type="file" class="form-control" name="userfile" size="20" style="width: auto;">
			</div>
			
			<button type="submit" class="btn btn-default">Upload</button>
		</form>
		<hr>
		<div class="well" style="min-height: 32%; max-height: 32%;">
			<?php if($cek){ ?>
				<p>Anda sudah memiliki data training yang telah dilakukan preprocessing, silahkan download file di bawah ini untuk digunakan pada menu build model. Jika ingin melakukan preprocessing ulang, silahkan upload file data training yang terbaru.</p>
				<p>File Preprocessing Training untuk Kateogri Politik: <a href="<?php echo base_url(); ?>master/efas/download_preprocess/1">Click here</a><br>
				File Preprocessing Training untuk Kateogri Ekonomi: <a href="<?php echo base_url(); ?>master/efas/download_preprocess/2">Click here</a><br>
				File Preprocessing Training untuk Kateogri Sosial: <a href="<?php echo base_url(); ?>master/efas/download_preprocess/3">Click here</a><br>
				File Preprocessing Training untuk Kateogri Teknologi: <a href="<?php echo base_url(); ?>master/efas/download_preprocess/4">Click here</a><br>
				File Preprocessing Training untuk Kateogri Legal: <a href="<?php echo base_url(); ?>master/efas/download_preprocess/5">Click here</a><br>
				File Preprocessing Training untuk Kateogri Environmental: <a href="<?php echo base_url(); ?>master/efas/download_preprocess/6">Click here</a></p>
			<?php } ?>
		</div>
	</div>
</div>