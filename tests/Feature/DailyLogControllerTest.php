<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;
use App\Models\DailyLog; 

uses(RefreshDatabase::class);

test('index method returns daily logs view', function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    
    $response = $this->get('/dailylog'); // Assuming '/dailylog' is the route to this controller's index method
    $response->assertStatus(200);
    $response->assertViewIs('dailylog.index');
});

test('create method returns create view', function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    
    $response = $this->get('/dailylog/create'); // Adjust the URL based on your route
    $response->assertStatus(200);
    $response->assertViewIs('dailylog.create');
});

test('store method saves new daily log', function () {
    $user = User::factory()->create();

    $this->actingAs($user);
    
    $data = [
        'hours_worked' => 8,
        'quality' => 5,
        'note' => 'Test note',
        // Include 'amountX' fields based on user's goals
    ];
    
    $response = $this->post('/dailylog', $data);
    
    $response->assertRedirect('/user'); // Or wherever you redirect on successful storage
    $this->assertDatabaseHas('daily_logs', [
        'note' => 'Test note',
        'user_id' => $user->id
    ]);
});

test('show method returns a daily log view for a given id', function () {
   

    $response = $this->get("/dailylog/1");
    
    $response->assertStatus(302);
 
});