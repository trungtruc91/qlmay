<?php
require_once 'funcs.php';
require_once 'CTD.php';
require_once 'CTP.php';
require_once 'May.php';
require_once 'Kho.php';
require_once 'File.php';
require_once 'KeyPress.php';

//get data from file
$params = File::getData('data.txt');

//run
start();

function start()
{
    processTypeInput(KeyPress::getKeyAndCheck());
}

//xac dinh yeu cau nhap tu ban phim
function processTypeInput($result)
{
    GLOBAL $params;
    switch ($result[0]) {
        case 'nhap':
            process_input($result[1]);
            break;
        case 'tk':
            $type = $result[1];//tinh tong gia hoac tinh tong khoi luong
            if ($type == 4) {
                $key = readline("1.May 2.Kho      | ");
            } else {
                $key = readline("1.May 2.Kho 3. Don 4.Phuc      | ");
            }
            $ct = null;
            switch ($key) {
                case 1:
                    $ct = new May();
                    break;
                case 2:
                    $ct = new Kho();
                    break;
                case 3:
                    $ct = new CTDon();
                    break;
                case 4:
                    $ct = new CTPhuc();
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
                case 4:
                    $result = readline("Nhap ID hoac Ten      | ");
                    $ct->findAll($result, $params);
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
    File::writeFile($params);
}
