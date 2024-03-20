<?php

it('returns a successful response', function () {
    $response = $this->get('/user');

    $response->assertStatus(302);
});
