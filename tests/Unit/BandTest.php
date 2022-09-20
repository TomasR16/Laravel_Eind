<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Band;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BandTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use RefreshDatabase;


    function test_bandSearch()
    {
        Band::factory()->count(5)->create();

        $first = Band::factory()->create(['band_name' => 'Name']);
        $second = Band::factory()->create(['bio' => 'Name']);

        $bands = Band::bandSearch(("Name"));

        $this->assertEquals($bands->count(), 2);

        $this->assertEquals($bands->first()->id, $first->id);

        $this->assertEquals($bands->second()->id, $second->id);
    }
}
