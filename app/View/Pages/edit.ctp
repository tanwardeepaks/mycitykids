 <?php 	echo $this->Html->script(array('ckeditor/ckeditor'));?>
 <div class="row-fluid">
				<ul class="breadcrumb">
					<?php
						$this->Html->addCrumb('Dashboard',array('controller'=>'dashboards','action'=>'index'));
						$this->Html->addCrumb('Pages',array('controller'=>'pages','action'=>'index'));
						$this->Html->addCrumb('Edit page');
						echo $this->Html->getCrumbs(' / ');
					?>
					
				</ul>
				<h2 class="heading">Edit Page</h2>
			</div>
<div class="row-fluid">
		<?php echo $this->Form->create('Page',array('class'=>'form-horizontal')); ?>
          <div class="widget widget-padding span12">
            <div class="widget-header">
              <i class="icon-list-alt"></i><h5>Edit Page</h5>
              <div class="widget-buttons">
                 <!-- <a href="#" title="Collapse" data-collapsed="false" class="tip collapse"><i class="icon-chevron-up"></i></a>-->
              </div>
            </div>
            <div class="widget-body">
              <div class="widget-forms clearfix">
			  
                  <div class="control-group">
                    <label class="control-label">&nbsp;</label>
                    <div class="controls">&nbsp;</div>
                  </div>
                  
                  <div class="control-group">
                    <label class="control-label">Page Name</label>
                    <div class="controls">
                      <?php echo $this->Form->input('name',array('div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'Page Name'));?>
                    </div>
                  </div>
				  <div class="control-group">
                    <label class="control-label">Slug</label>
                    <div class="controls">
                      <?php echo $this->Form->input('slug',array('div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'Slug'));?>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Meta Title</label>
                    <div class="controls">
                      <?php echo $this->Form->input('meta_title',array('div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'Meta Title','maxlength'=>65));?>
					   <span class="help-inline">(Max 65 char)</span>
                    </diV>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Meta Keyword</label>
                    <div class="controls">
					<?php echo $this->Form->input('meta_keyword',array('div'=>false,'label'=>false,'class'=>'span7 tip','placeholder'=>'Meta Keyword','maxlength'=>160));?>
                       <span class="help-inline">(Max 160 char)</span>
                    </diV>
                  </div>
				   <div class="control-group">
                    <label class="control-label">Meta Description</label>
                    <div class="controls">
                      <?php echo $this->Form->input('meta_description',array('div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'Meta Description','maxlength'=>256));?>
					  <span class="help-inline">(Max 256 char)</span>
                    </diV>
                  </div>
				  <div class="control-group">
                    <label class="control-label">Short Description</label>
                    <div class="controls">
                      <?php echo $this->Form->input('short_desc',array('div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'Short Description','maxlength'=>256));?>
					  <span class="help-inline">(Max 256 char)</span>
                    </diV>
                  </div>
				  <div class="control-group">
                    <label class="control-label">Content</label>
                    <div class="controls">
                      <?php echo $this->Form->textarea('description',array('div'=>'textarea','div'=>false,'label'=>false,'class'=>'span7 ckeditor'));?>
                    </diV>
                  </div>
				 
                <div class="control-group">
                <label class="control-label">Status</label>
                  <div class="controls">
                  <?php echo $this->Form->checkbox('Page.status',array('label'=>false,'div'=>false));?>
                 </div>
              </div>
     
              </div>
            </div>
            <div class="widget-footer">
               <button class="btn btn-primary" type="submit">Save</button>
               <button class="btn" onclick="window.location.href = '<?php echo Router::url('/');?>pages'" type="button">Cancel</button>
            </div>
          </div>
		   <?php echo $this->Form->end(); ?>
        </div>