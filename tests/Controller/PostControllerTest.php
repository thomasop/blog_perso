<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HTTPFoundation\Response;
use PHPUnit\Framework\TestCase;
use App\Repository\UserRepository;

class PostControllerTest extends WebTestCase
{
    /**
     * @var null
     */
    private $client = null;

    /**
     * Function for test /posts route
     *
     * @return void
     */
    public function testPost(): void
    {
        $this->client = static::createClient();
        
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@mail.com');

        $this->client->loginUser($testUser);
        $this->client->request('GET', '/posts');
        static::assertEquals(
        Response::HTTP_OK,
        $this->client->getResponse()->getStatusCode()
        );
    }

    /**
     * Function for test /posts/modification/post0 route
     *
     * @return void
     */
    public function testEdit(): void
    {
        $this->client = static::createClient();
        
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@mail.com');

        $this->client->loginUser($testUser);
        $this->client->request('GET', '/posts/modification/post0');
        static::assertEquals(
        Response::HTTP_OK,
        $this->client->getResponse()->getStatusCode()
        );
    }

    /**
     * Function for test /posts/modification/post0 route form
     *
     * @return void
     */
    public function testForm(): void
    {
        $this->client = static::createClient();
        
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@mail.com');

        $this->client->loginUser($testUser);
        $crawler = $this->client->request('GET', '/posts/modification/post0');
        $buttonCrawlerNode = $crawler->selectButton('edit');
        $form = $buttonCrawlerNode->form();
        $form['postedit[title]'] = 'title';
        $form['postedit[content]'] = 'test';
        $this->client->submit($form);
        static::assertEquals(
            Response::HTTP_FOUND,
            $this->client->getResponse()->getStatusCode()
            );
    }

    /**
     * Function for test /posts/suppression/post2 route
     *
     * @return void
     */
    public function testDelete(): void
    {
        $this->client = static::createClient();
        
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@mail.com');

        $this->client->loginUser($testUser);
        $this->client->request('GET', '/posts/suppression/post2');
        static::assertEquals(
        Response::HTTP_FOUND,
        $this->client->getResponse()->getStatusCode()
        );
    }
}