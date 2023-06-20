<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $points = Point::with('client')
            ->whereDate('created_at', Carbon::today())
            ->orderBy('created_at', 'DESC')
            ->get();

        return inertia('Dashboard', compact('points'));
    }
}
