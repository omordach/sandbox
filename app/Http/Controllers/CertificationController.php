<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CertificationController extends Controller
{
    public function index(Request $request): View
    {
        $certifications = Certification::query()
            ->published()
            ->orderBy('sort_order', 'asc')
            ->orderByDesc('issued_at')
            ->paginate(12)
            ->withQueryString();

        return view('certifications.index', [
            'certifications' => $certifications,
        ]);
    }

    public function show(string $slug): View
    {
        $cert = Certification::query()
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('certifications.show', [
            'cert' => $cert,
        ]);
    }
}
