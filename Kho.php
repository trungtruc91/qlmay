<?php
require_once 'CT.php';

class Kho extends ChiTiet
{
    protected $id;
    protected $name;
    public $sl_ctc;

    public function nhap()
    {
        $this->id = readline("Nhap MS: ");
        $this->name = readline("Nhap Ten: ");
        $this->sl_ctc = readline("SL CT con: ");
        $obj = [
            'id' => $this->getMS(),
            'name' => $this->name,
            'sl_ctc' => $this->sl_ctc,
            'list' => $this->checkSL($this->sl_ctc)
        ];
        $this->objs = $obj;
    }

    public function tinhTien($params = null)
    {
        $this->sum($params['kho'], $this->total_money, 'price');
    }

    public function tinhKL($params = null)
    {
        $this->sum($params['kho'], $this->total_weight, 'weight');
    }

    public function checkSL($sl)
    {
        $objs = [];
        for ($i = 0; $i < (int)$sl; $i++) {
            echo "Nhap phan tu thu: " . ($i + 1) . "\n";
            $number = readline("1. Don 2.Phuc ");
            if (in_array($number, [1, 2])) {
                $obj = $this->checkType($number);
                $objs[] = $obj;
            }
        }
        return $objs;
    }

    public function xuat($params = null)
    {
//        foreach ($params['kho'] as $key => $val) {
//            $arr_keys = array_keys($val);
//            if (in_array('list', $arr_keys)) {
//                echo 'STT: ' . ($key + 1) . ' => CTP';  echo "\n";
//                echo 'ID: ' . $val['id'];  echo "\n";
//                echo 'Name: ' . $val['name'];  echo "\n";
//                echo 'SL CTC: ' . $val['sl_ctc'];
//                echo "\n";
//            } else {
//                echo 'STT: ' . ($key + 1) . '=> CTD';  echo "\n";
//                echo 'ID: ' . $val['id'];  echo "\n";
//                echo 'Price: ' . $val['price'];  echo "\n";
//                echo 'Weight: ' . $val['weight'];
//                echo "\n";
//            }
//        }
        parent::xuat($params['kho']);
    }
}
