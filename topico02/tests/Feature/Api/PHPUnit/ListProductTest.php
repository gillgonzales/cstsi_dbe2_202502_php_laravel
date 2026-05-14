<?php

namespace Tests\Feature\Api\PHPUnit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListProductTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_listar_todos_os_produtos(): void
    {
        //ASSETS
        $url = "api/v1/produtos";

        //ACTIONS
        $response = $this->get($url);


        //ASSERTS
        $response->assertStatus(200);
        // $response->assertJsonIsArray();
        $response->assertJsonIsObject();
        $response->assertJsonStructure(["data"]);
    }
}
