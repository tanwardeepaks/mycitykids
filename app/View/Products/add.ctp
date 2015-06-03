<?php 	
echo $this->Html->script(array('ckeditor/ckeditor'));

?>

<div class="row-fluid">
				<ul class="breadcrumb">
					<?php
						$this->Html->addCrumb('Dashboard',array('controller'=>'dashboards','action'=>'index'));
						$this->Html->addCrumb('Products',array('controller'=>'products','action'=>'index'));
						$this->Html->addCrumb('Add Product');
						echo $this->Html->getCrumbs(' / ');
					?>
					
				</ul>
				<h2 class="heading">Add Product</h2>
			</div>
<div class="row-fluid">
		<?php echo $this->Form->create('Product',array('class'=>'form-horizontal','enctype'=>'multipart/form-data')); ?>
          <div class="widget widget-padding span12">
            <div class="widget-header">
              <i class="icon-list-alt"></i><h5>Add Product</h5>
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
                    <label class="control-label">Slug</label>
                    <div class="controls">
                      <?php echo $this->Form->input('slug',array('div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'Slug'));?>
                    </div>
                  </div>
				  
				   <div class="control-group">
                    <label class="control-label">Brand</label>
                    <div class="controls">
                      <?php echo $this->Form->input('brand_id',array('div'=>false,'label'=>false,'class'=>'span7 chosen-select','options'=>$brands,'empty'=>'-Select Brand-'));?>
                    </div>
                  </div>
				  
			  <div class="control-group">
				<label class="control-label">Category</label>
				<div class="controls">
				 <?php echo $this->Form->input('category_id',array('div'=>false,'label'=>false,'class'=>'span7 chosen-select','options'=>$categories,'empty'=>'-Select Category-'));?>
				</div>
			  </div>
			 
			 
			 <div class="control-group">
                    <label class="control-label">Model</label>
                    <div class="controls">
                      <?php echo $this->Form->input('model',array('div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'Model'));?>
                    </div>
             </div>
			 
			 <div class="control-group">
                    <label class="control-label">Price</label>
                    <div class="controls">
					<div class="input-prepend">
					  <span class="add-on">$</span>
                      <?php echo $this->Form->input('price',array('type'=>'text','div'=>false,'label'=>false,'class'=>'span7 price','placeholder'=>'Price'));?>
                    </div>
					</div>
             </div>
			 
			 
			  <div class="control-group">
                    <label class="control-label">Warranty</label>
                    <div class="controls">
                      <?php echo $this->Form->input('warranty',array('div'=>false,'label'=>false,'class'=>'span7','placeholder'=>'Warranty'));?>
                    </div>
             </div>
			 
			<div id="moreProductImageSection">		  
				   <div class="control-group">
                    <label class="control-label">Product Image</label>
                    <div class="controls">
                      <?php echo $this->Form->input('image',array('div'=>false,'label'=>false,'class'=>'span7 moreProductImage','type'=>'file'));?>
                    </div>
                  </div>
                  
				  <div class="control-group">
                    <label class="control-label">&nbsp;</label>
                    <div class="controls"> <a href="javascript:void(0)" class="addMoreProductImages">Add More</a></div>
                 </div>
			</div>	
			  
				  <div class="control-group">
                    <label class="control-label">Product Description</label>
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
							<label class="control-label">Feature</label>
							<div class="controls">
							<?php 
										echo $this->Form->checkbox('feature', array(
											'value' => '1',
											'hiddenField' => true,
										));
		
										?>
				</div>
				
				 </div>
              </div>
            </div>
            <div class="widget-footer">
               <button class="btn btn-primary" type="submit">Next</button>
               <button class="btn" onclick="window.location.href = '<?php echo Router::url('/');?>products'" type="button">Cancel</button>
            </div>
          </div>
		   <?php echo $this->Form->end(); ?>
        </div>
		

<script language="javascript" type="text/javascript">
		$(document).ready(function() {
			$('.datepicker').datepicker();
		});
		$(function(){
			$('.addMoreProductImages').click(function(){
				var response=false;
			$(".moreProductImage").each(function() {
		
				 if(this.value==''){
					alert('Please enter first then add more');
								response=true;
				 }
			});
			if(response){
				return false;
			}
				$('#moreProductImageSection').append('<div class="control-group"><label class="control-label">Product Image</label><div class="controls"><input type="file" name="data[ProductImage][image][]" class="moreProductImage span7"/> <?php echo $this->Html->image("remove.png",array("style"=>"cursor:pointer", "onclick"=>"$(this).parent().parent().remove();"));?></div></div>');
		
			});
			
	
	 });
	
	</script>	