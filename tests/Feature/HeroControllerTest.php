<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class HeroControllerTest extends TestCase
{

    // Ensure that the database won't be changed after the tests
    use DatabaseTransactions;

    // Tests the list method of the HeroController
    public function testList()
    {
        // Make a GET request to the controller method
        $response = $this->get('/api/heroes-list');

        // Assert that the HTTP status code is 200
        $response->assertStatus(200);

        // Assert that the response has a Content-Type header with value application/json
        $response->assertHeader('Content-Type', 'application/json');

        // Assert that the response has a success key with value true
        $response->assertJson(['success' => true]);

        // Assert that the response has the given JSON structure
        $response->assertJsonStructure([
            'success',
            'heroes' => [
                '*' => [
                    'id',
                    'name',
                    'marvel_id',
                    'description',
                    'image_url',
                    'votes'
                ]
            ]
        ]);

        // Assert the types of the first hero in the response
        $firstHero = $response->json('heroes.0');
        $this->assertIsInt($firstHero['id']);
        $this->assertIsString($firstHero['name']);
        $this->assertIsInt($firstHero['marvel_id']);
        $this->assertIsString($firstHero['description']);
        $this->assertIsString($firstHero['image_url']);
        $this->assertIsInt($firstHero['votes']);
    }

    public function testVoteHeroSuccess()
    {
        // Create a hero record in the database and get the ID
        $hero = [
            'name' => 'Iron Man',
            'marvel_id' => 1234,
            'description' => 'Tony Stark is a genius',
            'image_url' => 'http://example.com/ironman.jpg',
            'votes' => 5
        ];
        $heroId = DB::table('marvel_heroes')->insertGetId($hero);

        // Make a POST request to the voteHero endpoint with the hero ID parameter
        $response = $this->post("/api/hero-voting/$heroId");

        // Assert that the response has the success message
        $response->assertJson(['success' => true]);

        // Assert that the hero's vote count has been incremented by 1
        $this->assertEquals(6, DB::table('marvel_heroes')->where('id', $heroId)->value('votes'));
    }


}
