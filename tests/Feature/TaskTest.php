<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Tests\TestCase;

class TaskTest extends TestCase
{
    protected User $creator;
    protected User $assigned;
    protected TaskStatus $status;

    protected function setUp(): void
    {
        parent::setUp();
        $this->creator = User::factory()->create();
        $this->assigned = User::factory()->create();
        $this->status = TaskStatus::factory()->create();
        
    }

    public function testIndex(): void
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();
    }

    public function testCreate(): void
    {
        $user = $this->actingAs($this->creator);
        $this->assertAuthenticatedAs($this->creator, $guard = null);
        $response = $this->get(route('tasks.create'));
        $response->assertStatus(200);
    }

    public function testStore(): void
    {
        $task = Task::factory()->make()->toArray();
        $task['status_id'] = $this->status->id;
        $task['created_by_id'] = $this->creator->id;
        $task['assigned_to_id'] = $this->assigned->id;


        $response = $this->actingAs($this->creator)->post(route('tasks.store'), $task);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.index'));
        $this->get(route('tasks.index'))->assertSee($task['name']);
        $this->assertDatabaseHas('tasks', $task);
    }

    public function testEdit(): void
    {
        $task = DB::table('tasks')->first();
        $response = $this->actingAs($this->creator)->get(route('tasks.edit', $task->id));
        $response->assertOk();
    }

    public function testShow(): void
    {
        $task = DB::table('tasks')->first();
        $response = $this->actingAs($this->creator)->get(route('tasks.show', $task->id));
        $response->assertOk();
    }

    public function testUpdate(): void
    {
        $task = Task::first();
        $updateTask = ["name" => 'update name', 'description' => $task->description, 'status_id' => $task->status_id];
        $response = $this->actingAs($this->creator)->patch(route('tasks.update', $task->id), $updateTask);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.index'));
    }

    public function testDestroy(): void
    {
        $task = Task::first();

        $response = $this->actingAs($this->creator)->delete(route('tasks.destroy', $task->id));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.index'));
    }

}
