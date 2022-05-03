<?php declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Post;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class PostTest extends KernelTestCase
{
    /**
     * Function for test Post Entity
     *
     * @return void
     */
    public function test(): void
	{
		$post = (new Post())
		->setTitle("ajks")
        ->setContent("prenom");
		self::bootKernel();
		$error = self::getContainer()->get('validator')->validate($post);
		$this->assertCount(0, $error);
	}

    /**
     * Function for test title in Post Entity
     *
     * @return void
     */
    public function testTitle(): void
    {
        $post = new Post();
        $post->setTitle("test titre");
        $this->assertEquals("test titre", $post->getTitle());
    }

    /**
     * Function for test content in Post Entity
     *
     * @return void
     */
    public function testContent(): void
    {
        $post = new Post();
        $post->setContent("test content");
        $this->assertEquals("test content", $post->getContent());
    }
}