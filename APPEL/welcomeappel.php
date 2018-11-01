<?php
/**
 * Created by PhpStorm.
 * User: Mahbod, Anthony
 * Date: 2018-10-29
 * Time: 1:08 AM
 */
//use session veriables to set these veriables, so that when they use the signup, they dont need to use login, make a veriable that is only used when signing up with session to do this
$logged_in = false;
$access=NULL;
if (isset($_POST['login']) && $_POST['username'] != null){
    include "connectappel.php";
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);
    if($row = $result->fetch_assoc()){
        echo "<p>Login Succesful</p>";
        $logged_in == true;
    }
    elseif($_POST["username"]==null){
        echo "Error: username not submitted<br>";
    }
    else {
        echo "<p>User not found</p>";
        $logged_in = false;
    }
}
if (isset($_POST['signup'])){
    ?>
<form action="<?php echo htmlspecialchars($_SERVER['$PHP_SELF']); ?>" method="post">
    <input type="submit" name="student_sign" class="buttons" value="Student">
    <input type="submit" name="teacher_sign" class="buttons" value="Teacher">
    <input type="submit" name="admin_sign" class="buttons" value="Admin">
</form>
<?php
    if(isset($_POST['student_sign'])){?>
        form action="<?php echo htmlspecialchars($_SERVER['$PHP_SELF']); ?>" method="post">
            <input type="text" name="username" class="inputbox" placeholder="Username (ex.627842)">
            <input type="text" name="password" class="inputbox" placeholder="Password">
            <input type="submit" name="signup_student" class="buttons" value="Sign up Student">
    <?php}
    if(isset($_POST['signup_student'])){
        $is_student == true;
        $username=$post['username'];
        $password=$post['password'];
        $sql = "INSERT INTO login (username, password, access) VALUES ('$username', '$password', 'student')";
    }
    if(isset($_POST['teacher_sign'])){?>
        form action="<?php echo htmlspecialchars($_SERVER['$PHP_SELF']); ?>" method="post">
            <input type="text" name="username" class="inputbox" placeholder="Username (ex.627842)">
            <input type="text" name="password" class="inputbox" placeholder="Password">
            <input type="submit" name="signup_teacher" class="buttons" value="Sign up Teacher">
    <?php}
    if(isset($_POST['signup_teacher'])){
        $is_teacher == true;
        $username=$post['username'];
        $password=$post['password'];
        $sql = "INSERT INTO login (username, password, access) VALUES ('$username', '$password', 'teacher')";
}
    if(isset($_POST['admin_sign'])){?>
        form action="<?php echo htmlspecialchars($_SERVER['$PHP_SELF']); ?>" method="post">
            <input type="text" name="username" class="inputbox" placeholder="Username (ex.627842)">
            <input type="text" name="password" class="inputbox" placeholder="Password">
            <input type="submit" name="signup_admin" class="buttons" value="Sign up Admin">
<?php}
    if(isset($_POST['signup_admin'])){
        $is_admin == true;
        $username=$post['username'];
        $password=$post['password'];
        $sql = "INSERT INTO login (username, password, access) VALUES ('$username', '$password', 'admin')";
}
?>
<!DOCTYPE html>
<html>
<head>
    <rel="stylesheet" type="text/css" href="style_main.css" />
    <meta http-equiv="content-type" content="text/php; charset=utf-8" />
    <title>Appel</title>
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER['$PHP_SELF']); ?>" method="post">
        <input type="text" name="username" class="inputbox" placeholder="Username (ex.627842)">
        <input type="text" name="password" class="inputbox" placeholder="Password">
        <input type="submit" name="login" class="buttons" value="Login Now">
    </form>
    <form action="<?php echo htmlspecialchars($_SERVER['$PHP_SELF']); ?>" method="post">
        <input type="submit" name="signup" class="buttons" value="Sign up Now">
    </form>
</body>
<footer class="footer">
    <p>Created by: Anthony B and Mahbod S</p>
    <p>Contact information: <a class="contact" href="mahbodsabbaghi@gmail.com">
            mahbodsabbaghi@gmail.com</a><a class="contact" href="anthony.bertnyk@gmail">
            anthony.bertnyk@gmail</a>.</p>
</footer>
</html>
