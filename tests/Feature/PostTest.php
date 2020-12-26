<?php

namespace Tests\Feature;

use App\Models\BlogPost; //new model added
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase; //it lets recreate database stucture by running all migrations on each single test run
    
    public function testNoBlogPostsWhenNothingInDatabase() //act part
    {
        $response = $this->get('/posts');

        $response->assertSeeText('No post found!'); //assert part
    }

    public function testSee1BlogPostWhenThereIs1()
    {
        //Arrange (preparation data for testing, saving a new model inside database)
        $post = new BlogPost(); //use App\Models\BlogPost added
        $post->title = 'New title';
        $post->content = 'Content of blog post';
        $post->save();

        //Act
        $response = $this->get('/posts');

        //Assert 
        $response->assertSeeText('New title');

        //chech if there is a record with specific atribute in database
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New title'
        ]);
    }

    public function testStoreValid()
    {
        $params = [     //creating array of valid parameters
            'title' =>'Valid title',
            'content' => 'At least 10 characters'
        ];

        $this->post('/posts', $params)
            ->assertStatus(302) //302 status for successfull redirection
            ->assertSessionHas('status'); //stastus session variable

        $this->assertEquals(session('status'), 'The blog post was created!');   
    }

    public function testStoreFail()
    {
        $params = [
            'title' =>'x',
            'content' => 'x'
        ];

        $this->post('/posts', $params)
            ->assertStatus(302) //302 status for successfull redirection
            ->assertSessionHas('errors');  //errors session variable

        $messages = session('errors')->getMessages();        
        
        $this->assertEquals($messages['title'][0],'The title must be at least 5 characters.' );
        $this->assertEquals($messages['content'][0],'The content must be at least 10 characters.' );
    }    


}
