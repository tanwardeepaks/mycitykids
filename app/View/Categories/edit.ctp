<?php 	echo $this->Html->script(array('ckeditor/ckeditor'));?>
<div class="row-fluid">
				<ul class="breadcrumb">
					<?php
						$this->Html->addCrumb('Dashboard',array('controller'=>'dashboards','action'=>'index'));
						$this->Html->addCrumb('Categories',array('controller'=>'categories','action'=>'index'));
						$this->Html->addCrumb('Edit Category');
						echo $this->Html->getCrumbs(' / ');
					?>
					
				</ul>
				<h2 class="heading">Edit Category</h2>
			</div>
<div class="row-fluid">
		<?php echo $this->Form->create('Category',array('class'=>'form-horizontal','enctype'=>'multipart/form-data')); ?>
          <div class="widget widget-padding span12">
            <div class="widget-header">
              <i class="icon-list-alt"></i><h5>Edit Category</h5>
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
                    <label class="control-label">Parent Category</label>
                    <div class="controls">
                      <?php echo $this->Form->input('parent_id',array('div'=>false,'label'=>false,'class'=>'span7 chosen-select','options'=>$pcat,'empty'=>'-Select Category-'));?>
                    </div>
                  </div>
				  
				  <div class="control-group">
                    <label class="control-label">Category Image</label>
                    <div class="controls">
                      <?php echo $this->Form->input('image',array('div'=>false,'label'=>false,'class'=>'span7','type'=>'file'));?>
                    </div>
                  </div>
				  
				  	<?php
				 if($this->request->data['Category']['old_image']!='' && file_exists(WWW_ROOT.'uploads'.DS.'category'.DS.$this->request->data['Category']['old_image'])){?>	
					<div class="control-group">
                    <label class="control-label">&nbsp;</label>
                    <div class="controls">
					<?php echo $this->Html->Image('../uploads/category/150x100/'.$this->request->data['Category']['old_image']);?>
					</div>
					<?php } ?>	
				  
				  <div class="control-group">
                    <label class="control-label">Category Description</label>
                    <div class="controls">
                      <?php echo $this->Form->input('description',array('div'=>false,'label'=>false,'type'=>'textarea','class'=>'span7 ckeditor'));?>
                    </div>
                  </div>
                  
				  <div class="control-group">
                    <label class="control-label">Meta Title</label>
                    <div class="controls">
                      <?php echo $this->Form->input('meta_title',array('div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'Meta Title','maxlength'=>65));?>
					   <span class="help-inline">(Max 65 char)</span>
                    </div>
                  </div>
				  
                  <div class="control-group">
                    <label class="control-label">Meta Keyword</label>
                    <div class="controls">
					<?php echo $this->Form->input('meta_keyword',array('div'=>false,'label'=>false,'class'=>'span7 tip','placeholder'=>'Meta Keyword','maxlength'=>160));?>
                       <span class="help-inline">(Max 160 char)</span>
                    </div>
                  </div>
				  
				  <div class="control-group">
                    <label class="control-label">Meta Description</label>
                    <div class="controls">
                      <?php echo $this->Form->input('meta_description',array('div'=>false,'label'=>false,'type'=>'textarea','class'=>'span7','placeholder'=>'Meta Description','maxlength'=>256));?>
					  <span class="help-inline">(Max 256 char)</span>
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
				  
				  <div class="control-group">
                    <label class="control-label">Latest Show</label>
                    <div class="controls">
                    <?php 
								echo $this->Form->checkbox('latest_show', array(
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
               <button class="btn" onclick="window.location.href = '<?php echo Router::url('/');?>categories'" type="button">Cancel</button>
            </div>
          </div>
		   <?php 
		   echo $this->Form->hidden('old_image');
		   echo $this->Form->hidden('id');
		   echo $this->Form->end(); ?>
        </div>