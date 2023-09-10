<?php

namespace App\Traits;

trait OptionsEnum
{
    public static function options(int $case = 0)
    {
        $data = [];
        
        foreach (self::cases() as $item) {
            if ($case === 0) {
                $data[] = $item->value[0];
            } else if ($case === 1) {
                $data[$item->value[0]] = $item->value[1];
            }
        }

        return $data;
    }
}