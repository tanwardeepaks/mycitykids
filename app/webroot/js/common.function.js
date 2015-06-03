$(document).ready(function() {
					   
	$('.getFeatureGroupUsingCategory').bind('change',function(){
			
			var category_id = $(this).val();
			
			var base_url = $(this).attr('base-url');
			
			var element_id = $(this).attr('element-id');
			
			$.ajax({
			
			url: base_url+'featureGroups/getAjaxFeatureGroupList',
			
			type: 'post',
			
			data: 'category_id=' + category_id,
			
			dataType: 'html',
			
			success: function(result) {
			
			$('#'+element_id).html(result);
			
			}
		  
		  });
											 
	});	
	
	$('.removeFeatureValue').bind('click',function(){
				
			var agree = confirm('Do you want to delete this ?');
			if(agree){
					var feature_value_id = $(this).attr('feature-value-id');
					
					var base_url = $(this).attr('base-url');
				
					var element_id = $(this).attr('element-id');
					
					$.ajax({
				
						url: base_url+'features/removeAjaxFeatureValue',
						
						type: 'post',
						
						data: 'feature_value_id=' + feature_value_id,
						
						dataType: 'html',
						
						success: function(result) {
						
						$('#'+element_id).hide();
						
						}
					  
					 });
			}
	
	});
	
	

	
	$('.advanceSearchClass').bind('click',function(){
		
		var element_id = $(this).attr('element-id');
		
		$('#advanceSearch').toggle('slow');
		
		if($('#'+element_id).attr('class') == 'icon-chevron-down'){
				$('#'+element_id).removeClass('icon-chevron-down');
				$('#'+element_id).addClass('icon-chevron-up');
		}else{
				$('#'+element_id).addClass('icon-chevron-down');
				$('#'+element_id).removeClass('icon-chevron-up');	
		}
				
		
		
		
	});


	$('.countKeyForMeta').bind('keyup', function(e){
		 
		 var maxChar = $(this).attr('maxlength');
		 
		 var elementID = $(this).attr('element-id');
		 
    	 if($(this).val().length > maxChar)
		 	return false;
		 else
		 	$('#'+elementID).html(maxChar - $(this).val().length);


	});
	
	$('.price').bind('keyup', function(e){
		 
				var maintainplus = '';
				
				var numval = $(this).val();
				
				if ( numval.charAt(0)=='+' ){ var maintainplus = '';}
				
				curphonevar = numval.replace(/[^0-9.]/g,'');
				
				$(this).val(maintainplus + curphonevar);
				
				var maintainplus = '';
				
				$(this).focus;

	});


});