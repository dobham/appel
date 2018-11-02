<?php
/**
 * Created by PhpStorm.
 * User: Mahbod, Anthony
 * Date: 2018-10-29
 * Time: 1:08 AM
 */
//use session veriables to set these veriables, so that when they use the signup, they dont need to use login, make a veriable that is only used when signing up with session to do this
session_start();
include "connectappel.php";
$logged_in = false;
$access=NULL;
?>
    <!DOCTYPE html>
    <html>
    <head>
        <rel="stylesheet" type="text/css" href="style_main.css" />
        <meta http-equiv="content-type" content="text/php; charset=utf-8" />
        <title>Appel</title>
    </head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="submit" name="welcomeHome" class="buttons" value="Appel">
    </form>
    <br>
    <br>
<?php
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
    }
    elseif($_POST["username"]==null){
        echo "Error: username not submitted<br>";
    }
    else {
        echo "<p>User not found</p>";
        $logged_in = false;
    }
}elseif (isset($_POST['signup'])){
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="submit" name="student_sign" class="buttons" value="Student">
        <input type="submit" name="teacher_sign" class="buttons" value="Teacher">
        <input type="submit" name="admin_sign" class="buttons" value="Admin">
        <input type="hidden" name="signup">
    </form>
    <?php
    if(isset($_POST['student_sign'])){
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <input type="text" name="username" class="inputbox" placeholder="Username (ex.627842)">
            <input type="password" name="password" class="inputbox" placeholder="Password">
            <input type="submit" name="signup_student" class="buttons" value="Sign up Student">
            <input type="hidden" name="signup">
        </form>

        <?php
    }
    if(isset($_POST['signup_student'])  && $_POST['username'] != null && $_POST['password'] != null){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $sql = "INSERT INTO login (username, password, access) VALUES ('$username', '$password', 'student')";
        if($conn->query($sql)){
            echo "account created successfully";
            $sql = "SELECT id FROM login WHERE username = '$username' AND password = '$password'";
            $result = $conn->query($sql);
            if($row = $result->fetch_assoc()){
                echo "<p>Login Succesful</p>";
                $_SESSION['id']=$row['id'];
                header('Location: homepageappel.php');
            }
            
        }else{
            echo "error creating account";
        }
    }elseif(isset($_POST['signup_student'])){
        echo "You must fill all sections";
    }
    if(isset($_POST['teacher_sign'])){
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <input type="text" name="username" class="inputbox" placeholder="Username (ex.627842)">
            <input type="password" name="password" class="inputbox" placeholder="Password">
            <input type="submit" name="signup_teacher" class="buttons" value="Sign up Teacher">
            <input type="hidden" name="signup">
        </form>
        <?php
    }
    if(isset($_POST['signup_teacher']) && $_POST['username'] != null && $_POST['password'] != null){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $sql = "INSERT INTO login (username, password, access) VALUES ('$username', '$password', 'teacher')";
        if($conn->query($sql)){
            echo "account created successfully";
            //add homepage form
            $sql = "SELECT id FROM login WHERE username = '$username' AND password = '$password'";
            $result = $conn->query($sql);
            if($row = $result->fetch_assoc()){
                echo "<p>Login Succesful</p>";
                $_SESSION['id']=$row['id'];
                header('Location: homepageappel.php');
            }
            
        }else{
            echo "error creating account";
        }
    }elseif(isset($_POST['signup_teacher'])){
        echo "You must fill all sections";
    }
    if(isset($_POST['admin_sign'])){
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <input type="text" name="username" class="inputbox" placeholder="Username (ex.627842)">
            <input type="password" name="password" class="inputbox" placeholder="Password">
            <input type="submit" name="signup_admin" class="buttons" value="Sign up Admin">
            <input type="hidden" name="signup">
        </form>
        <?php
    }
    if(isset($_POST['signup_admin'])  && $_POST['username'] != null && $_POST['password'] != null){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $sql = "INSERT INTO login (username, password, access) VALUES ('$username', '$password', 'admin')";
        if($conn->query($sql)){
            echo "account created successfully";
            $sql = "SELECT id FROM login WHERE username = '$username' AND password = '$password'";
            $result = $conn->query($sql);
            if($row = $result->fetch_assoc()){
                echo "<p>Login Succesful</p>";
                $_SESSION['id']=$row['id'];
                header('Location: homepageappel.php');
            }
            
        }else{
            echo "error creating account";
        }
    }elseif(isset($_POST['signup_admin'])){
        echo "You must fill all sections";
    }
}else{
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="text" name="username" class="inputbox" placeholder="Username (ex.627842)">
        <input type="password" name="password" class="inputbox" placeholder="Password">
        <input type="submit" name="login" class="buttons" value="Login Now">
    </form>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="submit" name="signup" class="buttons" value="Or Sign Up">
    </form>
    </body>
    <footer class="footer">
        <p>Created by: Anthony B and Mahbod S</p>
        <p>Contact information: <a class="contact" href="mahbodsabbaghi@gmail.com">
                mahbodsabbaghi@gmail.com</a> <a class="contact" href="anthony.bertnyk@gmail">
                anthony.bertnyk@gmail.com</a></p>
    </footer>
    </html>
    <?php
}
$conn->close();
?>
