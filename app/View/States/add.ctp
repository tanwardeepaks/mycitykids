<div class="row-fluid">
				<ul class="breadcrumb">
					<?php
						$this->Html->addCrumb('Dashboard',array('admin'=>true,'controller'=>'dashboards','action'=>'index'));
						$this->Html->addCrumb('State',array('admin'=>true,'controller'=>'states','action'=>'index'));
						$this->Html->addCrumb('Add State');
						echo $this->Html->getCrumbs(' / ');
					?>
					
				</ul>
				<h2 class="heading">Add State</h2>
			</div>
<div class="row-fluid">
		<?php echo $this->Form->create('State',array('class'=>'form-horizontal')); ?>
          <div class="widget widget-padding span12">
            <div class="widget-header">
              <i class="icon-list-alt"></i><h5>Add State</h5>
              <div class="widget-buttons">
                  <a href="#" title="Collapse" data-collapsed="false" class="tip1 collapse"><i class="icon-chevron-up"></i></a>
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
                    <label class="control-label">State Code</label>
                    <div class="controls">
                      <?php echo $this->Form->input('state_code',array('div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'State Code'));?>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">State Name</label>
                    <div class="controls">
                      <?php echo $this->Form->input('state_name',array('div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'State Name'));?>
                    </diV>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Latitude</label>
                    <div class="controls">
					<?php echo $this->Form->input('lat',array('div'=>false,'label'=>false,'class'=>'span7 tip','placeholder'=>'Latitude','data-title'=>'Latitude'));?>
                     
                    </diV>
                  </div>
				   <div class="control-group">
                    <label class="control-label">Longitude</label>
                    <div class="controls">
                      <?php echo $this->Form->input('lon',array('div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'Longitude'));?>
                    </diV>
                  </div>
				  
				   <div class="control-group">
                    <label class="control-label">Status</label>
                    <div class="controls">
                       <?php echo $this->Form->checkbox('status', array('value' => '1','hiddenField' => true,));?>
                    </diV>
                  </div>
				  
				   <!--<div class="control-group">
                    <label class="control-label">Confirm Password</label>
                    <div class="controls">-->
                      <?php //echo $this->Form->input('cpassword',array('type'=>'password','div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'Confirm Password'));?>
                   <!-- </diV>
                  </div>-->
				   
                 
                 <!-- <div class="control-group">
                    <label class="control-label">Dropdown</label>
                      <div class="controls">-->
					  <?php //echo $this->Form->input('role_id',array('div'=>false,'label'=>false,'options'=>$roles,'class'=>'span7'));?>
                    
                     <!--</div>
                  </div>-->
                
     
              </div>
            </div>
            <div class="widget-footer">
               <button class="btn btn-primary" type="submit">Save</button>
               <button class="btn" onclick="window.location.href = '<?php echo Router::url('/');?>states'" type="button">Cancel</button>
            </div>
          </div>
		   <?php echo $this->Form->end(); ?>
        </div>