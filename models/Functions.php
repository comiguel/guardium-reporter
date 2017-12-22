<?php
namespace app\models;

use Yii;
use yii\base\Model;

class Functions extends Model
{
    public static function csv_to_array($filename='', $delimiter=',', $head = null)
    {
        if(!file_exists($filename) || !is_readable($filename)){
            return false;
        }

        if(!$head){
            $header = null;
        }else{
            $header = str_getcsv($head, $delimiter);
        }
        $data = [];
        if (($handle = fopen($filename, 'r')) !== false){
            while (($row2 = fgetcsv($handle, 0, $delimiter)) !== false)
            {
                $row = Functions::utf8_converter($row2);
                if(!$header){
                    $header = $row;
                }else{
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }
        array_walk_recursive($data, function(&$item, $key){
            $item = trim($item);
        });
        return $data;
        // return json_encode($data);
    }

    public static function utf8_converter($array)
    {
        array_walk_recursive($array, function(&$item, $key){
            if(!mb_detect_encoding($item, 'utf-8', true)){
                $item = utf8_encode($item);
            }
        });
        return $array;
    }

    public static function uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0fff ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }

    /**
     * simple method to encrypt or decrypt a plain text string
     * initialization vector(IV) has to be the same when encrypting and decrypting
     * PHP 5.4.9
     *
     * this is a beginners template for simple encryption decryption
     * before using this in production environments, please read about encryption
     *
     * @param string $action: can be 'encrypt' or 'decrypt'
     * @param string $string: string to encrypt or decrypt
     *
     * @return string
     */
    public static function encrypt_decrypt($action, $string, $secret_key = 'secret', $secret_iv = 'iv') {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        // hash
        $key = hash('sha256', $secret_key);
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        }elseif( $action == 'decrypt' ){
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }
 }

?>