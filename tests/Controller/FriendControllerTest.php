<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HTTPFoundation\Response;
use PHPUnit\Framework\TestCase;
use App\Repository\UserRepository;

class FriendControllerTest extends WebTestCase
{
    private $client = null;
  
    public function testAdd()
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

    public function testAddForm()
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

    public function testShows()
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