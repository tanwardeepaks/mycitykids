<div class="row-fluid">
    <ul class="breadcrumb">
        <?php
            $this->Html->addCrumb('Dashboard',array('controller'=>'dashboards','action'=>'index','admin'=>true));
            $this->Html->addCrumb('Settings');
            echo $this->Html->getCrumbs(' / ');
        ?>
        
    </ul>
    <h2 class="heading">Settings</h2>
   
</div>

<div class="row-fluid">
<div class="widget widget-padding span12">
<div class="widget-header">
  <i class="icon-group"></i>
  <h5>Brands</h5>
  
</div>  
<div class="widget-body">
  <table id="users" class="table table-striped table-bordered dataTable">
    <thead>
      <tr>
       <th>S.No.</th>
       <th><?php echo $this->Paginator->sort('name'); ?></th>
	   <th><?php echo $this->Paginator->sort('email'); ?></th>
       <th><?php echo $this->Paginator->sort('mobile'); ?></th>
	   <th><?php echo $this->Paginator->sort('phone'); ?></th>
       <th><?php echo $this->Paginator->sort('created'); ?></th>
        <th class="actions"><?php echo __('Actions'); ?></th>
      </tr>
    </thead>
    <tbody>
    <?php 

	foreach ($settings as $setting):
	 ?>
      <tr>
      <td>1&nbsp;</td>
      <td><?php echo h($setting['Setting']['name']); ?>&nbsp;</td>
	  <td><?php echo h($setting['Setting']['email']); ?>&nbsp;</td>
      <td><?php echo h($setting['Setting']['mobile']); ?>&nbsp;</td>
	  <td><?php echo h($setting['Setting']['phone']); ?>&nbsp;</td>
      <td><?php echo h(date('Y-m-d',strtotime($setting['Setting']['created']))); ?>&nbsp;</td>
      <td>
          <div class="btn-group">
            <a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#">
            Action
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu pull-right">
              <li><a href="<?php echo Router::url('/').'settings/edit';?>"><i class="icon-edit"></i> Edit</a></li>
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
