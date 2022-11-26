<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Estate;
use App\Models\Location;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cookie;

class EstateController extends Controller
{
        public function index(Request $request)
    {
        $request->validate([
            'q' => 'nullable|string|max:30', // search => q
            'l' => 'nullable|array', // locations => l
            'l.*' => 'nullable|integer|min:1|distinct', // locations[] => b.*
            'c' => 'nullable|array', // categories => c
            'c.*' => 'nullable|integer|min:1|distinct', // categories[] => c.*
            'v' => 'nullable|array', // values => v
            'v.*' => 'nullable|array', // values[] => v.*
            'v.*.*' => 'nullable|integer|min:1|distinct', // values[][] => v.*.*
            'n' => 'nullable|boolean', // new => n
            't' => 'nullable|boolean', // credit => t
            's' => 'nullable|boolean', // swap => s
            'y' => 'nullable|boolean', // yard => y
            'a' => 'nullable|boolean', // balcony => a
            'i' => 'nullable|boolean', // lift => i
        ]);
        $search = $request->q ?: null;
        $f_locations = $request->has('l') ? $request->l : [];
        $f_categories = $request->has('c') ? $request->c : [];
        $f_values = $request->has('v') ? $request->v : [];
        $f_new = $request->n ?: null;
        $f_credit = $request->t ?: null;
        $f_swap = $request->s ?: null;
        $f_yard = $request->y ?: null;
        $f_balcony = $request->a ?: null;
        $f_lift = $request->i ?: null;

        // FILTER
        $locations = Location::orderBy('sort_order')
            ->orderBy('slug')
            ->get();
        $categories = Category::orderBy('sort_order')
            ->orderBy('slug')
            ->get();
        $options = Option::with(['values'])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $estates = Estate::orderBy('slug')
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->orWhere('name', 'like', '%' . $search . '%');
                    $query->orWhere('slug', 'like', '%' . $search . '%');
                    $query->orWhere('description', 'like', '%' . $search . '%');
                });
            })
            ->when($f_locations, function ($query, $f_locations) {
                return $query->whereIn('location_id', $f_locations);
            })
            ->when($f_categories, function ($query, $f_categories) {
                return $query->whereIn('category_id', $f_categories);
            })
            ->when($f_values, function ($query, $f_values) {
                return $query->where(function ($query1) use ($f_values) {
                    foreach ($f_values as $f_value) {
                        $query1->whereHas('values', function ($query2) use ($f_value) {
                            $query2->whereIn('id', $f_value);
                        });
                    }
                });
            })
            ->when(isset($f_new), function ($query) {
                return $query->where('created_at', '>', Carbon::now()->subMonth()->toDateTimeString());
            })
            ->when(isset($f_credit), function ($query, $f_credit) {
                return $query->where('credit', $f_credit);
            })
            ->when(isset($f_swap), function ($query, $f_swap) {
                return $query->where('swap', $f_swap);
            })
            ->when(isset($f_yard), function ($query, $f_yard) {
                return $query->where('yard', $f_yard);
            })
            ->when(isset($f_balcony), function ($query, $f_balcony) {
                return $query->where('balcony', $f_balcony);
            })
            ->when(isset($f_lift), function ($query, $f_lift) {
                return $query->where('lift', $f_lift);
            })
            ->with(['category:id,name,name_en,name_ru','location:id,name,name_en,name_ru'])
            ->orderBy('random')
            ->orderBy('id', 'desc')
            ->paginate(20, [
                'id', 'category_id', 'location_id', 'name', 'slug', 'image', 'price', 'credit', 'swap', 'created_at'
            ], 'page')
            ->withQueryString();

        return view('Front.estate.index', [
            'search' => $request->q,
            'estates' => $estates,
            'locations' => $locations,
            'categories' => $categories,
            'options' => $options,
            'f_locations' => collect($f_locations),
            'f_categories' => collect($f_categories),
            'f_values' => collect($f_values)->collapse(),
            'f_new' => $f_new,
            'f_credit' => $f_credit,
            'f_swap' => $f_swap,
            'f_yard' => $f_yard,
            'f_balcony' => $f_balcony,
            'f_lift' => $f_lift,
        ]);
    }

    public function atamyrat()
    {
        return view('Front.estate.atamyrat');
    }

    public function show($slug)
    {

        $estate = Estate::where('slug', $slug)
            ->with(['values.option'])
            ->firstOrFail();

        $similar = Estate::where('id', '!=', $estate->id)
            ->with(['category:id,name,name_en','location:id,name,name_en'])
            ->inRandomOrder()
            ->take(6)
            ->get([
                'id', 'category_id', 'location_id', 'name', 'slug', 'image', 'price', 'credit', 'swap', 'yard', 'balcony', 'lift', 'created_at'
            ]);

        if (Cookie::has('store_views')) {
            $cookies = explode(",", Cookie::get('store_views'));
            if (!in_array($estate->id, $cookies)) {
                $estate->increment('viewed');
                $cookies[] = $estate->id;
                Cookie::queue('store_views', implode(",", $cookies), 60 * 24);
            }
        } else {
            $estate->increment('viewed');
            Cookie::queue('store_views', $estate->id, 60 * 24);
        }

        return view('Front.estate.show', [
            'estate' => $estate,
            'similar' => $similar,
        ]);
    }

    public function favorite($slug)
    {
        $estate = Estate::where('slug', $slug)
            ->firstOrFail();

        if (Cookie::has('store_favorites')) {
            $cookies = explode(",", Cookie::get('store_favorites'));
            if (in_array($estate->id, $cookies)) {
                $estate->decrement('favorited');
                $index = array_search($estate->id, $cookies);
                unset($cookies[$index]);
            } else {
                $estate->increment('favorited');
                $cookies[] = $estate->id;
            }
            Cookie::queue('store_favorites', implode(",", $cookies), 60 * 24);
        } else {
            $estate->increment('favorited');
            Cookie::queue('store_favorites', $estate->id, 60 * 24);
        }

        return redirect()->back();
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