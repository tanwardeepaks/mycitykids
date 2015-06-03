<script>
	$(function() {
		setTimeout(function(){
			$("#errorFlashMsg").fadeOut('slow');
		},2000)
	});
</script>
<div class="msg msg-error  alert alert-dander" id="errorFlashMsg">
<p><?php echo $message; ?></p>
</div>