<?php
session_start();
if(isset($_POST['logout'])){
echo "Logged out<br><br>";
session_unset();
session_destroy(); 
}
?>
<form action="<?php echo htmlspecialchars('homepage.php');?>" method="POST">
Email: <div class="input2"><input type="email" name="email" id="email"/> </div>
Password: <div class="input"><input type="password" name="password" id="email"/> </div>
<input type="submit" name="login" id="submit" value="LOGIN"/>
</form>

