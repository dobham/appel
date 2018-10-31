<?php
include "connectaphel.php";

?>
<form action="<?php echo htmlspecialchars($_SERVER['$PHP_SELF']); ?>" method="post" id="main_form">
<fieldset> 
	<label for="date">Date: </label> <input type="date" id="date">
	<label for="organ">Name of organization: </label> <input type="text" id="organ">
	<label for="sponsors">Staff sponsors</label> <input type="text" id="sponsors>
	<input type="submit">
</fieldset>
<label for="announce">Announcement</label><br><textarea name="announce" form="main_form" id="announce"></textarea>
</form>
