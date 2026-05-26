<?php

class passChangeValidator
{
    private $data;
    private $errors = [];
    private static $fields = ['oldpassword', 'newpassword'];

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
        $this->validateOldPassword();
        $this->validateNewPassword();
        $this->passwordMatcher();
        if (empty($this->errors)) {
            $this->passChanger();
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

        if (!password_verify($this->data['oldpassword'], $match['password'])) {
            $this->errorList('oldpassword', 'incorrect password');
        }
        }


    private function passChanger(){
        $host = 'localhost';
        $user = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASS'];
        $dbname = $_ENV['USER_TABLE'];

        $dsn = "mysql:host=$host;dbname=$dbname";

        $pdo = new PDO($dsn, $user, $password);

        $session = $_SESSION;

        $sql = 'UPDATE MEMBERS SET password = :newpassword WHERE username = :username';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':username' => $session['username'], ':newpassword' => password_hash($this->data['newpassword'], PASSWORD_DEFAULT)]);

    }

    private function validateOldPassword() {
        $value = trim($this->data['oldpassword']);

        if(empty($value)) {
            $this->errorList('oldpassword', 'password is required');
        } else {
            if(!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $value)) {
                $this->errorList('oldpassword', 'incorrect password.');
            }
        }
    }

    private function validateNewPassword() {
        $value = trim($this->data['newpassword']);

        if(empty($value)) {
            $this->errorList('newpassword', 'password is required');
        } else {
            if(!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $value)) {
                $this->errorList('newpassword', 'password must consist of at least one letter, one number, and be above 8 characters, and contain no special characters.');
            }
        }
    }

    private function errorList($key, $value) {
        $this->errors[$key] = $value;
    }
}

