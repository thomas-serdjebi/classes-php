<?php

session_start();

include('user.php');

if (isset($_POST['connexion'])) {

    $login = $_POST['login'];
    $password = $_POST['password'];

    $connexion_user = new User();
    $connexion_user->connect($login, $password);
    
}

if (isset($_POST['delete'])) {

    $delete_user = new User();
    $delete_user->disconnect();
}


?>

<html>

    <!-- TEST CONNEXION  -->
    <form action="tests.php" method="post">
        <input type="text" name="login" placeholder="login">
        <input type="password" name="password" placeholder="password">
        <input type="submit" name="connexion" value="connexion">
    </form>


    <!-- TEST DELETE -->
    <form action="tests.php" method="post">
        <input type="submit" name="delete" value="deconnexion" >
    </form>

</html>