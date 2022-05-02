<?php declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Image;
use App\Entity\Video;
use App\Entity\Friend;
use App\Entity\Comment;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class VideoTest extends KernelTestCase
{
    public function test()
	{
		$video = (new Video())
		->setUrl("https://www.youtube.com/watch?v=v-OGCaUm9R0");
		self::bootKernel();
		$error = self::getContainer()->get('validator')->validate($video);
		$this->assertCount(0, $error);
	}

    public function testName(): void
    {
        $video = new Video();
        $video->setUrl("video");
        $this->assertEquals("video", $video->getUrl());
    }
}