<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\SiteVisit;

class HomeController extends Controller
{
    public function index()
    {
        $visitorStats = [
            'today' => $this->visitorsSince(now()->startOfDay()),
            'week'  => $this->visitorsSince(now()->startOfWeek()),
            'month' => $this->visitorsSince(now()->startOfMonth()),
            'year'  => $this->visitorsSince(now()->startOfYear()),
        ];

        $pageViewStats = [
            'today' => $this->pageViewsSince(now()->startOfDay()),
            'week'  => $this->pageViewsSince(now()->startOfWeek()),
            'month' => $this->pageViewsSince(now()->startOfMonth()),
            'year'  => $this->pageViewsSince(now()->startOfYear()),
        ];

        return view('dashboard.home', compact('visitorStats', 'pageViewStats'));
    }

    private function visitorsSince($date): int
    {
        return SiteVisit::where('visited_at', '>=', $date)
            ->distinct('visitor_key')
            ->count('visitor_key');
    }

    private function pageViewsSince($date): int
    {
        return SiteVisit::where('visited_at', '>=', $date)->count();
    }
}
