<script>


    /*$(window).load(function(){

    var cameraType = $('#cameraType').val();
     var cameraFeatureId = $('#CameraFeatureProductId').val();
    				  $.ajax({
    						   type: "POST",
    						   url: '<?php echo Router::url('/')?>products/getCameraTypeFroms',
    						   data: {  cameraType: cameraType, cameraFeatureId: cameraFeatureId},



    						   success: function(result) {
    							 //success message mybe...

    							 $('#cameraTypeForms').html(result);

    						   }
    						 });
    });
	$(document).ready(function(){




        $('#cameraType').change(function(){


            var cameraType = $(this).val();
            var cameraFeatureId = $('#CameraFeatureProductId').val();

				  $.ajax({
						   type: "POST",
						   url: '<?php echo Router::url('/')?>products/getCameraTypeFroms',
						   data: { cameraType: cameraType, cameraFeatureId: cameraFeatureId},



						   success: function(result) {
							 //success message mybe...

							 $('#cameraTypeForms').html(result);

						   }
						 });



        });



	}); */
</script>

<div class="row-fluid">
				<ul class="breadcrumb">
					<?php
						$this->Html->addCrumb('Dashboard',array('controller'=>'dashboards','action'=>'index'));
						$this->Html->addCrumb('Products',array('controller'=>'products','action'=>'index'));
						$this->Html->addCrumb('Camera Feature');
						echo $this->Html->getCrumbs(' / ');
					?>
					
				</ul>
				<h2 class="heading">Camera Feature</h2>
			</div>
<div class="row-fluid">
		<?php echo $this->Form->create('CameraFeature',array('class'=>'form-horizontal','enctype'=>'multipart/form-data')); ?>
          <div class="widget widget-padding span12">
            <div class="widget-header">
              <i class="icon-list-alt"></i><h5>Camera Feature</h5>
            
            </div>



            <div class="widget-body">
              <div class="widget-forms clearfix">
			  		
                    <div class="control-group">
                    <label class="control-label">&nbsp;</label>
                    <div class="controls">
                      &nbsp;
                    </div>
                  </div>	
              		
                 <div class="control-group">
                    <label class="control-label">Type</label>
                    <div class="controls">
                      <ul style="list-style-type:none">
					  <?php
						$type = array(
								'Box' => ' Box',
								'Dom' => ' Dom',
								'Ptz' => ' Ptz'
							);
							
							$attributes = array(
								'separator'=> '</label></li><li><label>',
								'label' => false,
								'div' => false,
								'legend' => false,
								'hiddenField'=>true,
								'default' => 'Box'
							);

						echo $this->Form->radio('type', $type, $attributes);
					?>
					</ul>
                    </div>
 </div>
			 
 <div class="control-group">
		<label class="control-label">Cover Area</label>
		<div class="controls">
                     <ul style="list-style-type:none"> 
					  <?php
						$coverAreaOption = array(
								'Indoor' => ' Indoor',
								'Outdoor' => ' Outdoor'
							);
							
							$attributes = array(
								'separator'=> '</label></li><li><label>',
								'label' => false,
								'div' => false,
								'legend' => false,
								'hiddenField'=>true,
								'default' => 'Indoor'
							);

						echo $this->Form->radio('cover_area', $coverAreaOption, $attributes);
					?>
					</ul>
                    </div>
 </div>

                  <div class="control-group">
                      <label class="control-label">IR Illuminator</label>
                      <div class="controls">
                          <ul style="list-style-type:none">
                          <?php
                            $ir_IlluminatorOption = array(
                                    'Yes' => ' Yes',
                                    'No' => ' No'
                                );

                                $attributes = array(
                                    'separator'=> '</label></li><li><label>',
                                    'label' => false,
                                    'div' => false,
                                    'legend' => false,
                                    'hiddenField'=>true,
                                    'default' => 'Indoor'
                                );

                            echo $this->Form->radio('ir_Illuminator', $ir_IlluminatorOption, $attributes);
                        ?>
                          </ul>
                      </div>
                  </div>

                  <div class="control-group">
                      <label class="control-label">Camera Type</label>
                      <div class="controls">
                          <ul style="list-style-type:none">
                          <?php
                            $camera_type = array(
                                    'Analog' => ' Analog',
                                    'IP' => ' IP'
                                );


                            echo $this->Form->input('camera_type',array('options'=>$camera_type,'div'=>false,'label'=>false,'empty' =>'-select-', 'id' => 'cameraType'));
                        ?>
                          </ul>
                      </div>
                  </div>
 

                <!---- Get Camera Type Form---->


                    <div id="cameraTypeForms"></div>

                <!-----</code>----------->
				  <div class="control-group">
                      <label class="control-label">Screen Resolution</label>
                      <div class="controls">
                          <ul style="list-style-type:none">
                          <?php
                           $screen_resolution = array('4' => '160 x 120', '15' => '320 x 240', '37' => '640 x 240', '59' => '640 x 480');
						   echo $this->Form->input('screen_resolution',array('options'=>$screen_resolution,'div'=>false,'label'=>false, 'id' => 'cameraType'));
                        ?>
                          </ul>
                      </div>
                  </div>

  <div class="control-group">
		<label class="control-label">Vandal Proof</label>
		<div class="controls">
		  <?php 
		  echo $this->Form->checkbox('vandal_proof', array(
											'value' => '1',
											'hiddenField' => true,
										));
		  ?>
		</div>
 </div>



 
