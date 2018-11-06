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
		$sql="INSERT INTO announcement (announcement, organization, sponsor) VALUES ('$announcement', '$organ', '$sponsors')";
		if($conn->query($sql)){
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
<form action="<?php echo htmlspecialchars($_SERVER['$PHP_SELF']); ?>" method="post" id="main_form">
<fieldset> 
	<label for="dateStart">Date start: </label> <input type="date" id="dateStart" name="dateStart">
	<label for="dateEnd">Date end: </label> <input type="date" id="dateEnd" name=dateEnd>
	<label for="organ">Name of organization: </label> <input type="text" id="organ" name="organ">
	<label for="sponsors">Staff sponsors</label> <input type="text" id="sponsors" name="sponsors">	
	<div>
		<label for="monday" >Monday</label><input type="checkbox" id="monday" name=monday><br>
		<label for="tuesday">Tuesday</label><input type="checkbox" id="tuesday" name=tuesday><br>
		<label for="wednesday">Wednesday</label><input type="checkbox" id="wednesday" name=wednesday><br>
		<label for="thursday">Thursday</label><input type="checkbox" id="thursday" name=thursday><br>
		<label for="friday">Friday</label><input type="checkbox" id="friday" name=friday><br>
		<label for="saturday">Saturday</label><input type="checkbox" id="saturday" name=saturday><br>
		<label for="sunday">Sunday</label><input type="checkbox" id="sunday" name=sunday>
	</div>
	<input type="submit" name="announce">
</fieldset>
<label for="announce">Announcement</label><br><textarea name="announcement" form="main_form" id="announce"></textarea>
</form>
<?php }else{
echo "not logged";
	//header("Location: welcomeappel.php");
} ?>
