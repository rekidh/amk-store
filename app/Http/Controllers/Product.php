<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;
use App\Models\Category;

class Product extends Controller
{
   public function index()
   {
      $categories  = Category::select('name', 'uuid')->get();
      $products  = Items::select('uuid', 'name', 'price', 'description')->get();
      return view('pages.content.product.product')->with(['categories' => $categories, 'products' => $products]);
   }
}
