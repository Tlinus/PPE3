<?php
/**
 * Description of Crypter
 *
 * @author pascal
 
 */

class Crypter
{
    private static $cipher  = MCRYPT_RIJNDAEL_256;          // Algorithme utilisé pour le cryptage des blocs
    private static $key     = 'OnJhGHHJgVgdyeFZdhjKjLkBhgGdtIuLbnVgezCBToghDerHGhqdjhqskjdhGJHGJHGdsqjdhqkjGUYGAZIEHbkd';    // Clé de cryptage
    private static $mode    = 'cbc';                        // Mode opératoire (traitement des blocs)
 
    public function Encode($data){
        $keyHash = md5(self::$key);
        $key = substr($keyHash, 0,   mcrypt_get_key_size(self::$cipher, self::$mode) );
        $iv  = substr($keyHash, 0, mcrypt_get_block_size(self::$cipher, self::$mode) );
 
        $data = mcrypt_encrypt(self::$cipher, $key, $data, self::$mode, $iv);
        return base64_encode($data);
    }
 
    public function Decode($data){
        $keyHash = md5(self::$key);
        $key = substr($keyHash, 0,   mcrypt_get_key_size(self::$cipher, self::$mode) );
        $iv  = substr($keyHash, 0, mcrypt_get_block_size(self::$cipher, self::$mode) );
 
        $data = base64_decode($data);
        $data = mcrypt_decrypt(self::$cipher, $key, $data, self::$mode, $iv);
        return rtrim($data);
    }
}


