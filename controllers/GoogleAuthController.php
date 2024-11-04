<?php

require_once 'models/User.php';
require_once 'vendor/autoload.php';

use Google\Client as Google_Client; // Ensure you're using the right namespace
use Google\Service\Oauth2 as Google_Service_Oauth2;

class GoogleAuthController {
    private $userModel;
    private $client;

    public function __construct() {
        $this->userModel = new User();
        
        // Initialize Google Client
        $this->client = new Google_Client();

        // Set Client ID, Client Secret, and Redirect URI
        $this->client->setClientId("1006063154544-9rhbc2igqm7jjhnge5abt0nmrlnoreu1.apps.googleusercontent.com");
        $this->client->setClientSecret("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");
        $this->client->setRedirectUri("http://localhost:8888/profile"); // Ensure this matches the registered URI

        // Set required scopes
        $this->client->addScope('email');
        $this->client->addScope('profile');
    }

    public function initiateGoogleLogin() {
        // Generate the authentication URL and redirect the user
        $authUrl = $this->client->createAuthUrl();
        header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
        exit();
    }

    public function handleGoogleCallback() {
        try {
            if (!isset($_GET['code'])) {
                throw new Exception('Authorization code not found.');
            }
    
            $token = $this->client->fetchAccessTokenWithAuthCode($_GET['code']);
            
            if (isset($token['error'])) {
                throw new Exception('Error fetching access token: ' . $token['error_description']);
            }
    
            $this->client->setAccessToken($token['access_token']);
    
            $google_oauth = new Google_Service_Oauth2($this->client);
            $google_account_info = $google_oauth->userinfo->get();
    
            $userData = [
                'email' => filter_var($google_account_info->email, FILTER_SANITIZE_EMAIL),
                'first_name' => filter_var($google_account_info->givenName, FILTER_SANITIZE_STRING),
                'last_name' => filter_var($google_account_info->familyName, FILTER_SANITIZE_STRING),
                'google_id' => filter_var($google_account_info->id, FILTER_SANITIZE_STRING),
                'profile_picture' => filter_var($google_account_info->picture, FILTER_SANITIZE_URL),
                'password' => password_hash(bin2hex(random_bytes(32)), PASSWORD_DEFAULT),
            ];
    
            // Check if user exists
            if (!$this->userModel->emailExists($userData['email'])) {
                // Register new user
                if (!$this->userModel->createUserWithGoogle($userData['first_name'], $userData['last_name'], $userData['email'], $userData['google_id'])) {
                    error_log('Failed to create user in database');
                }
            }
    
            // Get user from database
            $user = $this->userModel->getUserByEmail($userData['email']);
            
            session_start();
            $_SESSION['user'] = $user;
    
            header('Location: /profile');
            exit();
    
        } catch (Exception $e) {
            error_log('Google Auth Error: ' . $e->getMessage());
            header('Location: /login?error=google_auth_failed');
            exit();
        }
    }
    
}
