<?php

/**
 * This class shows how to call Fidelizador API functions using curl.
 *
 * PHP version 5.6
 *
 * @author Daniel Muñoz <dmunoz@fidelizador.com>
 * @copyright  Fidelizador 2020
 *
 */ 


namespace Fidelizador\Contact;

class ContactManager {

    const URL_UPDATE_CONTACT = "https://api.fidelizador.com/1.1/contact/{uniquecode}.json";

     /**
     * Update contact information
     *
     * @param slug Instance slug
     * @param access_token Access token obtained through Oauth2
     * 
     * @method POST
     * @return Associative array with response. Return contact information
     */ 
    public function updateContact($slug, $access_token, $uniquecode, $fields) {
        $header = array("Authorization: Bearer {$access_token}", "X-Client-Slug: {$slug}");
        $url = str_replace("{uniquecode}", $uniquecode, ContactManager::URL_UPDATE_CONTACT);

        $content = http_build_query($fields);

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_HTTPHEADER => $header,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $content,
        CURLOPT_RETURNTRANSFER => true
        ));
        $response = curl_exec($curl);

        if($response === FALSE) {
            die(curl_error($curl));
        }

        curl_close($curl);
        return json_decode($response, true);
  }

}