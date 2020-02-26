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


namespace Fidelizador\ContactList;

class ListManager {

    const URL_CREATE_LIST = "https://api.fidelizador.com/1.0/list.json";
    const URL_GET_LIST = "https://api.fidelizador.com/1.0/list.json";
    const URL_IMPORT_CONTACT = "https://api.fidelizador.com/1.0/list/{list_id}/import.json";


    /**
     * Create a List in Fidelizador Platform
     *
     * @param slug Instance slug
     * @param access_token Access token obtained through Oauth2
     * @param name The list name
     * 
     * @method POST
     * @return Associative array with response data
     */ 
    public function createList($slug, $access_token, $name) {
        $header = array("Authorization: Bearer {$access_token}", "X-Client-Slug: {$slug}");
        $fields = array(
                'name' => "{$name}",
                'fields' => array(
                             "EMAIL",
                             "FIRSTNAME"
                            )
                );

        $content = http_build_query($fields);

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => ListManager::URL_CREATE_LIST,
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


    /**
     * Create a List in Fidelizador Platform
     *
     * @param slug Instance slug
     * @param access_token Access token obtained through Oauth2
     * 
     * @method GET
     * @return Associative array with lists
     */ 
    public function getLists($slug, $access_token) {
        $header = array("Authorization: Bearer {$access_token}", "X-Client-Slug: {$slug}");

        $curl = curl_init();
          curl_setopt_array($curl, array(
            CURLOPT_URL => ListManager::URL_GET_LIST,
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true
        ));
        $response = curl_exec($curl);
          
        if($response === FALSE) {
            die(curl_error($curl));
        }
          
        curl_close($curl);
        return json_decode($response, true);
    }


    /**
     * Import contacts to a list using a csv file
     *
     * @param slug Instance slug
     * @param access_token Access token obtained through Oauth2
     * 
     * @method GET
     * @return Associative array with response
     */ 
    public function createImport($slug, $access_token, $list_id) {
        $header = array("Authorization: Bearer {$access_token}", "X-Client-Slug: {$slug}");
        $url = str_replace("{list_id}", $list_id, ListManager::URL_IMPORT_CONTACT);

        $csvpath = '../data/list1.csv';
        $data = array(
                'file' => curl_file_create($csvpath, "text/csv"),
                'fields[EMAIL]' => 1,
                'fields[FIRSTNAME]' => 2,
              );

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_HTTPHEADER => $header,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data,
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