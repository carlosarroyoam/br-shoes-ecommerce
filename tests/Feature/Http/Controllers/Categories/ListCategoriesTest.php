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
     * The route displays the view.
     *
     * @return void
     */
    public function test_index_displays_view()
    {
        $categories = factory(Category::class, 3)->create();

        $response = $this->get(route('categories.index'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('pages.categories.index');
        $response->assertViewHas('categories');
    }
}