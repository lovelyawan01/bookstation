<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Book;
use File;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       if(!auth()->user()->can('book-list')) {
            abort(403);
        }

    	$searchTerm = request()->get('s');
        $books = Book::latest()->orWhere('title', 'LIKE', "%$searchTerm%")->paginate(50);
        return view('admin/book/index')->with(compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       if(!auth()->user()->can('book-create')) {
            abort(403);
        }

        return view('admin/book/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       if(!auth()->user()->can('book-create')) {
            abort(403);
        }

        // $this->validate(request(), [
        // 	'title' => 'required',
        // 	'slug' => 'required',
        // 	'category' => 'required',
        // 	'author ' => 'required',
        // 	'availability ' => 'required',
        // 	'price ' => 'required',
        // 	'country_of_publisher' => 'required',
        // 	'dscription  ' => 'required',
        //   ]);

        $fileName = null;
        if (request()->hasFile('book_img')) 
        {
            $file = request()->file('book_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getclientOriginalExtension();
            $file->move('./uploads/', $fileName);
        }

        $fileName_1 = null;
        if (request()->hasFile('book_upload')) 
        {
            $file = request()->file('book_upload');
            $fileName_1 = md5($file->getClientOriginalName()) . time() . "." . $file->getclientOriginalExtension();
            $file->move('./uploads/', $fileName_1);
        }

        Book::create([
        	'category_id' => 3,
            'author_id' => 3,
            'title' => request()->get('title'),
            'slug' => request()->get('slug'),
            'availability' => request()->get('availability'),
            'price' => request()->get('price'),
            'rating' => request()->get('rating'),
            'publisher' => request()->get('publisher'),
            'countrty_of_publisher' => request()->get('countrty_of_publisher'),
            'isbn' => request()->get('isbn'),
            'isbn_10' => request()->get('isbn_10'),
            'audience' => request()->get('audience'),
            'format' => request()->get('format'),
            'language' => request()->get('language'),
            'total_pages' => request()->get('total_pages'),
            'downloaded' => request()->get('downloaded'),
            'edition_number' => request()->get('edition_number'),
            'recommended' => request()->get('recommended'),
            'description' => request()->get('description'),
            'book_img' => $fileName,
            'book_upload' => $fileName_1,
            'status' => 'DEACTIVE', 
        ]);

         return redirect()->to('/admin/book');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       if(!auth()->user()->can('book-edit')) {
            abort(403);
        }

        $book = Book::find($id);
        return view('admin/book/edit')->with(compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       if(!auth()->user()->can('book-edit')) {
            abort(403);
        }

        $book = Book::find($id); 
        $currentImage = $book->book_img;
        $currentImage_1 = $book->book_upload;
        

         $fileName =  null;
        if (request()->hasFile('book_img')) 
        {
            $file = request()->file('book_img');
            $fileName = md5($file->getClientOriginalName()) . time() . '.' . $file->getclientOriginalExtension();
            $file->move('./uploads', $fileName);
        }


         $fileName_1 =  null;
        if (request()->hasFile('book_upload')) 
        {
            $file = request()->file('book_upload');
            $fileName_1 = md5($file->getClientOriginalName()) . time() . '.' . $file->getclientOriginalExtension();
            $file->move('./uploads', $fileName_1);
        }

        $book->update([
            'category_id' => 3,
            'author_id' => 3,
            'title' => request()->get('title'),
            'slug' => request()->get('slug'),
            'availability' => request()->get('availability'),
            'price' => request()->get('price'),
            'rating' => request()->get('rating'),
            'publisher' => request()->get('publisher'),
            'countrty_of_publisher' => request()->get('countrty_of_publisher'),
            'isbn' => request()->get('isbn'),
            'isbn_10' => request()->get('isbn_10'),
            'audience' => request()->get('audience'),
            'format' => request()->get('format'),
            'language' => request()->get('language'),
            'total_pages' => request()->get('total_pages'),
            'downloaded' => request()->get('downloaded'),
            'edition_number' => request()->get('edition_number'),
            'recommended' => request()->get('recommended'),
            'description' => request()->get('description'),
            'book_img' => ($fileName) ? $fileName :  $currentImage,
            'book_upload' => ($fileName_1) ? $fileName_1 : $currentImage_1,
        ]);

        if ($fileName) {
            File::delete('./uploads/' . $currentImage);
        }

        if ($fileName_1) {
            File::delete('./uploads/' . $currentImage_1);
        }
        return redirect()->to('admin/book');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
       if(!auth()->user()->can('author-delete')) {
            abort(403);
        }

        if ($request->ajax()) {
             $book = Book::find($id); //column name must be book_id.
             $book->delete();
           return 'true'; 
        }
       
    }

    public function status(Request $request, $id)
    {
        sleep(1);
        if ($request->ajax()) {
          $book = Book::find($id);
          $newStatus = ($book->status == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';
          $book->update([
             'status' => $newStatus
          ]);

         return $newStatus;
        }
        
    }

     public function statusActive(Request $request)
    {
        if ($request->ajax()) 
        {
            foreach ($request->statusAll as $value) {
                Book::where('id', $value)->update([ 'status' => 'ACTIVE']);
            }
            $record = Book::find($request->statusAll);
            return $record;
        }
    }

    public function statusDeactive(Request $request)
    {
        if ($request->ajax()) 
        {
            foreach ($request->statusAll as $value) {
                Book::where('id', $value)->update([ 'status' => 'DEACTIVE']);
            }
            $record = Book::find($request->statusAll);
            return $record;
        }
    }

    public function deleteAll(Request $request)
    {
        if ($request->ajax()) 
        {
            foreach ($request->statusAll as $value) {
                Book::where('id', $value)->delete();
            }
            $record = Book::find($request->statusAll);
            return $record;
        }
    }

}
