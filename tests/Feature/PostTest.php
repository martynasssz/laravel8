<?php

namespace Tests\Feature;

use App\Models\BlogPost; //new model added
use App\Models\Comment;
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

    public function testSee1BlogPostWhenThereIs1WihtNoComments()
    {
        //Arrange (preparation data for testing, saving a new model inside database)
        // $post = new BlogPost(); //use App\Models\BlogPost added
        // $post->title = 'New title';
        // $post->content = 'Content of blog post';
        // $post->save();
        $post=$this->createDummyBlogPost();

        //Act
        $response = $this->get('/posts');

        //Assert 
        $response->assertSeeText('New title');
        $response->assertSeeText('No comments yet!');

        //chech if there is a record with specific atribute in database
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New title'
        ]);
    }

    public function testSee1BlogPostWithComments()
    {
        //Arrange
        $post=$this->createDummyBlogPost();

        Comment::factory()->count(4)->create([
            'blog_post_id' => $post->id
        ]);
                       
        $response = $this->get('/posts');

        $response ->assertSeeText('4 comments');


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
    
    public function testUpdateValid()
    {
        // $post = new BlogPost(); //use App\Models\BlogPost added
        // $post->title = 'New title';
        // $post->content = 'Content of blog post';
        // $post->save();
        $post=$this->createDummyBlogPost();

        //doen't work with toArray()
        //$this->assertDatabaseHas('blog_posts', $post->toArray());//toArray() convert all the attributes (columns) of blogPost instance to array and we can find exactly all the columns that BlogPost instance can have 
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New title'
        ]);
               
        $params = [
            'title' =>'A new named title.',
            'content' => 'Content was chanded.'
        ];

        $this->put("/posts/{$post->id}", $params)
            ->assertStatus(302) //302 status for successfull redirection
            ->assertSessionHas('status');  

            $this->assertEquals(session('status'), 'Blog post was updated!');                 

            $this->assertDatabaseMissing('blog_posts', $post->toArray()); 
            
            $this->assertDatabaseHas('blog_posts', [
                'title' => 'A new named title.'
            ]);
    }

    public function testDelete()
    {
        $post=$this->createDummyBlogPost();
        //$this->assertDatabaseHas('blog_posts', $post->toArray()); //doesn't work
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New title'
        ]);

        $this->delete("/posts/{$post->id}")
            ->assertStatus(302) //302 status for successfull redirection
            ->assertSessionHas('status'); 
        
        $this->assertEquals(session('status'), 'Blog post was deleted!'); 
        $this->assertDatabaseMissing('blog_posts', $post->toArray());
        
    }   

    private function createDummyBlogPost(): BlogPost
    {
        // $post = new BlogPost(); //use App\Models\BlogPost added
        // $post->title = 'New title';
        // $post->content = 'Content of blog post';
        // $post->save();

        return BlogPost::factory()->newTitle()->create();

       // return $post;
    }    

}
