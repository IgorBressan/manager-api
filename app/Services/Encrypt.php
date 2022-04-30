<?php

namespace App\Services;

class Encrypt {

    public static function encrypt($payload)
    {
 
         $encrypt_method = "AES-256-CBC";
 
         $secret_key = getEnv('SECRET_FRONT');
     
         $key = hash('sha256', $secret_key);
     
         $iv = substr(hash('sha256', $secret_key), 0, 16);
 
         $output = openssl_encrypt($payload, $encrypt_method, $key, 0, $iv);
 
         $output = base64_encode($output);
 
         return $output;
    }
 
    public static function decrypt($payload)
    {
         $encrypt_method = "AES-256-CBC";
 
         $secret_key = getEnv('SECRET_FRONT');
 
         $key = hash('sha256', $secret_key);
 
         $iv = substr(hash('sha256', $secret_key), 0, 16);
 
         $output = openssl_decrypt(base64_decode($payload), $encrypt_method, $key, 0, $iv);
 
         return $output;
    }

}