<script>
	$(function() {
		setTimeout(function(){
			$("#successFlashMsg").fadeOut('slow');
		},2000)
	});
</script>
<div class="msg msg-ok alert alert-success" id="successFlashMsg">
<p><?php echo $message; ?></p>
</div>