<div class="panel panel-primary">
	<div class="panel-heading">Summary</div>
		<div class="panel-body">
	   	<div class="well" style="min-height: 52%; max-height:52%;">
			<p>Total Skor perhitungan EFAS adalah <?php echo $total_score; ?>, ini menandakan bahwa perusahaan menunjukkan posisi eksternal <b><?php if($total_score<2){ echo "LEMAH";}elseif($total_score>1.99 && $total_score<3){echo "RATA-RATA";}else{echo "KUAT";} ?></b>. Hasil akhir dari tabel EFAS yang telah ternormalisasi dapat dilihat pada tabel di bawah ini.</p>
			
			<div style="min-height: 40%; max-height: 40%; overflow-y: auto;">
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
								<td width="10%"><?php echo number_format($weight[$val['id_testing_data']],4); ?></td>
								<td width="10%"><?php echo $rating[$val['id_testing_data']]; ?></td>
								<td width="10%"><?php echo number_format($score[$val['id_testing_data']],4); ?></td>
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
								<td width="10%"><?php echo number_format($weight[$val['id_testing_data']],4); ?></td>
								<td width="10%"><?php echo $rating[$val['id_testing_data']]; ?></td>
								<td width="10%"><?php echo number_format($score[$val['id_testing_data']],4); ?></td>
							</tr>
						<?php $no++; } ?>
					<?php endforeach; ?>
				<?php endforeach; ?>
				<tr>
					<td colspan="2">Jumlah</td>
					<td>1</td>
					<td>&nbsp;</td>
					<td><b><?php echo $total_score; ?></b></td>
				</tr>
				<?php }else{ ?>
					<tr><td colspan=8>Tidak ada data, silahkan tambah data</td></tr>
				<?php } ?>
			</table>
			</div>
		</div>
		</div>
	</div>
</div>