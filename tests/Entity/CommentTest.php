<?php declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Comment;
use DateTime;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class CommentTest extends KernelTestCase
{
    public function test()
	{
		$comment = (new Comment())
        ->setContent("prenom");
		self::bootKernel();
		$error = self::getContainer()->get('validator')->validate($comment);
		$this->assertCount(0, $error);
	}

    public function testContent(): void
    {
        $comment = new Comment();
        $comment->setContent("test content");
        $this->assertEquals("test content", $comment->getContent());
    }
}