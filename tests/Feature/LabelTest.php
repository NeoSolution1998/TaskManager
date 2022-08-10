<?php

namespace Tests\Feature;

use App\Models\Label;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class LabelTest extends TestCase
{
    //use RefreshDatabase;

    protected $label;

    protected function setUp(): void
    {
        parent::setUp();
        $this->label = Label::factory()->create();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('labels.index'));
        $response->assertOk();
    }
    
    public function testShow(): void
    {
        $response = $this->get(route('labels.show', ['id' => $this->label->id]));
        $response->assertStatus(200);
    }

    public function testCreate(): void
    {
        $response = $this->get(route('labels.create'));
        $response->assertStatus(200);
    }

    public function testStore(): void
    {
        $label = Label::factory()->make()->toArray();
        $response = $this->post(route('labels.store'), $label);
        $response->assertRedirect();
        $this->assertDatabaseHas('labels', $label);
    }

    public function testEdit(): void
    {
        $response = $this->get(route('labels.edit', ['id' => $this->label->id]));
        $response->assertStatus(200);
    }

    public function testUpdate(): void
    {
        $id = $this->label->id;
        $oldLabel = $this->label->toArray();
        $newLabel = Label::factory()->make()->toArray();
        $response = $this->patch(route('labels.update', ['id' => $id]), $newLabel);
        $response->assertStatus(302);
        $this->assertDatabaseHas('labels', $newLabel);
        $this->assertDatabaseMissing('labels', $oldLabel);
    }

    public function testDestroy(): void
    {
        $response = $this->delete(route('labels.destroy', ['id' => $this->label->id]));
        $response->assertStatus(302);
        $response->assertRedirect(route('labels.index'));

        $label = [
            "name" => $this->label->name,
            "description" => $this->label->description,
            "created_at"=> $this->label->created_at,
            "updated_at"=> $this->label->updated_at,
            "deleted_at"=> NULL
        ];

        $this->assertDatabaseMissing('labels', $label);
    }
}
