<div class="panel panel-primary">
	<div class="panel-heading">Priority Opportunity and Threat</div>
	<div class="panel-body">
    	<form class="form-inline" action ="<?php echo base_url(); ?>master/efas/prioritas" method="POST" enctype="multipart/form-data">
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
				<select class="form-control" name="algoritma" style="width: auto;">
					<option value=0>-- Pilih Algoritma --</option>
					<option value=1 <?php if($algoritma==1){echo "selected";} ?>>AHP</option>
					<option value=2 <?php if($algoritma==2){echo "selected";} ?>>TOPSIS</option>
				</select>
			</div>
			<button type="submit" class="btn btn-default">Submit</button>
		</form>
		<hr>
		<div class="col-lg-6">
			<div class="panel panel-default">
			  <div class="panel-heading"><i>Opportunity</i></div>
			  <div class="table-responsive" style="min-height: 32%; max-height: 32%; overflow-y: auto;">
		    	<?php if($algoritma!=0 && $hasil_algoritma){ ?>
				  	<table class="table">
	  					<tr>
	  						<td class="text-center">Prioritas</td>
	  						<td class="text-center">Judul Berita</td>
	  						<td class="text-center">Bobot</td>
	  					</tr>
				    	<?php $no = 1; foreach($hasil_algoritma as $a):?>
				    		<?php if($a['kelas']==1){ ?>
			  					<tr>
							    	<td><?php echo $no;?></td>
									<td><?php echo $a['berita']; ?></td>
									<td><?php echo $a['bobot']; ?></td>
			  					</tr>
			  				<?php $no++; } ?>
						<?php endforeach; ?>
	  				</table>
		  		<?php } ?>
			  </div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="panel panel-default">
			  <div class="panel-heading"><i>Threat</i></div>
			  <div class="table-responsive" style="min-height: 32%; max-height: 32%; overflow-y: auto;">
		    	<?php if($algoritma!=0 && $hasil_algoritma){ ?>
				  	<table class="table">
	  					<tr>
	  						<td class="text-center">Prioritas</td>
	  						<td class="text-center">Judul Berita</td>
	  						<td class="text-center">Bobot</td>
	  					</tr>
				    	<?php $no = 1; foreach($hasil_algoritma as $a):?>
				    		<?php if($a['kelas']==2){ ?>
			  					<tr>
							    	<td><?php echo $no;?></td>
									<td><?php echo $a['berita']; ?></td>
									<td><?php echo $a['bobot']; ?></td>
			  					</tr>
			  				<?php $no++; } ?>
						<?php endforeach; ?>
	  				</table>
		  		<?php } ?>
			  </div>
			</div>
		</div>
	</div>
</div>