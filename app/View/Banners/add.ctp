<?php 	echo $this->Html->script(array('ckeditor/ckeditor'));?>

<div class="row-fluid">
				<ul class="breadcrumb">
					<?php
						$this->Html->addCrumb('Dashboard',array('controller'=>'dashboards','action'=>'index'));
						$this->Html->addCrumb('Banner',array('controller'=>'banners','action'=>'index'));
						$this->Html->addCrumb('Add Banner');
						echo $this->Html->getCrumbs(' / ');
					?>
					
				</ul>
				<h2 class="heading">
					Add Banner      
				</h2>
			</div>
<div class="row-fluid">
		<?php echo $this->Form->create('Banner',array('class'=>'form-horizontal','enctype'=>'multipart/form-data')); ?>
          <div class="widget widget-padding span12">
            <div class="widget-header">
              <i class="icon-list-alt"></i><h5>Add Banner</h5>
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
                    <label class="control-label">Name</label>
                    <div class="controls">
                      <?php echo $this->Form->input('name',array('div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'Name'));?>
                    </div>
                  </div>
				  <div class="control-group">
                    <label class="control-label">Url</label>
                    <div class="controls">
                      <?php echo $this->Form->input('url',array('div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'Url'));?>
                    </div>
                  </div>
                
				  
				  <div class="control-group">
                    <label class="control-label">Image</label>
                    <div class="controls">
                      <?php echo $this->Form->input('image',array('div'=>false,'label'=>false,'class'=>'span7','type'=>'file'));?>
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
               <button class="btn" onclick="window.location.href = '<?php echo Router::url('/');?>banners'" type="button">Cancel</button>
            </div>
          </div>
		   <?php echo $this->Form->end(); ?>
        </div>