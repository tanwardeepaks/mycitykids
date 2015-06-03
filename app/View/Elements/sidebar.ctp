<div class="sidebar-nav nav-collapse collapse">
        <div class="user_side clearfix">
          <?php echo $this->Html->image('odinn.jpg',array('alt'=>'Ticksol','title'=>'Ticksol'))?>
          <h5><?php echo $this->Session->read('Auth.User.User.firstname');?></h5>
          <a href="<?php echo Router::url('/').'settings';?>"><i class="icon-cog"></i> Settings</a>        
        </div>
    
	    <div class="accordion" id="accordion2">
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle b_F79999 <?php echo ($this->params['controller']=='dashboards')?'active':'';?>" href="<?php echo Router::url('/').'dashboards';?>">
			  <i class="icon-dashboard"></i> <span>Dashboard</span></a>
            </div>
          </div>
          
          
          
		<div class="accordion-group">
		<div class="accordion-heading">
		  <a class="accordion-toggle b_C1F8A9 <?php echo ($this->params['controller']=='pages')?'active':'';?>" href="<?php echo Router::url('/').'pages';?>">
		  <i class="icon-pages"></i> <span>Pages</span></a>
		</div>
		</div>


            <?php /*?><div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle b_C1F8A9 <?php echo ($this->params['controller']=='blogs')?'active':'';?>" href="<?php echo Router::url('/').'blogs';?>">
                        <i class="icon-pages"></i> <span>Blogs</span></a>
                </div>
            </div><?php */?>


            <?php /*?><div class="accordion-group">
		<div class="accordion-heading">
		  <a class="accordion-toggle b_F5C294 <?php echo ($this->params['controller']=='users')?'active':'';?>" href="<?php echo Router::url('/').'users';?>">
		  <i class="icon-user"></i> <span>Users</span></a>
		 </div>
		</div><?php */?>      
		  
		<div class="accordion-group">
		<div class="accordion-heading">
		  <a class="accordion-toggle b_F5C294 <?php echo ($this->params['controller']=='categories')?'active':'';?>" href="<?php echo Router::url('/').'categories';?>"><i class="icon-list"></i> <span>Category</span></a>
		 </div>
		</div>
		  
		<div class="accordion-group">
		<div class="accordion-heading">
		  <a class="accordion-toggle b_C3F7A7" data-toggle="collapse" data-parent="#accordion2" href="#collapse1"><i class="icon-magic"></i> <span>Features</span></a>
		</div>
		<div id="collapse1" class="accordion-body in collapse" style="height:auto">
		  <div class="accordion-inner">
			<a class="accordion-toggle <?php echo ($this->params['controller']=='featureGroups')?'active':'';?>" href="<?php echo Router::url('/').'featureGroups';?>" >
			<i class="icon-list-alt"></i> Feature Group</a>
		  
			<a class="accordion-toggle <?php echo ($this->params['controller']=='features')?'active':'';?>" href="<?php echo Router::url('/').'features';?>">
			<i class="icon-star"></i>Features</a>
		  
		  </div>
		</div>
		</div>
		
		  
		<div class="accordion-group">
		<div class="accordion-heading">
		  <a class="accordion-toggle b_F5C294 <?php echo ($this->params['controller']=='brands')?'active':'';?>" href="<?php echo Router::url('/').'brands';?>">
		  <i class="icon-fire"></i> <span>Brand</span></a>
		 </div>
		</div>
		  
		<?php /*?><div class="accordion-group">
		<div class="accordion-heading">
		  <a class="accordion-toggle b_F5C294 <?php echo ($this->params['controller']=='products')?'active':'';?>" href="<?php echo Router::url('/').'products';?>">
		  <i class="icon-check-empty"></i> <span>Product</span></a>
		 </div>
		</div><?php */?>
		  
		<?php /*?><div class="accordion-group">
		<div class="accordion-heading">
		  <a class="accordion-toggle b_F5C294 <?php echo ($this->params['controller']=='emailTemplates')?'active':'';?>" href="<?php echo Router::url('/').'emailTemplates';?>">
		  <i class="icon-envelope"></i> <span>Email Template</span></a>
		 </div>
		</div><?php */?>
		
		<?php /*?><div class="accordion-group">
		<div class="accordion-heading">
		  <a class="accordion-toggle b_F5C294 <?php echo ($this->params['controller']=='banners')?'active':'';?>" href="<?php echo Router::url('/').'banners';?>">
		  <i class="icon-picture"></i> <span>Banner</span></a>
		 </div>
		</div><?php */?>
		

		<?php /*?><div class="accordion-group">
		<div class="accordion-heading">
		  <a class="accordion-toggle b_F5C294 <?php echo ($this->params['controller']=='solutionHelps')?'active':'';?>" href="<?php echo Router::url('/').'solutionHelps';?>">
		  <i class="icon-picture"></i> <span>Solution Helps</span></a>
		 </div>
		</div><?php */?>


            <?php /*?><div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle b_F5C294 <?php echo ($this->params['controller']=='notifications')?'active':'';?>" href="<?php echo Router::url('/').'notifications';?>">
                        <i class="icon-picture"></i> <span>Notification</span></a>
                </div>
            </div><?php */?>
		  
		  
		
        </div>
      </div>