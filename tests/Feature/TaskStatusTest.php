<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class TaskStatusTest extends TestCase
{
    use RefreshDatabase;

    protected $taskStatus;

    protected function setUp(): void
    {
        parent::setUp();
        $this->taskStatus = TaskStatus::factory()->create();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertOk();
    }

    public function testCreate(): void
    {
        $response = $this->get(route('task_statuses.create'));
        $response->assertStatus(200);
    }

    public function testStore(): void
    {
        $task_status = TaskStatus::factory()->make()->toArray();
        $response = $this->post(route('task_statuses.store'), $task_status);
        $response->assertRedirect();
        $this->assertDatabaseHas('task_statuses', $task_status);
    }

    public function testEdit(): void
    {
        $response = $this->get(route('task_statuses.edit', ['id' => $this->taskStatus->id]));
        $response->assertStatus(200);
    }

    public function testUpdate(): void
    {
        $id = $this->taskStatus->id;
        $oldStatus = $this->taskStatus->toArray();
        $newStatus = TaskStatus::factory()->make()->toArray();
        $response = $this->patch(route('task_statuses.update', ['id' => $id]), $newStatus);
        $response->assertStatus(302);
        $this->assertDatabaseHas('task_statuses', $newStatus);
        $this->assertDatabaseMissing('task_statuses', $oldStatus);
    }

    public function testDestroy(): void
    {
        $response = $this->delete(route('task_statuses.destroy', ['id' => $this->taskStatus->id]));
        $response->assertStatus(302);
        $response->assertRedirect(route('task_statuses.index'));

        $taskStatus = [
            "name" => $this->taskStatus->name,
            "created_at"=> $this->taskStatus->created_at,
            "updated_at"=> $this->taskStatus->updated_at,
            "deleted_at"=> NULL
        ];

        $this->assertDatabaseMissing('task_statuses', $taskStatus);
    }
}
