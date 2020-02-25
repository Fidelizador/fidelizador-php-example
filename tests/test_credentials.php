<?php

// Autoload files using the Composer autoloader.
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config.php';

use Fidelizador\Oauth2\Credentials;

$credentials = new Credentials();
$credentials->setClientId(CLIENTID);
$credentials->setSecret(SECRET);
$credentials->setSlug(SLUG);

$access_token = $credentials->getAccessToken();

echo $access_token;