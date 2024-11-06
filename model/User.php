<?php

require_once 'Model.php';

class User extends Model
{
    public function __construct()
    {
        parent::__construct('users');
    }

    // Save reset token and expiry for the user
    public function savePasswordResetToken($email, $token)
    {
        $stmt = $this->pdo->prepare("
            UPDATE users 
            SET reset_token = :token, 
                token_expiry = DATE_ADD(NOW(), INTERVAL 1 HOUR) 
            WHERE email = :email
        ");
        return $stmt->execute([
            'token' => $token,
            'email' => $email
        ]);
    }

    // Check if the reset token is valid
    public function isTokenValid($token)
    {
        $stmt = $this->pdo->prepare("
            SELECT COUNT(*) 
            FROM users 
            WHERE reset_token = :token 
            AND token_expiry > NOW()
        ");
        $stmt->execute(['token' => $token]);
        return $stmt->fetchColumn() > 0;
    }

    // Reset the password using the reset token
    public function resetPasswordByToken($token, $newPassword)
    {
        $stmt = $this->pdo->prepare("
            UPDATE users 
            SET password = :password,
                reset_token = NULL,
                token_expiry = NULL 
            WHERE reset_token = :token 
            AND token_expiry > NOW()
        ");
        
        return $stmt->execute([
            'password' => password_hash($newPassword, PASSWORD_DEFAULT),
            'token' => $token
        ]);
    }

    // Check if an email exists in the database
    public function emailExists($email)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM `users` WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Retrieve user by email
    public function getUserByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Register a new user
    public function createUser($firstName, $lastName, $email, $hashedPassword, $phone)
    {
        $stmt = $this->pdo->prepare("INSERT INTO `users` (first_name, last_name, email, password, phone) VALUES (:first_name, :last_name, :email, :password, :phone)");
        $stmt->bindParam(':first_name', $firstName);
        $stmt->bindParam(':last_name', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':phone', $phone);

        return $stmt->execute();
    }

    // Check if a phone number exists in the database
    public function phoneExists($phone)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM `users` WHERE phone = :phone");
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Update a user's password directly by email
    public function updatePassword($email, $newPassword)
    {
        if (strlen($newPassword) < 8) {
            return false; // Enforce minimum password length
        }

        $query = "UPDATE `users` SET password = :password WHERE email = :email";
        $stmt = $this->pdo->prepare($query);
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':email', $email);

        return $stmt->execute();
    }

    // Reset the password by email and clear reset token and expiry
    public function resetPassword($email, $newPassword)
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("UPDATE `users` SET password = :password, reset_token = NULL, token_expiry = NULL WHERE email = :email");
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    // Register a new user and handle response messages
    public function registerUser($data)
    {
        header('Content-Type: application/json');

        if ($this->emailExists($data['email'])) {
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
}
