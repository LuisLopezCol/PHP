<?php

class API_Request{
    public function loginAPI($loginURL) {
        $apiLogin = curl_init($loginURL); 
        $_AUTHDATA = array("email" => "webpage@union-andina.net", "password" => "algarrobo", "fingerprint" => "string", "os" => "string", "platform" => "string"); //Llave para el login
        $_AUTHDATA_STRING = json_encode($_AUTHDATA);
        curl_setopt_array($apiLogin, array(
            CURLOPT_URL => $loginURL,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $_AUTHDATA_STRING,
            CURLOPT_HTTPHEADER => array("Content-Type: application/json"),
            CURLOPT_RETURNTRANSFER => true,
        ));
        $response = json_decode(curl_exec($apiLogin), true);
        # Valida la conexión y retorna
        curl_close($apiLogin); 
        if ($response["success"] == false) {
            echo "error, revisar el link de la API, datos de autenticacion, o comunicarse con IT";
            return;
        }else{
            return $response["data"]["token"]["token"];
        }
    }

    public function contentAPI($limitPerPage, $token) {
        $apiFetchURL = 'https://api.union-andina.net/v1/admin/project?limit='.$limitPerPage.'&page=1&filters={"country":"Colombia"}&populate=[%22builder%22,%20%22sector%22,%20%22propertyType%22]&sort={%22name%22:%22asc%22}';
        $apiFetch = curl_init($apiFetchURL); 
        $authorization = "Authorization: Token $token";
        curl_setopt_array($apiFetch, array(
            CURLOPT_URL => $apiFetchURL,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => array("Content-Type: application/json", $authorization),
            CURLOPT_RETURNTRANSFER => true,
        ));
        $response = json_decode(curl_exec($apiFetch), true);
        # Valida la conexión y retorna
        curl_close($apiFetch); 
        if ($response["success"] == false) {
            echo "error, comunicarse con IT";
            return;
        }else{
            $contentAPI = [$response['data']['totalDocs'], $response['data']['totalPages']];
            return $contentAPI;
        }
    
    }

    public function fetchAPI($limitPerPage, $page, $token) {
        $apiFetchURL = 'https://api.union-andina.net/v1/admin/project?limit='.$limitPerPage.'&page='.$page.'&filters={"country":"Colombia"}&populate=[%22builder%22,%20%22sector%22,%20%22propertyType%22]&sort={%22name%22:%22asc%22}';
        $apiFetch = curl_init($apiFetchURL); 
        $authorization = "Authorization: Token $token";
        curl_setopt_array($apiFetch, array(
            CURLOPT_URL => $apiFetchURL,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => array("Content-Type: application/json", $authorization),
            CURLOPT_RETURNTRANSFER => true,
        ));
        $response = json_decode(curl_exec($apiFetch), true);
        curl_close($apiFetch); 
        if ($response["success"] == false) {
            #Test
            echo "error, comunicarse con IT";
            return;
        }else{
            return $response['data']['docs'];
        }
    }
}
