<?php

namespace App\Tool;

class Search
{
    public function test($data)
    {
        htmlspecialchars($data);
        trim($data);
        return $data;
    }
}
