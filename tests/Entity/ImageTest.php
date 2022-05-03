<?php declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class ImageTest extends KernelTestCase
{
    /**
     * Function for test Image Entity
     *
     * @return void
     */
    public function test(): void
	{
		$image = (new Image())
		->setName("ajks.jpeg");
		self::bootKernel();
		$error = self::getContainer()->get('validator')->validate($image);
		$this->assertCount(0, $error);
	}

    /**
     * Function for test name in Image Entity
     *
     * @return void
     */
    public function testName(): void
    {
        $image = new Image();
        $image->setName("photo.jpeg");
        $this->assertEquals("photo.jpeg", $image->getName());
    }
}