<?php
function encrypt_decrypt($action, $string)
{
    if (!function_exists("openssl_encrypt")) {
        die("openssl function openssl_encrypt does not exist");
    }
    if (!function_exists("hash")) {
        die("function hash does not exist");
    }
    global $encryption_key;
    $output = false;
    $encrypt_method = "AES-256-CBC";
    //echo "$encryption_key\n";
    $secret_iv = '1a49b0e95460a821';
    // hash
    $key = hash('sha256', $encryption_key);
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else {
        if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
    }
    return $output;
}
?>
