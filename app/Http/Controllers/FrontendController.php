<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Place;
use App\Models\Post;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    public function index()
    {
        $categories = Category::has('posts')->get();
        $cities = City::where('is_active',true)->where('thumbnail_image','!=',null)->withCount(['places', 'places as post_count' => function ($query) {
            $query->whereHas('posts');
        }])->get();
        $testimonials = Testimonial::all();
        $parameters = [
           ['id' => 1, 'name' => 'Categories'],
           ['id' => 2, 'name' => 'Cities'],
           ['id' => 3, 'name' => 'Places'],
            ['id' => 4, 'name' => 'Posts'],
        ];
        return view('frontend.index',compact('categories','cities','testimonials','parameters'));
    }
    public function about(){
        return view('frontend.about-us.index');
    }
    public function contact(){
        return view('frontend.contact.index');
    }
    public function marketplace()
    {
        return view('frontend.marketplace.index');
    }
    public function city($slug){
        $city = City::where('slug',$slug)->first();
        return view('frontend.cities.show',compact('city'));
    }
    public function place($slug){
        $place = Place::where('slug',$slug)->first();
        return view('frontend.places.show',compact('place'));
    }
    public function profile($profile_slug,$profile_id){
        $user = User::where('slug',$profile_slug)->where('id',$profile_id)->first();
        return view('frontend.profile.index',compact('user'));
    }
    public function userProfile($userProfile_id)
    {
        $user = User::where('id', $userProfile_id)->first();
        return view('frontend.userprofile.index', compact('user'));
    }
    public function search(Request $request){
//        $parameters = [
//            ['id' => 1, 'name' => 'Categories'],
//            ['id' => 2, 'name' => 'Cities'],
//            ['id' => 3, 'name' => 'Places'],
//            ['id' => 4, 'name' => 'Posts'],
//        ];
        $query = $request->input('query');
        $category = $request->input('category');
        return view('frontend.search',compact('query','category'));
    }
    public function category($slug){
        $category = Category::where('slug',$slug)->first();
        return view('frontend.categories.show',compact('category'));
    }

}
