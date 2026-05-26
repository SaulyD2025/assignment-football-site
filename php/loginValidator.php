<?php

class loginValidator
{
    private $data;
    private $errors = [];
    private static $fields = ['username', 'password'];

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
        $this->validateUsername();
        $this->validatePassword();
        if(empty($this->errors)) {
            $this->usernameMatcher();
            $this->passwordMatcher();
        }
        return $this->errors;
    }

    private function usernameMatcher()
    {
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
        $match = $stmt->fetch();

            if (empty($match)) {
                $this->errorList('username', 'username does not exist');
            }
    }

        private function passwordMatcher()
        {
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
            $match = $stmt->fetch();


            if (!password_verify($this->data['password'], $match['password'])) {
                $this->errorList('password', 'incorrect password');
            }
            }


        private function validatePassword() {
            $value = trim($this->data['password']);

            if(empty($value)) {
                $this->errorList('password', 'password is required');
            } else {
                if(!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $value)) {
                    $this->errorList('password', 'incorrect password');
                }
            }
        }

        private function validateUsername() {
            $value = trim($this->data['username']);

            if(empty($value)) {
                $this->errorList('username', 'username is required');
            } else {
                if(!preg_match('/^[a-zA-Z0-9]{6,12}$/', $value)) {
                    $this->errorList('username', 'username does not exist');
                }
            }
        }

    private function errorList($key, $value) {
        $this->errors[$key] = $value;
    }
}

