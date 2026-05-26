<?php

class validator {
    private $data;
    private $errors = [];
    private static $fields = ['username', 'password', 'confirmPassword'];

    public function __construct($post_data) {
        $this->data = $post_data;
    }

    public function validateForm() {
        foreach(self::$fields as $field) {
            if (!array_key_exists($field, $this->data)) {
                trigger_error("{$field} is not present", E_USER_WARNING);
                return;
            }
        }
        $this->usernameMatcher();
        $this->validateUsername();
        $this->validatePassword();
        $this->passwordMatcher();
        return $this->errors;
    }

    private function validateUsername() {
        $value = trim($this->data['username']);

        if(empty($value)) {
            $this->errorList('username', 'username is required');
        } else {
            if(!preg_match('/^[a-zA-Z0-9]{6,12}$/', $value)) {
                $this->errorList('username', 'username must consist of 6-12 alphanumeric characters, with no special characters.');
            }
        }
    }

    private function validatePassword() {
        $value = trim($this->data['password']);

        if(empty($value)) {
            $this->errorList('password', 'password is required');
        } else {
            if(!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $value)) {
                $this->errorList('password', 'password must consist of at least one letter, one number, and be above 8 characters, and contain no special characters.');
            }
        }
    }

    private function passwordMatcher() {
        $pass = $this->data['password'];
        $cpass = $this->data['confirmPassword'];

        if ($pass !== $cpass) {
            $this->errorList('confirmPassword', 'password does not match.');
        }
    }

    private function usernameMatcher() {
        $host = 'localhost';
        $user = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASS'];
        $dbname = $_ENV['USER_TABLE'];

        $dsn = "mysql:host=$host;dbname=$dbname";

        $pdo = new PDO($dsn, $user, $password);

        $username = $this->data['username'];
        $sql = 'SELECT * FROM MEMBERS WHERE username = :username';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':username' => $username]);
        $matches = $stmt->fetchAll();

        foreach($matches as $match) {
            if($match[':username' == $username]) {
                $this->errorList('username', 'username already exists.');
            }
        }


    }

    private function errorList($key, $value) {
        $this->errors[$key] = $value;
    }
}

?>