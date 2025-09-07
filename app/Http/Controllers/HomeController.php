<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $profile = config('profile');

        $certifications = Certification::query()
            ->published()
            ->orderBy('sort_order', 'asc')
            ->orderByDesc('issued_at')
            ->limit(6)
            ->get();

        return view('home', [
            'profile' => $profile,
            'certifications' => $certifications,
        ]);
    }
}
