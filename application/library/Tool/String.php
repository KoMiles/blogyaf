<?php
class Tool_String {
    public static function getRandom($length = 4, $type = 1) {
        switch ($type) {
        case 1:
            $string = '1234567890';
            break;

        case 2:
            $string = 'abcdefghijklmnopqrstuvwxyz';
            break;

        case 3:
            $string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;

        case 4:
            $string = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;

        case 5:
            $string = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;
        }
        $output = '';
        for ($i = 0; $i < $length; $i++) {
            $pos = mt_rand(0, strlen($string) - 1); 
            $output .= $string[$pos];
        }
        return $output;
    }
}
