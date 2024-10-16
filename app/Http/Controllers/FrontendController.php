<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    public function index()
    {
        return view('frontend.index');
    }
    public function about()
    {
        return view('frontend.about-us.index');
    }
    public function contact()
    {
        return view('frontend.contact.index');
    }
    public function marketplace()
    {
        return view('frontend.marketplace.index');
    }
    public function city()
    {
        return view('frontend.cities.show');
    }
    public function place(){
        return view('frontend.places.show');
    }
    public function profile()
    {
        return view('frontend.profile.index');
    }
    public function userProfile()
    {
        return view('frontend.userprofile.index');
    }
    public function search()
    {
        return view('frontend.search');
    }
    public function category()
    {
        return view('frontend.categories.show');
    }
    public function services()
    {
        return view('frontend.services.index');
    }
    public function servicesDetail($id)
    {
        $service = Service::find($id);
        
        return view('frontend.services.details', compact('service'));
    }

}
