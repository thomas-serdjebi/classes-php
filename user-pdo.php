<?php

class User {

    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname;
    public $connexion;

    //déclaration des méthodes
    public function __construct () {

        try {
            $pdo = new PDO ("mysql:host=localhost;dbname=classes", "root","" );
            $this->connexion=$pdo;
        }
        
        catch(PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

    //REGISTER

    public function register($login, $password, $email, $firstname, $lastname) {

        $register = $this->connexion->prepare("INSERT into utilisateurs (login, password, email, firstname, lastname) VALUES('$login', '$password', '$email', '$firstname', '$lastname')");
        $register->execute();

        $returnregister =  $this->connexion->prepare("SELECT * FROM utilisateurs WHERE login='$login'");
        $returnregister->setFetchMode(PDO::FETCH_ASSOC);
        $returnregister->execute();

        $result = $returnregister->fetchAll();
        var_dump($result);
    }

    //CONNECT

    public function connect($login, $password) {

        $connect = $this->connexion->prepare("SELECT * FROM utilisateurs WHERE login='$login' AND password='$password'");
        $connect->setFetchMode(PDO::FETCH_ASSOC);
        $connect->execute();
        $result = $connect->fetchAll();

        if ( ($result[0]['login'])== $login && ($result[0]['password'])== $password) {
            
            $_SESSION['login'] = $result[0]['login'];
            $this->email = $result[0]['email'];
            $this->firstname = $result[0]['firstname'];
            $this->lastname = $result[0]['lastname'];

            echo "Connecté";
        
        }

        else { echo "Login ou mot de passe incorrect.";}

    }

    //DISCONNECT 

    public function disconnect() {
        session_destroy();
        header('Refresh:1; url=tests.php');
    }

    //DELETE

    public function delete() {

        $delete = $this->connexion->prepare("DELETE FROM utilisateurs WHERE login = '".$_SESSION['login']."'");
        $delete->execute();

        session_destroy();
        header('Refresh:1; url=tests.php');

        echo "Votre compte a été supprimé.";

    }

    //UPDATE

    public function update($login, $password, $email, $firstname, $lastname) {

        $update = $this->connexion->prepare("UPDATE utilisateurs SET login='$login', password='$password', email='$email', firstname='$firstname', lastname='$lastname' WHERE login='".$_SESSION['login']."'");
        $update->execute();
        $this->login = $login;
        $_SESSION['login'] = $this->login;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;

        echo "Modifications enregistrées";
    }

    //ISCONNECTED 

    public function isConnected() {

        $isConnected = null;

        if (isset($_SESSION['login'])) {

            $isConnected = true;
            echo "Connecté";
        }

        else $isConnected = false;
        echo "Vous n'êtes pas connecté.";
    }

    public function getAllInfos() {

        $getAll = $this->connexion->prepare("SELECT * FROM utilisateurs WHERE login ='".$_SESSION['login']."'");
        $getAll->setFetchMode(PDO::FETCH_ASSOC);
        $getAll->execute();

        $result = $getAll->FetchAll();

        var_dump($result);

        return($result);

    }

    public function getLogin(){
        $getlog = $this->connexion->prepare("SELECT login FROM utilisateurs where login ='".$_SESSION['login']."'");
        $getlog->setFetchMode(PDO::FETCH_ASSOC);
        $getlog->execute();

        $result= $getlog->fetchAll();
        $login = $result[0]['login'];
        echo $login;
        return $login;
    }
    public function getEmail(){
        $getmail = $this->connexion->prepare("SELECT email FROM utilisateurs where login ='".$_SESSION['login']."'");
        $getmail->setFetchMode(PDO::FETCH_ASSOC);
        $getmail->execute();

        $result= $getmail->fetchAll();
        $email = $result[0]['email'];
        echo $email;
        return $email;
    }

    public function getFirstname(){
        $getfirst = $this->connexion->prepare("SELECT firstname FROM utilisateurs where login ='".$_SESSION['login']."'");
        $getfirst->setFetchMode(PDO::FETCH_ASSOC);
        $getfirst->execute();

        $result= $getfirst->fetchAll();
        $firstname = $result[0]['firstname'];
        echo $firstname;
        return $firstname;
    }
    public function getLastname(){
        $getlast = $this->connexion->prepare("SELECT lastname FROM utilisateurs where login ='".$_SESSION['login']."'");
        $getlast->setFetchMode(PDO::FETCH_ASSOC);
        $getlast->execute();

        $result= $getlast->fetchAll();
        $lastname = $result[0]['lastname'];
        echo $lastname;
        return $lastname;
    }
    



}



?>