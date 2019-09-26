<?php
require_once 'CT.php';

class CTDon extends ChiTiet
{
    public $price;
    public $weight;

    public function tinhTien($params = null)
    {
        $this->sum($params['don'], $this->total_money, 'price');
    }

    public function tinhKL($params = null)
    {
        $this->sum($params['don'], $this->total_weight, 'weight');
    }

    public function nhap()
    {
        parent::nhap();
        $this->price = readline("Nhap price: ");
        $this->weight = readline("Nhap khoi luong: ");
        $this->objs = [
            'id' => $this->getMS(),
            'price' => $this->price,
            'weight' => $this->weight,
        ];
    }

    public function xuat($params = null)
    {
        $tbl = new ConsoleTable();
        $tbl->setHeaders(array("STT", "ID", "Price", "Weight"));
        foreach ($params['don'] as $key => $val) {
            $tbl->addRow(array(
                $key + 1,
                $val['id'],
                $val['price'],
                $val['weight']
            ));
        }
        echo $tbl->getTable();
    }

    public function findAll($id, $params = null)
    {
        parent::findAll($id, $params['don']);
    }
}
