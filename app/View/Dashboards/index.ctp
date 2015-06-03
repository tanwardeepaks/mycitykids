   <div class="row-fluid">
          <div class="overview_boxes">
            <div class="box_row clearfix">
              <div class="widget-tasks-statistics">
                <div class="userstats clearfix" style="margin-top: 25px; font-size: 35px;">
                    Welcome to Admin Panel
                </div>
              </div>
            </div> 
            <div class="dashboard">
                <a href="<?php echo Router::url('/').'pages';?>" ><div class="manager"><?php echo $this->Html->image('page.png');?>Pages Info</div></a>
                
              
                <a href="<?php echo Router::url('/').'users';?>" ><div class="manager"><?php echo $this->Html->image('user.png');?>Users Manager</div></a>
				
				<a href="<?php echo Router::url('/').'categories';?>" ><div class="manager"><?php echo $this->Html->image('category.png');?>Category Manager</div></a>
				
				<a href="<?php echo Router::url('/').'features';?>" ><div class="manager"><?php echo $this->Html->image('feature-icon.png');?>Feature Manager</div></a>
				
				<a href="<?php echo Router::url('/').'brands';?>" ><div class="manager"><?php echo $this->Html->image('brand.png');?>Brand Manager</div></a>
				
				<a href="<?php echo Router::url('/').'products';?>" ><div class="manager"><?php echo $this->Html->image('product.png');?>Product Manager</div></a>
				
				<a href="<?php echo Router::url('/').'states';?>" ><div class="manager"><?php echo $this->Html->image('product.png');?>State Manager</div></a>
                
                
            </div>
          </div>
        </div>  

