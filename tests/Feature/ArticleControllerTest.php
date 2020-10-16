<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;


class ArticleControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;

    public function testIndex(){
        $response = $this -> get(route("articles.index"));
        $response-> assertOK() -> assertViewIs('articles.index');
    } 

    public function testGuestCreate(){
        $response = $this-> get(route("articles.create"));

        $response -> assertRedirect(route("login"));
    }

    public function testAuthCreate(){
        $user = factory(User::class)-> create();
        $response = $this -> actingAs($user) ->get(route('articles.create'));

        $response->assertStatus(200)
            ->assertViewIs('articles.create');
    }

    public function testLogin(){
        $response = $this -> get(route("login"));
        $response -> assertOK();
    }
}
