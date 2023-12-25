<?php

namespace App\Http\Controllers;

use App\Traits\CleanSpecialCharsTrait;
use Illuminate\Http\Request;
use App\Models\Category;

class ProductCategory extends Controller
{
    use CleanSpecialCharsTrait;

    public function index(Request $request)
    {

        if (!$request->input('search')) {
            $categories  = Category::select('name', 'uuid')->get();
            return view('pages.content.product.category')->with('categories', $categories);
        } else {
            $searchTerm = $this->cleanSpecialChars($request->input('search'));
            $searchCategories = Category::where('name', 'like', '%' . $searchTerm . '%')->get();
            return view('pages.content.product.category')->with('categories', $searchCategories);
        }
    }

    public function createCategory(Request $request)
    {
        $request->validate([
            'category' => 'required'
        ]);
        try {
            $category = new Category([
                'name' => $this->cleanSpecialChars($request->category)
            ]);
            if ($category->save()) {
                return redirect()->back()->with('success', 'added category successfully');
            };
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Application Failed');
        }
    }

    public function edit($uuid)
    {
        $category = Category::where('uuid', $uuid)->first();
        return view('pages.content.product.category')->with('category', $category);
    }
    public function update(Request $request, $uuid)
    {
        $request->validate([
            'category' => 'required',
        ]);
        $category = Category::where('uuid', $uuid)->first();
        if (!$category) {
            return redirect()->route('showCategory')->with('error', 'Data Not Found');
        }
        $category->update([
            'name' => $request->input('category'),
        ]);
        return redirect()->route('showCategory')->with('success', 'Update data successfully');
    }

    public function deleteCategory($uuid)
    {
        $product = Category::where('uuid', $uuid)->first();

        if ($product) {
            $product->delete();

            return redirect()->back()->with('success', 'Product deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Product not found');
        }
    }
}
