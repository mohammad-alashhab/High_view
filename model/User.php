<?php

require_once 'Model.php';

class User extends Model {

    private $user;

    public function __construct() {
        parent::__construct('users');
    }

    public function emailExists($email) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM `users` WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0; // Returns true if email exists
    }

    public function createUserWithGoogle($firstName, $lastName, $email, $googleId) {
        $stmt = $this->pdo->prepare("INSERT INTO users (first_name, last_name, email, google_id, password, is_verified, last_login) VALUES (:first_name, :last_name, :email, :google_id, :password, :is_verified, :last_login)");

        $password = password_hash(bin2hex(random_bytes(32)), PASSWORD_DEFAULT); // Generate a random password
        $isVerified = 1; // Set as verified
        $lastLogin = date('Y-m-d H:i:s');

        $stmt->bindParam(':first_name', $firstName);
        $stmt->bindParam(':last_name', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':google_id', $googleId);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':is_verified', $isVerified);
        $stmt->bindParam(':last_login', $lastLogin);

        if (!$stmt->execute()) {
            error_log('Database error: ' . implode(" ", $stmt->errorInfo())); // Log any database errors
            return false; // or handle the error as you see fit
        }
        return true; // Successfully inserted
    }

    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Return user data if exists
    }

    public function createUser($firstName, $lastName, $email, $hashedPassword, $phone) {
        $stmt = $this->pdo->prepare("INSERT INTO `users` (first_name, last_name, email, password, phone) VALUES (:first_name, :last_name, :email, :password, :phone)");
        $stmt->bindParam(':first_name', $firstName);
        $stmt->bindParam(':last_name', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':phone', $phone);

        return $stmt->execute();
    }

    public function registerUser($data) {
        header('Content-Type: application/json');

        if ($this->emailExists($data['email'])) { // Call the method directly
            echo json_encode(['success' => false, 'message' => 'Email already registered']);
            exit();
        }

        if ($this->phoneExists($data['phone'])) {
            echo json_encode(['success' => false, 'message' => 'Phone number already registered']);
            exit();
        }

        if ($this->createUser($data['first_name'], $data['last_name'], $data['email'], $data['password'], $data['phone'])) {
            echo json_encode(['success' => true, 'redirect' => '/login']);
            exit();
        }

        echo json_encode(['success' => false, 'message' => 'Registration failed']);
        exit();
    }

    public function registerGoogleUser($userData) {
        $stmt = $this->pdo->prepare("
            INSERT INTO {$this->table} 
            (email, first_name, last_name, password, google_id, is_google_user) 
            VALUES 
            (:email, :first_name, :last_name, :password, :google_id, 1)
        ");

        return $stmt->execute([
            'email' => $userData['email'],
            'first_name' => $userData['first_name'],
            'last_name' => $userData['last_name'],
            'password' => $userData['password'],
            'google_id' => $userData['google_id'],
        ]);
    }

    public function getUserByGoogleId($googleId) {
        $stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE google_id = :google_id LIMIT 1");
        $stmt->bindParam(':google_id', $googleId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function savePasswordResetToken($email, $token) {
        $stmt = $this->pdo->prepare("UPDATE `users` SET reset_token = :token, token_expiration = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = :email");
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    public function isTokenValid($token) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM `users` WHERE reset_token = :token AND token_expiration > NOW()");
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        return $stmt->fetchColumn() > 0; // Returns true if token is valid
    }

    public function resetPasswordByToken($token, $newPassword) {
        $stmt = $this->pdo->prepare("SELECT email FROM `users` WHERE reset_token = :token");
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        $email = $stmt->fetchColumn();

        if ($email) {
            return $this->resetPassword($email, $newPassword);
        }
        return false; // Return false if email not found
    }

    public function phoneExists($phone) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM `users` WHERE phone = :phone");
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();
        return $stmt->fetchColumn() > 0; // Returns true if phone exists
    }

    public function updatePassword($email, $newPassword) {
        if (strlen($newPassword) < 8) {
            return false;
        }

        $query = "UPDATE `users` SET password = :password WHERE email = :email";
        $stmt = $this->pdo->prepare($query);
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':email', $email);

        return $stmt->execute();
    }

    public function resetPassword($email, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("UPDATE `users` SET password = :password, reset_token = NULL, token_expiration = NULL WHERE email = :email");
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }
}
