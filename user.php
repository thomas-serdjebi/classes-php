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

    public function disconnect(){
        session_destroy();
        echo "Déconnecté.";
        
    }
}



?>