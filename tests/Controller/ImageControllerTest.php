<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HTTPFoundation\Response;
use PHPUnit\Framework\TestCase;
use App\Repository\UserRepository;

class ImageControllerTest extends WebTestCase
{
    /**
     * @var null
     */
    private $client = null;
  
    /**
     * Function for test /image/ajouter route
     *
     * @return void
     */
    public function testAdd(): void
    {
        $this->client = static::createClient();
        
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@mail.com');

        $this->client->loginUser($testUser);
        $this->client->request('GET', '/image/ajouter');
        static::assertEquals(
        Response::HTTP_OK,
        $this->client->getResponse()->getStatusCode()
        );
    }

    /**
     * Function for test /image/ajouter/post0 route form
     *
     * @return void
     */
    public function testAddPost(): void
    {
        $this->client = static::createClient();
        
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@mail.com');

        $this->client->loginUser($testUser);
        $this->client->request('GET', '/image/ajouter/post0');
        static::assertEquals(
        Response::HTTP_OK,
        $this->client->getResponse()->getStatusCode()
        );
    }
}