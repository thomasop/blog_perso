<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HTTPFoundation\Response;

class LoginControllerTest extends WebTestCase
{
    /**
     * @var null
     */
    private $client = null;
  
    /**
     * function test / route
     *
     * @return void
     */
    public function testIndex(): void
    {
        $this->client = static::createClient();
        $this->client->request('GET', '/');
        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }

    /**
     * function test /logout route
     *
     * @return void
     */
    public function testLogout(): void
    {
        $this->client = static::createClient();
        $this->client->request('GET', '/logout');
        static::assertEquals(
        Response::HTTP_FOUND,
        $this->client->getResponse()->getStatusCode()
        );
    }
}