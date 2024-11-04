<?php



$client = new Google\Client;

$client->setClientId("1006063154544-9rhbc2igqm7jjhnge5abt0nmrlnoreu1.apps.googleusercontent.com");
$client->setClientSecret("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");
$client->setRedirectUri("http://localhost:8888/profile");

if ( ! isset($_GET["code"])) {

    exit("Login failed");

}

$token = $client->fetchAccessTokenWithAuthCode($_GET["code"]);

$client->setAccessToken($token["access_token"]);

$oauth = new Google\Service\Oauth2($client);

$userinfo = $oauth->userinfo->get();

var_dump(
    $userinfo->email,
    $userinfo->familyName,
    $userinfo->givenName,
    $userinfo->name
);