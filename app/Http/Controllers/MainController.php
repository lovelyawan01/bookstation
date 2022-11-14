<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\str;
use App\Author;
use App\Book;
use App\Team;
use App\Category;
use App\Media;

class MainController extends Controller
{
    public function index()
    {
    	$sliders = Media::Where(['media_type' => 'slideshow', 'status' => 'ACTIVE'])->get();
    	$upcoming_books = Book::Where('status' , 'UPCOMING')->limit(5)->get();
    	$downloaded_books = Book::with('category', 'author')->orderby('downloaded', 'DESC')->get();
    	$recomended_books = Book::Where('recommended', '1')->get();
    	$books = Book::with('author')->Where('status' , 'ACTIVE')->paginate(10);
    	$categories = Category::Where('status' , 'ACTIVE')->get();
    	$author_feature = Author::Where(['status' => 'ACTIVE', 'author_feature' => 'yes'])->inRandomOrder()->first();
    	$galleries = Media::Where(['media_type' => 'gallery', 'status' => 'ACTIVE'])->limit(6)->get();
    	return view('index')->with(compact('sliders', 'upcoming_books', 'downloaded_books', 'recomended_books', 'books', 'categories', 'author_feature', 'galleries'));
    }

    public function about()
    {
        $teams = Team::Where('status', 'ACTIVE')->limit(4)->get();
    	return view('about')->with(compact('teams'));
    }

    public function gallery()
    {
        $galleries  = Media::Where(['media_type' => 'gallery', 'status' => 'ACTIVE'])->paginate(8);
    	return view('gallery')->with(compact('galleries'));
    }

    public function blog()
    {
    	return view('blog');
    }

    public function author()
    {
        $searchTerm = request()->get('letter');
        $authors = Author::orWhere('title', 'LIKE', "$searchTerm%")->paginate(15);
        $downloaded_books = Book::orderBy('downloaded', 'DESC')->limit(5)->get();
        $author_features = Author::where('author_feature', 'yes')->limit(5)->get();
    	return view('author')->with(compact('authors', 'downloaded_books', 'author_features'));
    }

    public function author_detail($slug)
    {
        $author = Author::where('slug', $slug)->first();
        return view('author_detail')->with(compact('author'));
    }

    public function contact()
    {
    	return view('contact');
    }
}
