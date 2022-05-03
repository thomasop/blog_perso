<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HTTPFoundation\Response;
use PHPUnit\Framework\TestCase;
use App\Repository\UserRepository;

class FriendControllerTest extends WebTestCase
{
    /**
     * @var null
     */
    private $client = null;
  
    /**
     * Function for test /ami/user0-brumen0 route
     *
     * @return void
     */
    public function testAdd(): void
    {
        $this->client = static::createClient();
        
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@mail.com');

        $this->client->loginUser($testUser);
        $this->client->request('GET', '/ami/user0-brumen0');
        static::assertEquals(
        Response::HTTP_OK,
        $this->client->getResponse()->getStatusCode()
        );
    }

    /**
     * Function for test /ami/user0-brumen0 route form
     *
     * @return void
     */
    public function testAddForm(): void
    {
        $this->client = static::createClient();
        
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@mail.com');

        $this->client->loginUser($testUser);
        $crawler = $this->client->request('GET', '/ami/user0-brumen0');
        $buttonCrawlerNode = $crawler->selectButton('friend');
        $form = $buttonCrawlerNode->form();
        $form['friend[message]'] = 'test';
        $this->client->submit($form);
        static::assertEquals(
            Response::HTTP_SEE_OTHER,
            $this->client->getResponse()->getStatusCode()
            );
    }

    /**
     * Function for test /amis/afichages route
     *
     * @return void
     */
    public function testShows(): void
    {
        $this->client = static::createClient();
        
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@mail.com');

        $this->client->loginUser($testUser);
        $this->client->request('GET', '/amis/afichages');
        static::assertEquals(
        Response::HTTP_OK,
        $this->client->getResponse()->getStatusCode()
        );
    }
}