<?php
$mailSent = mail("p0076296@pdsb.elearningontario.ca", "PHP Email Server", "We have successfully setup the laptop to send emails through php -Anthony Bertnyk and Mahbod Sabbaghi. (Sent from php)");
if($mailSent){
	echo "<br>email sent successfully<br>";
}else{
	echo "<br>Error sending email<br>";
}
?>
