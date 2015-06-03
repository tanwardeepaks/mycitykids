<div class="row-fluid">
				<ul class="breadcrumb">
					<?php
						$this->Html->addCrumb('Dashboard',array('controller'=>'dashboards','action'=>'index'));
						$this->Html->addCrumb('Feature',array('controller'=>'featureGroups','action'=>'index'));
						$this->Html->addCrumb('Edit Feature');
						echo $this->Html->getCrumbs(' / ');
					?>
					
				</ul>
				<h2 class="heading">Edit Feature</h2>
			</div>
<div class="row-fluid">
		<?php echo $this->Form->create('Feature',array('class'=>'form-horizontal')); ?>
          <div class="widget widget-padding span12">
            <div class="widget-header">
              <i class="icon-list-alt"></i><h5>Edit Feature</h5>
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
                    <label class="control-label">Slug</label>
                    <div class="controls">
                      <?php echo $this->Form->input('slug',array('div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'Slug'));?>
                    </div>
                  </div>
				 
                  <div class="control-group">
                    <label class="control-label">Category</label>
                    <div class="controls">
                      <?php 
					 
					  echo $this->Form->input('category_id',array('div'=>false,'label'=>false,'class'=>'span7 getFeatureGroupUsingCategory chosen-select','options'=>$categories,'empty'=>'-Select Category-','base-url'=>Router::url('/'),'element-id'=>'featureGroupIdElement'));?>
                    </div>
                  </div>
				  
				  <div class="control-group" id="featureGroupIdElement">
                    <label class="control-label">Feature Group</label>
                    <div class="controls">
					<?php 
					echo $this->Form->input('feature_group_id',array('div'=>false,'label'=>false,'class'=>'span7 chosen-select','options'=>$featuregroups,'empty'=>'-Select Feature Group-'));
					?>
                    </div>
                  </div>
				  
				 <div class="control-group">
                    <label class="control-label">Type</label>
                    <div class="controls">
                <?php 
				echo $this->Form->input('type',array('div'=>false,'label'=>false,'class'=>'span7','options'=>array('text'=>'Text','single_select'=>'Single Select','multiselect'=>'Multi Select'),'empty'=>'-Select Type-','style'=>'width:30%'));
				?>
                    </div>
                  </div>
				  
				  <div class="control-group">
                    <label class="control-label">Unit</label>
                    <div class="controls">
                      <?php echo $this->Form->input('unit',array('div'=>false,'label'=>false,'class'=>'span7'));?>
                    </div>
                  </div>
				  
				  <div class="control-group">
                    <label class="control-label">Display Text</label>
                    <div class="controls">
                      <?php echo $this->Form->input('display_text',array('div'=>false,'label'=>false,'type'=>'textarea','class'=>'span7'));?>
                    </div>
                  </div>
				  
				  <div class="control-group">
                    <label class="control-label">Sort Order</label>
                    <div class="controls">
                      <?php echo $this->Form->input('sort_order',array('div'=>false,'label'=>false,'type'=>'text','class'=>'span7','style'=>'width:5%;'));?>
                    </div>
                  </div>
				  
                <div class="control-group">
                    <label class="control-label">Is Filter</label>
                    <div class="controls">
                    <?php 
								echo $this->Form->checkbox('is_filter', array(
									'value' => '1',
									'hiddenField' => true,
								));

								?>
                    </div>
                  </div>
				  
			 <div class="control-group">
                    <label class="control-label">Is Required</label>
                    <div class="controls">
                    <?php 
								echo $this->Form->checkbox('is_required', array(
									'value' => '1',
									'hiddenField' => true,
								));

								?>
                    </div>
                  </div>
				
				 <div class="control-group">
                    <label class="control-label">Status</label>
                    <div class="controls">
                    <?php 
								echo $this->Form->checkbox('status', array(
									'value' => '1',
									'hiddenField' => true,
								));

								?>
                    </div>
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