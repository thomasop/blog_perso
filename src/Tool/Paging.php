<?php

namespace App\Tool;

class Paging
{
    public function pagingComments($page, $comments)
    {
        $paging = array(
            'page' => $page,
            'nbPages' => ceil(count($comments) / 10),
            'nomRoute' => 'comment',
            'paramsRoute' => array()
        );
        return $paging;
    }
}
