<?php

session_start();

include('user.php');

if (isset($_POST['submit'])) {

    $login = $_POST['login'];
    $password = $_POST['password'];

    $connexion_user = new User();
    $connexion_user->connect($login, $password);
    
}


?>

<html>
    <form action="test2Loginpassword.php" method="post">
        <input type="text" name="login" placeholder="login">
        <input type="password" name="password" placeholder="password">
        <input type="submit" name="submit">
    </form>
</html>