<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title_for_layout; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Promeance">
    <link rel="shortcut icon" href="assets/ico/favicon.png">
     <?php
		echo $this->Html->meta('icon');

		echo $this->Html->css(
							array(
								 'bootstrap',
								 'theme',
								 'font-awesome.min',
								 'alertify',
								 'custom',
								 'datepicker',
								 'chosen')
							);

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		echo $this->Html->script(array('jquery-1.9.1.min'));
	?>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">
    <link rel="Favicon Icon" href="favicon.ico">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
   <?php echo $this->Session->flash(); ?>
  <body>

    <div id="wrap">
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <div class="logo"> 
			<?php echo $this->Html->image('logo.gif',array('alt'=>'Ticksol Admin Template','title'=>'REI Admin Template','height'=>80,'width'=>120))?>
          </div>
		  <a class="btn btn-navbar visible-phone" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
           <a class="btn btn-navbar slide_menu_left visible-tablet">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>

          <div class="top-menu visible-desktop">
           
            <ul class="pull-right">  
              <li><a href="<?php echo Router::url('/').'users/logout'?>"><i class="icon-off"></i> Logout</a></li>
            </ul>
          </div>

          <div class="top-menu visible-phone visible-tablet">
            <ul class="pull-right">  
              <li><a title="link to View all Messages page, no popover in phone view or tablet" href="#"><i class="icon-envelope"></i></a></li>
              <li><a title="link to View all Notifications page, no popover in phone view or tablet" href="#"><i class="icon-globe"></i></a></li>
              <li><a href="<?php echo Router::url('/').'users/logout'?>"><i class="icon-off"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
     
      <!-- Side menu -->
      <?php echo $this->element('sidebar');?>
      <!-- /Side menu -->

      <!-- Main window -->
      <div class="main_container" id="dashboard_page">
      	<?php echo $this->fetch('content'); ?>

      </div>
      <!-- /Main window -->
      
    </div><!--/.fluid-container-->
    </div><!-- wrap ends-->


   <?php  //echo $this->Html->script(array('jquery.min.1.8.2')); ?>
<script language="javascript">
	jQuery(document).ready(function(){
		setTimeout(function(){
			jQuery('#flashMessage').slideUp(2000);
		},3000);
	});
</script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
	<?php
	echo $this->Html->script(array(
									'raphael-min.js',
									'bootstrap',
									//'sparkline',
									//'morris.min',
									'jquery.dataTables.min',
									'jquery.masonry.min',
									'jquery.imagesloaded.min',
									//'jquery.facybox',
									'jquery.alertify.min',
									'jquery.knob',
									//'fullcalendar.min',
									'jquery.gritter.min',
									'jquery.slimscroll.min',
									'bootstrap-datepicker',
									'chosen.jquery',
									'common.function'
									//'realm'
									));	
	?>
	<script language="javascript">
		 var config = {
			  '.chosen-select'           : {},
			  '.chosen-select-deselect'  : {allow_single_deselect:true},
			  '.chosen-select-width'     : {width:"95%"}
			}
			for (var selector in config) {
			  $(selector).chosen(config[selector]);
			}
	</script>
    
  </body>
</html>
