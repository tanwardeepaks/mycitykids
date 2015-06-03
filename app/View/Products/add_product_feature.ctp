<?php 	
echo $this->Html->script(array('ckeditor/ckeditor'));

?>

<div class="row-fluid">
				<ul class="breadcrumb">
					<?php
						$this->Html->addCrumb('Dashboard',array('controller'=>'dashboards','action'=>'index'));
						$this->Html->addCrumb('Products',array('controller'=>'products','action'=>'index'));
						$this->Html->addCrumb('Add Product Feature');
						echo $this->Html->getCrumbs(' / ');
					?>
					
				</ul>
				<h2 class="heading">Add Product Feature</h2>
			</div>
<div class="row-fluid">
		<?php echo $this->Form->create('ProductFeature',array('class'=>'form-horizontal','enctype'=>'multipart/form-data')); ?>
          <div class="widget widget-padding span12">
            <div class="widget-header">
              <i class="icon-list-alt"></i><h5>Add Product Feature</h5>
              <div class="widget-buttons">
                 <!-- <a href="#" title="Collapse" data-collapsed="false" class="tip1 collapse"><i class="icon-chevron-up"></i></a>-->
              </div>
            </div>
            <div class="widget-body">
              <div class="widget-forms clearfix">
			  		
                    <div class="control-group">
                    <label class="control-label">&nbsp;</label>
                    <div class="controls">
                      &nbsp;
                    </div>
                  </div>	
              		
                 <?php 
				 
				 foreach($productFeatures as $productFeature){
							if(!empty($productFeature['Feature'])){
				 ?>
										<legend><?php echo $productFeature['FeatureGroup']['name'];?></legend>
										<?php foreach($productFeature['Feature'] as $feature){
												if(!empty($feature['FeatureValue']) || $feature['type']=='text'){
												?>
											<div class="control-group">
											<label class="control-label"><?php echo $feature['name'];?></label>
											<div class="controls">
											<?php if($feature['type']=='text'){
											
											 	echo $this->Form->input($feature['id'],array('div'=>false,'label'=>false,'class'=>'span7','placeholder' => $feature['name']));
											 
											 }else{?>
											 
											  <?php 
											  $featurValueArr = array();
											  foreach($feature['FeatureValue'] as $featureValue){
											  	$featurValueArr[$featureValue['id']] = $featureValue['value'];
											  }
											  $featurID = $feature['id'];
											  if($feature['type']=='multiselect'){
											  echo $this->Form->input($featurID,array('div'=>false,'label'=>false,'class'=>'span7','options' => $featurValueArr,'empty'=>'-Select '.$feature['name'],'multiple'=>'multiple'));
											  }else{
											  echo $this->Form->input($featurID,array('div'=>false,'label'=>false,'class'=>'span7','options' => $featurValueArr,'empty'=>'-Select '.$feature['name']));
											  }
										    } ?>
											</div>
											</div>
			<?php	 
												} 
											}
							 }
				}
		  	  ?> 
			
              </div>
            </div>
            <div class="widget-footer">
               <button class="btn btn-primary" type="submit">Save</button>
               <button class="btn" onclick="window.location.href = '<?php echo Router::url('/');?>products'" type="button">Cancel</button>
            </div>
          </div>
		   <?php echo $this->Form->end(); ?>
        </div>
		

	