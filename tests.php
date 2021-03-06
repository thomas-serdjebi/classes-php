<?php

session_start();

include('user.php');

if (isset($_POST['connexion'])) {

    $login = $_POST['login'];
    $password = $_POST['password'];

    $connexion_user = new User();
    $connexion_user->connect($login, $password);
    
}

if (isset($_SESSION['login'])) {
    if (isset($_POST['disconnect'])) {

        $delete_user = new User();
        $delete_user->disconnect();
    }
    
    if (isset($_POST['delete'])) {
    
        $delete_user = new User();
        $delete_user->delete();
    }
    
    if (isset($_POST['update'])) {
    
        $login = $_POST['newlogin'];
        $password = $_POST['newpassword'];
        $email = $_POST['newemail'];
        $firstname = $_POST['newfirstname'];
        $lastname = $_POST['newlastname'];
    
        $update_user = new User();
        $update_user->update($login, $password, $email, $firstname, $lastname);
    }
    
    if (isset($_POST['afficherinfos'])) {
    
        $afficher_user = new User();
        $afficher_user->getAllInfos();
    }
    
    if (isset($_POST['afficherlogin'])) {

        $afficherlogin= new User();
        $afficherlogin->getLogin();
    }
    
    if (isset($_POST['afficheremail'])) {
    
        $afficheremail = new User();
        $afficheremail->getEmail();
    }
    
    if (isset($_POST['afficherfirstname'])) {
    
        $afficherfirstname = new User();
        $afficherfirstname->getFirstname();
    }
    
    if (isset($_POST['afficherlastname'])) {
    
        $afficherlastname = new User();
        $afficherlastname->getLastname();
    }

}





?>

<html>

    

    <!-- TEST CONNEXION  -->
    <form action="tests.php" method="post">
        <input type="text" name="login" placeholder="login">
        <input type="password" name="password" placeholder="password">
        <input type="submit" name="connexion" value="connexion">
    </form>


    <!-- TEST DISCONNECT -->
    <form action="tests.php" method="post">
        <input type="submit" name="disconnect" value="deconnexion" >
    </form>

    <!-- TEST DELETE -->
    <form action="tests.php" method="post">
        <input type="submit" name="delete" value="delete">
    </form>

    <!-- TEST UPDATE -->

    <?php if (isset($_SESSION['login'])) { ?>
    <form action="tests.php" method="post">
        <input type="text" name="newlogin" placeholder="login">
        <input type="password" name="newpassword" placeholder="password">
        <input type="text" name="newemail" placeholder="email">
        <input type="text" name="newfirstname" placeholder="firstname">
        <input type="text" name="newlastname" placeholder="lastname">
        <input type="submit" name="update" value="update"> 
    </form>
    <?php } ?>

    <?php if (isset($_SESSION['login'])) { ?>
    <form action="tests.php" method="post">
        <input type="submit" name="afficherinfos" value="afficher"> 
    </form>
    <?php } ?>

    <?php if (isset($_SESSION['login'])) { ?>
    <form action="tests.php" method="post">
        <input type="submit" name="afficherlogin" value="afficherlogin"> 
    </form>
    <?php } ?>

    <?php if (isset($_SESSION['login'])) { ?>
    <form action="tests.php" method="post">
        <input type="submit" name="afficheremail" value="afficheremail"> 
    </form>
    <?php } ?>

    <?php if (isset($_SESSION['login'])) { ?>
    <form action="tests.php" method="post">
        <input type="submit" name="afficherfirstname" value="afficherfirstname"> 
    </form>
    <?php } ?>

    <?php if (isset($_SESSION['login'])) { ?>
    <form action="tests.php" method="post">
        <input type="submit" name="afficherlastname" value="afficherlastname"> 
    </form>
    <?php } ?>

</html>