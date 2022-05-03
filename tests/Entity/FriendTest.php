<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Friend;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class FriendTest extends KernelTestCase
{
    public function test(): void
    {
        $friend = (new Friend())
        ->setStatut(false);
        self::bootKernel();
        $error = self::getContainer()->get('validator')->validate($friend);
        $this->assertCount(0, $error);
    }

    public function testStatut(): void
    {
        $friend = new Friend();
        $friend->setStatut(true);
        $this->assertEquals(true, $friend->getStatut());
    }
}
