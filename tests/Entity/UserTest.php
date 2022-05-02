<?php declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\User;
use App\Entity\Comment;
use DateTime;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class UserTest extends KernelTestCase
{
    public function test()
	{
		$name = "nom";
		$user = (new User())
		->setNom($name)
        ->setPrenom("prenom")
        ->setEmail("test@mail.com")
        ->setPassword("Test1234?")
        ->setAge(new DateTime('now'))
        ->setSexe(true)
        ->setAdmin(false)
        ->setDemandeAdmin(false)
        ->setEnabled(true)
        ->setAvatar('test.jpeg');
		self::bootKernel();
		$error = self::getContainer()->get('validator')->validate($user);
		$this->assertCount(0, $error);
	}

    public function testNom(): void
    {
        $user = new User();
        $user->setNom("test nom");
        $this->assertEquals("test nom", $user->getNom());
    }

    public function testPrenom(): void
    {
        $user = new User();
        $user->setPrenom("test prenom");
        $this->assertEquals("test prenom", $user->getPrenom());
    }

    public function testEmail(): void
    {
        $user = new User();
        $user->setEmail("test mail");
        $this->assertEquals("test mail", $user->getEmail());
    }

    public function testPassword(): void
    {
        $user = new User();
        $user->setPassword("test password");
        $this->assertEquals("test password", $user->getPassword());
    }
}