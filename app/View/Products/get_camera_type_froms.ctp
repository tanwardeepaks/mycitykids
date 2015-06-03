<script>
    $('.CameraFeatureHardDisk').bind('keypress', function(e) {
			return ( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)) ? false : true ;
		});

</script>
<?php
    $hard_disk = '';

    if($cameraTypeValues['CameraFeature']['hard_disk'] != ''){

         $hard_disk = $cameraTypeValues['CameraFeature']['hard_disk'];
    }




?>
<?php if($this->data['cameraType'] == 'Analog'){ ?>
<div class="control-group">
 		<label class="control-label">Hard Disk</label>
 		<div class="controls">
 		  <?php
 		  echo $this->Form->input('CameraFeature.hard_disk', array('class' =>'span7 CameraFeatureHardDisk', 'div'=>false, 'label'=>false, 'type' => 'text', 'placeholder' => 'Analog Camrea Hard Disk in GB ', 'value' => $hard_disk));
 		  ?>
 		</div>
  </div>

<?php } if($this->data['cameraType'] == 'IP'){  ?>

<div class="control-group">
 		<label class="control-label">Hard Disk</label>
 		<div class="controls">
 		  <?php
 		  echo $this->Form->input('CameraFeature.hard_disk', array('class' =>'span7 CameraFeatureHardDisk', 'div'=>false, 'label'=>false, 'type' => 'text', 'placeholder' => 'IP Camrea Hard Disk in GB', 'value' => $hard_disk));
 		  ?>
 		</div>
  </div>
<?php } ?>
