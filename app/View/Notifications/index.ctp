<div class="row-fluid">
				<ul class="breadcrumb">
					<?php
						$this->Html->addCrumb('Dashboard',array('controller'=>'dashboards','action'=>'index'));
						$this->Html->addCrumb('Notifications');
						echo $this->Html->getCrumbs(' / ');
					?>
					
				</ul>
				<h2 class="heading">Notifications</h2>
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
		<div id="advanceSearch" <?php echo (array_key_exists('search_criteria',$this->request->query) || array_key_exists('from_date',$this->request->query) || array_key_exists('to_date',$this->request->query))?'':'style="display:none"'?>>
		<form action="<?php echo Configure::read('live_url');?>notifications/index" method="get" name="search_method">
		<div class="widget-body" style="padding-bottom:0px;">
		  
		  
		  <table cellpadding="10" cellspacing="8" border="0" width="100%">
			<tr>
				<td width="20%">Enter search criteria</td>
				<td width="30%"><input class="span7 inp60" type="text" id="search_criteria" name="search_criteria" value="<?php echo (array_key_exists('search_criteria',$this->request->query))?$this->request->query['search_criteria']:''?>"/></td>
				<td width="20%">&nbsp;</td>
				<td width="30%">&nbsp;</td>
					
			</tr>
			<tr>
			
				<td width="93%" colspan="2">
				<button class="btn btn-primary" type="submit">Search</button>
				<button class="btn" type="button" onclick="window.location.href = '<?php echo Router::url('/');?>notifications'">Cancel</button>
				</td>
			</tr>
		   
			
	   </table>
		</div>
		
		</form>
		</div>
	  </div>
	</div>	
<!--End code-->	
<div class="row-fluid">

          <div class="widget widget-padding span12">
            <div class="widget-header">
              <i class="icon-group"></i>
              <h5>Pages</h5>
              <div class="widget-buttons">
                  <a href="<?php echo Router::url('/').'notifications/add'?>" title="Add New Page" class="tifp" ><i class="icon-plus"></i></a>
                  <!--<a href="#" title="Collapse" data-collapsed="false" class="txp collapse"><i class="icon-chevron-up"></i></a>-->
              </div>
            </div>  
            <div class="widget-body">
              <table id="users" class="table table-striped table-bordered dataTable">
                <thead>
                  <tr>
                  	<th><?php echo $this->Paginator->sort('id'); ?></th>
					<th><?php echo $this->Paginator->sort('name'); ?></th>
					<th><?php echo $this->Paginator->sort('meta_title'); ?></th>
					<th><?php echo $this->Paginator->sort('meta_keyword'); ?></th>
					<th><?php echo $this->Paginator->sort('status'); ?></th>
					<th><?php echo $this->Paginator->sort('created'); ?></th>
					<th><?php echo $this->Paginator->sort('modified'); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
                  </tr>
                </thead>
                <tbody>
				<?php foreach ($notifications as $notification): ?>
                 <tr>
				<td><?php echo h($notification['Notification']['id']); ?>&nbsp;</td>
				<td><?php echo h($notification['Notification']['name']); ?>&nbsp;</td>
				<td><?php echo h($notification['Notification']['meta_title']); ?>&nbsp;</td>
				<td><?php echo h($notification['Notification']['meta_keyword']); ?>&nbsp;</td>
				<td><span class="label <?php echo ($notification['Notification']['status'])?'label-success':'label-important'?>"><?php echo ($notification['Notification']['status'])?'Active':'Inactive'?></span></td>
				<td><?php echo h($notification['Notification']['created']); ?>&nbsp;</td>
				<td><?php echo h($notification['Notification']['modified']); ?>&nbsp;</td>
				<td>
                      <div class="btn-group">
                        <a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#">
                        Action
                          <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu pull-right">
                          <li><a href="<?php echo Router::url('/').'notifications/edit/'.$notification['Notification']['id'];?>"><i class="icon-edit"></i> Edit</a></li>
						  <li><i class="icon-remove"></i><?php echo $this->Form->postLink(__('Delete'), array('admin'=>false,'controller'=>'notifications', 'action' => 'delete', $notification['Notification']['id']), null, __('Are you sure you want to delete "%s" notification?', $notification['Notification']['name'])); ?></li>
                        </ul>
                      </div>
                    </td>
			</tr>
				<?php endforeach; ?>  
                  
                  </tbody>
              </table>
            </div> <!-- /widget-body -->
          </div> <!-- /widget -->
        </div>
