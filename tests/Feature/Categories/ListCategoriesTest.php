<?php

namespace Tests\Feature;

use App\Category;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ListCategoriesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_user_can_list_categories()
    {
        $this->withoutExceptionHandling();

        factory(Category::class, 5)->create();
        $categories = Category::all();

        $response = $this->get(route('categories.index'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('pages.categories.index');
        $response->assertViewHas('categories', $categories);
    }
}
