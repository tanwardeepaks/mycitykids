<div class="widget-header">
						<i class="icon-user"></i>
						<h5>Log in to your account</h5>
					</div>  
					<div class="widget-body clearfix" style="padding:25px;">
		      			<?php echo $this->Form->create('User'); ?>
		      				<div class="control-group">
								<div class="controls">
									<?php echo $this->Form->input('email',array('placeholder'=>'Email','class'=>'btn-block'));?>
								</div>
							</div>
							<div class="control-group">
								<div class="controls">
								<?php echo $this->Form->input('password',array('placeholder'=>'Password','type'=>'password','class'=>'btn-block'));?>
								
								</div>
							</div>
							 					
						
						  <?php 
							$options = array(
								'label' => 'Sign in',
								'class' => 'btn pull-right',
								'div'=>false,
							);
							echo $this->Form->end($options);
						?>
					</div> 