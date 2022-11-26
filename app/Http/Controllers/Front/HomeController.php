<?php

namespace App\Http\Controllers\Front;

use App\Models\Estate;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    public function index()
    {
        $new = Estate::where('created_at', '>=', Carbon::today()->subMonth()->toDateString())
            ->with(['category:id,name,name_en','location:id,name,name_en'])
            ->inRandomOrder()
            ->take(4)
            ->get([
                'id', 'category_id', 'location_id', 'name', 'slug', 'image', 'price', 'credit', 'swap', 'created_at'
            ]);

        $credit = Estate::where('credit', 1)
            ->with(['category:id,name,name_en','location:id,name,name_en'])
            ->inRandomOrder()
            ->take(4)
            ->get([
                'id', 'category_id', 'location_id', 'name', 'slug', 'image', 'price', 'credit', 'swap', 'created_at'
            ]);

        $swap = Estate::where('swap', 1)
            ->with(['category:id,name,name_en','location:id,name,name_en'])
            ->inRandomOrder()
            ->take(4)
            ->get([
                'id', 'category_id', 'location_id', 'name', 'slug', 'image', 'price', 'credit', 'swap', 'created_at'
            ]);

        $lift = Estate::where('lift', 1)
            ->with(['category:id,name,name_en','location:id,name,name_en'])
            ->inRandomOrder()
            ->take(4)
            ->get([
                'id', 'category_id', 'location_id', 'name', 'slug', 'image', 'price', 'credit', 'swap', 'created_at'
            ]);

        $balcony = Estate::where('balcony', 1)
            ->with(['category:id,name,name_en','location:id,name,name_en'])
            ->inRandomOrder()
            ->take(4)
            ->get([
                'id', 'category_id', 'location_id', 'name', 'slug', 'image', 'price', 'credit', 'swap', 'created_at'
            ]);

        $yard = Estate::where('yard', 1)
            ->with(['category:id,name,name_en','location:id,name,name_en'])
            ->inRandomOrder()
            ->take(4)
            ->get([
                'id', 'category_id', 'location_id', 'name', 'slug', 'image', 'price', 'credit', 'swap', 'created_at'
            ]);

        return view('Front.home.index', [
            'new' => $new,
            'credit' => $credit,
            'swap' => $swap,
            'lift' => $lift,
            'balcony' => $balcony,
            'yard' => $yard,
        ]);
    }

    public function language($key)
    {
        if ($key == 'en') {
            session()->put('locale', 'en');
        } elseif ($key == 'ru')  {
            session()->put('locale', 'ru');
        } else {
            session()->put('locale', 'tm');
        }
        return redirect()->back();
    }
}
