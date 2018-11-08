<?php
session_start();
$logged_in = false;
include "connectappel.php";
date_default_timezone_set("America/Toronto");
if(isset($_SESSION['id'])){
    $userID=$_SESSION['id'];
    $sql = "SELECT id, username, access FROM login WHERE id = '$userID'";
    if($result = $conn->query($sql)){
    }else{
	echo "ERROR: $sql - " . $conn->error;
    }
    if($row = $result->fetch_assoc()){
        echo "<p>Login Succesful</p>";
        $username=$row['username'];
	$access=$row['access'];
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
	$access=$row['access'];
        $_SESSION['id']=$row['id'];
    	$userID=$_SESSION['id'];
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
if ($logged_in){ //LOGGED IN STARTS HERE
	$currentDate=date('Y-m-d');
	$currentWeekday=date('D');
	if(isset($_POST['submitDisplayDate'])){
		$currentDate=$_POST['displayDate'];
		$currentWeekday=date('D', strtotime($currentDate));
	}
        echo "<p>Welcome $access $username</p>";
	if(isset($_POST['delete'])){
		$deletion=$_POST['deletion'];
		$sql="DELETE FROM announcement WHERE id='$deletion'";
		if($conn->query($sql) === TRUE){
		}else{
			echo "ERROR with deletion: " . $conn->error;
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
<?php
	if ($access=="admin"){
?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="submit" name="createAnnounce" class="buttons" value="Create Announcement">
        <input type="submit" name="showAll" class="buttons" value="Show all announcements">
        <input type="submit" name="showMy" class="buttons" value="Show my announcements">
		<!--Add admin-only forms here-->
</form>
<?php
	}elseif ($access=="teacher"){
?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="submit" name="createAnnounce" class="buttons" value="Create Announcement">
        <input type="submit" name="showAll" class="buttons" value="Show all announcements">
        <input type="submit" name="showMy" class="buttons" value="Show my announcements">
</form>
<?php
	}elseif ($access=="student"){
?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="submit" name="showAll" class="buttons" value="Show all announcements">
</form>
<?php
	}else{
		echo "Error: Invalid access";
	}
	if(isset($_POST['createAnnounce'])){
?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" id="main_form">
<fieldset>
	<label for="dateStart">Date start: </label> <input type="date" id="dateStart" name="startDate">
	<label for="dateEnd">Date end: </label> <input type="date" id="dateEnd" name="endDate">
	<label for="organ">Name of organization: </label> <input type="text" id="organ" name="organ">
	<label for="sponsors">Staff sponsors</label> <input type="text" id="sponsors" name="sponsors">	
	<div>
		<label for="monday" >Monday</label><input type="checkbox" id="monday" name="weekdays[]" value=monday><br>
		<label for="tuesday">Tuesday</label><input type="checkbox" id="tuesday" name="weekdays[]" value=tuesday><br>
		<label for="wednesday">Wednesday</label><input type="checkbox" id="wednesday" name="weekdays[]" value=wednesday><br>
		<label for="thursday">Thursday</label><input type="checkbox" id="thursday" name="weekdays[]" value=thursday><br>
		<label for="friday">Friday</label><input type="checkbox" id="friday" name="weekdays[]" value=friday><br>
	</div>
	<input type="hidden" name="userid" value="$userID">
	<input type="submit" name="announce" value="Submit">
</fieldset>
<label for="announce">Announcement</label><br><textarea name="announcement" form="main_form" id="announce"></textarea>
</form>
<?php
	}elseif(isset($_POST['showAll'])){
?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" id="main_form">
	<label>Filter date</label> <input type="date" id="dateStart" name="displayDate" value="<?php echo $currentDate; ?>">
	<input type="hidden" id="dateStart" name="showAll">
	<input type="submit" id="submit" name="submitDisplayDate" value="Go">
</form>
<?php
		$sql="SELECT * FROM announcement WHERE startDate <= CONVERT('$currentDate', DATE) AND endDate >= CONVERT('$currentDate', DATE) AND weekdays LIKE '%$currentWeekday%'";
		$result=$conn->query($sql);
		if($result=$conn->query($sql)){
		}else{
			echo "ERROR: " . $sql . " - " . $conn->error;
		}
		while($row=$result->fetch_assoc()){
			echo "<div><br><br><b>" . $row['organization'] . " - " . $row['sponsors'] . "</b> ";
			if($userID==$row['userid'] || $access=="admin"){
?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" id="main_form" style="display: inline;">
	<input type="hidden" id="dateStart" name="deletion" value="<?php echo $row['id'] ?>">
	<input type="hidden" name="showAll">
	<input type="submit" id="delete" name="delete" value="Delete">
</form>
<?php
			}
			echo "<br>" . $row['announcement'] . "<br></div>";
		}
		echo "<br><br>No more announcements for this day.";
	}elseif(isset($_POST['showMy'])){
		$sql="SELECT * FROM announcement WHERE userid='$userID'";
		$result=$conn->query($sql);
		if($result=$conn->query($sql)){
		}else{
			echo "ERROR: " . $sql . " - " . $conn->error;
		}
		while($row=$result->fetch_assoc()){
			echo "<div><br><br>" . "Posted on: " . $row['date'] . "<br><b>" . $row['organization'] . " - " . $row['sponsors'] . "</b>";
?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" id="main_form" style="display: inline;">
	<input type="hidden" name="deletion" value="<?php echo $row['id'] ?>">
	<input type="hidden" name="showMy">
	<input type="submit" name="delete" value="Delete">
</form>
<?php
			echo "<br>" . $row['announcement'] . "</b></div>";
		}
		echo "<br><br>No more announcements.";
	}
	if(isset($_POST['announce'])){
		$announcement=$_POST['announcement'];
		$organ=$_POST['organ'];
		$sponsors=$_POST['sponsors'];
		$startDate=$_POST['startDate'];
		$endDate=$_POST['endDate'];
		$weekdays=$_POST['weekdays'];
		$weekdaysStr=implode(",",$weekdays);
		$sql="INSERT INTO announcement (announcement, organization, sponsors, userid, startDate, endDate, weekdays) VALUES ('$announcement', '$organ', '$sponsors', '$userID', '$startDate', '$endDate', '$weekdaysStr')";
		if($conn->query($sql)){
			echo "Announcement submitted";
		}else{
			echo "ERROR: ", $conn->error;
		}
	}
?>

<?php
}else{
	header("Location: welcomeappel.php");
} ?>
