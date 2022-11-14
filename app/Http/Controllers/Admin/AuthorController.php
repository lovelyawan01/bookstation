<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Author;
use App\Country;
use File;


class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user()->can('author-list')) {
            abort(403);
        }

        $searchTerm = request()->get('s');
    	$authors  = Author::latest()->orWhere('title', 'LIKE', "%$searchTerm%")->paginate(50);
        return view('admin/author/index')->with(compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!auth()->user()->can('author-create')) {
            abort(403);
        }

    	$countries = Country::get();
        return view('admin/author/create')->with(compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!auth()->user()->can('author-create')) {
            abort(403);
        }

        $this->validate(request(), [
            'title' => 'required',
            'slug' => 'required',
            'designation' => 'required',
            'dob' => 'required',
            'email' => 'required',   
        ]);

        $fileName = null;
        if (request()->hasFile('author_img')) {
            $file = request()->file('author_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getclientOriginalExtension();
            $file->move('./uploads/', $fileName);
        }

       Author::create([
            'title' => request()->get('title'),
            'slug' => request()->get('slug'),
            'designation' => request()->get('designation'),
            'dob' => request()->get('dob'),
            'country' => request()->get('country'),
            'email' => request()->get('email'),
            'phone' => request()->get('phone'),
            'description' => request()->get('description'),
            'author_feature' => request()->get('author_feature'),
            'facebook_id' => request()->get('facebook_id'),
            'twitter_id' => request()->get('twitter_id'),
            'youtube_id' => request()->get('youtube_id'),
            'pinterest_id' => request()->get('pinterest_id'),
            'author_img' => $fileName,
            'status' => 'DEACTIVE',
       ]);

       return redirect()->to('/admin/author');
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
        if(!auth()->user()->can('author-edit')) {
            abort(403);
        }

    	$author = Author::find($id);
    	$countries = Country::get();
        return view('admin/author/edit')->with(compact('author', 'countries'));
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
        if(!auth()->user()->can('author-edit')) {
            abort(403);
        }

         $author = Author::find($id);
        
        $currentImage = $author->author_img;
        $fileName =  null;
        if (request()->hasFile('author_img')) 
        {
            $file = request()->file('author_img');
            $fileName = md5($file->getClientOriginalName()) . time() . '.' . $file->getclientOriginalExtension();
            $file->move('./uploads', $fileName);
        }

        $author->update([
            'title' => request()->get('title'),
            'slug' => request()->get('slug'),
            'designation' => request()->get('designation'),
            'dob' => request()->get('dob'),
            'country' => request()->get('country'),
            'email' => request()->get('email'),
            'phone' => request()->get('phone'),
            'description' => request()->get('description'),
            'author_feature' => request()->get('author_feature'),
            'facebook_id' => request()->get('facebook_id'),
            'twitter_id' => request()->get('twitter_id'),
            'youtube_id' => request()->get('youtube_id'),
            'pinterest_id' => request()->get('pinterest_id'),
            'author_img' => ($fileName) ? $fileName : $currentImage,
        ]);
        if ($fileName) {
             file::delete('./uploads/' . $currentImage);
        }
        return redirect()->to('/admin/author');
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

         if ($request->ajax()) 
        {
            $author = Author::find($id); // column name must be author_id.
            $currentImage = $author->author_img;
            $author->delete();
            File::delete('./uploads/' . $currentImage);
            return 'true';
        }
    }

    public function status(Request $request, $id)
    {
        sleep(1);
        if ($request->ajax()) {
            $author = Author::find($id);
            $newStatus = ($author->status == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';
            $author->update([
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
                Author::where('id', $value)->update([ 'status' => 'ACTIVE']);
            }
            $record = Author::find($request->statusAll);
            return $record;
        }
    }

    public function statusDeactive(Request $request)
    {
        if ($request->ajax()) 
        {
            foreach ($request->statusAll as $value) {
                Author::where('id', $value)->update([ 'status' => 'DEACTIVE']);
            }
            $record = Author::find($request->statusAll);
            return $record;
        }
    }

    public function deleteAll(Request $request)
    {
        if ($request->ajax()) 
        {
            foreach ($request->statusAll as $value) {
                Author::where('id', $value)->delete();
            }
            $record = Author::find($request->statusAll);
            return $record;
        }
    }

    
}
