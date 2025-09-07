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
            $certifications = collect();
        }

        return view('home', [
            'profile' => $profile,
            'certifications' => $certifications,
        ]);
    }
}
