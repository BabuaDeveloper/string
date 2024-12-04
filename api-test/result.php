<?php
header('Content-Type: application/json');
if(isset($_POST["submit"]) && isset($_POST['method']) && $_POST['method']!='' && $_POST["token"]!=''){
    $method = $_POST['method'];
    $url = $_POST["search_url"];//Response URL
    $data_string = $_POST["json_text"];//Request JSON from body
    //$token = 'EAAn2rfWZBZCpABOydFBZApN4zEjqhujvBYmRviJweWwRRWmKjTuZCXnznVkp1czF3flxIdP2efYAKgArW2QhjNZBgcQpgnkurNflcZAUJsnfJCb8ckgNkDsIABZCg6K56a4mqKvLxhgZAZCseSBS5cfG8cj21B34P9TVZB7ksA6lpaZC6dEvfeyZC6eyAdtnPpfqHkjVNB1ZAUPzjBQdZAWRB1su1H2ID3xGfjCbhZCG7cXiRSXMRh1XIfVqOxZA';
    $token = $_POST["token"];
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);//Request method should be post or request
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);//Post fields should be in json format
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $token,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_TIMEOUT, 400);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 400);
    $result = curl_exec($ch);
    curl_close($ch);
    
    echo json_encode(json_decode($result), JSON_PRETTY_PRINT);
    //echo $url;
}else{
    echo 'Please Enter Authenication token';
}
?>