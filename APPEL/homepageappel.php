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
        $logged_in == true;
        header('Location: homepageappel.php');
	}
}elseif (isset($_POST['login']) && $_POST['username'] != null){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);
    if($row = $result->fetch_assoc()){
        echo "<p>Login Succesful</p>";
        $_SESSION['id']=$row['id'];
        $logged_in == true;
        header('Location: homepageappel.php');
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
	<label for="date">Date: </label> <input type="date" id="date">
	<label for="organ">Name of organization: </label> <input type="text" id="organ">
	<label for="sponsors">Staff sponsors</label> <input type="text" id="sponsors>
	<input type="submit">
</fieldset>
<label for="announce">Announcement</label><br><textarea name="announce" form="main_form" id="announce"></textarea>
</form>
<?php }else{
	header("Location: welcomeappel.php");
} ?>
