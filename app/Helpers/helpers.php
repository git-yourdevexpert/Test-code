<?php

if (!function_exists('setting')) {

    function setting($key)
    {
        $value = \App\Models\Setting::get($key);

        return $value;
    }
}
if (!function_exists('encryptText')) {
    function encryptText($text)
    {
        return @mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $encryptionkey, $text, MCRYPT_MODE_ECB);
    }
}
if (!function_exists('decryptText')) {
    function decryptText($crypt)
    {
        $decrypt = @mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $encryptionkey, $crypt, MCRYPT_MODE_ECB);
        preg_match('/[a-z\d \-]+/i', $decrypt, $catch);
        return $catch[0];
    }
}
