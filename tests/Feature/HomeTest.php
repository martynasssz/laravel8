<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeTest extends TestCase
{  
    public function testHomePageIsWorkingCorrectly() //renamed to actual method name, because we are testing home page
    {
        $response = $this->get('/');

        $response->assertSeeText('Hello world!'); //checking text in home page
        $response->assertSeeText('The current value is 0'); //we can test another text at the same time
    }

    public function testContactPageIsWorkingCorrectly()
    {
        $response = $this->get('/contact');

        $response->assertSeeText('Contact page');
        $response->assertSeeText('Hello this is contact!');
    }

}
