<?php

abstract class ChiTiet
{
    protected $id;
    public $objs = [];
    public $total_money = 0;
    public $total_weight = 0;
    public $check_output = 1;

    public function nhap()
    {
        $this->id = readline("Nhap id: ");
    }

    public function xuat($params = null)
    {
        foreach ($params as $key => $val) {
            $arr_keys = array_keys($val);
            if (in_array('list', $arr_keys)) {
                if (in_array('dsct', $arr_keys)) {
                    if ($this->check_output) {
                        echo "STT   -   ID      -   DSCT   -   SL CTC";
                        echo "\n";
                    }
                    echo ($key + 1) . '    -   ' . $val['id'] . '    -   ' . $val['dsct'] . '    -   ' . $val['sl_ctc'];
                    echo "\n";
                }
                $this->xuat($val);
            } else {
                if ($this->check_output) {
                    echo "STT   -   ID    -   PRICE   -   WEIGHT";
                    echo "\n";
                }
                echo ($key + 1) . '    -   ' . $val['id'] . '    -   ' . $val['price'] . '    -   ' . $val['weight'];
                echo "\n";
            }
            $this->check_output = 0;
        }
    }

    public function timkiem($id, $params)
    {

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
}
