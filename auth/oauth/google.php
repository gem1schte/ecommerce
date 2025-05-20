<?php
/* Google OAuth 2.0 PHP Documentation:
https://github.com/MusabDev/php-google-login */

require_once __DIR__ . '/../../core/config.php';
require __DIR__ . "/../../vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../', '.env');
$dotenv->load();

// init configuration
$clientID = $_ENV['GOOGLE_CLIENT_ID'];
$clientSecret = $_ENV['GOOGLE_CLIENT_SECRET'];
$redirectUrl = $_ENV['GOOGLE_REDIRECT_URL'];

// create Client Request to access Google API
$client = new Google\Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUrl);
$client->addScope("email");
$client->addScope("profile");

// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token);

  // get profile info
  $google_oauth = new Google\Service\Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email;
  $name =  $google_account_info->name;
  $picture = $google_account_info->picture;

  // now you can use this profile info to create account in your website and make user logged in.
  // echo "<img src='" . $picture . "' >Welcome Name:" . $name . " , You are registered using email: " . $email;
  header("Location:" . WEBSITE_URL . "index.php");
} else {
  echo "<a href='" . $client->createAuthUrl() . "'>Google Login</a>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Google</title>
</head>

<body>

</body>

</html>