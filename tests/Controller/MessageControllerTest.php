<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HTTPFoundation\Response;
use App\Repository\UserRepository;

class MessageControllerTest extends WebTestCase
{
    private $client = null;

    public function testIndex(): void
    {
        $this->client = static::createClient();

        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@mail.com');

        $this->client->loginUser($testUser);
        $this->client->request('GET', '/message/user0-brumen0');
        static::assertEquals(
            Response::HTTP_FOUND,
            $this->client->getResponse()->getStatusCode()
        );
    }

    public function testAddForm(): void
    {
        $this->client = static::createClient();

        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('paul@mail.com');

        $this->client->loginUser($testUser);
        $crawler = $this->client->request('GET', '/message/toto-eastek');
        $buttonCrawlerNode = $crawler->selectButton('message_add');
        $form = $buttonCrawlerNode->form();
        $form['message[content]'] = 'test';
        $this->client->submit($form);
        static::assertEquals(
            Response::HTTP_SEE_OTHER,
            $this->client->getResponse()->getStatusCode()
        );
    }
}
