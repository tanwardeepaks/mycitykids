<?php 	echo $this->Html->script(array('ckeditor/ckeditor'));?>
<div class="row-fluid">
				<ul class="breadcrumb">
					<?php
						$this->Html->addCrumb('Dashboard',array('controller'=>'dashboards','action'=>'index','admin'=>true));
						$this->Html->addCrumb('Setting',array('controller'=>'settings','action'=>'index','admin'=>true));
						$this->Html->addCrumb('Edit Setting');
						echo $this->Html->getCrumbs(' / ');
					?>
					
				</ul>
				<h2 class="heading">
					Edit Setting      
				</h2>
                <?php echo $this->Session->flash(); ?>
			</div>
<div class="row-fluid">
		<?php echo $this->Form->create('Setting',array('class'=>'form-horizontal','enctype'=>'multipart/form-data')); ?>
          <div class="widget widget-padding span12">
            <div class="widget-header">
              <i class="icon-list-alt"></i><h5>Edit Setting</h5>
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
                    <label class="control-label">Logo</label>
                    <div class="controls">
                      <?php echo $this->Form->input('logo',array('div'=>false,'label'=>false,'class'=>'span7','type'=>'file'));?>
                    </div>
                  </div>
				  
				   	<?php
				 if($this->request->data['Setting']['old_logo']!='' && file_exists(WWW_ROOT.'uploads'.DS.$this->request->data['Setting']['old_logo'])){?>	
					<div class="control-group">
                    <label class="control-label">&nbsp;</label>
                    <div class="controls">
					<?php echo $this->Html->Image('../uploads/'.$this->request->data['Setting']['old_logo']);?>
					</div>
					<?php } ?>	
				  
				  <div class="control-group">
                    <label class="control-label">Tag Line</label>
                    <div class="controls">
                      <?php echo $this->Form->input('tag_line',array('div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'Tag LIne'));?>
                    </div>
                  </div>
				  <div class="control-group">
                    <label class="control-label">Email</label>
                    <div class="controls">
                      <?php echo $this->Form->input('email',array('div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'Email'));?>
                    </div>
                  </div>
				  
                
				   <div class="control-group">
                    <label class="control-label">Email 2</label>
                    <div class="controls">
                      <?php echo $this->Form->input('email2',array('div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'Email'));?>
                    </div>
                  </div>
				  
				  <div class="control-group">
                    <label class="control-label">Address</label>
                    <div class="controls">
                      <?php echo $this->Form->input('address',array('type'=>'textarea','div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'Email'));?>
                    </div>
                  </div>
				  
				  <div class="control-group">
                    <label class="control-label">Mobile</label>
                    <div class="controls">
                      <?php echo $this->Form->input('mobile',array('div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'Mobile'));?>
                    </div>
                  </div>
				  
				  <div class="control-group">
                    <label class="control-label">Phone</label>
                    <div class="controls">
                      <?php echo $this->Form->input('phone',array('div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'Phone'));?>
                    </div>
                  </div>
				  
				   <div class="control-group">
                    <label class="control-label">Facebook Url:</label>
                    <div class="controls">
                      <?php echo $this->Form->input('fb_url',array('type'=>'text','div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'Facebook Url'));?>
					</div>
            	 </div>
				 
				   <div class="control-group">
                    <label class="control-label">Twitter Url:</label>
                    <div class="controls">
                      <?php echo $this->Form->input('tw_url',array('type'=>'text','div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'Twitter Url'));?>
					</div>
            	 </div>
				 
				   <div class="control-group">
                    <label class="control-label">Google Url:</label>
                    <div class="controls">
                      <?php echo $this->Form->input('g_url',array('type'=>'text','div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'Google Url'));?>
					</div>
            	 </div>
				 
				    <div class="control-group">
                    <label class="control-label">Pinterest Url:</label>
                    <div class="controls">
                      <?php echo $this->Form->input('pin_url',array('type'=>'text','div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'Pinterest Url'));?>
					</div>
            	 </div>
				
				
				  
              </div>
            </div>
            <div class="widget-footer">
               <button class="btn btn-primary" type="submit">Save</button>
               <button class="btn" onclick="window.location.href = '<?php echo Router::url('/');?>admin/settings'" type="button">Cancel</button>
            </div>
          </div>
		   <?php 
		   echo $this->Form->hidden('old_logo');
		   echo $this->Form->end(); ?>
        </div>