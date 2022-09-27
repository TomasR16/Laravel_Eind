<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Band;
use App\Models\User;
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
        Band::factory()->count(2)->create();
        $user = User::factory()->create();

        $first = Band::factory()->create(['band_name' => 'Name']);
        $first->users()->sync($user);

        $second = Band::factory()->create(['bio' => 'Name']);
        $second->users()->sync($user);

        $bands = Band::bandSearch(("Name"));

        $this->assertEquals($bands->count(), 2);

        $this->assertEquals($bands->first()->id, $first->id);

        $this->assertEquals($bands->second()->id, $second->id);
    }
}
