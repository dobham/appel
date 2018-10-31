<?php session_start(); ?>
<?php
include "connectdb.php";
$loggedin=FALSE;
if(isset($_SESSION['userid'])){ //If logged in through remembered session.
	$userid=$_SESSION['userid'];
	$sql="SELECT id, email, firstname, lastname FROM MyGuests WHERE id='$userid'";
	$result = $conn->query($sql);
	if($row = $result->fetch_assoc()){
		$email=$row['email'];
		$firstname=$row['firstname'];
		$lastname=$row['lastname'];
		$loggedin=TRUE;
	}else{
		echo "Error: Invalid session.";
	}
}elseif(isset($_POST["login"]) && $_POST["email"]!=null){ //If logged in through form.
	$email=$_POST['email'];
	$pass=$_POST['password'];
	$sql="SELECT id, email, password, firstname, lastname FROM MyGuests WHERE email='$email' AND password='$pass'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	if($row){
		$userid=$row['id'];
		$firstname=$row['firstname'];
		$lastname=$row['lastname'];
		$loggedin=TRUE;
	}
}elseif($_POST["email"]==null){
	echo "Error: email not submitted<br>";
}else{
	echo "Unknown login error: Session and post form are both unset.<br>";
}

if ($loggedin) {
?>
<form action="<?php echo htmlspecialchars('login.php');?>" method="POST">
<input type="submit" name="logout" id="submit" value="LOGOUT"/>
</form>
<?php
$firstname[0]=strtoupper($firstname[0]);
$lastname[0]=strtoupper($lastname[0]);
echo "Logged in as $firstname $lastname<br><br>";
$_SESSION['userid']=$userid;
//LOGGED IN BEGINS

if(isset($_POST["submit2"]) && !empty($_POST["comment"])){
	echo "Comment submitted ";
	$comment=$_POST['comment'];
	$sql="ALTER TABLE comments AUTO_INCREMENT = 1";
	if($conn->query($sql) === TRUE){
	}else{
		echo "ERROR: " . $sql . "<br>" . $conn->error;
	}
	$sql="INSERT INTO comments (userid, comment) VALUES ('$userid', '$comment')";
	if($conn->query($sql) === TRUE){
		echo "successfully<br><br>";
	}else{
		echo "ERROR: " . $sql . "<br>" . $conn->error;
	}

}
if(isset($_POST["deleteComment"])){
	echo "Comment deleted ";
	$deleteCommentid=$_POST['deleteCommentid'];
	$sql="SELECT userid FROM comments WHERE id = $deleteCommentid";
	$result=$conn->query($sql);
	if($row=$result->fetch_assoc()){
		echo "successfully<br><br>";
	}else{
		echo "ERROR: " . $sql . "<br>" . $conn->error;
	}
	$deleteCommentUserid=$row['userid'];
	if($userid==$deleteCommentUserid){
		$sql="DELETE FROM comments WHERE id = $deleteCommentid";
		if($conn->query($sql) === TRUE){
			echo "successfully<br><br>";
		}else{
			echo "ERROR: " . $sql . "<br>" . $conn->error;
		}
	}else{
		echo "Error: Access denied to comment deletion; Invalid user.";
	}
}
$sql="SELECT * FROM comments";
$result=$conn->query($sql);
while($row = $result->fetch_assoc()){
	$commentid=$row['id'];
	$commentUserid=$row['userid'];
	$comment=$row['comment'];
	$sql2="SELECT * FROM MyGuests WHERE id='$commentUserid'";
	$result2=$conn->query($sql2);
	if($row2 = $result2->fetch_assoc()){
		$commentFirstname=$row2['firstname'];
		$commentLastname=$row2['lastname'];
		$commentFirstname[0]=strtoupper($commentFirstname[0]);
		$commentLastname[0]=strtoupper($commentLastname[0]);
		echo "<b>$commentFirstname $commentLastname:</b> ";
		if($commentUserid==$userid){ ?>
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" style="display: inline;">
			<input type="hidden" name="deleteCommentid" value="<?php echo $commentid ?>"/>
			<input type="submit" name="deleteComment" value="DELETE"/>
			</form>
		<?php }//else{ echo "<br><br>";}
		echo "<br>$comment<br><br>";
	}else{
		echo "Error: Commenter not found<br>";
	}
}
?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
Comment: <div class="input2"><input type="text" name="comment" id="email"/> </div>
<input type="submit" name="submit2" id="submit" value="SUBMIT"/>
</form>
<?php

//LOGGED IN ENDS
} else{
	echo "User not found, go back to login.";
?>
	<form action="<?php echo htmlspecialchars('login.php');?>" method="POST">
	<input type="submit" name="toLogin" id="submit" value="LOGIN"/>
	</form>
<?php
}
$conn->close;
?>
