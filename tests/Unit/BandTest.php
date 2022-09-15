<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Band;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BandTest extends TestCase
{
    // Na elke test RefreshDatabase
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    function testBandSearch()
    {
        // Maak fake bands met static factory class
        Band::factory()->count(5)->create();
        // Maak fake data Band met name => company
        $first = Band::factory()->create(['name' => 'Name']);
        $second = Band::factory()->create(['second_name' => 'Name']);

        // Roep static method aan geef argument "company" mee
        // Deze zoekt door alle $bands voor "Name"
        $bands = Band::bandSearch("band_name");

        $this->assertEquals($bands->count(), 2);
        // De eerste is bekend
        $this->assertEquals($bands->first()->id, $first->id);
        // De tweede zou ook nog getest kunnen worden
        $this->assertEquals($bands->last()->id, $second->id);
    }


    public function test_example()
    {
        $this->assertTrue(true);
    }
}
