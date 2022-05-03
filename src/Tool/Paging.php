<?php

namespace App\Tool;

class Paging
{
    /**
     * Function for paging comment
     *
     * @param int $page
     * @param array $comments
     * @return array $paging 
     */
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
