<div class="panel panel-primary">
	<div class="panel-heading">Build Model Learning</div>
	<div class="panel-body">
    	<form class="form-inline">
			<div class="form-group">
				<label>Load Data preprocessing</label>
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
			<button type="submit" class="btn btn-default">Upload</button>
		</form>
		<hr>
		<div class="well" style="min-height: 32%; max-height: 32%;">
			<p></p>
		</div>
	</div>
</div>