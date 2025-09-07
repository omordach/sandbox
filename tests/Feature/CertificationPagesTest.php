<?php

use App\Models\Certification;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows published certifications on index', function () {
    Certification::create([
        'title' => 'AWS Certified Cloud Practitioner',
        'issuer' => 'Amazon',
        'is_published' => true,
        'sort_order' => 0,
    ]);

    Certification::create([
        'title' => 'GCP Associate',
        'issuer' => 'Google',
        'is_published' => true,
        'sort_order' => 1,
    ]);

    $this->get('/certifications')
        ->assertOk()
        ->assertSee('AWS Certified Cloud Practitioner')
        ->assertSee('GCP Associate');
});

it('hides unpublished certifications', function () {
    Certification::create([
        'title' => 'Secret Cert',
        'issuer' => 'Hidden',
        'is_published' => false,
        'sort_order' => 0,
    ]);

    $this->get('/certifications')
        ->assertOk()
        ->assertDontSee('Secret Cert');
});

it('shows certification detail by slug', function () {
    $cert = Certification::create([
        'title' => 'Kubernetes Admin',
        'issuer' => 'CNCF',
        'is_published' => true,
        'sort_order' => 0,
    ]);

    $this->get('/certifications/' . $cert->slug)
        ->assertOk()
        ->assertSee('Kubernetes Admin');
});

it('sanitizes embed_html to only iframe', function () {
    $dirty = '<script>alert(1)</script><iframe src="https://example.com/embed" width="300" height="300" style="border:0" onclick="evil()" onload="evil()"></iframe>';

    $cert = Certification::create([
        'title' => 'Security Test',
        'issuer' => 'Unit',
        'is_published' => true,
        'embed_html' => $dirty,
    ]);

    $sanitized = $cert->fresh()->embedHtmlSafe();

    expect($sanitized)
        ->toContain('<iframe')
        ->not->toContain('<script')
        ->not->toContain('onclick')
        ->not->toContain('onload')
        ->not->toContain('style=');
});

