<?php

namespace App\Http\Controllers;

use App\Traits\CleanSpecialCharsTrait;
use Illuminate\Http\Request;
use App\Models\Items;
use App\Models\Category;

class ProductManagement extends Controller
{
    use CleanSpecialCharsTrait;

    public function index(Request $request)
    {
        $categories  = Category::select('name', 'uuid')->get();
        if (!$request->input('search')) {
            $products = Items::select('uuid', 'name', 'price', 'description', 'category_id')->with(['category'])->get();
            return view('pages.content.product.management')->with(['categories' => $categories, 'products' => $products]);
        } else {

            $searchTerm = $this->cleanSpecialChars($request->input('search'));
            $searchProducts = Items::select('uuid', 'name', 'price', 'description', 'category_id')
                ->where(function ($query) use ($searchTerm) {
                    $query->where('name', 'like', '%' . $searchTerm . '%')
                        ->orWhere('price', 'like', '%' . $searchTerm . '%')
                        ->orWhere('description', 'like', '%' . $searchTerm . '%')
                        ->orWhereHas('category', function ($subquery) use ($searchTerm) {
                            $subquery->where('name', 'like', '%' . $searchTerm . '%');
                        });
                })
                ->with(['category'])
                ->get();

            return view('pages.content.product.management')->with(['categories' => $categories, 'products' => $searchProducts]);
        }
    }

    public function createProduct(Request $request)
    {
        try {
            $request->validate([
                'product_name' => 'required',
                'product_price' => 'required',
                'category' => 'required',
                'description' => 'required'
            ]);


            $items = new Items([
                'name' => $this->cleanSpecialChars($request->product_name),
                'price' =>  $this->cleanedPrice($request->product_price),
                'description' => $this->cleanSpecialChars($request->description),
                'category_id' => Category::findOrFail($request->category)->uuid,
            ]);

            if ($items->save()) {
                return redirect()->back()->with('success', 'Added items successful');
            }
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('error', 'Register items failed');
        }
    }

    public function deleteProduct($uuid)
    {
        $product = Items::where('uuid', $uuid)->first();

        if ($product) {
            $product->delete();

            return redirect()->back()->with('success', 'Product deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Product not found');
        }
    }

    public function edit($uuid)
    {
        $categories  = Category::select('name', 'uuid')->get();
        $products = Items::where('uuid', $uuid)->first();
        return view('pages.content.product.management')->with(['categories' => $categories, 'products' => $products]);
    }
    public function update(Request $request, $uuid)
    {
        $request->validate([
            'product_name' => 'required',
            'product_price' => 'required',
            'category' => 'required',
            'description' => 'required'
        ]);
        $product = Items::where('uuid', $uuid)->first();

        if (!$product) {
            return redirect()->route('showCategory')->with('error', 'Data Not Found');
        }
        $product->update([
            'name' => $this->cleanSpecialChars($request->product_name),
            'price' => (float) $this->cleanedPrice($request->product_price),
            'description' => $this->cleanSpecialChars($request->description),
            'category_id' => Category::findOrFail($request->category)->uuid,
        ]);
        return redirect()->route('showManagementProduct')->with('success', 'Update data successfully');
    }
}
