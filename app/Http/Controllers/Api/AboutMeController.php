<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutMe;

class AboutMeController extends Controller
{
    public function index()
    {
        return response()->json(
            AboutMe::with(['experiences', 'education'])->first()
        );
    }
}
