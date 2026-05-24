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
        $this->usernameMatcher();
        $this->passwordMatcher();
        $this->validateUsername();
        $this->validatePassword();
        return $this->errors;
    }

    private function usernameMatcher()
    {
        $host = 'localhost';
        $user = 'xsqcijsd';
        $password = 'w!Tje4P44Hor6Xce(y';
        $dbname = 'xsqcijsd_users';

        $dsn = "mysql:host=$host;dbname=$dbname";

        $pdo = new PDO($dsn, $user, $password);

        $username = $this->data['username'];
        $sql = 'SELECT * FROM MEMBERS WHERE username = :username';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':username' => $username]);
        $matches = $stmt->fetchAll();

        foreach ($matches as $match) {
            if ($match['username'] !== $username) {
                $this->errorList('username', 'username does not exist');
            }
        }
    }

        private function passwordMatcher()
        {
            $host = 'localhost';
            $user = 'xsqcijsd';
            $password = 'w!Tje4P44Hor6Xce(y';
            $dbname = 'xsqcijsd_users';

            $dsn = "mysql:host=$host;dbname=$dbname";

            $pdo = new PDO($dsn, $user, $password);

            $password = password_hash($this->data['password'], PASSWORD_DEFAULT);
            $sql = 'SELECT * FROM MEMBERS WHERE password = :password';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':password' => $password]);
            $matches = $stmt->fetchAll();

            foreach ($matches as $match) {
                if ($match[':password' !== $password]) {
                    $this->errorList('password', 'incorrect password');
                }
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

