<?php

//check nhap key tu ban phim
function getKeyAndCheck($key = 'start')
{
    $result = '';
    switch ($key) {
        case 'start':
            $result = readline("1. Nhap 2.Thong Ke 3.Ket Thuc ");
            return checkKeyStart($result);
            break;
        case 'nhap':
            $result = readline("1. Don 2.Phuc 3.May 4.Kho ");
            if (in_array($result, [1, 2, 3, 4])) {
                return [$key, $result];
            } else {
                return getKeyAndCheck('nhap');
            }
            break;
        case 'tk':
            $result = readline("1. Tinh Tong Tien 2.Tinh Tong KL 3.Xuat     ");
            if (in_array($result, [1, 2, 3])) {
                return [$key, $result];
            } else {
                return getKeyAndCheck('tk');
            }
            break;
        default:
            getKeyAndCheck();
            break;
    }
    return [$key, $result];
}

//1. Nhap 2.Thong Ke 3.Ket Thuc
function checkKeyStart($number)
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

//Tinh tong tien + tong khoi luong
function getTotal($number, $params)
{
    $sum = 0;
    if (checkKey($number, [1, 2])) {
        switch ($number) {
            case 1:
                //Tinh don
                foreach ($params['don'] as $val) {
                    $sum += $val['price'];
                }
                //Tinh phuc
                $sum_tmp = 0;
                sumComplex($params['phuc'], $sum_tmp, 'price');
                $sum += $sum_tmp;
                break;
            case 2:
                //Tinh don
                foreach ($params['don'] as $val) {
                    $sum += $val['weight'];
                }
                //Tinh phuc
                $sum_tmp = 0;
                sumComplex($params['phuc'], $sum_tmp, 'weight');
                $sum += $sum_tmp;
                break;
            default:
                echo 'Khong hop le';
                echo "\n";
                break;
        }
    }
    echo 'Tong la: ' . $sum;
    echo "\n";

}

//check key hop le
function checkKey($num, $arrAccept)
{
    if (in_array($num, $arrAccept)) {
        return 1;
    }
    return 0;
}

function sumComplex($params, &$result, $type)
{
    foreach ($params as $val) {
        if (is_array($val)) {
            $arr_keys = array_keys($val);
            if (in_array('list', $arr_keys)) {
                sumComplex($val, $result, $type);
            } elseif (in_array($type, $arr_keys)) {
                $result += (int)$val[$type];
            }
        }
    }
}
