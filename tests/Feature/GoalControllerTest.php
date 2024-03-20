<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Goal;

uses(RefreshDatabase::class);

test('index method displays the correct view for logged in user', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/goal');
    $response->assertStatus(200);
    $response->assertViewIs('goals.create');
});

test('store method saves a new goal and redirects', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $goalData = [
        'name' => 'Test Goal',
        'due_date' => now()->addWeek()->toDateString(),
        'total' => 100,
        'description' => 'Test Description',
        'user_id' => $user->id, 
        'progress' => 0,
    ];

    $response = $this->post('/goal', $goalData);
    $response->assertRedirect('/user'); 
    $this->assertDatabaseHas('goals', ['name' => 'Test Goal']);
});

test('destroy method deletes the goal and redirects', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Manually create a Goal instance
    $goal = new Goal();
    $goal->name = 'Sample Goal';
    $goal->due_date = now()->addDays(10);
    $goal->total = 100;
    $goal->description = 'Sample Description';
    $goal->progress = 0; 
    $goal->user_id = $user->id;
    $goal->save();

    $response = $this->delete("/goal/{$goal->id}");
    $response->assertRedirect('/'); // Adjust this to your actual redirect route
    $this->assertDatabaseMissing('goals', ['id' => $goal->id]);
});