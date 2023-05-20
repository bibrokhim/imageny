<?php

namespace App\Http\Controllers;

use App\Services\ImageService;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('HomeIndex', [
            'imagesCount' => auth()->user()->images()->count(),
            'imagesSize' => ImageService::calculateSize(auth()->user()->images()->sum('size'))
        ]);
    }
}
