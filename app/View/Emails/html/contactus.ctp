
<html><body>Hello Admin,<br>

A new enquiry has been found on carsell which have following details:<br><br>

Name: &nbsp;&nbsp; <?php echo $name; ?><br>
Email: &nbsp;&nbsp; <?php echo $email; ?><br>
<?php if(isset($website) && !empty($website)){ ?>Website: &nbsp;&nbsp; <?php echo $website; ?><br><?php } ?>
Message: &nbsp;&nbsp; <?php echo $message; ?><br><br>

Regards,<br>
Carsell </body></html>
