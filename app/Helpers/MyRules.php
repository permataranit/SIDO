<?php

namespace App\Helpers;

class MyRules
{
    public function password_check(string $str, string $fields, array $data)
    {
        $fields = explode(',', $fields);

        if ($data['lama'] !== $fields[1]) {

            return false;
        }

        return true;
    }
}
