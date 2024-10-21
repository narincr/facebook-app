<?php

if(file_exists("../vendor/autoload.php")){
    require '../vendor/autoload.php'; // Ensure you've installed the Google Cloud PHP library
}else{
    require 'vendor/autoload.php'; // Ensure you've installed the Google Cloud PHP library
}

use Google\Cloud\SecretManager\V1\SecretManagerServiceClient;
use Google\Cloud\Core\Exception\NotFoundException;

class ApiGo {

    private function access_secret_version($projectId, $secretId, $versionId = 'latest'): ?string
    {
        // Create the Secret Manager client.
        $client = new SecretManagerServiceClient();

        // Build the resource name of the secret version.
        $name = $client->secretVersionName($projectId, $secretId, $versionId);

        try {
            // Access the secret version.
            $response = $client->accessSecretVersion($name);
            // Extract the payload as a string.
            $payload = $response->getPayload()->getData();

            return $payload;
        } catch (NotFoundException $e) {
            // Handle the case where the secret or version doesn't exist.
            echo "Error: " . $e->getMessage();
            return null;
        } finally {
            // Close the client connection.
            $client->close();
        }
    }

    private function ApiConnectRaw($ActionUrl, $FormField = array(), $ReturnTransfer = true){

        $ApiUrl = 'https://facebook-api.narin.pro/';
        $ApiKey = '283787831298sdkjasodiw83sjuy6d6hhmmaj28763123388x';

        $PostString = '';
        $PostString = json_encode($FormField);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            // CURLOPT_PORT => $this->ApiPort,
            CURLOPT_URL => $ApiUrl . $ActionUrl,
            CURLOPT_RETURNTRANSFER => $ReturnTransfer,
            CURLOPT_ENCODING => "UTF-8",
            CURLOPT_MAXREDIRS => 20,
            CURLOPT_TIMEOUT => 360,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $PostString,
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Accept-Encoding: gzip, deflate",
                "Authorization: Bearer ".$ApiKey,
                "Cache-Control: public",
                "Connection: keep-alive",
                "Content-Type: application/json",
                "cache-control: max-age"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return json_decode($response, true);
        }
    }

    function GetApi($path,$Data = array()){
        $DATA_RES = self::ApiConnectRaw($path,$Data);
        return $DATA_RES;
    }
}

