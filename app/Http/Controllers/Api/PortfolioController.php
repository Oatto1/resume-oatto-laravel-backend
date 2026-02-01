<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;

class PortfolioController extends Controller
{
    public function index()
    {
        return response()->json(
            Portfolio::with('images')
                ->orderBy('id')
                ->get()
        );
    }

    public function show($id)
    {
        return response()->json(
            Portfolio::with('images')
                ->findOrFail($id)
        );
    }
}