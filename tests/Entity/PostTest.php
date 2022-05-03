<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class PostTest extends KernelTestCase
{
    public function test(): void
    {
        $post = (new Post())
        ->setTitle("ajks")
        ->setContent("prenom");
        self::bootKernel();
        $error = self::getContainer()->get('validator')->validate($post);
        $this->assertCount(0, $error);
    }

    public function testTitle(): void
    {
        $post = new Post();
        $post->setTitle("test titre");
        $this->assertEquals("test titre", $post->getTitle());
    }

    public function testContent(): void
    {
        $post = new Post();
        $post->setContent("test content");
        $this->assertEquals("test content", $post->getContent());
    }
}
