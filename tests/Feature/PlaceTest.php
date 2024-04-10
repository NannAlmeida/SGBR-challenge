<?php

namespace Tests\Feature;

use App\Models\Place;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlaceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_places()
    {
        $response = $this->getJson('/api/places');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_create_a_place()
    {
        $datas = [
            'name' => 'Elevador Lacerda',
            'slug' => 'SSA',
            'city' => 'Salvador',
            'state' => 'Bahia'
        ];

        $response = $this->postJson('/api/places', $datas);

        $response->assertStatus(201);
        $this->assertDatabaseHas('places', $datas);
    }

    /** @test */
    public function it_can_update_place()
    {
        $place = Place::factory()->create();

        $data = [
            'name' => 'Mercado Modelo'
        ];

        $response = $this->putJson('/api/places/' . $place->id, $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('places', $data);
    }

    /** @test */
    public function it_can_update_a_place()
    {
        $place = Place::factory()->create();

        $response = $this->getJson('/api/places/' . $place->id);

        $response->assertStatus(200)
                 ->assertJson([
                    'id' => $place->id,
                    'name' => $place->name,
                    'slug' => $place->slug,
                    'city' => $place->city,
                    'state' => $place->state
                 ]);
    }

    /** @test */
    public function it_can_show_a_specific_place()
    {
        $place = Place::factory()->create();

        $response = $this->getJson('/api/places/' . $place->id);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $place->id,
                'name' => $place->name,
                'slug' => $place->slug,
                'city' => $place->city,
                'state' => $place->state
            ]);
    }

    /** @test */
    public function it_can_list_places_filtered_by_name()
    {
        Place::factory()->create(['name' => 'Lugar A']);
        Place::factory()->create(['name' => 'Lugar B']);
        Place::factory()->create(['name' => 'Outro lugar']);

        $response = $this->getJson('/api/places?name=Lugar');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }
}
