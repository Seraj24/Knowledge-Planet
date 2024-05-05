<?php

class SignUpValidator  {
    private static $firstNameMaxLength = 20;
    private static $lastNameMaxLength = 20;
    private static $usernameMinLength = 8;
    private static $passwordMinLength = 8;

    public static function validateFirstName($firstName) {
        if (empty($firstName)) {
            return 'First name is required';
        } elseif (!preg_match('/^[a-zA-Z]/', $firstName)) {
            return 'First name should not start with a number';
        } elseif (strlen($firstName) > self::$firstNameMaxLength) {
            return 'First name should not exceed ' . self::$firstNameMaxLength . ' characters';
        }
        return null; 
    }

    public static function validateLastName($lastName) {
        if (empty($lastName)) {
            return 'Last name is required';
        } elseif (!preg_match('/^[a-zA-Z]/', $lastName)) {
            return 'Last name should not start with a number';
        } elseif (strlen($lastName) > self::$lastNameMaxLength) {
            return 'Last name should not exceed ' . self::$lastNameMaxLength . ' characters';
        }
        return null; 
    }

    public static function validateUsername($username) {
        if (empty($username)) {
            return 'Username is required';
        }

        if (strlen($username) < self::$usernameMinLength) {
            return 'Username must be at least ' . self::$usernameMinLength . ' characters';
        }

        $database = new Database();
        $database->connectToMySQL("localhost", "root", "");
        $database->selectDatabase("php_game");
        $execute = "SELECT p.username FROM player p WHERE p.username = '$username';";
        $result = $database->executeQuery($execute);

        if ($result !== false && $result->num_rows > 0) {
            return 'Username already exists';
        }

        $database->closeMySQL();

        return null; 
    }

    public static function validatePassword($password) {
        if (empty($password)) {
            return 'Password is required';
        } elseif (strlen($password) < self::$passwordMinLength) {
            return 'Password must be at least ' . self::$passwordMinLength . ' characters';
        }
        return null; 
    }

    public static function validateConfirmPassword($password, $confirmPassword) {
        if (empty($confirmPassword)) {
            return 'Confirm password is required';
        } elseif ($password !== $confirmPassword) {
            return 'Passwords do not match';
        }
        return null; 
    }
}