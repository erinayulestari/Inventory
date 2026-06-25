<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemApiTest extends TestCase
{
    use RefreshDatabase;


    public function test_can_create_item()
    {
        $user = User::factory()->create();

        $category = Category::factory()->create();


        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/items', [
                'name' => 'Laptop Test',
                'category_id' => $category->id,
                'price' => 5000000,
                'quantity' => 10
            ]);


        $response->assertStatus(201);

        $response->assertJson([
            'success' => true
        ]);
    }

    public function test_can_get_items()
    {
        $user = User::factory()->create();


        $response = $this->actingAs($user, 'sanctum')
            ->getJson('/api/v1/items');


        $response->assertStatus(200);
    }

    public function test_can_update_item()
    {
        $user = User::factory()->create();

        $category = Category::factory()->create();

        $item = Item::factory()->create([
            'category_id' => $category->id
        ]);


        $response = $this->actingAs($user, 'sanctum')
            ->putJson('/api/v1/items/'.$item->id, [

                'name' => 'Laptop Update',
                'category_id' => $category->id,
                'price' => 6000000,
                'quantity' => 20

            ]);


        $response->assertStatus(200);
    }

    public function test_can_delete_item()
    {
        $user = User::factory()->create();

        $category = Category::factory()->create();

        $item = Item::factory()->create([
            'category_id' => $category->id
        ]);


        $response = $this->actingAs($user, 'sanctum')
            ->deleteJson('/api/v1/items/'.$item->id);

        $response->assertStatus(403);
    }

}