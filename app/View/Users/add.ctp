<div class="row-fluid">
				<ul class="breadcrumb">
					<?php
						$this->Html->addCrumb('Dashboard',array('admin'=>true,'controller'=>'dashboards','action'=>'index'));
						$this->Html->addCrumb('User',array('admin'=>true,'controller'=>'users','action'=>'index'));
						$this->Html->addCrumb('Add user');
						echo $this->Html->getCrumbs(' / ');
					?>
					
				</ul>
				<h2 class="heading">Add Users</h2>
			</div>
<div class="row-fluid">
		<?php echo $this->Form->create('User',array('class'=>'form-horizontal')); ?>
          <div class="widget widget-padding span12">
            <div class="widget-header">
              <i class="icon-list-alt"></i><h5>Add User</h5>
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
                    <label class="control-label">First Name</label>
                    <div class="controls">
                      <?php echo $this->Form->input('firstname',array('div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'First Name'));?>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Last Name</label>
                    <div class="controls">
                      <?php echo $this->Form->input('lastname',array('div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'Last Name'));?>
                    </diV>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Email</label>
                    <div class="controls">
					<?php echo $this->Form->input('email',array('div'=>false,'label'=>false,'class'=>'span7 tip','placeholder'=>'Email','data-title'=>'Enter Email Address'));?>
                     
                    </diV>
                  </div>
				   <div class="control-group">
                    <label class="control-label">Password</label>
                    <div class="controls">
                      <?php echo $this->Form->input('password',array('div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'Password'));?>
                    </diV>
                  </div>
				  
				   <div class="control-group">
                    <label class="control-label">Confirm Password</label>
                    <div class="controls">
                      <?php echo $this->Form->input('cpassword',array('type'=>'password','div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'Confirm Password'));?>
                    </diV>
                  </div>
				   
                 
                  <div class="control-group">
                    <label class="control-label">Dropdown</label>
                      <div class="controls">
					  <?php echo $this->Form->input('role_id',array('div'=>false,'label'=>false,'options'=>$roles,'class'=>'span7'));?>
                    
                     </div>
                  </div>
                
     
              </div>
            </div>
            <div class="widget-footer">
               <button class="btn btn-primary" type="submit">Save</button>
               <button class="btn" onclick="window.location.href = '<?php echo Router::url('/');?>users'" type="button">Cancel</button>
            </div>
          </div>
		   <?php echo $this->Form->end(); ?>
        </div>