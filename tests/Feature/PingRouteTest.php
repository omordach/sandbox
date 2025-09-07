<?php

declare(strict_types=1);

it('throttles ping endpoint after too many requests', function () {
    for ($i = 0; $i < 60; $i++) {
        $this->get('/ping')->assertOk();
    }

    $this->get('/ping')->assertStatus(429);
});
