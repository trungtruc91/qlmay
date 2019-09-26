<?php

class  KeyPress
{
    //1. Nhap 2.Thong Ke 3.Ket Thuc
    static function checkKeyStart($number)
    {
        if (in_array($number, ['1', '2', '3'], TRUE)) {
            switch ($number) {
                case 1:
                    nhap:
                    $result = readline("1. Don 2.Phuc 3.May 4.Kho       | ");
                    if (in_array($result, ['1', '2', '3', '4'], TRUE)) {
                        return ['nhap', $result];
                    } else {
                        self::showError();
                        goto nhap;
                    }
                    break;
                case 2:
                    tk:
                    $result = readline("1. Tinh Tong Tien 2.Tinh Tong KL 3.Xuat 4.Tim Kiem      | ");
                    if (in_array($result, ['1', '2', '3', '4'])) {
                        return ['tk', $result];
                    } else {
                        self::showError();
                        goto tk;
                    }
                default:
                    echo "\n-----------BYE------------ \n";
                    die();
                    break;
            }
        } else {
            self::showError();
            return getKeyAndCheck();
        }
    }

    //start
    static function getKeyAndCheck($key = 'start')
    {
        $result = readline("1. Nhap 2.Thong Ke 3.Ket Thuc       | ");
        return self::checkKeyStart($result);
    }

    //show errors
    static function showError()
    {
        echo "Khong hop le. Hay nhap lai.\n";
    }
}