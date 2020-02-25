<?php
namespace Fidelizador\Oauth2;

class Credentials {
    const URL_TOKEN = "https://login.fidelizador.com/oauth/v2/token";
    private $clientId = null;
    private $secret = null;
    private $slug = null;


    public function setClientId($clientId) {
        $this->clientId = $clientId;
    } 

    public function setSecret($secret) {
        $this->secret = $secret;
    }

    public function setSlug($slug) {
        $this->slug = $slug;
    }

    public function getAccessToken() {
        $content = "grant_type=client_credentials";
        $authorization = base64_encode("{$this->clientId}:{$this->secret}");
        $header = array("Authorization: Basic {$authorization}","Content-Type: application/x-www-form-urlencoded");

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => Credentials::URL_TOKEN,
        CURLOPT_HTTPHEADER => $header,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $content
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response)->access_token;
    }
}


?>