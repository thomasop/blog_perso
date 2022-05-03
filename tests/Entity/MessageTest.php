<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Message;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class MessageTest extends KernelTestCase
{
    public function test(): void
    {
        $message = (new Message())
        ->setContent("ajks");
        self::bootKernel();
        $error = self::getContainer()->get('validator')->validate($message);
        $this->assertCount(0, $error);
    }

    public function testMessage(): void
    {
        $message = new Message();
        $message->setContent("test massage");
        $this->assertEquals("test massage", $message->getContent());
    }
}
