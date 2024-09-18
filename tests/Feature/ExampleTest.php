<?php

it('returns a successful response', function () {
    $response = $this->get('/');

    //assert redirected to another url
    $response->assertStatus(302);
});
