<?php


function do_wa($url, $token, $payload){

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_HTTPHEADER,
    array(
        "Authorization: $token",
    )
);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_ENCODING, false);
    curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
    curl_setopt($curl, CURLOPT_TIMEOUT, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION,true);
    curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    
    if ($payload !== null) {
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($payload));
    }
        
    $result = curl_exec($curl);
    curl_close($curl);
    
    $response = json_decode($result);
    return $response;

}

function caridb($payload)
    {
        $text = $payload;
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "http://www.omdbapi.com/?apikey=d3b2de23&i=".$text,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Cookie: __cfduid=dc206fb3c52ee50387f6bc7a941e14ff81604875924"
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $result = json_decode($response, true);
        return $result;

    }