<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HTTPFoundation\Response;
use App\Repository\UserRepository;

class CommentControllerTest extends WebTestCase
{
    private $client = null;

    public function testPost(): void
    {
        $this->client = static::createClient();

        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@mail.com');

        $this->client->loginUser($testUser);
        $this->client->request('GET', '/commentaires/affichages/post0/1');
        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }

    public function testAddForm(): void
    {
        $this->client = static::createClient();

        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@mail.com');

        $this->client->loginUser($testUser);
        $crawler = $this->client->request('GET', '/commentaires/affichages/post0/1');
        $buttonCrawlerNode = $crawler->selectButton('comment_add');
        $form = $buttonCrawlerNode->form();
        $form['comment[content]'] = 'test';
        $this->client->submit($form);
        static::assertEquals(
            Response::HTTP_FOUND,
            $this->client->getResponse()->getStatusCode()
        );
    }

    public function testEdit(): void
    {
        $this->client = static::createClient();

        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@mail.com');

        $this->client->loginUser($testUser);
        $this->client->request('GET', '/commentaires/modification/1/post0');
        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }

    public function testForm(): void
    {
        $this->client = static::createClient();

        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@mail.com');

        $this->client->loginUser($testUser);
        $crawler = $this->client->request('GET', '/commentaires/modification/1/post0');
        $buttonCrawlerNode = $crawler->selectButton('comment_update');
        $form = $buttonCrawlerNode->form();
        $form['comment[content]'] = 'test';
        $this->client->submit($form);
        static::assertEquals(
            Response::HTTP_SEE_OTHER,
            $this->client->getResponse()->getStatusCode()
        );
    }

    public function testDelete(): void
    {
        $this->client = static::createClient();

        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@mail.com');

        $this->client->loginUser($testUser);
        $this->client->request('GET', '/commentaires/suppression/1/post0');
        static::assertEquals(
            Response::HTTP_SEE_OTHER,
            $this->client->getResponse()->getStatusCode()
        );
    }
}
