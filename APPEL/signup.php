<form action="<?php echo htmlspecialchars('login.php');?>" method="POST">
Already have an account? <input type="submit" name="submit1" id="submit" value="Login"/>
</form>
<?php

if(isset($_POST["submit1"])){
	include 'connectdb.php';
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = strtolower($_POST['email']);
	$fname = strtolower($_POST['fname']);
	$lname = strtolower($_POST['lname']);
	$pass = $_POST['password'];
	$sql="ALTER TABLE MyGuests AUTO_INCREMENT = 1";
	if($conn->query($sql) === TRUE){
		echo "Account Created Successfully, you can now login";
	}else{
		echo "ERROR: " . $sql . "<br>" . $conn->error;
	}
	$sql="INSERT INTO MyGuests (firstname, lastname, email, password) VALUES ('$fname', '$lname', '$email', '$pass')";
	if($conn->query($sql) === TRUE){
		echo "Account Created Successfully, you can now login";
	}else{
		echo "ERROR: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
?>
	<form action="<?php mail($email, 'Email Verification', 'This is to verify that you have signed up with the correct email');?>" method="POST">
	<input type="submit" name="submit1" id="submit" value="Send verification email"/>
	</form>
<?php
}else{
?>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
	First Name: <div class="input"> <input type="text" name="fname" id="name"/> </div>
	Last name: <div class="input"> <input type="text" name="lname" id="name"/> </div>
	Email: <div class="input2"><input type="email" name="email" id="email"/> </div>
	Password: <div class="input"><input type="password" name="password" id="email"/> </div>
	<input type="submit" name="submit1" id="submit" value="SUBMIT"/>
	</form>
<?php
}
?>
