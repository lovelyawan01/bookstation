<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Book;

class CategoryController extends Controller
{
    public function show($slug)
    {
    	$category = Category::where('slug', $slug)->first();
    	$books = Book::where('category_id', $category->id)->paginate(10);
    	$categories = Category::where('status', 'ACTIVE')->get();

    	return view('category/detail')->with(compact('category', 'books', 'categories'));
    }
}
