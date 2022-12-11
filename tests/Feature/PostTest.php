<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**@test */

    public function test_can_create_a_post(){
        //Arrange
        $data =[
            'title'=> $this->faker->sentence,
            'description'=>$this->faker->paragraph
        ];
        //Asing
        $response = $this->json('Post','/api/v1/posts',$data);

        //Assert status
        $response->assertStatus(201)
        ->assertJson(compact('data'));
        //chacke data in database

        $this->assertDatabaseHas('posts',[
            'title'=>$data['title'],
            'description'=>$data['description']
        ]);
    }
}
