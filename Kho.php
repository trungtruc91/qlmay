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
        $this->name = readline("Nhap Ten Kho: ");
        $this->sl_ctc = readline("SL May: ");
        checkSLC:
        $this->sl_ctc = readline("SL CT con: ");
        if (!$this->validateNum($this->sl_ctc)) {
            goto checkSLC;
        }
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
//            echo "Nhap phan tu thu: " . ($i + 1) . "\n";
//            $number = readline("1. Don 2.Phuc ");
//            if (in_array($number, [1, 2])) {
//                $obj = $this->checkType($number);
//                $objs[] = $obj;
//            }
            $obj = $this->checkType(3);
            $objs[] = $obj;
        }
        return $objs;
    }

    public function xuat($params = null)
    {
        $tbl = new ConsoleTable();

        $tbl->setHeaders(array("STT", "ID", "Name", "SL May"));

        foreach ($params['kho'] as $key => $val) {
            $arr_keys = array_keys($val);
            if (in_array('list', $arr_keys)) {
                $tbl->addRow(array(
                    $key + 1,
                    $val['id'],
                    $val['name'],
                    $val['sl_ctc']
                ));
            }
        }
        echo $tbl->getTable();
    }

    public function findAll($id, $params = null)
    {
        parent::findAll($id, $params['kho']);
    }
}
