<?php

declare(strict_types=1);

it('is healthy', function () {
    $response = $this->get('/ping');

    $response->assertOk();
    $response->assertSeeText('pong');
});
