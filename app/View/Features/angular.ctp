<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"></script>
<div ng-app="" ng-controller="customersController">
<div class="row-fluid">
    <ul class="breadcrumb">
        <?php
            $this->Html->addCrumb('Dashboard',array('controller'=>'dashboards','action'=>'index'));
            $this->Html->addCrumb('Feature');
            echo $this->Html->getCrumbs(' / ');
        ?>
        
    </ul>
    <h2 class="heading">Feature</h2>
</div>
<!--Code Start For Searching-->
<div class="row-fluid">
	  <div class="widget widget-padding span12">
		<div class="widget-header">
		  <i class="icon-list-alt"></i><h5>Advance Search</h5>
		  <div class="widget-buttons">
		<a href="javascript:void(0);" data-title="Collapse" data-collapsed="false" class="tip collapse advanceSearchClass" element-id="searchIconClass">
			<i class="icon-chevron-down" id="searchIconClass"></i>
		</a>
		  </div>
		</div>
		<div class="widget-body" style="padding-bottom:0px;">
		  
		  
		  <table cellpadding="10" cellspacing="8" border="0" width="100%">
			<tr>
				<td width="20%">Enter search criteria</td>
				<td width="30%"><input class="span7" type="text" class="inp60" id="search_criteria" name="search_criteria" ng-model="test"/></td>
				<td width="20%">&nbsp;</td>
				<td width="30%">&nbsp;</td>
					
			</tr>
			
		   
			
	   </table>
		</div>
	  </div>
	</div>	
<!--End code-->	
<div class="row-fluid">
<div class="widget widget-padding span12">
<div class="widget-header">
  <i class="icon-group"></i>
  <h5>Feature</h5>
  <div class="widget-buttons">
      <a href="<?php echo Router::url('/').'features/add'?>" data-title="Add Feature Groups" class="tip" ><i class="icon-plus"></i></a>
     <!-- <a href="#" title="Collapse" data-collapsed="false" class="tip1 collapse"><i class="icon-chevron-up"></i></a>-->
  </div>
</div>  
<div class="widget-body"> 
  <table id="users" class="table table-striped table-bordered dataTable">
    <thead>
      <tr>
       <th>Id</th>
       <th>Name</th>
	   <th>Category Name</th>
	   <th>FeatureGroup Name</th>
	   </tr>
    </thead>
    <tbody>
   <tr  ng-repeat="fe in features|filter:test">
      <td>{{ fe.Feature.id }}</td>
      <td>{{ fe.Feature.name }}</td>
	  <td>{{ fe.Category.name }}</td>
	  <td>{{ fe.FeatureGroup.name }}</td>
      
      </tr>  
      
      </tbody>
  </table>

</div> <!-- /widget-body -->


    <!-- Pagging -->
                
                <!-- End Pagging -->

</div> <!-- /widget -->
</div>

</div>
<script>

function customersController($scope,$http) {
    $http.get("http://localhost/ticksol-pms/features/getFeatureList")
    .success(function(response) {
	
	$scope.features = response;
	
	});
}
</script>