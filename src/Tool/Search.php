<?php

namespace App\Tool;

/**
 * Function for htmlspecialchars form data
 * 
 * @return $data
 */
class Search {
    public function test($data) {
        htmlspecialchars($data);
        trim($data);
        return $data;
    }
}