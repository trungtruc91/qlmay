<?php

class File
{
    static function getData($filename = 'data.txt')
    {
        return json_decode(json_encode(self::readFile()), true);
    }

    //ghi file
    static function writeFile($value = null)
    {
        $fp = fopen('data.txt', 'w');
        fwrite($fp, json_encode($value));
        fclose($fp);
    }

    //doc file
    static function readFile($filename = 'data.txt')
    {
        $fn = fopen($filename, "r");
        $result = fgets($fn);
        fclose($fn);
        return json_decode($result);
    }
}