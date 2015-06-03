  <script language="javascript">
		  var config = {
			  '.chosen-select'           : {},
			  '.chosen-select-deselect'  : {allow_single_deselect:true},
			  '.chosen-select-width'     : {width:"95%"}
			}
			for (var selector in config) {
			  $(selector).chosen(config[selector]);
			}
	</script>
  <label class="control-label">Feature Group</label>
	<div class="controls">
	<?php 
	echo $this->Form->input('Feature.feature_group_id',array('div'=>false,'label'=>false,'class'=>'span7 chosen-select','options'=>$featureGroups,'empty'=>'-Select Feature Group-'));
	?>
	</div>