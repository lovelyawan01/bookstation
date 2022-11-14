<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\category;

class BookController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:book-list|book-create|book-edit|book-delete', ['only' => ['index','show']]);
         $this->middleware('permission:book-create', ['only' => ['create','store']]);
         $this->middleware('permission:book-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:book-delete', ['only' => ['destroy']]);
    }


    public function show($slug)
    {
    	$book = Book::where('slug', $slug)->first();
    	$categories = Book::where('category_id', $book->category_id)->where('slug', '!=', $slug)->inRandomOrder()->take(4)->get();
    	return view('book/detail')->with(compact('book', 'categories'));
    }


    // public function show (product $product)
    // {
    //     $related = $product->relatedProducts(4, true)->with('categories')->get();

    //     return view('products.show', compact('product', 'related');
    // }


// $productsLike = Product::with('categories')->where('slug', '!=', $slug)->inRandomOrder()->take(4)->get();
}