<div class="control-group">
		<label class="control-label">Image Sensor Size</label>
		<div class="controls">
		<?php 
		$imageSensorArr = array_keys(Configure::read('IMAGESIZESENSOR'));	
		$imageSensorSizeOption  = array_combine($imageSensorArr,$imageSensorArr);
		echo $this->Form->input('image_sensor_size',array('options'=>$imageSensorSizeOption,'div'=>false,'label'=>false)); ?>
		</div>
 </div>
 
 <div class="control-group">
		<label class="control-label">Horizontal Effective Pixel</label>
		<div class="controls">
		  <?php 
			echo $this->Form->input('hrz_eff_pix',array('options'=>Configure::read('HEFFECTIVEPIXEL'),'div'=>false,'empty'=>'-Select Horizontal Effective Pixel-','label'=>false)); 
			?>
		</div>
 </div>
 
 <div class="control-group">
		<label class="control-label">Min Focal Length</label>
		<div class="controls">
		  	<?php 
			echo $this->Form->input('min_focal_length',array('options'=>Configure::read('FOCALLENGTH'),'div'=>false,'empty'=>'-Select Min Focal Length-','label'=>false)); 
			?>
		</div>
 </div>
 
 <div class="control-group">
		<label class="control-label">Max Focal Length</label>
		<div class="controls">
	  <?php 
	 echo $this->Form->input('max_focal_length',array('options'=>Configure::read('FOCALLENGTH'),'div'=>false,'empty'=>'-Select Max Focal Length-','label'=>false)); 
	  ?>
		</div>
 </div>
 
 <div class="control-group">
		<label class="control-label">Day Night</label>
		<div class="controls">
		<ul style="list-style-type:none">
		  <?php
						$dayNightOption = array(
								'No' => ' No',
								'Electronic' => ' Electronic',
								'Auto/Day/Night' => ' Auto/Day/Night',
								'IR cut filter with auto switch' => ' IR cut filter with auto switch'
							);
							
							$attributes = array(
								'separator'=> '</label></li><li><label>',
								'label' => false,
								'div' => false,
								'legend' => false,
								'hiddenField'=>true,
								'default' => 'No'
							);

						echo $this->Form->radio('day_night', $dayNightOption, $attributes);
					?>
		</ul>		
		</div>

<div class="control-group">
		<label class="control-label">Wide Dynamic Range</label>
		<div class="controls">
		  <?php 
		  echo $this->Form->checkbox('wdr', array(
											'value' => '1',
											'hiddenField' => true,
										));
		  ?>
		</div>
 </div>
 		
 </div>
              </div>
            </div>
            <div class="widget-footer">
               <button class="btn btn-primary" type="submit">Next</button>
               <button class="btn" onclick="window.location.href = '<?php echo Router::url('/');?>products'" type="button">Cancel</button>
            </div>
          </div>
		   <?php
		   if($requireAction == 'update'){ 
		   		echo $this->Form->hidden('id');
			}	
		   echo $this->Form->hidden('product_id');
		   echo $this->Form->end(); ?>
        </div>
		

	