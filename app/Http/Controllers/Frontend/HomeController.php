<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Partner;
use App\Models\Service;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $services      = Service::active()->orderBy('sort_order')->limit(6)->get();
        $servicesTotal = Service::active()->count();
        $testimonials  = Testimonial::where('status', 'active')->limit(6)->get();
        $partners      = Partner::all();
        $faqs          = Faq::where('status', 'active')->take(6)->get();
        return view('front.home', compact('services', 'servicesTotal', 'testimonials', 'partners', 'faqs'));
    }
}