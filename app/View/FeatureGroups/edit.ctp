<div class="row-fluid">
				<ul class="breadcrumb">
					<?php
						$this->Html->addCrumb('Dashboard',array('controller'=>'dashboards','action'=>'index'));
						$this->Html->addCrumb('Feature Group',array('controller'=>'featureGroups','action'=>'index'));
						$this->Html->addCrumb('Edit Feature Group');
						echo $this->Html->getCrumbs(' / ');
					?>
					
				</ul>
				<h2 class="heading">Edit Feature Group</h2>
			</div>
<div class="row-fluid">
		<?php echo $this->Form->create('FeatureGroup',array('class'=>'form-horizontal')); ?>
          <div class="widget widget-padding span12">
            <div class="widget-header">
              <i class="icon-list-alt"></i><h5>Edit Feature Group</h5>
              <div class="widget-buttons">
                  <!--<a href="#" title="Collapse" data-collapsed="false" class="tip1 collapse"><i class="icon-chevron-up"></i></a>-->
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
                    <label class="control-label">Name</label>
                    <div class="controls">
                      <?php echo $this->Form->input('name',array('div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'Name'));?>
                    </div>
                  </div>
				 
                  <div class="control-group">
                    <label class="control-label">Category</label>
                    <div class="controls">
                      <?php echo $this->Form->input('category_id',array('div'=>false,'label'=>false,'class'=>'span7 chosen-select','options'=>$categories,'empty'=>'-Select Category-'));?>
                    </div>
                  </div>
				  
				  <div class="control-group">
                    <label class="control-label">Sort Order</label>
                    <div class="controls">
                      <?php echo $this->Form->input('sort_order',array('div'=>false,'label'=>false,'type'=>'text','class'=>'span7','style'=>'width:5%;'));?>
                    </div>
                  </div>
                
     
              </div>
            </div>
            <div class="widget-footer">
               <button class="btn btn-primary" type="submit">Save</button>
               <button class="btn" onclick="window.location.href = '<?php echo Router::url('/');?>featureGroups'" type="button">Cancel</button>
            </div>
          </div>
		   <?php echo $this->Form->end(); ?>
        </div>