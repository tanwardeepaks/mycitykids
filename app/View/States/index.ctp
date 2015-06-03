<div class="row-fluid">
    <ul class="breadcrumb">
        <?php
            $this->Html->addCrumb('Dashboard',array('controller'=>'dashboards','action'=>'index'));
            $this->Html->addCrumb('States');
            echo $this->Html->getCrumbs(' / ');
        ?>
        
    </ul>
    <h2 class="heading">States</h2>
</div>
<div class="row-fluid">
<div class="widget widget-padding span12">
<div class="widget-header">
  <i class="icon-group"></i>
  <h5>States</h5>
  <div class="widget-buttons">
      <a href="<?php echo Router::url('/').'states/add'?>" data-title="Add State" class="tip" ><i class="icon-external-link"></i></a>
     <!-- <a href="#" title="Collapse" data-collapsed="false" class="tip1 collapse"><i class="icon-chevron-up"></i></a>-->
  </div>
</div>  
<div class="widget-body">
  <table id="states" class="table table-striped table-bordered dataTable">
    <thead>
      <tr>
       <th><?php echo $this->Paginator->sort('id'); ?></th>
       <th><?php echo $this->Paginator->sort('State.state_code','Code'); ?></th>
        <?php /*?><th><?php echo $this->Paginator->sort('Role.role','Role'); ?></th><?php */?>
        <th><?php echo $this->Paginator->sort('State.state_name','Name'); ?></th>
        <th><?php echo $this->Paginator->sort('State.lon','Longitude'); ?></th>
		<th><?php echo $this->Paginator->sort('State.lat','Latitude'); ?></th>
		<th><?php echo $this->Paginator->sort('State.status','Status'); ?></th>
        <th><?php echo $this->Paginator->sort('created'); ?></th>
        <th class="actions"><?php echo __('Actions'); ?></th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($states as $state): ?>
      <tr>
      <td><?php echo h($state['State']['id']); ?>&nbsp;</td>
      <td><?php echo h($state['State']['state_code']); ?>&nbsp;</td>
      <?php /*?><td><?php echo h($state['Role']['role']);?></td><?php */?>
      <td><?php echo h($state['State']['state_name']); ?>&nbsp;</td>
	  <td><?php echo h($state['State']['lon']); ?>&nbsp;</td>
	  <td><?php echo h($state['State']['lat']); ?>&nbsp;</td>
	  <td><span class="label <?php echo ($state['State']['status'])?'label-success':'label-important'?>"><?php echo ($state['State']['status'])?'Active':'Inactive'?></span></td>
      <td><?php echo h(date('Y-m-d',strtotime($state['State']['created']))); ?>&nbsp;</td>
      <td>
          <div class="btn-group">
            <a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#">
            Action
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu pull-right">
              <?php /*?><li><a href="<?php echo Router::url('/').'states/permission/'.$state['State']['id'];?>"><i class="icon-edit"></i> Permission</a></li><?php */?>
			  <li><a href="<?php echo Router::url('/').'states/edit/'.$state['State']['id'];?>"><i class="icon-edit"></i> Edit</a></li>
            </ul>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>  
      
      </tbody>
  </table>
</div> <!-- /widget-body -->


    <!-- Pagging -->
                <div class="pagging">
                    <div class="left"><?php	echo $this->Paginator->counter(array('format' => __('Showing {:current}-{:count} of {:pages}')));?></div>
                    <div class="right">
                        <?php 
                        if ($this->Paginator->hasPage(2)) {
                        echo $this->Paginator->prev( __('Previous'), array('tag'=>'span','after'=>null,'before'=>null), null, array());
                        }
                        ?>
                        <?php echo $this->Paginator->numbers(array('separator' => ''));?>
                        <?php
                        if ($this->Paginator->hasPage(2)) {
                         echo $this->Paginator->next(__('Next'), array(), null, array());
                        } 
                         ?>
                        
                    </div>
                </div>
                <!-- End Pagging -->

</div> <!-- /widget -->
</div>
