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

        $conn = mysqli_connect('localhost', 'root', '', 'classes');
        $this->connexion=$conn;
    }

    //REGISTER

    public function register($login, $password, $email, $firstname, $lastname) {

        $req = mysqli_query($this->connexion, "INSERT INTO utilisateurs (login, password, email, firstname, lastname) VALUES ( '$login', '$password','$email', '$firstname', '$lastname')");
        $select = mysqli_query($this->connexion, " SELECT * from utilisateurs WHERE login = '$login'");
        $fetch = mysqli_fetch_assoc($select);
        var_dump($fetch);
        
    }

    //CONNECT

    public function connect($login, $password) {

        $login = $_POST['login'];
        $password = $_POST['password'];

        $req2 = mysqli_query($this->connexion, "SELECT * FROM utilisateurs WHERE login='".$login."' AND password='".$password."'");
        $assoc = mysqli_fetch_assoc($req2);
        

        if ( $login == $assoc['login'] && $password = $assoc['password']) {
            $_SESSION['login'] = $login;
            $this->id = $assoc['id'];
            $this->login = $assoc['login'];
            $this->email = $assoc['email'];
            $this->firstname =$assoc['firstname'] ;
            $this->lastname = $assoc['lastname'];
            echo "connecté";
            echo $_SESSION['login'];

        }

        else  {echo "Erreur, le login ou le mot de passe est incorrect." ; }

    }

    // DISCONNECT

    public function disconnect() {

        session_destroy() ;
        echo "Déconnecté." ;
        
    }

    // DELETE

    public function delete() {

        $delete =  "DELETE FROM utilisateurs WHERE login='".$_SESSION['login']."'";

        if (mysqli_query($this->connexion, $delete)) {
            session_destroy();
            echo "Compte supprimé.";
        }
    }

    public function update($login, $password, $email, $firstname, $lastname) {
        
        $update = "UPDATE utilisateurs SET login='$login', password='$password', email='$email', firstname='$firstname', lastname='$lastname' WHERE login='".$_SESSION['login']."'";
        $query = mysqli_query($this->connexion, $update);
    }

    public function isConnected() {

        if ($this->login == true ) {
            return true;
        }       
        else { return false;} 
    }

    public function getAllInfos() {


        $select = mysqli_query($this->connexion, "SELECT * FROM utilisateurs WHERE login='".$_SESSION['login']."' ");

        $assoc = mysqli_fetch_assoc($select);

        return $assoc;
    }

    public function getLogin(){
        $login = mysqli_query($this->connexion, "SELECT login FROM utilisateurs WHERE login ='".$_SESSION['login']."'");
        $assoc = mysqli_fetch_assoc($login);
        echo $assoc['login'];
        return $assoc['login'];

    }

    public function getEmail(){
        $email = mysqli_query($this->connexion, "SELECT email FROM utilisateurs WHERE login = '".$_SESSION['login']."'");
        $assoc = mysqli_fetch_assoc($email);
        echo $assoc['email'];
        return $assoc['email'];
        
    }

    public function getFirstname(){
        $firstname = mysqli_query($this->connexion, "SELECT firstname FROM utilisateurs WHERE login = '".$_SESSION['login']."'");
        $assoc = mysqli_fetch_assoc($firstname);
        echo $assoc['firstname'];
        return $assoc['firstname'];
        
    }

    public function getLastname(){
        $lastname = mysqli_query($this->connexion, "SELECT lastname FROM utilisateurs WHERE login = '".$_SESSION['login']."'");
        $assoc = mysqli_fetch_assoc($lastname);
        echo $assoc['lastname'];
        return $assoc['lastname'];
        
    }

    
}



?>