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
     * An user can retrieve the list of categories.
     *
     * @return void
     */
    public function test_a_user_can_list_categories()
    {
        factory(Category::class, 5)->create();
        $categories = Category::all();

        $response = $this->get(route('categories.index'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('pages.categories.index');
        $response->assertViewHas('categories', $categories);
    }
}
