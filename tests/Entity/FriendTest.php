<?php declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Friend;
use App\Entity\Comment;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class FriendTest extends KernelTestCase
{
    /**
     * Function for test Friend Entity
     *
     * @return void
     */
    public function test(): void
	{
		$friend = (new Friend())
		->setStatut(false);
		self::bootKernel();
		$error = self::getContainer()->get('validator')->validate($friend);
		$this->assertCount(0, $error);
	}

    /**
     * Function for test statut in Friend Entity
     *
     * @return void
     */
    public function testStatut(): void
    {
        $friend = new Friend();
        $friend->setStatut(true);
        $this->assertEquals(true, $friend->getStatut());
    }
}