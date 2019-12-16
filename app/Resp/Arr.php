<?php
namespace App\Resp;

class Arr implements RespDataType
{
    public static function nil()
    {
        return "*-1\r\n";
    }

    public static function encode($val)
    {
        $result = "*" . count($val) . "\r\n";

        foreach ($val as $item) {
            if (is_array($item)) {
                $result .= self::array($item);
            } else {
                $result .= $item;
            }
        }
        return $result;
    }

    public static function decode(array $array, $size)
    {
        $result = [];

        for ($i = 0; $i < count($array); $i += 2) {
            $data_type_flag = substr($array[$i], 0, 1);

            if (isset(RespDataType::FLAG_MAP[$data_type_flag])) {
                $parser_class = RespDataType::FLAG_MAP[$data_type_flag];
                $element = $parser_class::decode(array_slice($array, $i, $i + 2), 0);
                $result[] = $element;
            } else {
                echo $array[$i];
            }
        }

        return $result;
    }
}