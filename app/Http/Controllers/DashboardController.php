<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index(Request $request)
    {

        return view('auth.dashboard');
    }
}
