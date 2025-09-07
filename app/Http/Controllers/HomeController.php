<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use Illuminate\View\View;
use Throwable;

class HomeController extends Controller
{
    public function index(): View
    {
        $profile = config('profile');

        try {
            $certifications = Certification::query()
                ->published()
                ->orderBy('sort_order', 'asc')
                ->orderByDesc('issued_at')
                ->limit(6)
                ->get();
        } catch (Throwable $e) {
            // Log the failure so that issues in production aren't silently ignored
            report($e);

            // Fall back to an empty collection to keep the homepage rendering
            $certifications = collect();
        }

        return view('home', [
            'profile' => $profile,
            'certifications' => $certifications,
        ]);
    }
}
