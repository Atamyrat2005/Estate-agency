<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Estate;
use App\Models\Location;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EstateController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'id' => 'nullable|integer|min:1',
            'l' => 'nullable|string', // locations => l
            'l.*' => 'nullable|integer|min:1|distinct', // locations[] => b.*
            'c' => 'nullable|string', // categories => c
            'c.*' => 'nullable|integer|min:1|distinct', // categories[] => c.*
            'v' => 'nullable|string', // values => v
            'v.*' => 'nullable|string', // values[] => v.*
            'v.*.*' => 'nullable|integer|min:1|distinct', // values[][] => v.*.*
            'name' => 'nullable|string|max:32',
            'price' => 'nullable|integer|min:1|max:99999999999',
            'phone' => 'nullable|integer|min:61000000|max:65000000',
            'slug' => 'nullable|string|max:32',
            'description' => 'nullable|string|max:250',
            // 'n' => 'nullable|boolean', // new => n
            't' => 'nullable|boolean', // credit => t
            's' => 'nullable|boolean', // swap => s
            'y' => 'nullable|boolean', // yard => y
            'a' => 'nullable|boolean', // balcony => a
            'i' => 'nullable|boolean', // lift => i
            'image' => 'nullable|image|mimes:jpg,png',
        ]);
        $e_id = $request->id ?: null;
        $e_locations = $request->has('l') ? $request->l : '';
        $e_categories = $request->has('c') ? $request->c : '';
        $e_values = $request->has('v') ? $request->v : '';
        $e_name = $request->name ?: null;
        $e_slug = $request->slug ?: null;
        $e_price = $request->price ?: null;
        $e_phone = $request->phone ?: null;
        $e_description = $request->description ?: null;
