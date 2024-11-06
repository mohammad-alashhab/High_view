<?php
require_once 'vendor/autoload.php'; // Ensure this path is correct

class GoogleController {
    private $client;

    public function __construct() {
        $this->client = new Google\Client;
        $this->client->setClientId("1006063154544-9rhbc2igqm7jjhnge5abt0nmrlnoreu1.apps.googleusercontent.com");
        $this->client->setClientSecret("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");
        $this->client->setRedirectUri("http://localhost:8888/google/auth");
        $this->client->addScope("email");
        $this->client->addScope("profile");
    }

    public function login() {
        $url = $this->client->createAuthUrl();
        header("Location: $url");
        exit();
    }

    public function auth() {
        if (isset($_GET['code'])) {
            try {
                $token = $this->client->fetchAccessTokenWithAuthCode($_GET['code']);
                if (array_key_exists('error', $token)) {
                    throw new Exception($token['error']);
                }
    
                $_SESSION['access_token'] = $token['access_token'];
                $this->client->setAccessToken($token['access_token']);
                $google_service = new Google\Service\OAuth2($this->client);
                $user_info = $google_service->userinfo->get();
    
                $this->saveUserData($user_info);
                // Redirect the user to the desired page after login
                header("Location: /login");
                exit();
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        } else {
            echo "No code parameter found.";
        }
    }
    
    private function saveUserData($user_info) {
        $db = new PDO('mysql:host=localhost;dbname=e_commerce', 'root', ''); // Update with your DB credentials

        $stmt = $db->prepare("INSERT INTO users (first_name, last_name, email, img) VALUES (?, ?, ?, ?)
                               ON DUPLICATE KEY UPDATE img = ?");
        $stmt->execute([
            $user_info->given_name,
            $user_info->family_name,
            $user_info->email,
            $user_info->picture,
        ]);
    }
}
