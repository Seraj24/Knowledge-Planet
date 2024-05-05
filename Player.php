<?php

class Player {
    private $username;
    private $firstName;
    private $lastName;
    private $password;

    public function __construct($username, $firstName, $lastName, $password) {
        $this->username = $username;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->password = $hashedPassword;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getPassword() {
        return $this->password;
    }
}

?>