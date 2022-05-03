<?php

namespace App\Tests\Controller;

use DateTime;
use PHPUnit\Framework\TestCase;
use App\Repository\UserRepository;
use Symfony\Component\HTTPFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    private $client = null;

    public function testRegister()
    {
        $this->client = static::createClient();
        $this->client->request('GET', '/register');
        static::assertEquals(
        Response::HTTP_OK,
        $this->client->getResponse()->getStatusCode()
        );
    }

    public function testRegisterForm()
    {
        $this->client = static::createClient();
        $this->client->request('GET', '/register');
        $this->client->submitForm('registration[submit]', [
            'registration[prenom]' => 'prenom',
            'registration[nom]' => 'nom',
            'registration[email]' => 'nom@mail.com',
            'registration[password][first]' => 'Test1234?',
            'registration[password][second]' => 'Test1234?',
            'registration[age][month]' => '11',
            'registration[age][day]' => '11',
            'registration[age][year]' => '2021',
            'registration[sexe]' => 1,
        ]);
        $this->assertResponseRedirects();
        $this->client->followRedirect();
        $this->assertSelectorExists('.alert.alert-success');
    }

    public function testForgotPassword()
    {
        $this->client = static::createClient();
        $this->client->request('GET', '/forgot-password');
        static::assertEquals(
        Response::HTTP_FOUND,
        $this->client->getResponse()->getStatusCode()
        );
    }

    public function testShow()
    {
        $this->client = static::createClient();
        
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@mail.com');

        $this->client->loginUser($testUser);
        $this->client->request('GET', '/user/profile/1');
        static::assertEquals(
        Response::HTTP_OK,
        $this->client->getResponse()->getStatusCode()
        );
    }

    public function testEdit()
    {
        $this->client = static::createClient();
        
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@mail.com');

        $this->client->loginUser($testUser);
        $this->client->request('GET', '/user/edit/1');
        static::assertEquals(
        Response::HTTP_OK,
        $this->client->getResponse()->getStatusCode()
        );
    }

    public function testDelete()
    {
        $this->client = static::createClient();
        
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@mail.com');

        $this->client->loginUser($testUser);
        $this->client->request('GET', '/user/delete/1');
        static::assertEquals(
        Response::HTTP_SEE_OTHER,
        $this->client->getResponse()->getStatusCode()
        );
    }

    public function testDemandAdmin()
    {
        $this->client = static::createClient();
        
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@mail.com');

        $this->client->loginUser($testUser);
        $this->client->request('GET', '/user/demande/1');
        static::assertEquals(
        Response::HTTP_OK,
        $this->client->getResponse()->getStatusCode()
        );
    }

    public function testAccept()
    {
        $this->client = static::createClient();
        
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@mail.com');

        $this->client->loginUser($testUser);
        $this->client->request('GET', '/user/accept/1');
        static::assertEquals(
        Response::HTTP_SEE_OTHER,
        $this->client->getResponse()->getStatusCode()
        );
    }

    public function testDeleteUser()
    {

        $this->client = static::createClient();
        
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@mail.com');

        $this->client->loginUser($testUser);
        $this->client->request('GET', '/user/admin/delete/1');
        static::assertEquals(
        Response::HTTP_SEE_OTHER,
        $this->client->getResponse()->getStatusCode()
        );
    }


    public function testModifPassword()
    {
        $this->client = static::createClient();
        
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@mail.com');

        $this->client->loginUser($testUser);
        $this->client->request('GET', '/modification-password/user0-brumen0');
        static::assertEquals(
        Response::HTTP_OK,
        $this->client->getResponse()->getStatusCode()
        );
    }
}