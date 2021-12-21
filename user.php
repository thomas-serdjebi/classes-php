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

    public function register($login, $password, $email, $firstname, $lastname) {
        $req = mysqli_query($this->connexion, "INSERT INTO utilisateurs (login, password, email, firstname, lastname) VALUES ( '$login', '$password','$email', '$firstname', '$lastname')");
        $select = mysqli_query($this->connexion, " SELECT * from utilisateurs WHERE login = '$login'");
        $fetch = mysqli_fetch_assoc($select);
        var_dump($fetch);
        
    }

    
}



?>