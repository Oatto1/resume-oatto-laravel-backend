<?php

namespace App\Http\Controllers;

use App\Models\AboutMe;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Portfolio;
use App\Models\Skill;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display the portfolio homepage.
     */
    public function index()
    {
        // Fetch data for the portfolio
        // Using first() for AboutMe assuming a single record profile
        $aboutMe = AboutMe::first();

        // Fetch collections for other sections
        $experiences = Experience::orderBy('start_year', 'desc')->get();
        $educations = Education::orderBy('start_year', 'desc')->get();
        $skills = Skill::all();
        $portfolios = Portfolio::all();

        return view('welcome', compact('aboutMe', 'experiences', 'educations', 'skills', 'portfolios'));
    }
}
