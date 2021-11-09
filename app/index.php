<?php
function preco($corrente,$destino){
    $curl = curl_init();
    curl_setopt_array($curl, [
    CURLOPT_URL => "https://economia.awesomeapi.com.br/last/$corrente-$destino",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_POSTFIELDS => "",
    ]);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
    echo "cURL Error #:" . $err;
    } else {
    return json_decode($response, true);
    }
}


function exchange($val,$corrente,$destino){
    $preco =  preco($corrente,$destino);
    $multiplicando =  $preco[$corrente.$destino]['bid'];
    return $val * $multiplicando;
}

echo "  BRL 100 > USD >" . number_format(exchange(100,'BRL','USD'),2,',', '.') . '.<br/>';
echo " ARS 100 > BRL >"  . number_format(exchange(100,'ARS','BRL'),2,',', '.') . '.<br/>';
echo "USD 100 > USD >"   . number_format(exchange(100,'USD','BRL'),2,',', '.') . '.<br/>';