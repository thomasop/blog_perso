<?php

namespace App\Tool;

class VideoIdExtractor
{

    /**
     * Function for verify youtube video
     *
     * @param string $url
     * @return boolean
     */
    public function urlToId($url): bool
    {
        $pregMatch = preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);

        if ($pregMatch) {
            return 'https://www.youtube.com/embed/' . $match[1];
        }
        return null;
    }
}