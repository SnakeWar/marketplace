<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Store;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $product;
    private $category;
    private $store;

    public function __construct(Product $product, Store $store, Category $category)
    {
        $this->product = $product;  // Usado para não chamar o caminho completo do Model quando precisar.
        $this->store = $store;
        $this->category = $category;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = $this->product->limit(6)->orderBy('id', 'DESC')->get();
        $stores = Store::limit(3)->get();

        return view('welcome', compact('products', 'stores'));
    }

    public function single($slug)
    {
        $product = $this->product->whereSlug($slug)->first();

        return view('single', compact('product'));
    }
}
