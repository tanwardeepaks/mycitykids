<div class="row-fluid">
    <ul class="breadcrumb">
        <?php
            $this->Html->addCrumb('Dashboard',array('controller'=>'dashboards','action'=>'index'));
            $this->Html->addCrumb('Blogs');
            echo $this->Html->getCrumbs(' / ');
        ?>

    </ul>
    <h2 class="heading">Blogs</h2>
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

		<form action="<?php echo Configure::read('live_url');?>blogs/index" method="get" name="search_method">
		<div class="widget-body" style="padding-bottom:0px;">


		  <table cellpadding="10" cellspacing="8" border="0" width="100%">
			<tr>
				<td width="20%">Enter search criteria</td>
				<td width="30%"><input class="span7" type="text" id="search_criteria" name="search_criteria" value="<?php echo (array_key_exists('search_criteria',$this->request->query))?$this->request->query['search_criteria']:''?>"/></td>
				<td width="20%">&nbsp;</td>
				<td width="30%">&nbsp;</td>

			</tr>
			<tr>

				<td width="93%" colspan="2">
				<button class="btn btn-primary" type="submit">Search</button>
				<button class="btn" type="button" onclick="window.location.href = '<?php echo Router::url('/');?>blogs'">Cancel</button>
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
  <h5>Blogs</h5>
  <div class="widget-buttons">
      <a href="<?php echo Router::url('/').'blogs/add'?>" data-title="Add Category" class="tip" ><i class="icon-plus"></i></a>
     <!-- <a href="#" title="Collapse" data-collapsed="false" class="tip1 collapse"><i class="icon-chevron-up"></i></a>-->
  </div>
</div>
<div class="widget-body">
  <table id="users" class="table table-striped table-bordered dataTable">
    <thead>
      <tr>
       <th>S.No.</th>
       <th><?php echo $this->Paginator->sort('name'); ?></th>
	   <th><?php echo $this->Paginator->sort('slug'); ?></th>
       <th><?php echo $this->Paginator->sort('status'); ?></th>
       <th><?php echo $this->Paginator->sort('created'); ?></th>
        <th class="actions"><?php echo __('Actions'); ?></th>
      </tr>
    </thead>
    <tbody>
    <?php

	$index = 0;
	$paginatorParams = $this->Paginator->params();
	foreach ($blogs as $blog):
	 $index++;
	 ?>
      <tr>
      <td><?php echo  $index + ( ((int)$this->Paginator->counter('{:page}') - 1) * $paginatorParams['limit'] ); ?>&nbsp;</td>
      <td><?php echo h($blog['Blog']['name']); ?>&nbsp;</td>
	  <td><?php echo h($blog['Blog']['slug']); ?>&nbsp;</td>
      <td><span class="label <?php echo ($blog['Blog']['status'])?'label-success':'label-important'?>"><?php echo ($blog['Blog']['status'])?'Active':'Inactive'?></span></td>
      <td><?php echo h(date('Y-m-d',strtotime($blog['Blog']['created']))); ?>&nbsp;</td>
      <td>
          <div class="btn-group">
            <a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#">
            Action
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu pull-right">
              <li><a href="<?php echo Router::url('/').'blogs/edit/'.$blog['Blog']['id'];?>"><i class="icon-edit"></i> Edit</a></li>
              <li><i class="icon-remove"></i><?php echo $this->Form->postLink(__('Delete'), array('admin'=>false,'controller'=>'blogs', 'action' => 'delete', $blog['Blog']['id']), null, __('Are you sure you want to delete "%s" page?', $blog['Blog']['name'])); ?></li>
            </ul>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>

      </tbody>
  </table>

     <div class="row-fluid">

		 <div class="span6">
		  <div class="dataTables_paginate paging_bootstrap pagination">
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



		  </div>
		  </div>
	  </div>
</div> <!-- /widget-body -->




</div> <!-- /widget -->
</div>
<script type="text/javascript">
        $(document).ready(function(){
             $('li.disabled').wrapInner('<a href="#"/>'+ $(this).html()+'</a>');
             $('li.current').wrapInner('<a href="#"/>'+ $(this).html()+'</a>');
        });

</script>