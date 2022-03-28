<?php

namespace App\Helpers;

class PhoneSanitizer {
    public static function sanitize(string $phoneNumber) {
        switch($phoneNumber) {
            case strlen($phoneNumber) === 9:
             return '+254'.$phoneNumber;
             case strlen($phoneNumber) === 10:
                 return '+254'.substr($phoneNumber, 1);
             case  strlen($phoneNumber) === 12: 
                return '+'.$phoneNumber;
             default:
              return $phoneNumber;
         }
    }
}