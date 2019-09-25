<?php
require_once 'chi_tiet.php';

class May extends ChiTiet
{
    protected $id;
    protected $name;
    public $dsct;
    public $sl_ctc;

    public function nhap()
    {
        $this->id = readline("Nhap MS: ");
        $this->name = readline("Nhap Ten: ");
        $this->dsct = readline("Nhap DSCT: ");
        $this->sl_ctc = readline("SL CT con: ");
        $obj = [
            'id' => $this->getMS(),
            'name' => $this->name,
            'dsct' => $this->dsct,
            'sl_ctc' => $this->sl_ctc,
            'list' => $this->checkSL($this->sl_ctc)
        ];
        $this->objs = $obj;
    }


    public function tinhTien($params = null)
    {
        $this->sum($params['may'], $this->total_money, 'price');
    }

    public function tinhKL($params = null)
    {
        $this->sum($params['may'], $this->total_weight, 'weight');
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
        parent::xuat($params['may']);
    }
}
