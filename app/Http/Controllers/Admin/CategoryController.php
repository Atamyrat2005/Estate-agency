<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'id' => 'nullable|integer|min:1',
            'name' => 'nullable|string|max:32',
            'name_en' => 'nullable|string|max:32',
            'name_ru' => 'nullable|string|max:32',
            'slug' => 'nullable|string|max:32',
            'sort_order' => 'nullable|string|max:5',
        ]);
        $f_id = $request->id ?: null;
        $f_name = $request->name ?: null;
        $f_name_en = $request->name_en ?: null;
        $f_name_ru = $request->name_ru ?: null;
        $f_slug = $request->slug ?: null;
        $f_sort_order = $request->sort_order ?: null;

        $categories = Category::when($f_id, function ($query, $f_id) {
            return $query->where('id', 'like', '%' . $f_id . '%');
        })
            ->when($f_name, function ($query, $f_name) {
                return $query->where('name', 'like', '%' . $f_name . '%');
            })
            ->when($f_name_en, function ($query, $f_name_en) {
                return $query->where('name_en', 'like', '%' . $f_name_en . '%');
            })
            ->when($f_name_ru, function ($query, $f_name_ru) {
                return $query->where('name_ru', 'like', '%' . $f_name_ru . '%');
            })
            ->when($f_slug, function ($query, $f_slug) {
                return $query->where('slug', 'like', '%' . $f_slug . '%');
            })
            ->when($f_sort_order, function ($query, $f_sort_order) {
                return $query->where('sort_order', 'like', '%' . $f_sort_order . '%');
            })
            ->orderBy('id')
            ->orderBy('sort_order')
            ->paginate(20)
            ->withQueryString();

        return view('Admin.categories.index', [
            'f_id' => $f_id,
            'f_name' => $f_name,
            'f_name_en' => $f_name_en,
            'f_name_ru' => $f_name_ru,
            'f_slug' => $f_slug,
            'f_sort_order' => $f_sort_order,
            'categories' => $categories,
        ]);
    }

    public function create(Request $slug)
    {
        $category = Category::where('slug', $slug)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->first();

        return view('admin.categories.create', [
            'category' => $category
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:32',
            'name_en'=>'required|string|max:32',
            'name_ru'=>'required|string|max:32',
            'slug'=>'required|string|max:32',
            'sort_order'=>'required|string|max:5',
        ]);

        // category
        $category = new Category();
        $category->name = $request->name;
        $category->name_en = $request->name_en;
        $category->name_ru = $request->name_ru;
        $category->slug = $request->slug;
        $category->sort_order = $request->sort_order;
        $category->save();


        $success = trans('app.store-response', ['name' => $category->name]);
        return redirect()->route('admin.categories.index', $category->slug)
            ->with([
                'success' => $success,
            ]);
    }

    public function edit($slug)
    {
        $category = Category::where('slug', $slug)
            ->orderBy('sort_order')
            ->orderBy('name')
            // ->get();
            ->first();//get() edip sonunda goysan diymek sana list geler, onam foreach bilen cagyrmaly. A sen barde birja element cagyryan diymek listyn icinde birja element bar, sonra sen blade-da goni listyn adyny sorayan, aslynda listyn yekeje elemendynyn adyny soramaly. onun ucin goni get() derek first() ullanyan. first() sheyle diymek bolyar list[0]. sana goni listyn icindaki element gelyar senem onnon goni shol elemendyn adyny cagyrayyan.

        return view('admin.categories.edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)
            ->firstOrFail();
        $request->validate([
            'name'=>'required|string|max:32',
            'name_en'=>'required|string|max:32',
            'name_ru'=>'required|string|max:32',
            'slug'=>'required|string|max:32',
            'sort_order'=>'required|string|max:5',
        ]);

        // category
        $category->name = $request->name;
        $category->name_en = $request->name_en;
        $category->name_ru = $request->name_ru;
        $category->slug = $request->slug;
        $category->sort_order = $request->sort_order;
        $category->update();


        $success = trans('app.store-response', ['name' => $category->name]);
        return redirect()->route('admin.categories.index', $category->slug)
            ->with([
                'success' => $success,
            ]);
    }

    public function delete($slug)
    {
        $category = Category::where('slug', $slug)
            ->firstOrFail();
        $success = trans('app.delete-response', ['name' => $category->name]);
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with([
                'success' => $success,
            ]);
    }
}
