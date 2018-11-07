<?php
session_start();
$logged_in = false;
include "connectappel.php";
if(isset($_SESSION['id'])){
    $userID=$_SESSION['id'];
    $sql = "SELECT * FROM login WHERE id = '$userID'";
    $result = $conn->query($sql);
    if($row = $result->fetch_assoc()){
        echo "<p>Login Succesful</p>";
        $username=$row['username'];
        $_SESSION['id']=$row['id'];
        $logged_in = true;
	}
}elseif (isset($_POST['login']) && $_POST['username'] != null){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);
    if($row = $result->fetch_assoc()){
        echo "<p>Login Succesful</p>";
        $_SESSION['id']=$row['id'];
        $logged_in = true;
    }
    elseif($_POST["username"]==null){
        echo "Error: username not submitted<br>";
    }
    else {
        echo "<p>User not found</p>";
        $logged_in = false;
    }
}
if ($logged_in){
	if(isset($_POST['announce'])){
		$announcement=$_POST['announcement'];
		$organ=$_POST['organ'];
		$sponsors=$_POST['sponsors'];
		$startDate=$_POST['startDate'];
		$endDate=$_POST['endDate'];
		$weekDays=$_POST['weekDays'];
		$weekDaysStr=implode(",",$weekDays);
		$sql="INSERT INTO announcement (announcement, organization, sponsors, startDate, endDate, weekDays) VALUES ('$announcement', '$organ', '$sponsors', '$startDate', '$endDate', '$weekDaysStr')";
		if($conn->query($sql)){
			echo "Announcement submitted";
		}else{
			echo "ERROR: ", $conn->error;
		}
	}
?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" style="display: inline;">
<input type="submit" name="home" class="buttons" value="Appel">
</form>
<form action="<?php echo htmlspecialchars('welcomeappel.php'); ?>" method="post" style="display: inline;">
<input type="submit" name="logout" class="buttons" value="Logout">
</form>
<br>
<br>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" id="main_form">
<fieldset>
	<label for="dateStart">Date start: </label> <input type="date" id="dateStart" name="endDate">
	<label for="dateEnd">Date end: </label> <input type="date" id="dateEnd" name="startDate">
	<label for="organ">Name of organization: </label> <input type="text" id="organ" name="organ">
	<label for="sponsors">Staff sponsors</label> <input type="text" id="sponsors" name="sponsors">	
	<div>
		<label for="monday" >Monday</label><input type="checkbox" id="monday" name="weekDays[]" value=monday><br>
		<label for="tuesday">Tuesday</label><input type="checkbox" id="tuesday" name="weekDays[]" value=tuesday><br>
		<label for="wednesday">Wednesday</label><input type="checkbox" id="wednesday" name="weekDays[]" value=wednesday><br>
		<label for="thursday">Thursday</label><input type="checkbox" id="thursday" name="weekDays[]" value=thursday><br>
		<label for="friday">Friday</label><input type="checkbox" id="friday" name="weekDays[]" value=friday><br>
	</div>
	<input type="submit" name="announce" value="Submit">
</fieldset>
<label for="announce">Announcement</label><br><textarea name="announcement" form="main_form" id="announce"></textarea>
</form>
<?php }else{
	header("Location: welcomeappel.php");
} ?>
