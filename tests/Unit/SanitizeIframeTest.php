<?php

declare(strict_types=1);

use App\Helpers\Sanitize;

it('strips external entities when sanitizing iframe html', function () {
    $html = '<!DOCTYPE foo [<!ENTITY xxe SYSTEM "http://example.com">]><iframe src="https://example.com">&xxe;</iframe>';

    $sanitized = Sanitize::iframe($html);

    expect($sanitized)->toBe('<iframe src="https://example.com" title="Credly badge">&amp;xxe;</iframe>');
});
