<?php
$params = [
    [
        "price" => "3",
        "weight" => "1"
    ],
    [
        "id" => "1",
        "dsct" => "2",
        "sl_ctc" => "2",
        "list" => [
            [
                "price" => "3",
                "weight" => "1"
            ],
            [
                "price" => "1",
                "weight" => "2"
            ]
        ]
    ],
    [
        "id" => "1",
        "dsct" => "4",
        "sl_ctc" => "1",
        "list" => [
            [
                "id" => "1",
                "dsct" => "2",
                "sl_ctc" => "1",
                "list" => [
                    [
                        "price" => "4",
                        "weight" => "2"
                    ]
                ]
            ]
        ]
    ]
];

function func($params, &$result)
{
    foreach ($params as $val) {
        if (is_array($val)) {
            $arr_keys = array_keys($val);
            print_r($arr_keys);
            if (in_array('list', $arr_keys)) {
                func($val, $result);
            } elseif (in_array('price', $arr_keys)) {
                $result += (int)$val['price'];
            }
        }
    }

}

$result = 0;
func($params, $result);
echo "==============";
print_r($result);