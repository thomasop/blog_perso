<?php declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Friend;
use App\Entity\Comment;
use App\Entity\Message;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class MessageTest extends KernelTestCase
{
    /**
     * Function for test Message Entity
     *
     * @return void
     */
    public function test(): void
	{
		$message = (new Message())
		->setContent("ajks");
		self::bootKernel();
		$error = self::getContainer()->get('validator')->validate($message);
		$this->assertCount(0, $error);
	}

    /**
     * Function for test message in Message Entity
     *
     * @return void
     */
    public function testMessage(): void
    {
        $message = new Message();
        $message->setContent("test massage");
        $this->assertEquals("test massage", $message->getContent());
    }
}