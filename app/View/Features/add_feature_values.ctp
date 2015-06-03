<div class="row-fluid">
				<ul class="breadcrumb">
					<?php
						$this->Html->addCrumb('Dashboard',array('admin'=>true,'controller'=>'dashboards','action'=>'index'));
						$this->Html->addCrumb('Feature',array('admin'=>true,'controller'=>'featureGroups','action'=>'index'));
						$this->Html->addCrumb('Add Feature Values');
						echo $this->Html->getCrumbs(' / ');
					?>
					
				</ul>
				<h2 class="heading">Add Feature Values</h2>
			</div>
<div class="row-fluid">
		<?php echo $this->Form->create('FeatureValue',array('class'=>'form-horizontal')); ?>
          <div class="widget widget-padding span12">
            <div class="widget-header">
              <i class="icon-list-alt"></i><h5>Add Feature Values</h5>
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
				  
				
              		
                  <div class="control-group">
                    <label class="control-label">Feature</label>
                    <div class="controls">
                      <?php echo $this->data['Feature']['name'];?>
                    </div>
                  </div>
				  
				  <div class="control-group" style="margin-left:50px;">
                    <?php foreach($this->data['FeatureValue'] as $featureValue){?>
					<span style="background:#CCFF00;color:#000000;padding:5px 5px 5px 5px;margin:5px;font-family:Open Sans,sans-serif;border-radius: 3px 3px 3px 3px;" id="spanID<?php echo $featureValue['id'];?>">
					<?php echo $featureValue['value'];?>
					<?php echo $this->Html->image('remove.png',array('class'=>'removeFeatureValue','style'=>'cursor:pointer;','feature-value-id'=>$featureValue['id'],'element-id'=>'spanID'.$featureValue['id'],'base-url'=>Router::url('/')));?>
					</span>
					<?php } ?>
                  </div>
				 <div id="moreValueSection">
				  <div class="control-group">
                    <label class="control-label">Value</label>
                    <div class="controls">
                      <?php echo $this->Form->input('value.',array('div'=>false,'label'=>false,'class'=>'span7 moreValue'));?>
					 </div>
                    </div>
				  </div>
				
				 <div class="control-group">
                    <label class="control-label">&nbsp;</label>
                    <div class="controls"> <a href="javascript:void(0)" class="addMoreValues">Add More</a></div>
                 </div>
                  
     
              </div>
            </div>
            <div class="widget-footer">
               <button class="btn btn-primary" type="submit">Save</button>
               <button class="btn" onclick="window.location.href = '<?php echo Router::url('/');?>features'" type="button">Cancel</button>
            </div>
          </div>
		   <?php echo $this->Form->end(); ?>
        </div>
	
	<script language="javascript" type="text/javascript">
		$(function(){
			$('.addMoreValues').click(function(){
				var response=false;
			$(".moreValue").each(function() {
		
				 if(this.value==''){
					alert('Please enter first then add more');
								response=true;
				 }
			});
			if(response){
				return false;
			}
				$('#moreValueSection').append('<div class="control-group"><label class="control-label">Value</label><div class="controls"><input type="text" name="data[FeatureValue][value][]" class="moreValue span7"/> <?php echo $this->Html->image("remove.png",array("style"=>"cursor:pointer", "onclick"=>"$(this).parent().parent().remove();"));?></div></div>');
		
			});
	
	 });
	
	</script>