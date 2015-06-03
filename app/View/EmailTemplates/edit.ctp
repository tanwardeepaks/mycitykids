<?php 	echo $this->Html->script(array('ckeditor/ckeditor'));?>

<div class="row-fluid">
				<ul class="breadcrumb">
					<?php
						$this->Html->addCrumb('Dashboard',array('controller'=>'dashboards','action'=>'index'));
						$this->Html->addCrumb('Email Templates',array('controller'=>'emailTemplates','action'=>'index'));
						$this->Html->addCrumb('Edit Email Template');
						echo $this->Html->getCrumbs(' / ');
					?>
					
				</ul>
				<h2 class="heading">Edit Email Template</h2>
			</div>
<div class="row-fluid">
		<?php echo $this->Form->create('EmailTemplate',array('class'=>'form-horizontal','enctype'=>'multipart/form-data')); ?>
          <div class="widget widget-padding span12">
            <div class="widget-header">
              <i class="icon-list-alt"></i><h5>Edit Email Template</h5>
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
                    <label class="control-label">Subject/Title</label>
                    <div class="controls">
                      <?php echo $this->Form->input('subject',array('div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'Subject'));?>
                    </div>
                  </div>
				  <div class="control-group">
                    <label class="control-label">Message</label>
                    <div class="controls">
                    	<?php echo $this->Form->input('EmailTemplate.message', array('type' => 'textarea','label' => false,'div'=>false,'class'=>'ckeditor'));?>
                    </div>
                  </div>
                
				  
				  <div class="control-group">
				   <label class="control-label">Short Code</label>
                    <div class="controls">
									#FNAME<br />
									#LNAME<br />
									#NAME<br />
									#EMAIL<br />
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
               <button class="btn" onclick="window.location.href = '<?php echo Router::url('/');?>emailTemplates'" type="button">Cancel</button>
            </div>
          </div>
		   <?php echo $this->Form->end(); ?>
        </div>