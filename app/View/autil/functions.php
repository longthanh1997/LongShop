<?php

$REDIRECT_URL= "https://www.disney.es";

$FILENAME_DATABASE="blocked_countries.txt";

/* ----------- DO NOT MODIFY UNDER THIS LINE ------------- */


function check_block_country(){
             $data = file_get_contents("http://ip-api.com/json/".get_user_ip_addr()."?fields=country,countryCode,proxy");
            // $data = file_get_contents("http://ip-api.com/json/82.180.147.232?fields=country,countryCode,proxy");
             $obj = json_decode($data, true);
             if($obj[proxy] == 1) return false; 
             return   true; 
}

function get_user_ip_addr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

?>