<div class="panel panel-primary">
	<div class="panel-heading">EFAS</div>
	<div class="panel-body" style="min-height: 60%; max-height: 60%; overflow-y: auto;">
    	<form class="form-horizontal" role="form" action ="<?php echo base_url(); ?>master/efas/submit_efas" method="POST" enctype="multipart/form-data">
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
			<?php foreach($topik as $s): ?>
				<tr><td colspan=5><?php echo $s->topik; ?></td></tr>
				<?php $no=1; foreach($hasil[$s->id_topik] as $val): ?>
					<?php if($val['kelas']==1){ ?>
						<tr>
							<td width="5%" class="text-center"><?php echo $no; ?></td>
							<td width="50%"><?php echo $val['berita']; ?></td>
							<input type="hidden" name="id_testing_data[]" value="<?php echo $val['id_testing_data']; ?>">
							<td width="10%"><?php echo $val['bobot']; ?></td>
							<input type="hidden" name="bobot[]" value="<?php echo $val['bobot']; ?>">
							<input type="hidden" name="kelas[]" value="1">
							<td width="10%"><input type="text" name="rating[]" class="form-control" value="<?php echo $rating[$val['id_testing_data']]; ?>"></td>
							<td width="10%" class="active"></td>
						</tr>
					<?php $no++; } ?>
				<?php endforeach; ?>
			<?php endforeach; ?>
			<tr>
				<td colspan=5 class="danger">Threat</td>
			</tr>
			<?php foreach($topik as $s): ?>
				<tr><td colspan=5><?php echo $s->topik; ?></td></tr>
				<?php $no=1; foreach($hasil[$s->id_topik] as $val): ?>
					<?php if($val['kelas']==2){ ?>
						<tr>
							<td width="5%" class="text-center"><?php echo $no; ?></td>
							<td width="50%"><?php echo $val['berita']; ?></td>
							<input type="hidden" name="id_testing_data[]" value="<?php echo $val['id_testing_data']; ?>">
							<td width="10%"><?php echo $val['bobot']; ?></td>
							<input type="hidden" name="bobot[]" value="<?php echo $val['bobot']; ?>">
							<input type="hidden" name="kelas[]" value="2">
							<td width="10%"><input type="text" name="rating[]" class="form-control" value="<?php echo $rating[$val['id_testing_data']]; ?>"></td>
							<td width="10%" class="active"></td>
						</tr>
					<?php $no++; } ?>
				<?php endforeach; ?>
			<?php endforeach; ?>
			<?php }else{ ?>
				<tr><td colspan=8>Tidak ada data, silahkan tambah data</td></tr>
			<?php } ?>
		</table>
		<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>