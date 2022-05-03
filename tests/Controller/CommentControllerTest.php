<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HTTPFoundation\Response;
use PHPUnit\Framework\TestCase;
use App\Repository\UserRepository;

class CommentControllerTest extends WebTestCase
{
    /**
     * @var null
     */
    private $client = null;

    /**
     * Function for test /commentaires/affichages/post0/1 route
     *
     * @return void
     */
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

    /**
     * Function for test /commentaires/affichages/post0/1 route form
     *
     * @return void
     */
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

    /**
     * Function for test /commentaires/modification/1/post0 route
     *
     * @return void
     */
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

    /**
     * Function for test /commentaires/modification/1/post0 route form
     *
     * @return void
     */
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

    /**
     * Function for test /commentaires/suppression/1/post0 route
     *
     * @return void
     */
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