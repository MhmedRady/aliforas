<?php

namespace App\Helpers;

use Illuminate\Support\Facades\App;

class newHelper{
    public function split_array($array, $parts) {
        $t = 0;
        $array = json_decode($array);
        $result = array_fill(0, $parts - 1, array());
        $max = ceil(count($array) / $parts);
        foreach($array as $v) {
            count($result[$t]) >= $max and $t ++;
            $result[$t][] = $v;
        }
        return $result;
    }
}