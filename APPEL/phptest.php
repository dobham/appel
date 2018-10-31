<html>
<head>
<style>
#name,#email{
transition: ease 0.5s;
color: black;
position: relative;
left: 40%; 
}
#name:hover, #email:hover{
transition: ease 0.5s;
color: red;
}
.input2, .input{
background-color: blue;
border-radius-top-left: 10px;
border-radius-bottom-right: 10px;
transition: ease 0.5s;
}
.input2:hover, .input:hover{
background-color:yellow;
transition: ease 0.5s;
}
}
</style>
</head>
<body>
<?php
if (!isset ($_POST["submit1"])){
?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
Full name: <div class="input"> <input type="text" name="name" id="name"/> </div>
Email: <div class="input2"><input type="email" name="email" id="email"/> </div>
<input type="submit" name="submit1" id="submit" value="SUBMIT"/>
</form>
<?php
}elseif (!isset ($_POST["submit2"])) {
include "connectdb.php";
echo "lol your name is " . $_POST['name'] . "? lol what a bad name lol also we stole your password " . $_POST['pass'] . "<br>";
$email=$_POST['email'];
$name=$_POST['name'];
$names=explode(" ", $name);
$fname=$names[0];
$lname=$names[1];
$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('$fname', '$lname', '$email')";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
<h1>Lost your info?</h1>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
Retrieve your account info via inputing your e-mail: <div class="input2"><input type="email" name="email" id="email"/> </div>
<input type="submit" name="submit2" class="submit" value="SUBMIT"/>
</form>
<?php
}else{
include "connectdb.php";
$email=$_POST['email'];
$sql="SELECT firstname FROM MyGuests WHERE email == '$email'";
//$result = conn->query($sql);
//var_dump($result);
}
$conn->close();
?>

</body>
</html>
