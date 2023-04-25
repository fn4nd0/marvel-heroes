<?php

namespace Tests\Unit;

use App\Models\MarvelHero;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MarvelHeroTest extends TestCase
{
    use RefreshDatabase;

    // This is a test function to check if the Hero model can be updated correctly.
    public function testUpdateHero()
    {
        // Create a new hero with spicified attributes
        $hero = MarvelHero::create([
            'name' => 'Iron Man',
            'marvel_id' => 123456,
            'description' => 'Tony Stark is a genius',
            'image_url' => 'http://example.com/ironman.jpg',
            'votes' => 5
        ]);

        // Update the created hero's attributes
        $hero->name = 'Updated Iron Man';
        $hero->marvel_id = 567890;
        $hero->description = 'Updated description';
        $hero->image_url = 'http://example.com/updated-ironman.jpg';
        $hero->votes = 10;
        $hero->save();

        // Get the updated hero from the database
        $updatedHero = MarvelHero::find($hero->id);

        // Verify if the attributes have been updated correctly
        $this->assertEquals('Updated Iron Man', $updatedHero->name);
        $this->assertEquals(567890, $updatedHero->marvel_id);
        $this->assertEquals('Updated description', $updatedHero->description);
        $this->assertEquals('http://example.com/updated-ironman.jpg', $updatedHero->image_url);
        $this->assertEquals(10, $updatedHero->votes);
    }
}
