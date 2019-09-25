<?php

class  KeyPress
{
    //1. Nhap 2.Thong Ke 3.Ket Thuc
    static function checkKeyStart($number)
    {
        if (in_array($number, [1, 2, 3])) {
            switch ($number) {
                case 1:
                    return getKeyAndCheck('nhap');
                    break;
                case 2:
                    return getKeyAndCheck('tk');
                    break;
                default:
                    die();
                    break;
            }
        } else {
            echo "Khong hop le. Hay nhap lai.\n";
            return getKeyAndCheck();
        }
    }

    static function getKeyAndCheck($key = 'start')
    {
        $result = '';
        switch ($key) {
            case 'start':
                $result = readline("1. Nhap 2.Thong Ke 3.Ket Thuc   ");
                return self::checkKeyStart($result);
                break;
            case 'nhap':
                $result = readline("1. Don 2.Phuc 3.May 4.Kho   ");
                if (in_array($result, [1, 2, 3, 4])) {
                    return [$key, $result];
                } else {
                    return self::getKeyAndCheck('nhap');
                }
                break;
            case 'tk':
                $result = readline("1. Tinh Tong Tien 2.Tinh Tong KL 3.Xuat     ");
                if (in_array($result, [1, 2, 3])) {
                    return [$key, $result];
                } else {
                    return self::getKeyAndCheck('tk');
                }
                break;
            default:
                self::getKeyAndCheck();
                break;
        }
        return [$key, $result];
    }

    function checkInArr($val, $arr)
    {
        return in_array($val, $arr);
    }
}