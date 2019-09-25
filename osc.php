<?php
require_once 'funcs.php';
require_once 'chi_tiet_don.php';
require_once 'chi_tiet_phuc.php';
require_once 'may.php';
require_once 'kho.php';
require_once 'func_file.php';

$params = json_decode(json_encode(read_file()), true);
start();
//chay ham lay yeu cau tu ban phim
function start()
{
    $result = getKeyAndCheck();
    process_type_input($result);
}

//xac dinh yeu cau nhap tu ban phim
function process_type_input($result)
{
    GLOBAL $params;
    switch ($result[0]) {
        case 'nhap':
            process_input($result[1]);
            break;
        case 'tk':
//            getTotal($result[1], $params);
            $type = $result[1];//tinh tong gia hoac tinh tong khoi luong
            $key = readline("1. Don 2.Phuc 3.May 4.Kho  ");
            $ct = null;
            switch ($key) {
                case 1:
                    $ct = new CTDon();
                    break;
                case 2:
                    $ct = new CTPhuc();
                    break;
                case 3:
                    $ct = new May();
                    break;
                case 4:
                    $ct = new Kho();
                    break;
                default:
                    $ct = new CTDon();
                    break;
            }
            switch ($type) {
                case 1;
                    $ct->tinhTien($params);
                    echo $ct->total_money;
                    echo "\n";
                    break;
                case 2:
                    $ct->tinhKL($params);
                    echo $ct->total_weight;
                    echo "\n";
                    break;
                case 3:
                    $ct->xuat($params);
                    break;
            }
            break;
    }
    start();
}

//lay ket qua nhap tu ban phim == don hoac phuc
function process_input($number)
{
    GLOBAL $params;
    $ct = null;
    switch ($number) {
        //nhap chi tiet don
        case 1:
            $ct = new CTDon();
            $ct->nhap();
            $params['don'][] = $ct->objs;
            break;

        //nhap chi tiet phuc
        case 2:
            $ct = new CTPhuc();
            $ct->nhap();
            $params['phuc'][] = $ct->objs;
            break;

        //nhap chi tiet phuc
        case 3:
            $ct = new May();
            $ct->nhap();
            $params['may'][] = $ct->objs;
            break;

        //nhap chi tiet phuc
        case 4:
            $ct = new Kho();
            $ct->nhap();
            $params['kho'][] = $ct->objs;
            break;
    }
    write_file($params);
}
