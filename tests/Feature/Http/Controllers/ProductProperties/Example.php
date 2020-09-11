<?php

namespace Tests\Feature;

use App\Models\ProductProperty;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class Example extends TestCase
{
    use RefreshDatabase, AdditionalAssertions, WithFaker;
}
