<div class="panel panel-primary">
	<div class="panel-heading">Preprocessing</div>
	<div class="panel-body">
    	<form class="form-inline" action ="<?php echo base_url(); ?>master/efas/preprocessing_submit" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label>Load Data</label>
				<input type="file" class="form-control" name="userfile" size="20" style="width: auto;">
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
				<label>Jenis</label>
				<select class="form-control" name="jenis" style="width: auto;">
					<option value=0>-- Pilih Data --</option>
					<option value=1>Data Training</option>
					<option value=2>Data Testing</option>
				</select>
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