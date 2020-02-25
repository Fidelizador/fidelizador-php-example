<?php
namespace Fidelizador\ContactList;

class ListManager {
    const URL_CREATE_LIST = "https://api.fidelizador.com/1.0/list.json";

    function createList($slug, $access_token, $name) {
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

}