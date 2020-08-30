<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriesManagmentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRouteExists()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('categories.index'));
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testATagCanBeCreated()
    {
        $this->withoutExceptionHandling();

        $expected = [
            'name' => 'Sandals',
            'slug' => 'sandals'
        ];

        $response = $this->postJson(route('categories.store'), [
            'name' => $expected['name']
            ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('categories', [
            'name' => $expected['name'],
            'slug' => $expected['slug'],
        ]);
    }

}
