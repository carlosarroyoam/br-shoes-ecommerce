<?php

namespace Tests\Feature\Http\Controllers\Users;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Users\UserController
 */
class UserControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $users = factory(User::class, 3)->create();

        $response = $this->get(route('users.index'));

        $response->assertOk();
        $response->assertViewIs('pages.users.index');
        $response->assertViewHas('users');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $user = factory(User::class)->create();

        $response = $this->get(route('users.show', $user));

        $response->assertOk();
        $response->assertViewIs('pages.users.show');
        $response->assertViewHas('user');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $user = factory(User::class)->create();

        $response = $this->get(route('users.edit', $user));

        $response->assertOk();
        $response->assertViewIs('pages.users.edit');
        $response->assertViewHas('user');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Users\UserController::class,
            'update',
            \App\Http\Requests\Users\UserUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $user = factory(User::class)->states('is_admin')->make();
        $this->actingAs($user);

        $user = factory(User::class)->create();
        $first_name = $this->faker->firstName;
        $last_name = $this->faker->lastName;
        $email = $this->faker->safeEmail;
        $password = $this->faker->password;
        $is_admin = $this->faker->boolean;

        $response = $this->put(route('users.update', $user), [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $password,
            'is_admin' => $is_admin,
        ]);

        $user->refresh();

        $response->assertRedirect(route('users.index'));
        $response->assertSessionHas('user.id', $user->id);

        $this->assertEquals($first_name, $user->first_name);
        $this->assertEquals($last_name, $user->last_name);
        $this->assertEquals($email, $user->email);
        $this->assertEquals($password, $user->password);
        $this->assertEquals($is_admin, $user->is_admin);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $user = factory(User::class)->states('is_admin')->make();
        $this->actingAs($user);

        $user = factory(User::class)->create();

        $response = $this->delete(route('users.destroy', $user));

        $response->assertRedirect(route('users.index'));

        $this->assertSoftDeleted('users', $user);
    }
}
