<?php

it('returns a successful response', function () {
    $response = $this->get('/');

    //assert redirected to another url
    $response->assertStatus(302);
});


use App\Models\User;

test('an action that requires authentication', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->withSession(['banned' => false])
        ->get('/');

    dd($response);

    //
});
