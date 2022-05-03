<?php

namespace App\Tool;

class ForeachMessage
{
    /**
     * Function for sarch conversation message
     *
     * @param array $message
     * @return array
     */
    public function foreach($message)
    {
        $element1 = [];
        $array1 = [];
        foreach ($message as $value) {
            $test = (string)$value->getReceive()->getPrenom();
            $mail = (string)$value->getReceive()->getEmail();
            $element1[] = $test;
            $array1[] = $mail;
            
        }
        $element2 = [];
        $array2 = [];
        foreach ($message as $value) {
            $test = (string)$value->getSend()->getPrenom();
            $mail = (string)$value->getSend()->getEmail();
            $element2[] = $test;
            $array2[] = $mail;
            
        }
        $nombre1 = array_count_values($element1);
        $nombre2 = array_count_values($element2);
        $nombre3 = array_count_values($array1);
        $nombre4 = array_count_values($array2);
        $final1 = [];
        foreach ($nombre1 as $cle => $value) {
           $final1[] = $cle;
        }
        $final2 = [];
        foreach ($nombre2 as $cle => $value) {
           $final2[] = $cle;
        }
        $final3 = [];
        foreach ($nombre3 as $cle => $value) {
            $final3[] = $cle;
        }
        $final4 = [];
        foreach ($nombre4 as $cle => $value) {
            $final4[] = $cle;
        }
        return [$final1, $final2, $final3, $final4];
    }
}