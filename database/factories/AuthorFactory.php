<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Author::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
        ];
    }

    
        public function newProfile()
    {
        return $this->afterCreating(function($author) {
            $author->profile()->save(Profile::factory()->make());
        });

        return $this->afterMaking(function($author) {
            $author->profile()->save(Profile::factory()->make());
        }); //we can use after making

    }
    
}
