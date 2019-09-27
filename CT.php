<?php
require_once 'ConsoleTable.php';

abstract class ChiTiet
{
    protected $id;
    public $objs = [];
    public $total_money = 0;
    public $total_weight = 0;
    public $check_output = 1;
    public $check_find = 1;

    public function nhap()
    {
        $this->id = readline("Nhap id: ");
    }

    public function xuat($params = null)
    {
        $tbl = new ConsoleTable();

        $tbl->setHeaders(array("STT", "ID", "Price", "Weight"));

        foreach ($params as $key => $val) {
            $arr_keys = array_keys($val);
            if (in_array('list', $arr_keys)) {
                $tbl->addRow(array(
                    $key + 1,
                    $val['id'],
                    $val['name'],
                    $val['sl_ctc']
                ));
            } else {
                $tbl->addRow(array(
                    $key + 1,
                    $val['id'],
                    $val['price'],
                    $val['weight']
                ));
//                if ($this->check_output) {
//                    echo "STT   -   ID    -   PRICE   -   WEIGHT";
//                    echo "\n";
//                }
//                echo ($key + 1) . '    -   ' . $val['id'] . '    -   ' . $val['price'] . '    -   ' . $val['weight'];
//                echo "\n";
            }
            $this->check_output = 0;
        }
        echo $tbl->getTable();
    }

    public function findAll($val_find, $params)
    {
        $results = [];
        foreach ($params as $val) {
            if ($val_find == $val['id'] || $val_find == $val['name']) {
                if ($this->check_find) {
                    $this->check_find = 0;
                    echo 'ID        -       NAME' . "\n";
                }
                echo $val['id'] . '        -       ' . $val['name'] . "\n";;
            }
        }
        if ($this->check_find) {
            echo "Khong tim thay.\n";
        }
        return $results;
    }

    public function getMS()
    {
        return $this->id;
    }

    abstract public function tinhTien();

    abstract public function tinhKL();

    public function checkType($number)
    {
        $ct = null;
        switch ($number) {
            //nhap chi tiet don
            case 1:
                $ct = new CTDon();
                $ct->nhap();
                break;

            //nhap chi tiet phuc
            case 2:
                $ct = new CTPhuc();
                $ct->nhap();
                break;

            //nhap may
            case 3:
                $ct = new May();
                $ct->nhap();
                break;
        }
        return $ct->objs;
    }

    public function sum($params, &$result, $type)
    {
        foreach ($params as $val) {
            if (is_array($val)) {
                $arr_keys = array_keys($val);
                if (in_array('list', $arr_keys)) {
                    $this->sum($val, $result, $type);
                } elseif (in_array($type, $arr_keys)) {
                    $result += (int)$val[$type];
                }
            }
        }
    }

    public function validateNum($number)
    {
//        $number = readline('Nhap so luong chi tiet cua may: ');
        while ((float)$number < 1 || ((float)$number - (int)$number > 0) || (int)strpos($number, ',') > 0) {
//            $number = readline('Ban da nhap sai, moi nhap lai: ');
//            echo '+------------------------------------+';
//            echo "\n";
            return false;
        }
        return true;
    }
}
