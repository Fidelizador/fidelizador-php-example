<?php

// Autoload files using the Composer autoloader.
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config.php';

use Fidelizador\Oauth2\Credentials;
use Fidelizador\Contact\ContactManager;

$credentials = new Credentials();
$credentials->setClientId(CLIENTID);
$credentials->setSecret(SECRET);
$credentials->setSlug(SLUG);

$access_token = $credentials->getAccessToken();

$manager = new ContactManager();

//update contact information

$fields = array(    
    'fields[FIRST_NAME]' => 'CHAVO DEL 8',
    'fields[CELLPHONE]' => '+56111111111',
);

$response = $manager->updateContact(SLUG, $access_token, "userdemo2@gmail.com", $fields);
print_r($response);

?>