<?php

declare(strict_types=1);

it('returns pong', function () {
    $response = $this->get('/ping');

    $response->assertOk();
    $response->assertSeeText('pong');
});
