<?php

//ghi file
function write_file($value)
{
    $fp = fopen('data.txt', 'w');
    fwrite($fp, json_encode($value));
    fclose($fp);
}

//doc file
function read_file($filename = 'data.txt')
{
    $fn = fopen($filename, "r");
    $result = fgets($fn);
    fclose($fn);
    return json_decode($result);
}

?>
