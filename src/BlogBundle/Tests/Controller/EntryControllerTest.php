<?php

namespace BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EntryControllerTest extends WebTestCase
{
    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addEntry');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/EditAction');
    }

    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/entries');
    }

}
