<?php

class userChangeValidator
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
        $this->usernameMatcher();
        $this->passwordMatcher();
        if(empty($this->errors)) {
            $this->userChanger();
        }
        return $this->errors;
    }

    private function passwordMatcher()
    {
        $host = 'localhost';
        $user = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASS'];
        $dbname = $_ENV['USER_TABLE'];

        $dsn = "mysql:host=$host;dbname=$dbname";

        $pdo = new PDO($dsn, $user, $password);

        $session = $_SESSION;

        $sql = 'SELECT * FROM MEMBERS WHERE username = :username';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':username' => $session['username']]);
        $match = $stmt->fetch();

        if (!$match || !password_verify($this->data['password'], $match['password'])) {
            $this->errorList('password', 'incorrect password');
        }
    }

    private function userChanger(){
        $host = 'localhost';
        $user = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASS'];
        $dbname = $_ENV['USER_TABLE'];

        $dsn = "mysql:host=$host;dbname=$dbname";

        $pdo = new PDO($dsn, $user, $password);

        $session = $_SESSION;

        $sql = 'UPDATE MEMBERS SET username = :newusername WHERE username = :username';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':username' => $session['username'], ':newusername' => $this->data['username']]);
        $_SESSION['username'] = $this->data['username'];

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
        $matches = $stmt->fetchAll();

        foreach ($matches as $match) {
            if ($match['username'] == $username) {
                $this->errorList('username', 'username already exists.');
            }
        }
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

    private function errorList($key, $value) {
        $this->errors[$key] = $value;
    }
}

