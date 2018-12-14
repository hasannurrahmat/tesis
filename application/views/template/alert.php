<?php $message = $this->session->flashdata('message'); $statusmessage = $this->session->flashdata('statusmessage'); if($statusmessage=='1'){ ?>
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php echo $message; ?>
	</div>
<?php }elseif($statusmessage=='2'){ ?>
	<div class="alert alert-warning alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php echo $message; ?>
	</div>
<?php } ?>