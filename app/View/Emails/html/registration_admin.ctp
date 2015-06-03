<html><body>Hello Admin<br>

A New user has been registered on carsell which have following details:.<br><br>

<b>Company Details:</b><br><br>
Company Name: &nbsp;&nbsp; <?php echo $userData['Company']['business_name']; ?><br>
ABN: &nbsp;&nbsp; <?php echo $userData['Company']['ABN']; ?><br>
Mobile: &nbsp;&nbsp; <?php echo $userData['Company']['mobile']; ?><br>
Phone: &nbsp;&nbsp; <?php echo $userData['Company']['phone']; ?><br>
About Company: &nbsp;&nbsp; <?php echo $userData['Company']['description'] ?><br><br>


<b>User Details:</b><br><br>
Name: &nbsp;&nbsp; <?php echo $userData['User']['firstname'].' '.$userData['User']['lastname']; ?><br>
Email: &nbsp;&nbsp; <?php echo $userData['User']['email']; ?><br>
Mobile: &nbsp;&nbsp; <?php echo $userData['User']['mobile']; ?><br>
About User: &nbsp;&nbsp; <?php echo $userData['User']['about_user'] ?><br><br>

Thanks & Regards,<br>
Carsell Team</body></html>
