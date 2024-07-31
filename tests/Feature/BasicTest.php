<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Seeders\CitySeeder;
use Database\Seeders\StateSeeder;
class BasicTest extends TestCase
{
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        // $this->seed(CitySeeder::class);
        // $this->seed(StateSeeder::class);
    }
    /**
     * Test to create a new place.
     */
    public function test_create_place(): void
    {
        $formData = [
            'name' => "local legal",
            'state' => "Rondônia",
            'city' => "Alta Floresta D'Oeste"
        ]; 

        $response = $this->post('api/places/', $formData);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'id',
                    'name',
                    'state_id',
                    'city_id',
                    'state',
                    'city'
                ],
                'message'
            ]);
    }


    /**
     * Test to get all places.
     */
    public function test_get_all_places(): void
    {
        $response = $this->getJson('https://simplecrud.ddev.site/api/places?name=troca');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data',
                'message'
            ]);
    }

    /**
     * Test to get a place by ID.
     */
    public function test_get_place_by_id(): void
    {
        // Assuming the place with ID 4 exists for testing
        $placeId = 1;

        $response = $this->getJson("https://simplecrud.ddev.site/api/places/{$placeId}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'id',
                    'name',
                    'state_id',
                    'city_id'
                ],
                'message'
            ]);
    }

    /**
     * Test to update a place by ID.
     */
    public function test_update_place_by_id(): void
    {
        // Assuming the place with ID 4 exists for testing
        $placeId = 1;

        $formData = [
            'name' => 'trocado'
        ];

        $response = $this->put("https://simplecrud.ddev.site/api/places/{$placeId}", $formData);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'id',
                    'name',
                    'state_id',
                    'city_id'
                ],
                'message'
            ]);
    }
}
