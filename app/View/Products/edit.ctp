<?php 	
echo $this->Html->script(array('ckeditor/ckeditor'));

?>

<script>
    $(document).ready(function(){
    $('.removeProductImage').bind('click',function(){
        
        var agree = confirm('Do you want to delete this ?');
        if(agree){
            var product_image_id = $(this).attr('product-image-id');

            var base_url = $(this).attr('base-url');

            var element_id = $(this).attr('element-id');

            $.ajax({

                url: base_url+'products/removeAjaxProductImage',

                type: 'post',

                data: 'id=' + product_image_id,

                dataType: 'html',

                success: function(result) {

                    $('#'+element_id).hide();

                }

});
}

});
    });
</script>

<div class="row-fluid">
				<ul class="breadcrumb">
					<?php
						$this->Html->addCrumb('Dashboard',array('controller'=>'dashboards','action'=>'index'));
						$this->Html->addCrumb('Products',array('controller'=>'products','action'=>'index'));
						$this->Html->addCrumb('Edit Product');
						echo $this->Html->getCrumbs(' / ');
					?>
					
				</ul>
				<h2 class="heading">Edit Product</h2>
			</div>
<div class="row-fluid">
		<?php echo $this->Form->create('Product',array('class'=>'form-horizontal','enctype'=>'multipart/form-data')); ?>
          <div class="widget widget-padding span12">
            <div class="widget-header">
              <i class="icon-list-alt"></i><h5>Edit Product</h5>
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
                      <?php echo $this->Form->input('image',array('div'=>false,'label'=>false,'class'=>'span7','type'=>'file'));?>
                    </div>
                  </div>
				<!--Product image if exist-->  
					<?php
				 if($this->request->data['Product']['old_image']!='' && file_exists(WWW_ROOT.'uploads'.DS.'product'.DS.$this->request->data['Product']['old_image'])){?>	
					<div class="control-group">
					<label class="control-label">&nbsp;</label>
					<div class="controls">
					<?php echo $this->Html->Image('../uploads/product/150x100/'.$this->request->data['Product']['old_image']);?>
					</div>
					</div>
				<?php } ?>
				
				<!--End product image-->
				
				<?php if(!empty($this->request->data['ProductImage'])){?>
				   <div class="control-group">&nbsp;</div>
					<div class="control-group">
					<label class="control-label">Other Images</label>
					<div class="controls">
					<?php foreach($this->request->data['ProductImage'] as $product_image){
						 if($product_image['image']!='' && file_exists(WWW_ROOT.'uploads'.DS.'product'.DS.$product_image['image'])){
					?>
							<span id="productImage<?php echo $product_image['id'];?>">
							<?php echo $this->Html->Image('../uploads/product/150x100/'.$product_image['image']);?>
							<?php echo $this->Html->image("remove.png",array("style"=>"cursor:pointer;vertical-align:top",'class'=>'removeProductImage','product-image-id'=>$product_image['id'],'element-id'=>'productImage'.$product_image['id'],'base-url'=>Router::url('/')));?>
							</span>
					<?php } 
					}
					?>
					</div>
				  </div>
                 <?php } ?>
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
		   <?php 
		   echo $this->Form->hidden('id');
		   echo $this->Form->hidden('old_image');
		   echo $this->Form->end(); ?>
        </div>
		

<script language="javascript" type="text/javascript">
		$(document).ready(function() {
			$('.datepicker').datepicker();
		});
		$(function(){
			$('.addMoreProductImages').click(function(){
			if(($('.moreProductImage').length > 0) ){	
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
			}
				$('#moreProductImageSection').append('<div class="control-group"><label class="control-label">Product Image</label><div class="controls"><input type="file" name="data[ProductImage][image][]" class="moreProductImage span7"/> <?php echo $this->Html->image("remove.png",array("style"=>"cursor:pointer", "onclick"=>"$(this).parent().parent().remove();"));?></div></div>');
		
			});
	
	 });
	
	</script>	