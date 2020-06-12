<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function showJobs()
    {
        $user = Auth::user();
        $jobs = $user->jobs;
        return view('cabinet.jobs.jobs', compact('user'));
    }
}
