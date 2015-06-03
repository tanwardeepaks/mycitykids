<script>

$(document).ready(function(){


    $('.CameraFeatureHardDisk').bind('keypress', function(e) {
			return ( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)) ? false : true ;
		});

});
</script>
<style>
    .span7.CameraFeatureHardDisk{width: 24%; margin-left: 2.7% !important;}
</style>
<div class="row-fluid">
				<ul class="breadcrumb">
					<?php
						$this->Html->addCrumb('Dashboard',array('controller'=>'dashboards','action'=>'index'));
						$this->Html->addCrumb('Products',array('controller'=>'products','action'=>'index'));
						$this->Html->addCrumb('DVR Feature');
						echo $this->Html->getCrumbs(' / ');
					?>

				</ul>
				<h2 class="heading">DVR Feature</h2>
			</div>
<div class="row-fluid">
		<?php echo $this->Form->create('DvrFeature',array('class'=>'form-horizontal','enctype'=>'multipart/form-data')); ?>
          <div class="widget widget-padding span12">
            <div class="widget-header">
              <i class="icon-list-alt"></i><h5>NVR Feature</h5>

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
                    <label class="control-label">Channels</label>
                    <div class="controls">
                      <ul style="list-style-type:none">
					  <?php
                            $channel = array(
                                            '4' => ' 4 Channels',
                                            '8' => ' 8 Channels',
                                            '16' => ' 16 Channels',
                                            '32' => ' 32 Channels'
                                        );


                             echo $this->Form->input('channel',array('options'=>$channel,'div'=>false,'label'=>false,'empty' =>'-select-', 'id' => 'cameraType'));
                      ?>
					</ul>
                    </div>
                 </div>


                 <div class="control-group">
                                     <label class="control-label">Hard Disk Type</label>
                                     <div class="controls">
                                       <ul style="list-style-type:none">
                 					  <?php
                                             $hard_disk_type = array('GB' => ' GB');


                                              echo $this->Form->input('hard_disk_type',array('options'=>$hard_disk_type,'div'=>false,'label'=>false));
                                       ?>
                 					</ul>
                                     </div>
                                  </div>


                 <div class="control-group">
                  		<label class="control-label">Hard Disk</label>
                  		<div class="controls">
                  		  <?php
                  		  echo $this->Form->input('hard_disk', array('class' =>'span7 CameraFeatureHardDisk', 'div'=>false, 'label'=>false, 'type' => 'text', 'placeholder' => 'DVR Memory'));
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
		

	