//        $e_new = $request->n ?: null;
        $e_credit = $request->t ?: null;
        $e_swap = $request->s ?: null;
        $e_yard = $request->y ?: null;
        $e_balcony = $request->a ?: null;
        $e_lift = $request->i ?: null;
        $value = $request->v ?: null;
        $location = $request->l ?: null;
        $category = $request->c ?: null;

        $estates = Estate::when($e_id, function ($query, $e_id) {
    return $query->where('id', 'like', '%' . $e_id . '%');
})
            ->when($location, function ($query, $location) {
                return $query->where(function ($query1) use ($location) {
                    $query1->whereHas('location', function ($query2) use ($location) {
                        $query2->where('name', 'like', '%' . $location . '%');
                    });
                });
            })
            ->when($category, function ($query, $category) {
                return $query->where(function ($query1) use ($category) {
                    $query1->whereHas('category', function ($query2) use ($category) {
                        $query2->where('name', 'like', '%' . $category . '%');
                    });
                });
            })
            ->when($value, function ($query, $value) {
                return $query->where(function ($query1) use ($value) {
                    $query1->whereHas('values', function ($query2) use ($value) {
                        $query2->where('name',  'like', '%' . $value . '%');
                    });
                });
            })
            ->when($e_name, function ($query, $e_name) {
    return $query->where('name', 'like', '%' . $e_name . '%');
})
            ->when($e_slug, function ($query, $e_slug) {
    return $query->where('slug', 'like', '%' . $e_slug . '%');
})
            ->when($e_price, function ($query, $e_price) {
    return $query->where('price', 'like', '%' . $e_price . '%');
})
            ->when($e_phone, function ($query, $e_phone) {
    return $query->where('phone', 'like', '%' . $e_phone . '%');
})
            ->when($e_description, function ($query, $e_description) {
    return $query->where('description', 'like', '%' . $e_description . '%');
})
            // ->when(isset($e_new), function ($query) {
            //     return $query->where('created_at', '>', Carbon::now()->subMonth()->toDateTimeString());
            // })
            ->when(isset($e_credit), function ($query, $e_credit) {
    return $query->where('credit', $e_credit);
})
            ->when(isset($e_swap), function ($query, $e_swap) {
    return $query->where('swap', $e_swap);
})
            ->when(isset($e_yard), function ($query, $e_yard) {
    return $query->where('yard', $e_yard);
})
            ->when(isset($e_balcony), function ($query, $e_balcony) {
    return $query->where('balcony', $e_balcony);
})
            ->when(isset($e_lift), function ($query, $e_lift) {
    return $query->where('lift', $e_lift);
})
            ->with(['category:id,name,name_en','location:id,name,name_en', 'values.option'])
            ->orderBy('id')
            ->paginate(50, [
                '*'], 'page')
            ->withQueryString();
            // return $estates;

        return view('Admin.estates.index', [
            'e_id' => $e_id,
            'e_locations' => $e_locations,
            'e_categories' => $e_categories,
            'e_price' => $e_price,
            'e_name' => $e_name,
            'e_phone' => $e_phone,
            'e_slug' => $e_slug,
            'e_description' => $e_description,
            // 'e_new' => $e_new,
            'e_credit' => $e_credit,
            'e_swap' => $e_swap,
            'e_yard' => $e_yard,
            'e_lift' => $e_lift,
            'e_balcony' => $e_balcony,
            'e_values' => $e_values,
            'estates' => $estates,
        ]);
    }

    public function show(Estate $estate)
    {
        return view('Admin.estates.show', $estate->with('location', 'category', 'comment'));
    }

    public function edit($slug)
    {
        $estate = Estate::where('slug', $slug)
            ->with(['values:id'])
            ->firstOrFail();
        $categories = Category::orderBy('sort_order')
            ->orderBy('slug')
            ->get();
        $locations = Location::orderBy('sort_order')
            ->orderBy('slug')
            ->get();
        $options = Option::with(['values'])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('Admin.estates.edit', [
            'estate' => $estate,
            'categories' => $categories,
            'locations' => $locations,
            'options' => $options,
        ]);
    }

    public function update(Request $request, $slug)
    {
        $estate = Estate::where('slug', $slug)
            ->firstOrFail();
        $request->validate([
            'category_id' => 'required|integer|min:1',
            'location_id' => 'required|integer|min:1',
            'values_id' => 'required|array',
            'values_id.*' => 'required|integer|min:1|distinct',
            'name' => 'required|string|max:40',
            'price' => 'required|integer|min:1|max:99999999999',
            'phone' => 'required|integer|min:61000000|max:65999999',
            'slug' => 'required|string|max:40',
            'description' => 'nullable|string|max:2550',
            't' => 'nullable|boolean', // credit => t
            's' => 'nullable|boolean', // swap => s
            'y' => 'nullable|boolean', // yard => y
            'a' => 'nullable|boolean', // balcony => a
            'i' => 'nullable|boolean', // lift => i
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
        ]);

        // name
        $category = Category::findOrFail($request->category_id);
        $location = Location::findOrFail($request->location_id);

        // estate
        $estate->category_id = $category->id;
        $estate->location_id = $location->id;
        $estate->name = $request->name;
        $estate->slug = $request->slug;
        $estate->price = $request->price;
        $estate->phone = $request->phone;
        $estate->description = $request->description ?: null;
        $estate->credit = $request->t ?: null;
        $estate->swap = $request->s ?: null;
        $estate->yard = $request->y ?: null;
        $estate->balcony = $request->a ?: null;
        $estate->lift = $request->i ?: null;
        $estate->update();


        $estate->values()->sync($request->values_id);

        // image
        if ($request->has('image')) {
            if ($estate->image) {
                Storage::delete($estate->image);
            }
            $newImage = $request->file('image');
            $newImageName = Str::random(10) . '-' . $estate->id . '.' . $newImage->getClientOriginalExtension();
            Storage::putFileAs('public/estates/', $newImage, $newImageName);
//            $newImage->storeAs('public/estates/', $newImageName);

            $estate->image = $newImageName;
            $estate->update();
        }

        $success = trans('app.store-response', ['name' => $estate->name]);
        return redirect()->route('admin.estates.index', $estate->slug)
            ->with([
                'success' => $success,
            ]);
    }

    public function create()
    {
        $categories = Category::orderBy('sort_order')
            ->orderBy('slug')
            ->get();
        $locations = Location::orderBy('sort_order')
            ->orderBy('slug')
            ->get();
        $options = Option::with(['values'])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('Admin.estates.create', [
            'categories' => $categories,
            'locations' => $locations,
            'options' => $options,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer|min:1',
            'location_id' => 'required|integer|min:1',
            'values_id' => 'required|array',
            'values_id.*' => 'required|integer|min:1|distinct',
            'name' => 'required|string|max:40',
            'price' => 'required|integer|min:1|max:99999999999',
            'phone' => 'required|integer|min:61000000|max:65999999',
            'slug' => 'required|string|max:40',
            'description' => 'nullable|string|max:2550',
            't' => 'nullable|boolean', // credit => t
            's' => 'nullable|boolean', // swap => s
            'y' => 'nullable|boolean', // yard => y
            'a' => 'nullable|boolean', // balcony => a
            'i' => 'nullable|boolean', // lift => i
            'image' => 'nullable|image|mimes:jpg,png',
        ]);

        // name
        $category = Category::findOrFail($request->category_id);
        $location = Location::findOrFail($request->location_id);

        // estate
        $estate = new Estate();
        $estate->category_id = $category->id;
        $estate->location_id = $location->id;
        $estate->name = $request->name;
        $estate->slug = $request->slug;
        $estate->price = $request->price;
        $estate->phone = $request->phone;
        $estate->description = $request->description ?: null;
        $estate->credit = $request->t ?: null;
        $estate->swap = $request->s ?: null;
        $estate->yard = $request->y ?: null;
        $estate->balcony = $request->a ?: null;
        $estate->lift = $request->i ?: null;
        $estate->save();

        $estate->values()->sync($request->values_id);

// image
            $newImage = $request->file('image');
            $newImageName = Str::random(10) . '-' . $estate->id . '.' . $newImage->getClientOriginalExtension();
            Storage::putFileAs('public/estates/', $newImage, $newImageName);
//            $newImage->storeAs('public/estates/', $newImageName);

            $estate->image = $newImageName;
            $estate->save();

        $success = trans('app.store-response', ['name' => $estate->name]);
        return redirect()->route('admin.estates.index', $estate->slug)
            ->with([
                'success' => $success,
            ]);
    }

    public function delete($slug)
    {
        $estate = Estate::where('slug', $slug)
            ->firstOrFail();
        $success = trans('app.delete-response', ['name' => $estate->name]);
        $estate->delete();

        return redirect()->route('admin.estates.index')
            ->with([
                'success' => $success,
            ]);
    }
}

