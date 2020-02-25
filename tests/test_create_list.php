<?php

// Autoload files using the Composer autoloader.
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config.php';

use Fidelizador\Oauth2\Credentials;
use Fidelizador\ContactList\ListManager;

$credentials = new Credentials();
$credentials->setClientId(CLIENTID);
$credentials->setSecret(SECRET);
$credentials->setSlug(SLUG);

$access_token = $credentials->getAccessToken();

$manager = new ListManager();

$response = $manager->createList(SLUG, $access_token, "Lista de prueba");

print_r($response);
?>

