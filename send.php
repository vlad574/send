<?php
    $text = isset($_POST['text']) ? $_POST['text'] : "";
    $key = isset($_POST['key']) ? $_POST['key'] : "";
    if($text!='' && $key!=''){
        $url = 'https://beatles.monobank.com.ua/api-ext-services/api/partners/penalty/planet/avto/vehicle';
        $request_string = $text;
        $signature = base64_encode(hash_hmac("sha256", $request_string, $key, true));
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'partnerId: planet-auto-partner',
            'signature: '.$signature,
            'Content-Type: application/json',
            'Accept: application/json'
        ));
        $server_output = curl_exec($ch);
        echo json_encode(array("send"=>$server_output));
        curl_close ($ch);
        exit();
    }else{
        echo json_encode(array("send"=>'false'));
        exit();
    }
?>
