<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ShowCategoriesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * The route displays the view.
     *
     * @return void
     */
    public function test_show_displays_view()
    {
        $category = Category::factory()->create();

        $response = $this->get(route('categories.show', $category));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('pages.categories.show');
        $response->assertViewHas('category', $category);
    }

    /**
     * The route doesn't display the view when the resource doesn't exist.
     *
     * @return void
     */
    public function test_show_doesnt_display_view_if_resource_doesnt_exist()
    {
        $nonExistingSlug = Str::slug($this->faker->name);

        $response = $this->get(route('categories.show', $nonExistingSlug));

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
