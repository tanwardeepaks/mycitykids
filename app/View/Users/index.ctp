<div class="row-fluid">
    <ul class="breadcrumb">
        <?php
            $this->Html->addCrumb('Dashboard',array('controller'=>'dashboards','action'=>'index'));
            $this->Html->addCrumb('Users');
            echo $this->Html->getCrumbs(' / ');
        ?>
        
    </ul>
    <h2 class="heading">Users</h2>
</div>
<div class="row-fluid">
<div class="widget widget-padding span12">
<div class="widget-header">
  <i class="icon-group"></i>
  <h5>Users</h5>
  <div class="widget-buttons">
      <a href="<?php echo Router::url('/').'users/add'?>" data-title="Add User" class="tip" ><i class="icon-external-link"></i></a>
     <!-- <a href="#" title="Collapse" data-collapsed="false" class="tip1 collapse"><i class="icon-chevron-up"></i></a>-->
  </div>
</div>  
<div class="widget-body">
  <table id="users" class="table table-striped table-bordered dataTable">
    <thead>
      <tr>
       <th><?php echo $this->Paginator->sort('id'); ?></th>
       <th><?php echo $this->Paginator->sort('User.firstname','Name'); ?></th>
        <th><?php echo $this->Paginator->sort('Role.role','Role'); ?></th>
        <th><?php echo $this->Paginator->sort('User.email','Email'); ?></th>
        <th><?php echo $this->Paginator->sort('User.status','Status'); ?></th>
        <th><?php echo $this->Paginator->sort('created'); ?></th>
        <th class="actions"><?php echo __('Actions'); ?></th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
      <tr>
      <td><?php echo h($user['User']['id']); ?>&nbsp;</td>
      <td><?php echo h($user['User']['firstname'].' '.$user['User']['lastname']); ?>&nbsp;</td>
      <td><?php echo h($user['Role']['role']);?></td>
      <td><?php echo h($user['User']['email']); ?>&nbsp;</td>
      <td><span class="label <?php echo ($user['User']['status'])?'label-success':'label-important'?>"><?php echo ($user['User']['status'])?'Active':'Inactive'?></span></td>
      <td><?php echo h(date('Y-m-d',strtotime($user['User']['created']))); ?>&nbsp;</td>
      <td>
          <div class="btn-group">
            <a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#">
            Action
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu pull-right">
              <li><a href="<?php echo Router::url('/').'users/permission/'.$user['User']['id'];?>"><i class="icon-edit"></i> Permission</a></li>
			  <li><a href="<?php echo Router::url('/').'users/edit/'.$user['User']['id'];?>"><i class="icon-edit"></i> Edit</a></li>
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
                    <div class="left"><?php	//echo $this->Paginator->counter(array('format' => __('Showing {:current}-{:count} of {:pages}')));?></div>
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
