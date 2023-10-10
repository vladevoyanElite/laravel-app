<?php

namespace Tests\Unit;

use App\Models\Feedback;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_store_product ()
    {
        $name = $this->faker->name;

        //Action
        $response = $this->post(route('products.store'), [
            'name' => $name,
        ]);

        //Assertion
        $response->assertStatus(201);
        $response->assertJsonFragment([
            'name' => $name,
            'quantity' => 1, //Default Quantity value
        ]);
    }

    public function test_store_product_with_wrong_name_type ()
    {
        //Action
        $response = $this->post(route('products.store'), [
            'name' => false,
        ]);

        //Assertion
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'name' => 'The name must be a string.',
        ]);
    }

    public function  test_destroy_product ()
    {
        $product = Product::factory()->create([
            'name' => 'test-name',
        ]);

        //Action
        $response = $this->delete(route('products.destroy', $product));

        //Assertion
        $response->assertStatus(204);
        $this->assertDatabaseMissing('products', [
           'id' => $product->id,
        ]);
    }

    public function test_get_product_with_feedback ()
    {
        $feedback = Feedback::factory()->create();

        $expectedResponse = [
            'data' => [
                'id' => $feedback->product->id,
                'name' => $feedback->product->name,
                'quantity' => $feedback->product->quantity,
                'feedbacks' => [[
                    'id' => $feedback->id,
                    'name' => $feedback->name,
                    'email' => $feedback->email,
                    'comment' => $feedback->comment,
                    'rating' => $feedback->rating,
                    'photo' => asset($feedback->photo),
                    'date' => $feedback->created_at,
                ]]
            ]
        ];

        //Action
        $response = $this->get(route('products.show', $feedback->product_id));

        //Assertion
        $response->assertStatus(200);
        $response->assertJsonFragment($expectedResponse);
    }

    public function test_list_products ()
    {
        $products = Product::factory()->count(5)->create();

        $response = $this->get(route('products.index'));

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'quantity',
                ],
            ],
        ]);
        $response->assertJsonCount(count($products), 'data');
        $response->assertStatus(200);
    }

}
