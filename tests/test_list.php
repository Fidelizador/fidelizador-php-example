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

//create a list
$response = $manager->createList(SLUG, $access_token, "Lista de prueba");

$newList = $response["list_id"];
//print_r($response);

//get lists

$response = $manager->getLists(SLUG, $access_token);
//print_r($response);

//import contacts into list
$response = $manager->createImport(SLUG, $access_token, $newList);
print_r($response);

?>

