<?php

namespace Tests\Modules\Admin\Feature;

use App\Models\Category;
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
        $categories = Category::factory()->count(5)->create();

        $response = $this->get(route('admin.categories.index'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin::pages.categories.index');
        $response->assertViewHas('categories');
    }
}
