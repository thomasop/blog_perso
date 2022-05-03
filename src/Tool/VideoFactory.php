<?php

namespace App\Tool;

use App\Entity\Post;
use App\Entity\User;
use App\Entity\Video;
use App\Tool\VideoIdExtractor;

class VideoFactory
{
    public static function set($videosCollection, Post $post, User $user): void
    {
        $videoIdExtractor = new VideoIdExtractor();
        foreach ($videosCollection as $b => $video) {
            /** @var Video $video */
            $videos[] = $video->getUrl();
            $video->setPost($post);
            $video->setUser($user);
            $video->setUrl($videoIdExtractor->urlToId($video->getUrl()));
        }
    }
}
