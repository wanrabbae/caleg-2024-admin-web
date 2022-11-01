<?php
namespace App\Helpers;

class Helper {
    public static function RequestCheck($data) {
        if (is_array($data)) {
            foreach ($data as $request) {
                if (preg_match_all("/[^\w\d@\s]/i", $request)) return true;;
            }
        } else {
            return preg_match_all("/[^\w\d@\s]/i", $data) ? true : false;
        }
    }
}